<?php
$password = filter_input(INPUT_POST,'password');
$email = filter_input(INPUT_POST,'email');
$errors = array();

include 'validation.php';
session_start();
$functions = new validation();
if ($functions->check_login($email, $password)== true)
{
	$_SESSION['loggedin'] == true;
}
if ($functions->check_email($email)== false)
{
	$errors[] = "Invalid Email.  Email not found.";
}
else
{
    $_SESSION['loggedin']=false;
    $errors[] = "Invalid Login.  Please reenter email and password.";
}
    
if ($_SESSION['loggedin'] == true) {
    header('Location: Admin.php');
}
    include('login.php');
?>