<?php
require_once 'include/init.php';

// Initialize log arrays
$successLogs = [];
$errorLogs = [];

// Function to log messages
function logMessage($message, $isError = false) {
    global $successLogs, $errorLogs;
    if ($isError) {
        $errorLogs[] = $message;
    } else {
        $successLogs[] = $message;
    }
}

// Function to get building ID by name and barangay
function getBuildingId($pdo, $buildingName, $barangayName) {
    // Barangay name corrections
    $barangayCorrections = [
        'Poblacion 3 (CAINGIN)' => 'Caingin'
    ];
    $barangayName = $barangayCorrections[$barangayName] ?? $barangayName;

    // Name mapping for variations
    $nameVariations = [
        // Bucal 1
        'Multi-purpose Hall Bucal 1' => 'Multipurpose Hall Bucal 1',
        
        // Bucal 2
        'BH BUCAL 2' => 'Multipurpose Hall Bucal 2',
        'BNIS - ABM Bldg' => 'Bucal National Integrated School - ABM Building',
        'BNIS - HUMSS Bldg' => 'Bucal National Integrated School - HUMMS Building',
        'BNIS - PagCor' => 'Bucal National Integrated School - PAGCOR',
        'BNIS - PagCor .PNG' => 'Bucal National Integrated School - PAGCOR',
        'BNIS - SH Lab' => 'Bucal National Integrated School - SH Laboratory',
        'BNIS - Sigla Bldg' => 'Bucal National Integrated School - SIGLA Building',
        'BNIS - Stockroom' => 'Bucal National Integrated School - Stockroom Building',
        'BNIS - Stockroom .PNG' => 'Bucal National Integrated School - Stockroom Building',
        'BNIS-Encantadia' => 'Bucal National Integrated School - Encantadia Building',
        
        // Bucal 3A
        'Brgy Hall Bucal 3A' => 'Barangay Hall Bucal 3A',
        
        // Bucal 3B
        'BH Bucal 3' => 'Barangay Hall Bucal 3B',
        'BH Bucal 3 .PNG' => 'Barangay Hall Bucal 3B',
        
        // Bucal 4A
        'BH Bucal 4A' => 'Barangay Hall Bucal 4A',
        
        // Bucal 4B
        'BH Bucal 4B' => 'Multipurpose Hall Bucal 4B',
        
        // Garita A
        'MES Bldg 2' => 'Maragondon Elementary School - Building 2',
        'MES - Bldg 1' => 'Maragondon Elementary School - Building 1',
        'MES - Bldg 3' => 'Maragondon Elementary School - Building 3',
        'MHS - Bldg 1' => 'Maragondon National High School - Building 1',
        'MHS - Bldg 2' => 'Maragondon National High School - Building 2',
        'Municipal Trial Court' => 'Municipal Circuit Trial Court',
        'Police Station' => 'Maragondon Police Station',
        
        // Garita B
        'CSIS-RSHS Beautycare NC2 Bldg 10' => 'CSIS-RSHS - Beautycare N.C 2 Building 10',
        'CSIS-RSHS Maliksi Bldg 5' => 'CSIS-RSHS - Maliksi Building 5',
        'CSIS-RSHS Modifired School Bldg 6' => 'CSIS-RSHS - Modified School Building 6',
        'CSIS-RSHS Science Laboratory Bldg 9' => 'CSIS-RSHS - Science Laboratory Building 9',
        'CSIS-RSHS Standard School Bldg 7' => 'CSIS-RSHS - DepEd Standard School Building 7',
        'CSIS - Bldg 14' => 'CSIS-RSHS - Science Laboratory Building 14',
        'CSIS - Standard School Building - Bldg 4' => 'CSIS-RSHS - DepEd Standard School Building 4',
        
        // Pinagsanhan B
        'CvSU Marag - ES Bldg' => 'CvSU - Maragondon Campus - Elementary Building',
        'CvSU Marag - HS Bldg' => 'CvSU - Maragondon Campus - High School Building',
        
        // Poblacion 1A
        'DILG Bldg' => 'Municipal Environment and Natural Resources Office/Municipal Tourism Office',
        'MTO & MENRO' => 'Municipal Environment and Natural Resources Office/Municipal Tourism Office',
        'Mayor\'s Office' => 'Office of the Mayor - Third Building',
        'Mayor\'s Office.PNG' => 'Office of the Mayor - Third Building',
        'Multi-Purpose Hall Poblacion 1A' => 'Multipurpose Hall Poblacion 1A',
        'Municipa Hall' => 'Municipal hall of Maragondon - Main Building',
        
        // Poblacion 1B
        'BH Poblacion 1B' => 'Multipurpose Hall Poblacion 1B',
        
        // Poblacion 2B
        'BH Poblacion 2B' => 'Barangay Hall Poblacion 2B',
        'MDRRMO' => 'Municipal Disaster Risk Reduction Management Office',
        'MDRRMO .PNG' => 'Municipal Disaster Risk Reduction Management Office',
        
        // Caingin
        'BH Poblacion 3 (Caingin)' => 'Barangay Hall Caingin',
        'BH Poblacion 3 (Caingin).PNG' => 'Barangay Hall Caingin',
        'Multi-Purpose Hall Poblacion 3 (Caingin)' => 'Multipurpose Hall Caingin',
        'Multi-Purpose Hall Poblacion 3 (Caingin).PNG' => 'Multipurpose Hall Caingin'
    ];
    
    // Try with mapped name if it exists
    $mappedName = $nameVariations[$buildingName] ?? $buildingName;
    
    // Normalize case for comparison
    $mappedName = ucwords(strtolower($mappedName));
    $barangayName = ucwords(strtolower($barangayName));
    
    // Debug logging
    logMessage("Debug - Looking for building: $buildingName");
    logMessage("Debug - Mapped to: $mappedName");
    logMessage("Debug - In barangay: $barangayName");
    
    // First try exact match
    $stmt = $pdo->prepare("
        SELECT b.id 
        FROM buildings b 
        JOIN barangays br ON b.barangay_id = br.id 
        WHERE LOWER(b.name) = LOWER(?) AND LOWER(br.name) = LOWER(?)
    ");
    $stmt->execute([$mappedName, $barangayName]);
    $buildingId = $stmt->fetchColumn();

    // If not found, try partial match
    if (!$buildingId) {
        $stmt = $pdo->prepare("
            SELECT b.id 
            FROM buildings b 
            JOIN barangays br ON b.barangay_id = br.id 
            WHERE LOWER(b.name) LIKE LOWER(?) AND LOWER(br.name) = LOWER(?)
        ");
        $stmt->execute(['%' . str_replace(' ', '%', $mappedName) . '%', $barangayName]);
        $buildingId = $stmt->fetchColumn();
    }

    // If building not found, log available buildings for debugging
    if (!$buildingId) {
        $stmt = $pdo->prepare("
            SELECT b.name 
            FROM buildings b 
            JOIN barangays br ON b.barangay_id = br.id 
            WHERE LOWER(br.name) = LOWER(?)
            ORDER BY b.name
        ");
        $stmt->execute([$barangayName]);
        $availableBuildings = $stmt->fetchAll(PDO::FETCH_COLUMN);
        logMessage("Available buildings in $barangayName: " . implode(", ", $availableBuildings), true);
    } else {
        logMessage("Debug - Found building ID: $buildingId");
    }

    return $buildingId;
}

// Function to check if media already exists
function mediaExists($pdo, $buildingId, $filePath) {
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM building_media 
        WHERE building_id = ? AND file_path = ? AND category = 'main_photo'
    ");
    $stmt->execute([$buildingId, $filePath]);
    return $stmt->fetchColumn() > 0;
}

// Function to import media
function importMedia($pdo, $buildingId, $filePath) {
    // Skip HEIF images
    if (strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) === 'heif') {
        logMessage("Skipping HEIF image: $filePath", true);
        return;
    }

    // Check if media already exists
    if (mediaExists($pdo, $buildingId, $filePath)) {
        logMessage("Skipping duplicate photo: $filePath");
        return;
    }
    
    $sql = "INSERT INTO building_media (
        building_id, file_path, media_type, category, description
    ) VALUES (
        :building_id, :file_path, :media_type, :category, :description
    )";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'building_id' => $buildingId,
            'file_path' => $filePath,
            'media_type' => 'photo',
            'category' => 'main_photo',
            'description' => 'Main photo of the building'
        ]);
        logMessage("Successfully imported main photo: $filePath");
    } catch (Exception $e) {
        logMessage("Error importing main photo: $filePath - " . $e->getMessage(), true);
    }
}

