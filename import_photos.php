<?php
require_once 'include/init.php';

// Initialize log arrays
$successLogs = [];
$errorLogs = [];

// Function to get all barangays and their buildings from database
function getDatabaseContents($pdo) {
    $stmt = $pdo->prepare("
        SELECT br.name as barangay_name, b.name as building_name, b.id as building_id
        FROM barangays br
        LEFT JOIN buildings b ON br.id = b.barangay_id
        ORDER BY br.name, b.name
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to get all local folders
function getLocalFolders($baseDir) {
    $folders = [];
    $barangayDirs = glob($baseDir . '*', GLOB_ONLYDIR);
    
    foreach ($barangayDirs as $barangayDir) {
        $barangayName = basename($barangayDir);
        $buildingDirs = glob($barangayDir . '/*', GLOB_ONLYDIR);
        $folders[$barangayName] = array_map('basename', $buildingDirs);
    }
    
    return $folders;
}

// Function to compare database and local folders
function compareDatabaseAndLocal($pdo) {
    $dbContents = getDatabaseContents($pdo);
    $localFolders = getLocalFolders('assets/photo-docs/');
    
    logMessage("\n=== Database Contents ===");
    foreach ($dbContents as $row) {
        logMessage("Barangay: {$row['barangay_name']}, Building: {$row['building_name']} (ID: {$row['building_id']})");
    }
    
    logMessage("\n=== Local Folders ===");
    foreach ($localFolders as $barangay => $buildings) {
        logMessage("Barangay: $barangay");
        foreach ($buildings as $building) {
            logMessage("  - $building");
        }
    }
}

// Call the comparison function at the start
compareDatabaseAndLocal($pdo);

// Function to get all buildings in a barangay (for debugging)
function getBuildingsInBarangay($pdo, $barangayName) {
    $stmt = $pdo->prepare("
        SELECT b.name 
        FROM buildings b 
        JOIN barangays br ON b.barangay_id = br.id 
        WHERE LOWER(br.name) = LOWER(?)
        ORDER BY b.name
    ");
    $stmt->execute([$barangayName]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Function to log messages
function logMessage($message, $isError = false) {
    global $successLogs, $errorLogs;
    if ($isError) {
        $errorLogs[] = $message;
    } else {
        $successLogs[] = $message;
    }
}

// Function to check if media already exists
function mediaExists($pdo, $buildingId, $filePath) {
    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM building_media 
        WHERE building_id = ? AND file_path = ?
    ");
    $stmt->execute([$buildingId, $filePath]);
    return $stmt->fetchColumn() > 0;
}

// Function to get building details by ID (for debugging)
function getBuildingDetails($pdo, $buildingId) {
    $stmt = $pdo->prepare("
        SELECT b.name, br.name as barangay_name
        FROM buildings b 
        JOIN barangays br ON b.barangay_id = br.id 
        WHERE b.id = ?
    ");
    $stmt->execute([$buildingId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to process photos for a building
function processBuildingPhotos($pdo, $buildingDir, $buildingName, $barangayName, $category) {
    // Skip parent folders that don't correspond to actual buildings
    $skipFolders = [
        'CvSU - Maragondon' // Parent folder in Pinagsanhan B
    ];
    
    if (in_array($buildingName, $skipFolders)) {
        logMessage("Skipping parent folder: $buildingName");
        return;
    }

    $buildingId = getBuildingId($pdo, $buildingName, $barangayName);
    
    if (!$buildingId) {
        logMessage("Error: Building not found in database: $buildingName (Barangay: $barangayName)", true);
        return;
    }
    
    // Get all photos in this building directory (case-insensitive for extensions)
    $photos = array_merge(
        glob($buildingDir . '/*.{jpg,jpeg,png}', GLOB_BRACE),
        glob($buildingDir . '/*.{JPG,JPEG,PNG}', GLOB_BRACE)
    );
    
    foreach ($photos as $photo) {
        $relativePath = str_replace('\\', '/', $photo);
        importMedia(
            $pdo,
            $buildingId,
            $relativePath,
            'photo',
            $category,
            ucfirst($category) . ' photo'
        );
    }
}

// Function to get building ID by name and barangay with name variations
function getBuildingId($pdo, $buildingName, $barangayName) {
    // Barangay name corrections
    $barangayCorrections = [
        'Poblacion 3 (Caingin)' => 'Caingin'
    ];
    $barangayName = $barangayCorrections[$barangayName] ?? $barangayName;

    // Common abbreviations mapping
    $abbreviations = [
        'BH' => 'Barangay Hall',
        'BNIS' => 'Bucal National Integrated School',
        'MES' => 'Maragondon Elementary School',
        'MHS' => 'Maragondon High School',
        'MPS' => 'Maragondon Police Station',
        'MCT' => 'Municipal Circuit Trial Court',
        'CSIS' => 'Cavite Science Integrated School',
        'CvSU' => 'Cavite State University - Maragondon Campus',
        'MTO' => 'Municipal Environment and Natural Resources Office/Municipal Tourism Office',
        'MDRRMO' => 'Municipal Disaster Risk Reduction Management Office'
    ];

    // Expand abbreviations
    foreach ($abbreviations as $abbr => $full) {
        if (strpos($buildingName, $abbr) === 0) {
            $buildingName = str_replace($abbr, $full, $buildingName);
        }
    }

    // Name mapping for variations
    $nameVariations = [
        // Bucal 1
        'Barangay Hall Bucal 1' => 'Multipurpose Hall Bucal 1',
        
        // Bucal 2
        'BNIS - Encantadia' => 'Bucal National Integrated School - Encantadia Building',
        'BNIS - PAGCOR' => 'Bucal National Integrated School - PAGCOR',
        'BNIS - SH Laboratory' => 'Bucal National Integrated School - SH Laboratory',
        'BNIS - ABM Building' => 'Bucal National Integrated School - ABM Building',
        'BNIS - SIGLA Building' => 'Bucal National Integrated School - SIGLA Building',
        'BNIS - Stockroom Building' => 'Bucal National Integrated School - Stockroom Building',
        'BNIS - HUMMS Building' => 'Bucal National Integrated School - HUMMS Building',
        'Barangay Hall Bucal 2' => 'Multipurpose Hall Bucal 2',
        'Bucal National Integrated School' => 'Bucal National Integrated School - ABM Building', // Default to ABM building
        
        // Bucal 3B
        'Barangay hall Bucal 3B' => 'Barangay Hall Bucal 3B',
        
        // Bucal 4B
        'Barangay Hall Bucal 4B' => 'Multipurpose Hall Bucal 4B',
        
        // Garita A
        'Maragondon Elementary School' => 'Maragondon Elementary School - Building 1', // Default to Building 1
        'Maragondon High School' => 'Maragondon National High School - Building 1', // Default to Building 1
        'Municipal Curcuit Trial Court' => 'Municipal Circuit Trial Court',
        
        // Garita B
        'Cavite Science Integrated School' => 'CSIS-RSHS - DepEd Standard School Building 4', // Default to Building 4
        
        // Pinagsanhan B
        'CvSU - Maragondon' => 'CvSU - Maragondon Campus - High School Building',
        'Cavite State University - Maragondon Campus' => 'CvSU - Maragondon Campus - High School Building',
        'CvSU' => 'CvSU - Maragondon Campus - High School Building',
        
        // Poblacion 1A
        'Barangay Hall Poblacion 1A' => 'Multipurpose Hall Poblacion 1A',
        'DILG Building' => 'Municipal Environment and Natural Resources Office/Municipal Tourism Office',
        'MTO' => 'Municipal Environment and Natural Resources Office/Municipal Tourism Office',
        'Mayor\'s Office' => 'Office of the Mayor - Third Building',
        'Mayors Office' => 'Office of the Mayor - Third Building',
        'Mayor Office' => 'Office of the Mayor - Third Building',
        'Office of the Mayor' => 'Office of the Mayor - Third Building',
        'Mayor\'s Office Poblacion 1A' => 'Office of the Mayor - Third Building',
        'Mayors Office Poblacion 1A' => 'Office of the Mayor - Third Building',
        'Mayor Office Poblacion 1A' => 'Office of the Mayor - Third Building',
        'Office of the Mayor Poblacion 1A' => 'Office of the Mayor - Third Building',
        'Municipal Hall' => 'Municipal hall of Maragondon - Main Building',
        
        // Poblacion 1B
        'Barangay Hall' => 'Multipurpose Hall Poblacion 1B',
        
        // Poblacion 2B
        'MDRRMO' => 'Municipal Disaster Risk Reduction Management Office',
        
        // Caingin
        'Barangay Hall Caingin' => 'Barangay Hall Caingin',
        'Multi-purpose Hall Caingin' => 'Multipurpose Hall Caingin'
    ];
    
    // Try with mapped name if it exists
    $mappedName = $nameVariations[$buildingName] ?? $buildingName;
    
    // Special case for barangay halls - append barangay name if not already present
    if (strpos($mappedName, 'Barangay Hall') === 0 && strpos($mappedName, $barangayName) === false) {
        $mappedName = 'Barangay Hall ' . $barangayName;
    }

    // Normalize case for comparison
    $mappedName = ucwords(strtolower($mappedName));
    $barangayName = ucwords(strtolower($barangayName));
    
    // Debug logging for Mayor's Office
    if (strpos(strtolower($buildingName), 'mayor') !== false) {
        logMessage("Debug - Original building name: $buildingName");
        logMessage("Debug - Mapped name: $mappedName");
        logMessage("Debug - Barangay: $barangayName");
    }
    
    $stmt = $pdo->prepare("
        SELECT b.id 
        FROM buildings b 
        JOIN barangays br ON b.barangay_id = br.id 
        WHERE LOWER(b.name) = LOWER(?) AND LOWER(br.name) = LOWER(?)
    ");
    $stmt->execute([$mappedName, $barangayName]);
    $buildingId = $stmt->fetchColumn();

    // If building not found, log available buildings for debugging
    if (!$buildingId) {
        $availableBuildings = getBuildingsInBarangay($pdo, $barangayName);
        logMessage("Available buildings in $barangayName: " . implode(", ", $availableBuildings), true);
    }

    return $buildingId;
}

// Function to import media
function importMedia($pdo, $buildingId, $filePath, $mediaType, $category, $description = '') {
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
            'media_type' => $mediaType,
            'category' => $category,
            'description' => $description
        ]);
        logMessage("Successfully imported $category photo: $filePath");
    } catch (Exception $e) {
        logMessage("Error importing $category photo: $filePath - " . $e->getMessage(), true);
    }
}

// Base directories
$mainPhotosDir = 'assets/photo-docs/!main-pictures-buildings/';
$docsDir = 'assets/photo-docs/';

// Process main photos
logMessage("\n=== Processing Main Photos ===");
$barangayDirs = glob($mainPhotosDir . '*', GLOB_ONLYDIR);

foreach ($barangayDirs as $barangayDir) {
    $barangayName = basename($barangayDir);
    logMessage("Processing barangay: $barangayName");
    
    // Get all building directories in this barangay
    $buildingDirs = glob($barangayDir . '/*', GLOB_ONLYDIR);
    
    foreach ($buildingDirs as $buildingDir) {
        $buildingName = basename($buildingDir);
        logMessage("  Processing building: $buildingName");
        processBuildingPhotos($pdo, $buildingDir, $buildingName, $barangayName, 'main_photo');
    }
}

// Process documentation photos
logMessage("\n=== Processing Documentation Photos ===");
$barangayDirs = glob($docsDir . '*', GLOB_ONLYDIR);

foreach ($barangayDirs as $barangayDir) {
    $barangayName = basename($barangayDir);
    if ($barangayName === '!main-pictures-buildings') continue;
    
    logMessage("Processing barangay: $barangayName");
    
    // Get all building directories in this barangay
    $buildingDirs = glob($barangayDir . '/*', GLOB_ONLYDIR);
    
    foreach ($buildingDirs as $buildingDir) {
        $buildingName = basename($buildingDir);
        logMessage("  Processing building: $buildingName");
        processBuildingPhotos($pdo, $buildingDir, $buildingName, $barangayName, 'documentation');
    }
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