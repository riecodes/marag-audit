<?php
require_once '../include/init.php';

// Set the timezone
date_default_timezone_set('Asia/Manila');

// Create backup directory if it doesn't exist
$backup_dir = __DIR__ . '/backups';
if (!file_exists($backup_dir)) {
    mkdir($backup_dir, 0777, true);
}

// Generate filename with timestamp
$timestamp = date('Y-m-d_H-i-s');
$filename = "marag_audit_full_backup_{$timestamp}.sql";
$backup_file = $backup_dir . '/' . $filename;

// Get database credentials from init.php
$db_host = DB_HOST;
$db_name = DB_NAME;
$db_user = DB_USER;
$db_pass = DB_PASS;

// Get XAMPP MySQL path
$xampp_mysql_path = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

// Check if mysqldump exists
if (!file_exists($xampp_mysql_path)) {
    die("❌ Error: mysqldump.exe not found at {$xampp_mysql_path}\nPlease make sure XAMPP is installed correctly.");
}

// Command to export database (Windows specific)
$command = sprintf(
    '"%s" --host=%s --user=%s --password=%s %s > "%s"',
    $xampp_mysql_path,
    escapeshellarg($db_host),
    escapeshellarg($db_user),
    escapeshellarg($db_pass),
    escapeshellarg($db_name),
    $backup_file
);

// Execute the command
exec($command . ' 2>&1', $output, $return_var);

if ($return_var === 0) {
    echo "✅ Database backup created successfully!\n";
    echo "📁 Backup file: {$filename}\n";
    echo "📍 Location: {$backup_dir}\n";
    
    // Keep only the last 5 backups
    $files = glob($backup_dir . '/*.sql');
    if (count($files) > 5) {
        // Sort files by modification time
        usort($files, function($a, $b) {
            return filemtime($a) - filemtime($b);
        });
        
        // Remove oldest files
        $files_to_remove = array_slice($files, 0, count($files) - 5);
        foreach ($files_to_remove as $file) {
            unlink($file);
            echo "🗑️ Removed old backup: " . basename($file) . "\n";
        }
    }
} else {
    echo "❌ Error creating database backup!\n";
    echo "Error code: {$return_var}\n";
    if (!empty($output)) {
        echo "Error details:\n";
        print_r($output);
    }
    exit(1); // Exit with error code
} 