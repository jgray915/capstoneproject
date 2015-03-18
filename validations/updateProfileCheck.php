<?php
$email = filter_input(INPUT_POST,'email');

$errors = array();

include 'validation.php';
if(!isset($_SESSION))
	session_start ();
$functions = new validation();

if ($functions->valid_email($email)== true)
{
	include 'functions.php';
	$email = filter_input(INPUT_POST,'email');
    $biography = filter_input(INPUT_POST,'biography');
    $userID = getUserID($_SESSION['email']);
	
	updateProfile($userID, $email, $biography);
	$_SESSION['email'] = getEmailByID($userID);
	header('Location: ../pages/profile.php');
}
else
{
    $_SESSION['loggedin'] = false;
    $errors[] = "Please reenter email";
}
    include('../pages/login.php');
?>