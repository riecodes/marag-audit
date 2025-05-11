<?php

$barangay = $_GET['name'] ?? '';
if (empty($barangay)) {
    header('Location: explore.php');
    exit;
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get buildings in this barangay
    $stmt = $pdo->prepare("SELECT * FROM buildings WHERE barangay = ? ORDER BY name");
    $stmt->execute([$barangay]);
    $buildings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Error: " . $e->getMessage();
}
?>
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php?section=explore">Explore</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($barangay); ?></li>
        </ol>
    </nav>

    <h1 class="text-center mb-4">Buildings in <?php echo htmlspecialchars($barangay); ?></h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (empty($buildings)): ?>
        <div class="alert alert-info">No buildings found in this barangay.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($buildings as $building): ?>
            <div class="col">
                <div class="card h-100 card-hover">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($building['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($building['description'] ?? ''); ?></p>
                        <a href="index.php?section=building&id=<?php echo $building['id']; ?>" class="btn btn-main">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div> 