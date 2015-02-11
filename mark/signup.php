<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
   
<body>
    <div id="wrapper">
        <?php 
        include_once 'header.php';?>
		<?php
        // php code for inserting into the users table
        
        $userName = filter_input(INPUT_POST, 'userName'); 
        $password = filter_input(INPUT_POST,'password');
        $email = filter_input(INPUT_POST,'email');
		$signUpDate = filter_input(INPUT_POST,'signUpDate');
		$bio = filter_input(INPUT_POST,'bio');
        $error_message = '';                        
                  
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('insert into users set userName=:userName, password=:password, email=:email, signUpDate=:signUpDate, bio=:bio ');
                 
        $dbs->bindParam(':userName', $userName, PDO::PARAM_STR);
        $dbs->bindParam(':password', $password, PDO::PARAM_STR);
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':signUpDate', $signUpDate, PDO::PARAM_STR);
		$dbs->bindParam(':bio', $bio, PDO::PARAM_STR);
        
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
             $error_message = '';
            } else {
             $error_message .= 'Input error';  
            }                                           
        ?>
        <div id="container ">
            <div id="main-content">
                <div id="article-wrapper">
                    <h1 class="title2">Sign Up</h1>
                    <form action="signup2.php" method="post"></select>
                    <br />

					<label>Username:&nbsp;&nbsp;</label>
                    <input type="text" name="userName" />
                    <br />
                    <br />
					
                    <label>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="email" />
                    <br />
                    <br />

                    <label>Password:&nbsp;&nbsp;&nbsp;</label>
                    <input type="password" name="password" />
                    <br />
                    <br />
					
					<label>Biography:&nbsp;&nbsp;</label>
                    <input type="text" name="bio" />
                    <br />
                    <br />
                
                    <input type="submit" value="Join" />
                    <br />
                    
                    <?php 
					if (isset($errors)&& count($errors)> 0) : ?>
					<h2>Errors:</h2>
					<ul>
					<?php foreach($errors as $error) : ?>
					<li><?php echo $error; ?></li>
					<?php endforeach; ?>
					</ul>
					<?php endif; ?>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>