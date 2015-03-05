<?php include ('header.php');
$ID = getUserID($_SESSION['email']);
$Name = getUserName($_SESSION['email']);
$Bio = getUserBio ($_SESSION['email']);
?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
	<h1 class="title">Welcome Back, <?php echo $Name['userName'] ?>!</h1>
	<!-- Main content div -->
		<div id="main-content"><div id="article-wrapper">
			<h1 class="title2"><?php echo $Name['userName']?></h1>
			<p>User ID for <?php echo $Name['userName']?> is: <?php echo $ID['userID'] ?></p>
			<p>All About <?php echo $Name['userName']?>:</p>
			<p><?php echo $Bio['bio']?> </p>
			<p>Top 10 Scores for <?php echo $Name['userName']?></p>
			<p><?php //var_dump($ID);?></p>
			<p><?php topTenScoresforUser($ID['userID']) ?></p>
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