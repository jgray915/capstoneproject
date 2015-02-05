<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Page</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <?php
        include './Header.php';
        
        if ($_SESSION['loggedin'] != true) {
           header('Location: login.php');
        } ?>

        <h1> Admin Page </h1>
    </body>
</html>