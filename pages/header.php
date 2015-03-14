<?php 
$path = $_SERVER['DOCUMENT_ROOT'].'/capstoneproject';
include ($path.'/validations/functions.php')?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <title>Capstone Arcade</title>
    <link rel="stylesheet" type="text/css" href="<?php echo '/capstoneproject/css/main.css' ?>"/>
</head>

<body>
        
<!-- Main Wrapper -->
<div id="wrapper">
<!-- Start Header -->
<div id="header">
    <div id="nav">
        <div id="buttons">
			<?php 
			//start session
			if(!isset($_SESSION)){
			session_start();
			} 
			?>
            <a class="btn" href="/capstoneproject/pages/home.php">HOME</a>
			<?php
			if (isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true) {
			$_SESSION['userID'] = getUserID($_SESSION['email']);
			echo '<a class="btn" href="/capstoneproject/pages/profile.php">PROFILE</a>';
            echo '<a class="btn" href="/capstoneproject/pages/logout.php">LOGOUT</a>';
			} else {
			echo '<a class="btn" href="/capstoneproject/pages/signup.php">JOIN</a>';
			echo '<a class="btn" href="/capstoneproject/pages/login.php">LOGIN</a>';
			}
			?>
        </div>
    </div><!-- close nav -->
</div><!-- End Header -->