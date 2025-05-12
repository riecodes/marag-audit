<?php
require_once '../include/config.php';
require_once '../vendor/autoload.php'; // You'll need to install PhpSpreadsheet via Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Start transaction
        $pdo->beginTransaction();
        
        // Load Excel file
        $spreadsheet = IOFactory::load($_FILES['excel_file']['tmp_name']);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        
        // Remove header row
        array_shift($rows);
        
        // Prepare statements
        $stmt = $pdo->prepare("SELECT id FROM barangays WHERE name = ?");
        $insert_stmt = $pdo->prepare("INSERT INTO buildings (
            name, barangay_id, location, height, storey_count, 
            building_type, construction_year, structure_type, 
            design_occupancy, nscp_edition_year
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $success_count = 0;
        $error_rows = [];
        
        foreach ($rows as $index => $row) {
            try {
                // Get barangay ID
                $stmt->execute([$row[1]]); // Assuming column B is barangay name
                $barangay = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$barangay) {
                    throw new Exception("Barangay not found: " . $row[1]);
                }
                
                // Insert building
                $insert_stmt->execute([
                    $row[0], // Building Name
                    $barangay['id'],
                    $row[2], // Location
                    $row[3], // Height
                    $row[4], // Storey Count
                    $row[5], // Building Type
                    $row[6], // Construction Year
                    $row[7], // Structure Type
                    $row[8], // Design Occupancy
                    $row[9]  // NSCP Edition Year
                ]);
                
                $success_count++;
                
            } catch (Exception $e) {
                $error_rows[] = [
                    'row' => $index + 2, // +2 because of 0-based index and header row
                    'error' => $e->getMessage()
                ];
            }
        }
        
        if ($success_count > 0) {
            $pdo->commit();
            $_SESSION['success'] = "Successfully imported $success_count buildings.";
        } else {
            $pdo->rollBack();
            $_SESSION['error'] = "No buildings were imported.";
        }
        
        if (!empty($error_rows)) {
            $_SESSION['import_errors'] = $error_rows;
        }
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Redirect back to buildings page
header('Location: buildings.php');
exit; 