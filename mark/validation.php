<?php
class validation {
    
   function check_login($email, $password)
{
    //$password = sha1($password);
    
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare('SELECT * FROM users WHERE Email = :email AND Password = :password');
    $dbs->bindParam(':email', $email, PDO::PARAM_STR);
    $dbs->bindParam(':password', $password, PDO::PARAM_STR);
    if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
        return true;
    } else {
        return false;
    }
}
function check_email($email)
{
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare('SELECT * FROM users WHERE Email = :email');
    $dbs->bindParam(':email', $email, PDO::PARAM_STR);
    if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
        return true;
    } else {
        return false;
    }
}
function valid_email($email)
{
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   return false;
   } else {
   return true;
   }
} 
function valid_password($password)
{
   if (isset($password) && (strlen($password) < 4)) {
       return false;
   } else {
       return true;
   }
} 
}