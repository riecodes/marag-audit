<?php
require_once 'include/init.php';

// Function to get audit type ID by name
function getAuditTypeId($pdo, $typeName) {
    $stmt = $pdo->prepare("SELECT id FROM audit_types WHERE name = ?");
    $stmt->execute([$typeName]);
    return $stmt->fetchColumn();
}

// Function to get building ID by name and barangay with name variations
function getBuildingId($pdo, $buildingName, $barangayName) {
    // Name mapping for variations
    $nameVariations = [
        // Bucal 2
        'BNIS - Encantadia' => 'Bucal National Integrated School - Encantadia Building',
        'BNIS - PAGCOR' => 'Bucal National Integrated School - PAGCOR',
        'BNIS - SH Laboratory' => 'Bucal National Integrated School - SH Laboratory',
        'BNIS - ABM Building' => 'Bucal National Integrated School - ABM Building',
        'BNIS - SIGLA Building' => 'Bucal National Integrated School - SIGLA Building',
        'BNIS - Stockroom Building' => 'Bucal National Integrated School - Stockroom Building',
        'BNIS - HUMMS Building' => 'Bucal National Integrated School - HUMMS Building',
        'Multi-purpose Hall' => 'Multipurpose Hall Bucal 2',
        
        // Bucal 4A
        'Barangay Hall' => 'Barangay Hall Bucal 4A',
        
        // Garita A
        'MES - Building 1' => 'Maragondon Elementary School - Building 1',
        'MES - Building 2' => 'Maragondon Elementary School - Building 2',
        'MES - Building 3' => 'Maragondon Elementary School - Building 3',
        'MNHS - Building 1' => 'Maragondon National High School - Building 1',
        'MNHS - Building 2' => 'Maragondon National High School - Building 2',
        'Trial Court' => 'Municipal Circuit Trial Court',
        
        // Garita B
        'CavSci - DepEd Standard School Building 4' => 'CSIS-RSHS - DepEd Standard School Building 4',
        'CavSci - Maliksi Building 5' => 'CSIS-RSHS - Maliksi Building 5',
        'CavSci - DepEd Modified School Building 6' => 'CSIS-RSHS - Modified School Building 6',
        'CavSci - DepEd Standard School Building 7' => 'CSIS-RSHS - DepEd Standard School Building 7',
        'CavSci - Science Laboratory Building 9' => 'CSIS-RSHS - Science Laboratory Building 9',
        'CavSci - Beautycare N.C 2 Building 10' => 'CSIS-RSHS - Beautycare N.C 2 Building 10',
        'CavSci - Science Laboratory Building 14' => 'CSIS-RSHS - Science Laboratory Building 14',
        
        // Pinagsanhan B
        'CvSU Marag - HS Building' => 'CvSU - Maragondon Campus - High School Building',
        'CvSU Marag - ES Building' => 'CvSU - Maragondon Campus - Elementary Building',
        
        // Poblacion 1A
        'Municipal Hall' => 'Municipal hall of Maragondon - Main Building',
        'MENRO/MTourism' => 'Municipal Environment and Natural Resources Office/Municipal Tourism Office',
        'Mayor\'s Office' => 'Office of the Mayor - Third Building',
        'SB Building' => 'Sangguniang Bayan - Second Building',
        
        // Poblacion 2B
        'MDRRMO' => 'Municipal Disaster Risk Reduction Management Office'
    ];
    
    // Try with mapped name if it exists
    $mappedName = $nameVariations[$buildingName] ?? $buildingName;
    
    $stmt = $pdo->prepare("
        SELECT b.id 
        FROM buildings b 
        JOIN barangays br ON b.barangay_id = br.id 
        WHERE b.name = ? AND br.name = ?
    ");
    $stmt->execute([$mappedName, $barangayName]);
    return $stmt->fetchColumn();
}

// Function to import checklist
function importChecklist($pdo, $buildingId, $auditTypeId, $checklistPath) {
    $sql = "INSERT INTO audit_checklists (
        building_id, audit_type_id, checklist_path, status
    ) VALUES (
        :building_id, :audit_type_id, :checklist_path, 'completed'
    )";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'building_id' => $buildingId,
        'audit_type_id' => $auditTypeId,
        'checklist_path' => $checklistPath
    ]);
}

// Get audit type IDs
$auditTypeIds = [
    'infrastructure' => getAuditTypeId($pdo, 'infrastructure'),
    'fire_safety' => getAuditTypeId($pdo, 'fire_safety'),
    'accessibility' => getAuditTypeId($pdo, 'accessibility')
];

// Base directory for checklists
$baseDir = 'assets/checklist/';

// Get all barangay directories
$barangayDirs = glob($baseDir . '*', GLOB_ONLYDIR);

foreach ($barangayDirs as $barangayDir) {
    $barangayName = basename($barangayDir);
    echo "Processing barangay: $barangayName\n";
    
    // Get all building directories in this barangay
    $buildingDirs = glob($barangayDir . '/*', GLOB_ONLYDIR);
    
    foreach ($buildingDirs as $buildingDir) {
        $buildingName = basename($buildingDir);
        echo "  Processing building: $buildingName\n";
        
        // Get building ID
        $buildingId = getBuildingId($pdo, $buildingName, $barangayName);
        
        if (!$buildingId) {
            echo "    Error: Building not found in database: $buildingName\n";
            continue;
        }
        
        // Process each audit type directory
        $auditDirs = [
            'Infra Audit' => 'infrastructure',
            'Fire Safety' => 'fire_safety',
            'Accessibility' => 'accessibility'
        ];
        
        foreach ($auditDirs as $dirName => $typeName) {
            $auditDir = $buildingDir . '/' . $dirName;
            
            if (is_dir($auditDir)) {
                // Get all PDF files in this audit directory
                $pdfFiles = glob($auditDir . '/*.pdf');
                
                foreach ($pdfFiles as $pdfFile) {
                    $relativePath = str_replace('\\', '/', $pdfFile);
                    echo "    Importing $typeName checklist: $relativePath\n";
                    
                    try {
                        importChecklist(
                            $pdo,
                            $buildingId,
                            $auditTypeIds[$typeName],
                            $relativePath
                        );
                        echo "    Successfully imported $typeName checklist\n";
                    } catch (Exception $e) {
                        echo "    Error importing $typeName checklist: " . $e->getMessage() . "\n";
                    }
                }
            } else {
                echo "    No $typeName checklist directory found\n";
            }
        }
    }
}

echo "Import completed!\n";
?> 