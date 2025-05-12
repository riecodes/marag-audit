<?php
require_once 'include/init.php';
$section = $_GET['section'] ?? 'home';
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/link.php'; ?>    
</head>

<body>
<nav class="navbar">
    <?php include 'include/nav.php'; ?>
</nav>

<div class="main-content flex-item">
    <?php
    if ($section === 'home') {
        include 'content/home.php';
    } elseif ($section === 'about') {
        include 'content/about.php';
    } elseif ($section === 'contact') {
        include 'content/contact.php';
    } elseif ($section === 'barangay') {
        include 'content/barangay.php';
    } elseif ($section === 'explore') {
        include 'content/explore.php';
    } elseif ($section === 'explore-about') {
        include 'content/explore-about.php';
    } elseif ($section === 'buildings') {
        include 'content/building.php';
    } elseif ($section === 'building_info') {
        include 'content/building_info.php';
    } elseif ($section === 'building_audit') {
        include 'content/building_audit.php';
    }
    ?>
</div>

<footer class="footer bg-dark text-light py-3 mt-auto">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> Maragondon Building Audit. All rights reserved.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 