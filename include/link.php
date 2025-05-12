<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maragondon Building Audit</title>
<!-- Google Fonts: League Spartan and alternatives -->
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&family=Montserrat:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Global Custom CSS -->
<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/nav.css">
<link rel="stylesheet" href="../css/index.css">
<?php
if (!isset($section)) $section = $_GET['section'] ?? 'home';
if ($section === 'home') {
    echo '<link rel="stylesheet" href="../css/home.css">';
} elseif ($section === 'about') {
    echo '<link rel="stylesheet" href="../css/about.css">';
} elseif ($section === 'contact') {
    echo '<link rel="stylesheet" href="../css/contact.css">';
} elseif ($section === 'explore') {
    echo '<link rel="stylesheet" href="../css/explore.css">';
} elseif ($section === 'explore-about') {
    echo '<link rel="stylesheet" href="../css/explore-about.css">';
} elseif ($section === 'barangay') {
    echo '<link rel="stylesheet" href="../css/barangay.css">';
} elseif ($section === 'buildings') {
    echo '<link rel="stylesheet" href="../css/barangay.css">';
}
?>