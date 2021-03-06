<?php
$userName = filter_input(INPUT_POST, 'userName'); 
$password = filter_input(INPUT_POST,'password');
$email = filter_input(INPUT_POST,'email');
$signUpDate = date("Y-m-d H:i:s"); 
$bio = filter_input(INPUT_POST,'bio');
$errors = array();

include 'validation.php';
$functions = new validation();
// Checks agains the validation.php to varify emails
if ($functions->valid_email($email)== false){
    $errors[] = "Invalid email.";
} 
// Checks agains the validation.php to varify password length
if ($functions->valid_password($password)== false){
    $errors[] = "Password much be at least 4 characters.";
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// The following block makes sure that email, bio, password and userName don't exceed the limits established in the database.  //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (strlen($email) > 40)
{
   $errors[] = "Email cannot exceed 40 characters.";
}
if (strlen($bio) > 500)
{
   $errors[] = "Biography cannot exceed 500 characters.";
}
if (strlen($password) > 40)
{
   $errors[] = "Password cannot exceed 40 characters.";
}
if (strlen($userName) > 20)
{
   $errors[] = "UserName cannot exceed 20 characters.";
}

// Checks to make sure the email isn't taken
if ($functions->check_email($email)== true) {
   $errors[] = "Email already exists.  Please use different email or select login.";
}
// Checks to see if the userName is taken
if ($functions->check_userName($userName)== true) {
   $errors[] = "User Name is taken.";
}

// If it passes all validation, then send the data to the database.
if (isset($email)&& count($errors)== 0){
    $password = sha1($password);
    
    include('../pages/signup.php');
    
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare('insert into users set userName=:userName, password=:password, email=:email, signUpDate=:signUpDate, bio=:bio ');
		$dbs->bindParam(':userName', $userName, PDO::PARAM_STR);
        $dbs->bindParam(':password', $password, PDO::PARAM_STR);
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':signUpDate', $signUpDate, PDO::PARAM_STR);
		$dbs->bindParam(':bio', $bio, PDO::PARAM_STR);
    
    if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
        $_SESSION['loggedin'] = true;
		$_SESSION['email'] = $email;
		header('Location: ../pages/profile.php');
    } else {
		//var_dump($_POST);
    }    
}
//else redirect back to the signup page and print out error messages. 
else {
    include('../pages/signup.php');
}
?>