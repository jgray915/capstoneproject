<?php
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$errors = array();
include './validation.php';
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
    
    include('signup.php');
    
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare('INSERT into users set Email = :email, password = :password');
    $dbs->bindParam(':email', $email, PDO::PARAM_STR);
    $dbs->bindParam(':password', $password, PDO::PARAM_STR);
    
    if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
        echo "Sign Up Complete";
    } else {
        echo "Sign Up Incomplete";
    }    
} else {
    include('signup.php');
}
?>