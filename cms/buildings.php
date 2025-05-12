<?php
require_once 'includes/header.php';

// Fetch barangays for dropdown
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM barangays ORDER BY name");
    $barangays = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $barangays = [];
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
        $stmt = $pdo->prepare("INSERT INTO buildings (
            name, barangay_id, location, height, storey_count, 
            building_type, construction_year, structure_type, 
            design_occupancy, nscp_edition_year
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $_POST['building_name'],
            $_POST['barangay_id'],
            $_POST['location'],
            $_POST['height'],
            $_POST['storey_count'],
            $_POST['building_type'],
            $_POST['construction_year'],
            $_POST['structure_type'],
            $_POST['design_occupancy'],
            $_POST['nscp_edition_year']
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
        
        // Insert audit summaries
        $audit_types = ['infrastructure', 'fire_safety', 'accessibility'];
        foreach ($audit_types as $type) {
            if (!empty($_POST[$type . '_summary'])) {
                $stmt = $pdo->prepare("INSERT INTO audits (building_id, type, summary) VALUES (?, ?, ?)");
                $stmt->execute([$building_id, $type, $_POST[$type . '_summary']]);
            }
        }
        
        $pdo->commit();
        $success = "Building added successfully!";
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Error: " . $e->getMessage();
    }
}
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Add New Building</h2>
                <form method="POST" enctype="multipart/form-data">
                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h4>Basic Information</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="building_name" class="form-label">Building Name</label>
                                <input type="text" class="form-control" id="building_name" name="building_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="barangay_id" class="form-label">Barangay</label>
                                <select class="form-control" id="barangay_id" name="barangay_id" required>
                                    <option value="">-- Select Barangay --</option>
                                    <?php foreach ($barangays as $b): ?>
                                        <option value="<?php echo $b['id']; ?>"><?php echo htmlspecialchars($b['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="height" class="form-label">Height (meters)</label>
                                <input type="number" step="0.01" class="form-control" id="height" name="height" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="storey_count" class="form-label">No. of Storey</label>
                                <input type="number" class="form-control" id="storey_count" name="storey_count" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="building_type" class="form-label">Building Type</label>
                                <input type="text" class="form-control" id="building_type" name="building_type" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="construction_year" class="form-label">Year of Construction</label>
                                <input type="number" class="form-control" id="construction_year" name="construction_year" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="structure_type" class="form-label">Type of Structure</label>
                                <input type="text" class="form-control" id="structure_type" name="structure_type" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="design_occupancy" class="form-label">Design Occupancy</label>
                                <input type="text" class="form-control" id="design_occupancy" name="design_occupancy" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nscp_edition_year" class="form-label">Year Ed. of NSCP</label>
                                <input type="number" class="form-control" id="nscp_edition_year" name="nscp_edition_year" required>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Summaries -->
                    <div class="mb-4">
                        <h4>Audit Summaries</h4>
                        <div class="mb-3">
                            <label for="infrastructure_summary" class="form-label">Infrastructure Summary</label>
                            <textarea class="form-control" id="infrastructure_summary" name="infrastructure_summary" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fire_safety_summary" class="form-label">Fire Safety Summary</label>
                            <textarea class="form-control" id="fire_safety_summary" name="fire_safety_summary" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="accessibility_summary" class="form-label">Accessibility Summary</label>
                            <textarea class="form-control" id="accessibility_summary" name="accessibility_summary" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div class="mb-4">
                        <h4>Photos (Max 10)</h4>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="photos[]" accept="image/*" multiple>
                            <small class="text-muted">Select up to 10 photos</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-main">Add Building</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Bulk Import Buildings</h2>
                <form method="POST" enctype="multipart/form-data" action="import_buildings.php">
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Upload Excel File</label>
                        <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xlsx,.xls" required>
                        <small class="text-muted">Upload an Excel file with building information. <a href="templates/buildings_template.xlsx">Download template</a></small>
                    </div>
                    <button type="submit" class="btn btn-main">Import Buildings</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 