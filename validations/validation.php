<?php
class validation {
// Function that checks to see in the email and password match what's in the database for login    
   function check_login($email, $password)
{
    $password = sha1($password);
    
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare("SELECT email, password FROM users WHERE password = :password AND email = :email");
		$dbs->bindParam(':email', $email);
		$dbs->bindParam(':password', $password);
    if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
        return true;
    } else {
        return false;
    }
}
// Function that checks to see if the email exists in the database.
function check_email($email)
{
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare('SELECT * FROM users WHERE Email = :email');
    $dbs->bindParam(':email', $email, PDO::PARAM_STR);
    if ( $dbs->execute() && $dbs->rowCount() == 0 ) {
        return false;
    } else {
        return true;
    }
}
// Checks to see if the userName is taken because it's a unique key.
function check_userName($userName)
{
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare('SELECT * FROM users WHERE UserName = :userName');
    $dbs->bindParam(':userName', $userName, PDO::PARAM_STR);
    if ( $dbs->execute() && $dbs->rowCount() == 0 ) {
        return false;
    } else {
        return true;
    }
}
// Checks to make sure emails contain a @ and a (.) to ensure it's valid.
function valid_email($email)
{
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   return false;
   } else {
   return true;
   }
} 
// Makes sure the password is at least 4 characters long.
function valid_password($password)
{
   if (isset($password) && (strlen($password) < 4)) {
       return false;
   } else {
       return true;
   }
}
}