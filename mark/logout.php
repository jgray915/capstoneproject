<?php
include 'header.php';
unset($_SESSION['loggedin']); 
$_SESSION['loggedin'] = false;
header('Location: index.php');
?>