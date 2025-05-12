<?php
require_once 'include/init.php';

function insertBarangay($pdo, $barangayName) {
    $stmt = $pdo->prepare("INSERT IGNORE INTO barangays (name) VALUES (?)");
    $stmt->execute([$barangayName]);
    
    $stmt = $pdo->prepare("SELECT id FROM barangays WHERE name = ?");
    $stmt->execute([$barangayName]);
    return $stmt->fetchColumn();
}

function insertBuilding($pdo, $data) {
    // Get or create barangay
    $barangayId = insertBarangay($pdo, $data['barangay']);
    
    $sql = "INSERT INTO buildings (
        name, barangay_id, location, height, storey_count, 
        construction_year, building_type, structure_type, 
        occupancy, design_occupancy, occupant_count, 
        nscp_edition_year, is_original
    ) VALUES (
        :name, :barangay_id, :location, :height, :storey_count,
        :construction_year, :building_type, :structure_type,
        :occupancy, :design_occupancy, :occupant_count,
        :nscp_edition_year, :is_original
    )";
    
    $stmt = $pdo->prepare($sql);
    
    // Clean height value (remove 'm' and convert to decimal)
    $height = str_replace(['m', ' '], '', $data['height']);
    
    // Clean storey count (extract number)
    $storeyCount = (int) preg_replace('/[^0-9]/', '', $data['storey_count']);
    
    $stmt->execute([
        'name' => $data['name'],
        'barangay_id' => $barangayId,
        'location' => $data['location'],
        'height' => $height,
        'storey_count' => $storeyCount,
        'construction_year' => $data['construction_year'],
        'building_type' => $data['building_type'],
        'structure_type' => $data['structure_type'],
        'occupancy' => $data['occupancy'],
        'design_occupancy' => $data['design_occupancy'],
        'occupant_count' => $data['occupant_count'],
        'nscp_edition_year' => $data['nscp_edition_year'],
        'is_original' => $data['is_original']
    ]);
}

// Read CSV file
$file = fopen('assets/BUILDING INFORMATION.csv', 'r');

// Skip header rows
fgetcsv($file); // Skip first header row
fgetcsv($file); // Skip second header row

// Process each row
while (($row = fgetcsv($file)) !== FALSE) {
    if (empty($row[0])) continue; // Skip empty rows
    
    $data = [
        'name' => $row[1],
        'barangay' => $row[2],
        'location' => $row[2],
        'height' => $row[3],
        'storey_count' => $row[4],
        'construction_year' => $row[5],
        'building_type' => $row[6],
        'structure_type' => $row[7],
        'occupancy' => $row[8],
        'design_occupancy' => $row[9],
        'occupant_count' => $row[10],
        'nscp_edition_year' => $row[11],
        'is_original' => $row[12]
    ];
    
    try {
        insertBuilding($pdo, $data);
        echo "Imported: " . $data['name'] . "\n";
    } catch (Exception $e) {
        echo "Error importing " . $data['name'] . ": " . $e->getMessage() . "\n";
    }
}

fclose($file);
echo "Import completed!\n";
?> 