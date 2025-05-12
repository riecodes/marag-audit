<?php
require_once __DIR__ . '/../include/config.php';

function calculateSimilarity($str1, $str2) {
    $str1 = strtolower($str1);
    $str2 = strtolower($str2);
    $commonWords = ['building', 'bldg', 'the', 'and', 'of', 'in', 'on', 'at', 'to', 'for'];
    $str1 = str_replace($commonWords, '', $str1);
    $str2 = str_replace($commonWords, '', $str2);
    $str1 = preg_replace('/[^a-z0-9\\s]/', '', $str1);
    $str2 = preg_replace('/[^a-z0-9\\s]/', '', $str2);
    $words1 = array_filter(explode(' ', $str1));
    $words2 = array_filter(explode(' ', $str2));
    $similarity = 0;
    foreach ($words1 as $word1) {
        foreach ($words2 as $word2) {
            if ($word1 === $word2) {
                $similarity += 1;
            } elseif (strpos($word1, $word2) !== false || strpos($word2, $word1) !== false) {
                $similarity += 0.5;
            } elseif (is_numeric($word1) && is_numeric($word2) && $word1 === $word2) {
                $similarity += 1;
            }
        }
    }
    return $similarity;
}

function scanDirectory($dir) {
    $files = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'pdf', 'PDF'];
    
    if (is_dir($dir)) {
        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..' || $item === '!main-pictures-buildings') continue;
            
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            
            if (is_dir($path)) {
                // Recursively scan subdirectories
                $subFiles = scanDirectory($path);
                $files = array_merge($files, $subFiles);
            } else {
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if (in_array($ext, $allowedExtensions)) {
                    // Store relative path from assets directory
                    $relativePath = str_replace('\\', '/', str_replace(__DIR__ . '/../', '', $path));
                    $files[] = [
                        'path' => $relativePath,
                        'filename' => $item,
                        'extension' => $ext,
                        'full_path' => $path
                    ];
                }
            }
        }
    }
    return $files;
}

// Fetch all building names and IDs from the database once
function getAllBuildings(PDO $pdo) {
    $stmt = $pdo->query("SELECT id, name FROM buildings");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBuildingIdFromPath($path, $allBuildings) {
    $parts = explode('/', $path);
    $bestScore = 0;
    $bestId = null;
    // Try last 1, 2, and 3 folders before the file
    for ($n = 1; $n <= 3; $n++) {
        $relevant = [];
        for ($i = count($parts) - 2; $i >= 0 && count($relevant) < $n; $i--) {
            $relevant[] = $parts[$i];
        }
        if (count($relevant) === 0) continue;
        $relevantPath = implode(' ', array_reverse($relevant));
        foreach ($allBuildings as $building) {
            $score = calculateSimilarity($relevantPath, $building['name']);
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestId = $building['id'];
            }
        }
    }
    // Threshold: require at least 1.5 (tune as needed)
    if ($bestScore >= 1.5) {
        return $bestId;
    }
    return null;
}

function determineMediaType($filename, $path) {
    // Check if it's a main photo
    if (strpos($filename, 'main') !== false || strpos($path, 'main') !== false) {
        return 'main_photo';
    }
    
    // Check if it's documentation
    if (strpos($path, 'documentation') !== false) {
        return 'documentation';
    }
    
    // Default to photo
    return 'photo';
}

