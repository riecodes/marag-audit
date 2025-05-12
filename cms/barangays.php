<?php
require_once 'includes/header.php';

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
        
        // Process CSV input
        $barangays = array_filter(
            array_map('trim', explode("\n", $_POST['barangays']))
        );
        
        $stmt = $pdo->prepare("INSERT IGNORE INTO barangays (name) VALUES (?)");
        foreach ($barangays as $barangay) {
            if (!empty($barangay)) {
                $stmt->execute([$barangay]);
            }
        }
        
        $pdo->commit();
        $success = "Barangays added successfully!";
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Error: " . $e->getMessage();
    }
}

// Fetch existing barangays
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM barangays ORDER BY name");
    $existing_barangays = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $existing_barangays = [];
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Add Barangays</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="barangays" class="form-label">Enter Barangay Names (one per line)</label>
                        <textarea class="form-control" id="barangays" name="barangays" rows="10" required></textarea>
                        <small class="text-muted">Enter one barangay name per line</small>
                    </div>
                    <button type="submit" class="btn btn-main">Import Barangays</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Existing Barangays</h2>
                <?php if (empty($existing_barangays)): ?>
                    <p class="text-muted">No barangays added yet.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Added On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($existing_barangays as $barangay): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($barangay['name']); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($barangay['created_at'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 