<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Capstone Arcade</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>

<body>
        
<!-- Main Wrapper -->
<div id="wrapper">
<!-- Start Header -->
<div id="header">
    <div id="nav">
        <div id="buttons">
            <a class="btn" href="index.php">HOME</a>
            <a class="btn" href="signup.php">JOIN</a>
			<?php
			//start session
			if(!isset($_SESSION)){
			session_start ();
			echo '<a class="btn" href="login.php">LOGIN</a>';
			} else {
			echo '<a class="btn" href="logout.php">LOGOUT</a>';
			}
			?>
        </div>
    </div><!-- close nav -->
</div><!-- End Header -->