function determineCategory($path) {
    // All images except those in infrastructure, fire, or accessibility folders are documentation
    $path = strtolower($path);
    if (strpos($path, 'infrastructure') !== false) {
        return 'infrastructure';
    } elseif (strpos($path, 'fire') !== false) {
        return 'fire_safety';
    } elseif (strpos($path, 'accessibility') !== false) {
        return 'accessibility';
    }
    // Default to documentation
    return 'documentation';
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Start transaction
    $pdo->beginTransaction();
    
    // Get existing files from database
    $stmt = $pdo->query("SELECT file_path FROM building_media");
    $existingFiles = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Get all buildings for fuzzy matching
    $allBuildings = getAllBuildings($pdo);
    
    // Scan local directory
    $baseDir = __DIR__ . '/../assets/checklist';
    $localFiles = scanDirectory($baseDir);
    
    echo "<h2>Media Upload Process</h2>";
    echo "<div class='upload-log'>";
    
    $uploaded = 0;
    $skipped = 0;
    $errors = 0;
    $fire_uploaded = 0;
    $fire_skipped = 0;
    $fire_errors = 0;
    
    foreach ($localFiles as $file) {
        $relativePath = $file['path'];
        $ext = strtolower($file['extension']);
        
        // Handle fire checklists (PDFs with 'fire' in the name or path)
        if ($ext === 'pdf' && strpos(strtolower($relativePath), 'fire') !== false) {
            $buildingId = getBuildingIdFromPath($relativePath, $allBuildings);
            if (!$buildingId) {
                echo "<p class='error'>Error: Could not determine building ID for fire checklist: " . htmlspecialchars($relativePath) . "</p>";
                $fire_errors++;
                continue;
            }
            // audit_type_id = 2 for fire safety
            try {
                // Check if checklist already exists
                $stmt = $pdo->prepare("SELECT id FROM audit_checklists WHERE building_id = ? AND audit_type_id = 2");
                $stmt->execute([$buildingId]);
                $existing = $stmt->fetchColumn();
                if ($existing) {
                    // Update existing checklist
                    $stmt = $pdo->prepare("UPDATE audit_checklists SET checklist_path = ? WHERE id = ?");
                    $stmt->execute([$relativePath, $existing]);
                    echo "<p class='skipped'>Updated fire checklist for building $buildingId: " . htmlspecialchars($relativePath) . "</p>";
                    $fire_skipped++;
                } else {
                    // Insert new checklist
                    $stmt = $pdo->prepare("INSERT INTO audit_checklists (building_id, audit_type_id, checklist_path) VALUES (?, 2, ?)");
                    $stmt->execute([$buildingId, $relativePath]);
                    echo "<p class='success'>Uploaded fire checklist for building $buildingId: " . htmlspecialchars($relativePath) . "</p>";
                    $fire_uploaded++;
                }
            } catch (PDOException $e) {
                echo "<p class='error'>Error uploading fire checklist " . htmlspecialchars($relativePath) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
                $fire_errors++;
            }
            continue;
        }
        
        // Check if file already exists in database
        if (in_array($relativePath, $existingFiles)) {
            echo "<p class='skipped'>Skipped (already exists): " . htmlspecialchars($relativePath) . "</p>";
            $skipped++;
            continue;
        }
        
        // Get building ID using improved fuzzy matching
        $buildingId = getBuildingIdFromPath($relativePath, $allBuildings);
        if (!$buildingId) {
            echo "<p class='error'>Error: Could not determine building ID for: " . htmlspecialchars($relativePath) . "</p>";
            $errors++;
            continue;
        }
        
        // Determine media type and category
        $mediaType = determineMediaType($file['filename'], $relativePath);
        $category = determineCategory($relativePath);
        
        try {
            $stmt = $pdo->prepare("
                INSERT INTO building_media (building_id, file_path, media_type, category)
                VALUES (?, ?, ?, ?)
            ");
            
            $stmt->execute([$buildingId, $relativePath, $mediaType, $category]);
            
            echo "<p class='success'>Uploaded: " . htmlspecialchars($relativePath) . "</p>";
            $uploaded++;
        } catch (PDOException $e) {
            echo "<p class='error'>Error uploading " . htmlspecialchars($relativePath) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
            $errors++;
        }
    }
    
    // Commit transaction
    $pdo->commit();
    
    echo "<h3>Upload Summary</h3>";
    echo "<ul>";
    echo "<li>Files uploaded: " . $uploaded . "</li>";
    echo "<li>Files skipped: " . $skipped . "</li>";
    echo "<li>Errors: " . $errors . "</li>";
    echo "<li>Fire checklists uploaded: " . $fire_uploaded . "</li>";
    echo "<li>Fire checklists skipped: " . $fire_skipped . "</li>";
    echo "<li>Fire checklist errors: " . $fire_errors . "</li>";
    echo "</ul>";
    
    echo "</div>";
    
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "<h2>Error</h2>";
    echo "<p>Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

<style>
.upload-log {
    background: #f5f5f5;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
    max-height: 600px;
    overflow-y: auto;
}
.upload-log p {
    margin: 5px 0;
    padding: 5px;
    border-radius: 4px;
}
.upload-log .success {
    background: #e8f5e9;
    color: #2e7d32;
}
.upload-log .error {
    background: #ffebee;
    color: #c62828;
}
.upload-log .skipped {
    background: #fff3e0;
    color: #ef6c00;
}
</style> 