<?php
$userName = filter_input(INPUT_POST, 'userName'); 
$password = filter_input(INPUT_POST,'password');
$email = filter_input(INPUT_POST,'email');
$signUpDate = date("Y-m-d H:i:s"); 
$bio = filter_input(INPUT_POST,'bio');
$errors = array();

include 'validation.php';
$functions = new validation();
if ($functions->valid_email($email)== false){
    $errors[] = "Invalid email.";
} 
if ($functions->valid_password($password)== false){
    $errors[] = "Password much be at least 4 characters.";
}
if ($functions->check_email($email)== true) {
   $errors[] = "Email already exists.  Please use different email or select login.";
}
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
		var_dump($_POST);
    }    
} else {
    include('../pages/signup.php');
}
?>