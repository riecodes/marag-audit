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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Information</title>
    <link rel="stylesheet" href="../css/barangay.css">
    <style>
        body { background: #e5e5e5; }
        .building-info-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 0;
            margin: 2rem auto;
            max-width: 1000px;
            background: #e5e5e5;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        .info-panel {
            background: #42939e;
            color: #f3f3e7;
            flex: 1 1 50%;
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: 8px 0 0 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-width: 320px;
        }
        .info-panel h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        .info-list {
            font-size: 1.15rem;
            margin-bottom: 2.5rem;
        }
        .info-list span.label {
            font-weight: bold;
            display: inline-block;
            min-width: 170px;
        }
        .audit-btn {
            display: inline-block;
            background: #8a5a63;
            color: #f3f3e7;
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            border: none;
            border-radius: 3px;
            margin-top: 1.5rem;
            text-decoration: underline;
            cursor: pointer;
            transition: background 0.2s;
        }
        .audit-btn:hover {
            background: #a97b8a;
        }
        .photo-panel {
            flex: 1 1 50%;
            background: #fff;
            border-radius: 0 8px 8px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .photo-panel img {
            width: 100%;
            max-width: 420px;
            height: 320px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }
        .photo-panel h2 {
            color: #2a3a4a;
            font-size: 2rem;
            font-weight: bold;
            margin: 1.2rem 0 0.5rem 0;
            text-shadow: 1px 1px 2px #fff, 0 2px 8px rgba(0,0,0,0.08);
        }
        .photo-panel h3 {
            color: #2a3a4a;
            font-size: 1.2rem;
            font-weight: 400;
            margin: 0 0 1rem 0;
        }
        @media (max-width: 900px) {
            .building-info-container { flex-direction: column; }
            .info-panel, .photo-panel { border-radius: 8px 8px 0 0; }
            .photo-panel { border-radius: 0 0 8px 8px; }
        }
    </style>
</head>
<body>
    <div class="building-info-container">
        <div class="info-panel">
            <div>
                <h2>BUILDING INFORMATION</h2>
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
            <a href="#" class="audit-btn">Building Audit &nbsp; &raquo;&raquo;</a>
        </div>
        <div class="photo-panel">
            <img src="<?php echo htmlspecialchars($main_photo); ?>" alt="Building Photo">
            <h2><?php echo safe($building['name'] ?? null); ?></h2>
        </div>
    </div>
</body>
</html> 