<?php
// Get the email from the text box
$email = filter_input(INPUT_POST,'email');

// Create an array to hold any error messages
$errors = array();

// Include for validation purposes
include 'validation.php';

// If a session has not been started, start one.
if(!isset($_SESSION))
	session_start ();
	
// create a variable to use for validation 	
$functions = new validation();

// Check to see if the email is valid.  If it is, continue in to the loop.
if ($functions->valid_email($email)== true)
{
	$email = filter_input(INPUT_POST,'email');
	$functions = new validation();

	// If the email isn't all ready in the database or is the one all ready associated with this account, continue on.
	if ($functions->check_email($email)!= true || $email == $_SESSION['email']){
	
	include 'functions.php';
	// Get the email and biography data from the text boxes
	$email = filter_input(INPUT_POST,'email');
    $biography = filter_input(INPUT_POST,'biography');
	// Get the UserID from the database
    $userID = getUserID($_SESSION['email']);
	
	// Update the data in the database to match the new information
	updateProfile($userID, $email, $biography);
	// Set the session email to be whatever the user recorded in the text box, whether it's new or the original one.
	$_SESSION['email'] = $email;
	// Redirect to the updated profile page.
	header('Location: ../pages/profile.php');
	} 
	
	// Else if the email is all ready taken, record an error message.
	else {
	$errors[] = "Email is taken.";
	}
}
// If the entered email is not valid, redirect back to the editProfile page and display the error message
else
{
    $errors[] = "Please enter a valid email.";
}
    include('../pages/editProfile.php');
?>