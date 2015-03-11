<?php
$password = filter_input(INPUT_POST,'password');
$email = filter_input(INPUT_POST,'email');

$errors = array();

include 'validation.php';
if(!isset($_SESSION))
	session_start ();
$functions = new validation();

if ($functions->check_login($email, $password)== true)
{
	$_SESSION['loggedin'] = true;
	$_SESSION['email'] = $email;
	header('Location: profile.php');
}
else
{
    $_SESSION['loggedin'] = false;
    $errors[] = "Invalid Login.  Please reenter email and password.";
}
    include('login.php');
?>