<?php
require_once __DIR__ . '/../include/config.php';

function scanDirectory($dir) {
    $files = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
    
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
                    $files[] = $relativePath;
                }
            }
        }
    }
    return $files;
}

function findDuplicates($array) {
    $duplicates = [];
    $counts = array_count_values($array);
    foreach ($counts as $value => $count) {
        if ($count > 1) {
            $duplicates[] = $value;
        }
    }
    return $duplicates;
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all media files from database
    $stmt = $pdo->query("SELECT id, building_id, file_path, media_type, category FROM building_media");
    $dbFiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Scan local directory
    $baseDir = __DIR__ . '/../assets/photo-docs';
    $localFiles = scanDirectory($baseDir);

    // Convert database paths to match local format
    $dbPaths = array_map(function($file) {
        return $file['file_path'];
    }, $dbFiles);

    // Normalize paths for comparison
    $normalizePath = function($path) {
        return str_replace('\\', '/', $path);
    };
    
    $localFiles = array_map($normalizePath, $localFiles);
    $dbPaths = array_map($normalizePath, $dbPaths);

    // Debug output for path comparison
    echo "<h3>Debug: Sample Paths</h3>";
    echo "<p>Local Files Sample:</p>";
    echo "<pre>";
    print_r(array_slice($localFiles, 0, 5));
    echo "</pre>";
    
    echo "<p>Database Files Sample:</p>";
    echo "<pre>";
    print_r(array_slice($dbPaths, 0, 5));
    echo "</pre>";

    // Find files in local but not in database
    $missingInDb = array_diff($localFiles, $dbPaths);

    // Find files in database but not in local
    $missingInLocal = array_diff($dbPaths, $localFiles);

    // Find duplicates in local files
    $localDuplicates = findDuplicates($localFiles);

    // Find duplicates in database
    $dbDuplicates = findDuplicates($dbPaths);

    // Output results
    echo "<h2>Media File Analysis Results</h2>";
    
    echo "<h3>Files in Local Directory but Missing in Database (" . count($missingInDb) . ")</h3>";
    if (count($missingInDb) > 0) {
        echo "<ul>";
        foreach ($missingInDb as $file) {
            echo "<li>" . htmlspecialchars($file) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No missing files found.</p>";
    }

    echo "<h3>Files in Database but Missing in Local Directory (" . count($missingInLocal) . ")</h3>";
    if (count($missingInLocal) > 0) {
        echo "<ul>";
        foreach ($missingInLocal as $file) {
            echo "<li>" . htmlspecialchars($file) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No missing files found.</p>";
    }

    echo "<h3>Duplicate Files in Local Directory (" . count($localDuplicates) . ")</h3>";
    if (count($localDuplicates) > 0) {
        echo "<ul>";
        foreach ($localDuplicates as $file) {
            echo "<li>" . htmlspecialchars($file) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No duplicates found.</p>";
    }

    echo "<h3>Duplicate Files in Database (" . count($dbDuplicates) . ")</h3>";
    if (count($dbDuplicates) > 0) {
        echo "<ul>";
        foreach ($dbDuplicates as $file) {
            echo "<li>" . htmlspecialchars($file) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No duplicates found.</p>";
    }

    // Additional database analysis
    echo "<h3>Database Media Type Distribution</h3>";
    $typeStmt = $pdo->query("SELECT media_type, COUNT(*) as count FROM building_media GROUP BY media_type");
    $typeCounts = $typeStmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<ul>";
    foreach ($typeCounts as $type) {
        echo "<li>" . htmlspecialchars($type['media_type']) . ": " . $type['count'] . " files</li>";
    }
    echo "</ul>";

    echo "<h3>Database Category Distribution</h3>";
    $catStmt = $pdo->query("SELECT category, COUNT(*) as count FROM building_media GROUP BY category");
    $catCounts = $catStmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<ul>";
    foreach ($catCounts as $cat) {
        echo "<li>" . htmlspecialchars($cat['category']) . ": " . $cat['count'] . " files</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    echo "<h2>Error</h2>";
    echo "<p>Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?> 