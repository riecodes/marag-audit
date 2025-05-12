<?php
// Path to the main pictures directory
$mainDir = __DIR__ . '/../assets/photo-docs/!main-pictures-buildings';

// Recursively get all files in the directory and subdirectories
function getAllFiles($dir) {
    $files = [];
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($rii as $file) {
        if ($file->isDir()) continue;
        $files[] = $file->getPathname();
    }
    return $files;
}

$allFiles = getAllFiles($mainDir);

// Normalize file paths for DB comparison
function normalizePath($path) {
    return str_replace(['\\', '/'], ['/', '/'], $path);
}

// Connect to DB
require_once __DIR__ . '/../include/config.php';
$pdo = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
    DB_USER,
    DB_PASS
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch all main_photo file_paths from building_media
$stmt = $pdo->query("SELECT file_path FROM building_media WHERE category = 'main_photo'");
$dbFiles = $stmt->fetchAll(PDO::FETCH_COLUMN);
$dbFilesNorm = array_map('normalizePath', $dbFiles);

// Check for each file in the directory if it exists in DB
$missingInDB = [];
$duplicatesInDB = [];
$foundInDB = [];
foreach ($allFiles as $file) {
    $relPath = str_replace(realpath(__DIR__ . '/../'), '', realpath($file));
    $relPath = ltrim(str_replace('\\', '/', $relPath), '/');
    $count = 0;
    foreach ($dbFilesNorm as $dbFile) {
        // Check for exact match or basename match
        if (
            strpos($dbFile, $relPath) !== false ||
            basename($dbFile) === basename($file)
        ) {
            $count++;
        }
    }
    if ($count == 0) {
        $missingInDB[] = $relPath;
    } elseif ($count > 1) {
        $duplicatesInDB[] = $relPath . " (found $count times)";
    } else {
        $foundInDB[] = $relPath;
    }
}

// --- Detailed Listing Section ---
echo "\n================ DETAILED LISTING OF IMAGES AND DATABASE ENTRIES ================\n";
$subfolders = glob($mainDir . '/*', GLOB_ONLYDIR);
foreach ($subfolders as $subfolder) {
    $folderName = basename($subfolder);
    echo "\n[$folderName]\n";
    $files = glob($subfolder . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            $relPath = ltrim(str_replace('\\', '/', str_replace(realpath(__DIR__ . '/../'), '', realpath($file))), '/');
            $matches = [];
            foreach ($dbFiles as $dbFile) {
                if (strpos($dbFile, basename($file)) !== false) {
                    $matches[] = $dbFile;
                }
            }
            echo "  • " . basename($file);
            if (count($matches) > 0) {
                echo "\n      DB: ";
                foreach ($matches as $m) {
                    echo $m . "; ";
                }
                echo "\n";
            } else {
                echo "\n      DB: MISSING\n";
            }
        }
    }
}

// --- Reverse Check: DB entries missing locally ---
echo "\n================ DATABASE ENTRIES MISSING LOCALLY ================\n";
$missingLocally = [];
foreach ($dbFiles as $dbFile) {
    // Only check files that should be in !main-pictures-buildings
    if (strpos($dbFile, '!main-pictures-buildings') !== false) {
        $localPath = __DIR__ . '/../' . $dbFile;
        $localPath = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $localPath);
        if (!file_exists($localPath)) {
            $missingLocally[] = $dbFile;
        }
    }
}
if (empty($missingLocally)) {
    echo "\n  ✔ All main_photo entries in building_media have a corresponding local file.\n";
} else {
    echo "\n  The following main_photo entries in building_media are missing locally:\n";
    foreach ($missingLocally as $dbFile) {
        echo "    - $dbFile\n";
    }
} 