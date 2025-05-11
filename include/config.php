<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'marag_audit');

// Site configuration
define('SITE_URL', 'http://localhost/marag-audit');
define('UPLOAD_PATH', __DIR__ . '/uploads');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session configuration
session_start();
?> 