<?php
echo "<!-- BARANGAY_PHP_INCLUDED_MARKER -->\n";
require_once __DIR__ . '/../include/config.php';
$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
$barangays = $pdo->query("SELECT id, name FROM barangays ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Barangay Button Test</title>
    <style>
        .barangay-btn { margin: 5px; padding: 10px; }
    </style>
</head>
<body>
<h2>Barangay Button Test</h2>
<div class="barangay-list">
<?php foreach ($barangays as $index => $barangay): ?>
    <button class="barangay-btn <?php echo ($index === 0) ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
        <?php echo htmlspecialchars($barangay['name']); ?>
    </button>
<?php endforeach; ?>
</div>
</body>
</html> 