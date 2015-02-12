<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Capstone Arcade</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
</head>

<body>
        
<!-- Main Wrapper -->
<div id="wrapper">
<?php include ('header.php');?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
		<?php
        // php code for inserting into the users table
        if (isset($email)&& count($errors)== 0){
        $userName = filter_input(INPUT_POST, 'userName'); 
        $password = filter_input(INPUT_POST,'password');
        $email = filter_input(INPUT_POST,'email');
		$signUpDate = date("Y-m-d H:i:s"); 
		$bio = filter_input(INPUT_POST,'bio');
        $errors = array();                       
                  
		$password = sha1($password);		  
				  
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('insert into users set userName=:userName, password=:password, email=:email, signUpDate=:signUpDate, bio=:bio ');
                 
        $dbs->bindParam(':userName', $userName, PDO::PARAM_STR);
        $dbs->bindParam(':password', $password, PDO::PARAM_STR);
        $dbs->bindParam(':email', $email, PDO::PARAM_STR);
        $dbs->bindParam(':signUpDate', $signUpDate, PDO::PARAM_STR);
		$dbs->bindParam(':bio', $bio, PDO::PARAM_STR);
		}
                                         
        ?>
<div id="container">
<h1 class="title">Capstone Arcade Presents:</h1>

<!-- Main content div -->
<div id="main-content">
	<div id="article-wrapper">
                    <h1 class="title2">Sign Up</h1>
                    <form action="signup2.php" method="post"></select>
                    <br />

					<label>Username:&nbsp;&nbsp;</label>
                    <input type="text" name="userName" value="<?php echo $userName;?>" />
                    <br />
                    <br />
					
                    <label>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="email" value="<?php echo $email; ?>" />
                    <br />
                    <br />

                    <label>Password:&nbsp;&nbsp;&nbsp;</label>
                    <input type="password" name="password" value="<?php echo $password;?>" />
                    <br />
                    <br />
					
					<label>Biography:&nbsp;&nbsp;</label>
                    <input type="text" name="bio" value="<?php echo $bio; ?>" />
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
    </div><!-- end article wrapper -->
</div><!-- end main content -->
<!-- sidebar -->
<div id="sidebar">
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
</div><!--  end sidebar -->
</div><!-- end container -->
<?php include ('footer.php');?>
</div><!-- End wrapper -->

</body>
</html>