<?php
require_once 'include/init.php';
$section = $_GET['section'] ?? 'home';
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/link.php'; ?>

</head>

<body>
<?php include 'include/nav.php'; ?>

<div class="container-fluid p-0">
<?php
if ($section === 'home') {
    include 'content/home.php';
} elseif ($section === 'about') {
    include 'content/about.php';
} elseif ($section === 'barangay') {
    include 'content/barangay.php';
} elseif ($section === 'building') {
    include 'content/building.php';
} elseif ($section === 'explore') {
    include 'content/explore.php';
}
?>
</div>

<footer class="bg-dark text-light py-4">
    <div class="container text-center">
        <p>&copy; <?php echo date('Y'); ?> Maragondon Building Audit. All rights reserved.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 