<?php
$email = filter_input(INPUT_POST,'email');

$errors = array();

include 'validation.php';
if(!isset($_SESSION))
	session_start ();
$functions = new validation();

if ($functions->valid_email($email)== true)
{
	$email = filter_input(INPUT_POST,'email');
	
	$functions = new validation();
	if ($functions->check_email($email)!= true || $email == $_SESSION['email']){
	include 'functions.php';
	$email = filter_input(INPUT_POST,'email');
    $biography = filter_input(INPUT_POST,'biography');
    $userID = getUserID($_SESSION['email']);
	
	updateProfile($userID, $email, $biography);
	$_SESSION['email'] = $email;
	header('Location: ../pages/profile.php');
	} else {
	$errors[] = "Email is taken.";
	}
}
else
{
    $errors[] = "Please enter a valid email.";
}
    include('../pages/editProfile.php');
?>