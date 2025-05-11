<?php
require_once '../config.php';

// Check if user is logged in
if (!isset($_SESSION['cms_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Start transaction
        $pdo->beginTransaction();
        
        // Insert building
        $stmt = $pdo->prepare("INSERT INTO buildings (name, barangay, description) VALUES (?, ?, ?)");
        $stmt->execute([
            $_POST['building_name'],
            $_POST['barangay'],
            $_POST['description'] ?? ''
        ]);
        
        $building_id = $pdo->lastInsertId();
        
        // Create upload directory
        $upload_dir = UPLOAD_PATH . '/' . $building_id;
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Handle photo uploads
        if (isset($_FILES['photos'])) {
            $photo_count = 0;
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
                if ($photo_count >= 10) break; // Max 10 photos
                
                if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                    $filename = uniqid() . '_' . $_FILES['photos']['name'][$key];
                    $destination = $upload_dir . '/' . $filename;
                    
                    if (move_uploaded_file($tmp_name, $destination)) {
                        $stmt = $pdo->prepare("INSERT INTO photos (building_id, filename) VALUES (?, ?)");
                        $stmt->execute([$building_id, $filename]);
                        $photo_count++;
                    }
                }
            }
        }
        
        // Handle PDF uploads
        if (isset($_FILES['documents'])) {
            foreach ($_FILES['documents']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['documents']['error'][$key] === UPLOAD_ERR_OK) {
                    $filename = uniqid() . '_' . $_FILES['documents']['name'][$key];
                    $destination = $upload_dir . '/' . $filename;
                    
                    if (move_uploaded_file($tmp_name, $destination)) {
                        $stmt = $pdo->prepare("INSERT INTO documents (building_id, filename) VALUES (?, ?)");
                        $stmt->execute([$building_id, $filename]);
                    }
                }
            }
        }
        
        // Insert audit summaries
        $audit_types = ['infrastructure', 'fire_safety', 'accessibility'];
        foreach ($audit_types as $type) {
            if (!empty($_POST[$type . '_summary'])) {
                $stmt = $pdo->prepare("INSERT INTO audits (building_id, type, summary) VALUES (?, ?, ?)");
                $stmt->execute([$building_id, $type, $_POST[$type . '_summary']]);
            }
        }
        
        $pdo->commit();
        $success = "Building audit added successfully!";
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Dashboard - Maragondon Audit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-main mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">CMS Dashboard</a>
            <div class="navbar-nav ms-auto">
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Add New Building Audit</h2>
                <form method="POST" enctype="multipart/form-data">
                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h4>Basic Information</h4>
                        <div class="mb-3">
                            <label for="building_name" class="form-label">Building Name</label>
                            <input type="text" class="form-control" id="building_name" name="building_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Audit Summaries -->
                    <div class="mb-4">
                        <h4>Audit Summaries</h4>
                        <div class="mb-3">
                            <label for="infrastructure_summary" class="form-label">Infrastructure Summary</label>
                            <textarea class="form-control" id="infrastructure_summary" name="infrastructure_summary" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fire_safety_summary" class="form-label">Fire Safety Summary</label>
                            <textarea class="form-control" id="fire_safety_summary" name="fire_safety_summary" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="accessibility_summary" class="form-label">Accessibility Summary</label>
                            <textarea class="form-control" id="accessibility_summary" name="accessibility_summary" rows="3" required></textarea>
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div class="mb-4">
                        <h4>Photos (Max 10)</h4>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="photos[]" accept="image/*" multiple required>
                            <small class="text-muted">Select up to 10 photos</small>
                        </div>
                    </div>

                    <!-- PDF Upload -->
                    <div class="mb-4">
                        <h4>PDF Documents (Optional)</h4>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="documents[]" accept=".pdf" multiple>
                            <small class="text-muted">Select up to 3 PDF files</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-main">Submit Audit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 