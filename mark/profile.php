<?php include ('header.php');

	if(!isset($_SESSION))
	session_start ();

	
?>


<!-- $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT userID, userName, email, signUpDate, bio FROM users WHERE email = :email'); 
		$dbs->bindParam(':email', $_SESSION['email']);
		$dbs->bindParam(':userID', $_SESSION['userID']);
		$dbs->bindParam(':userName', $_SESSION['userName']);
		$dbs->bindParam(':signUpDate', $_SESSION['signUpDate']);
		$dbs->bindParam(':bio', $_SESSION['bio']);
		
		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		var_dump($_SESSION['email']);
		var_dump($_SESSION['userID']);
		var_dump($_SESSION['userName']);
		var_dump($_SESSION['signUpDate']);
		var_dump($_SESSION['bio']);
		} -->


<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
	<h1 class="title">Welcome Back, <?php echo $_SESSION['email'] ?>!</h1>
	<!-- Main content div -->
		<div id="main-content"><div id="article-wrapper">
			<h1 class="title2"><?php echo 'userName' ?></h1>
			<p></p>
			<img src="" alt=""/>
			</div><!-- end article -->
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