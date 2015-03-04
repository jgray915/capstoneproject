<?php
include 'header.php';
unset($_SESSION['loggedin']); 
$_SESSION['loggedin'] = false;
session_destroy();
header('Location: index.php');
?>