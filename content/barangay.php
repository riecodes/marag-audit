<?php

// Fetch unique barangays from the database
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT DISTINCT barangay FROM buildings ORDER BY barangay");
    $barangays = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $barangays = [];
}
?>
<section class="barangay-section">
    <div class="barangay-content">
        <div class="explore-map">
            <img src="../assets/maps/marag map outline.png" alt="Maragondon Map">
        </div>
        <div class="barangay-list">
            <?php foreach ($barangays as $barangay): ?>
                <a href="#" class="barangay-btn"><?php echo htmlspecialchars($barangay); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