// Function to process photos for a barangay
function processBarangayPhotos($pdo, $barangayDir, $barangayName) {
    // Get all photos in this barangay directory (case-insensitive for extensions)
    $photos = array_merge(
        glob($barangayDir . '/*.{jpg,jpeg,png}', GLOB_BRACE),
        glob($barangayDir . '/*.{JPG,JPEG,PNG}', GLOB_BRACE)
    );
    
    logMessage("Found " . count($photos) . " photos in $barangayName");
    
    foreach ($photos as $photo) {
        // Get the filename without extension
        $filename = pathinfo($photo, PATHINFO_FILENAME);
        $relativePath = str_replace('\\', '/', $photo);
        
        // Get building ID based on filename
        $buildingId = getBuildingId($pdo, $filename, $barangayName);
        
        if (!$buildingId) {
            logMessage("Error: Building not found in database for photo: $filename (Barangay: $barangayName)", true);
            continue;
        }
        
        // Import the photo
        importMedia($pdo, $buildingId, $relativePath);
    }
}

// Main photos directory
$mainPhotosDir = 'assets/photo-docs/!main-pictures-buildings/';

// Process main photos
logMessage("\n=== Processing Main Photos ===");

// First, check if the main directory exists
if (!is_dir($mainPhotosDir)) {
    logMessage("Error: Main photos directory not found: $mainPhotosDir", true);
    exit;
}

// Get all barangay directories
$barangayDirs = glob($mainPhotosDir . '*', GLOB_ONLYDIR);
logMessage("Found " . count($barangayDirs) . " barangay directories");

foreach ($barangayDirs as $barangayDir) {
    $barangayName = basename($barangayDir);
    logMessage("\nProcessing barangay: $barangayName");
    
    // Debug: List contents of barangay directory
    $contents = scandir($barangayDir);
    $photos = array_filter($contents, function($item) {
        $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
        return in_array($ext, ['jpg', 'jpeg', 'png']);
    });
    logMessage("Photos found in $barangayName: " . implode(", ", $photos));
    
    // Process photos in this barangay directory
    processBarangayPhotos($pdo, $barangayDir, $barangayName);
}

// Output organized logs
echo "\n=== Successful Operations ===\n";
foreach ($successLogs as $log) {
    echo $log . "\n";
}

echo "\n=== Errors ===\n";
foreach ($errorLogs as $log) {
    echo $log . "\n";
}

echo "\nImport completed!\n";
?> 