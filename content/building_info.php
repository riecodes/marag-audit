<?php
require_once __DIR__ . '/../include/config.php';
$building_id = isset($_GET['building_id']) ? intval($_GET['building_id']) : 0;
$building = null;
$main_photo = '../assets/photo-docs/!main-pictures-buildings/0-MAIN-PHOTO.jpg';

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM buildings WHERE id = ?");
    $stmt->execute([$building_id]);
    $building = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($building) {
        $photoStmt = $pdo->prepare("SELECT file_path FROM building_media WHERE building_id = ? AND category = 'main_photo' LIMIT 1");
        $photoStmt->execute([$building_id]);
        $photo = $photoStmt->fetchColumn();
        if ($photo) {
            $main_photo = '../' . $photo;
        }
    }
} catch (PDOException $e) {
    $building = null;
}
function safe($val) {
    return $val ? htmlspecialchars($val) : 'N/A';
}
?>
<section class="barangay-section building-info-section">
    <div class="barangay-content">
        <div class="building-info-card">
            <div class="info-panel">
                <div>
                    <h2 class="info-title">BUILDING INFORMATION</h2>
                    <div class="info-list">
                        <div><span class="label">Building Name:</span> <?php echo safe($building['name'] ?? null); ?></div>
                        <div><span class="label">Location:</span> <?php echo safe($building['location'] ?? null); ?></div>
                        <div><span class="label">Height:</span> <?php echo safe($building['height'] ?? null); ?></div>
                        <div><span class="label">No. of Storey:</span> <?php echo safe($building['storey_count'] ?? null); ?></div>
                        <div><span class="label">Building Type:</span> <?php echo safe($building['building_type'] ?? null); ?></div>
                        <div><span class="label">Year of Construction:</span> <?php echo safe($building['construction_year'] ?? null); ?></div>
                        <div><span class="label">Type of Structure:</span> <?php echo safe($building['structure_type'] ?? null); ?></div>
                        <div><span class="label">Design Occupancy:</span> <?php echo safe($building['design_occupancy'] ?? null); ?></div>
                        <div><span class="label">Year Ed. of NSCP:</span> <?php echo safe($building['nscp_edition_year'] ?? null); ?></div>
                    </div>
                </div>
                <a href="index.php?section=building_audit&building_id=<?php echo $building_id; ?>" class="building-audit-btn">
                    <p>Building Audit <span class="material-icons">arrow_forward</span></p>
                </a>
            </div>
            <div class="photo-panel">
                <img src="<?php echo htmlspecialchars($main_photo); ?>" alt="Building Photo">
                <h2 class="photo-title"><?php echo safe($building['name'] ?? null); ?></h2>
            </div>
        </div>
    </div>
</section>