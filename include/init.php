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
        building_type VARCHAR(100) NOT NULL,
        construction_year INT NOT NULL,
        structure_type VARCHAR(100) NOT NULL,
        design_occupancy VARCHAR(100) NOT NULL,
        nscp_edition_year INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (barangay_id) REFERENCES barangays(id) ON DELETE CASCADE
    )");
    
    // Create audits table
    $pdo->exec("CREATE TABLE IF NOT EXISTS audits (
        id INT AUTO_INCREMENT PRIMARY KEY,
        building_id INT NOT NULL,
        type ENUM('infrastructure', 'fire_safety', 'accessibility') NOT NULL,
        summary TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE CASCADE
    )");
    
    // Create photos table
    $pdo->exec("CREATE TABLE IF NOT EXISTS photos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        building_id INT NOT NULL,
        filename VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE CASCADE
    )");
    
    // Create documents table
    $pdo->exec("CREATE TABLE IF NOT EXISTS documents (
        id INT AUTO_INCREMENT PRIMARY KEY,
        building_id INT NOT NULL,
        filename VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE CASCADE
    )");
    
    // Create uploads directory if it doesn't exist
    if (!file_exists(UPLOAD_PATH)) {
        mkdir(UPLOAD_PATH, 0777, true);
    }
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());    
}
?> 