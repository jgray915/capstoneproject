<?php include ('header.php');
$ID = $_SESSION['userID'];
$Name = getUserName($_SESSION['email']);
?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
	<h1 class="title">Welcome Back, <?php echo $Name['userName'] ?>!</h1>
	<!-- Main content div -->
		<div id="main-content"><div id="article-wrapper">
			<h1 class="title2">User ID for <?php echo $Name['userName']?> is: <?php echo $ID['userID'] ?></h1>
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