<?php
require_once 'include/init.php';

// Get all buildings with their barangays
$stmt = $pdo->query("
    SELECT b.name as building_name, br.name as barangay_name 
    FROM buildings b 
    JOIN barangays br ON b.barangay_id = br.id 
    ORDER BY br.name, b.name
");

echo "Current Buildings in Database:\n";
echo "=============================\n";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Building: {$row['building_name']}\n";
    echo "Barangay: {$row['barangay_name']}\n";
    echo "-----------------------------\n";
}
?> 