<?php
include 'header.php';
unset($_SESSION['loggedin']); 
header('Location: index.php');
?>