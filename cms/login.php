<?php
require_once '../config.php';
session_start();
$_SESSION['cms_logged_in'] = true;
header('Location: index.php');
exit;
?> 