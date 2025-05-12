<?php
require_once 'config.php';

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST,
        DB_USER,
        DB_PASS
    );
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $pdo->exec("USE " . DB_NAME);
    
    // Create barangays table
    $pdo->exec("CREATE TABLE IF NOT EXISTS barangays (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create buildings table with new fields
    $pdo->exec("CREATE TABLE IF NOT EXISTS buildings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        barangay_id INT NOT NULL,
        location VARCHAR(255) NOT NULL,
        height DECIMAL(10,2) NOT NULL,
        storey_count INT NOT NULL,
        construction_year VARCHAR(50),
        building_type VARCHAR(100) NOT NULL,
        structure_type VARCHAR(100) NOT NULL,
        occupancy VARCHAR(100) NOT NULL,
        design_occupancy VARCHAR(100),
        occupant_count VARCHAR(100),
        nscp_edition_year VARCHAR(50),
        is_original VARCHAR(10),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (barangay_id) REFERENCES barangays(id) ON DELETE CASCADE
    )");
    
    // Create audit_types table
    $pdo->exec("CREATE TABLE IF NOT EXISTS audit_types (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL UNIQUE,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create audit_checklists table
    $pdo->exec("CREATE TABLE IF NOT EXISTS audit_checklists (
        id INT AUTO_INCREMENT PRIMARY KEY,
        building_id INT NOT NULL,
        audit_type_id INT NOT NULL,
        checklist_path VARCHAR(255) NOT NULL,
        status ENUM('pending', 'completed', 'in_progress') DEFAULT 'pending',
        audit_date DATE,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE CASCADE,
        FOREIGN KEY (audit_type_id) REFERENCES audit_types(id) ON DELETE CASCADE
    )");
    
    // Create building_media table (combined documents and photos)
    $pdo->exec("CREATE TABLE IF NOT EXISTS building_media (
        id INT AUTO_INCREMENT PRIMARY KEY,
        building_id INT NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        media_type ENUM('photo', 'document') NOT NULL,
        category ENUM('main_photo', 'documentation', 'other') NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE CASCADE
    )");
    
    // Insert default audit types
    $pdo->exec("INSERT IGNORE INTO audit_types (name, description) VALUES 
        ('infrastructure', 'Infrastructure Audit Checklist'),
        ('fire_safety', 'Fire Safety Audit Checklist'),
        ('accessibility', 'Accessibility Audit Checklist')
    ");
    
    // Create uploads directory if it doesn't exist
    if (!file_exists(UPLOAD_PATH)) {
        mkdir(UPLOAD_PATH, 0777, true);
    }
    
    // Create building_checklist_description table
    $pdo->exec("CREATE TABLE IF NOT EXISTS building_checklist_description (
        id INT AUTO_INCREMENT PRIMARY KEY,
        barangay VARCHAR(255) NOT NULL,
        building_name VARCHAR(255) NOT NULL,
        audit_type ENUM('infrastructure', 'fire_safety', 'accessibility') NOT NULL,
        summary TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());    
}
?> 