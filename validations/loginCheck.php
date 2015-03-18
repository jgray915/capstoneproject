<?php
// Get the email and password from the text boxes
$password = filter_input(INPUT_POST,'password');
$email = filter_input(INPUT_POST,'email');

// Create an array to hold error messages.
$errors = array();

// Include for validation purposes.
include 'validation.php';

// Open a session if it hasn't all ready been started.
if(!isset($_SESSION))
	session_start ();

// Create a variable to allow for validation	
$functions = new validation();

// if the email and password are in the database, set session log in variable and 
// store user entered email in sessions for use with retrieving database information.
if ($functions->check_login($email, $password)== true)
{
	$_SESSION['loggedin'] = true;
	$_SESSION['email'] = $email;
	header('Location: ../pages/profile.php');
}
// If they are not, redirect back to the login page and set the session log in variable as false.
else
{
    $_SESSION['loggedin'] = false;
    $errors[] = "Invalid Login.  Please reenter email and password.";
}
    include('../pages/login.php');
?>