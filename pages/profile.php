<?php 
$path = $_SERVER['DOCUMENT_ROOT'].'/capstoneproject';
include ($path.'/pages/header.php');
$ID = getUserID($_SESSION['email']);
$Name = getUserName($_SESSION['email']);
$Bio = getUserBio ($_SESSION['email']);
?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
	<h1 class="titleMain">Welcome Back, <?php echo $Name ?>!</h1>
	<!-- Main content div -->
		<div id="main-content">
			<div id="article-wrapper">
				<h1 class="titleArticle"><?php echo $Name?></h1>
				<div id= "profilePic">
				</div>
				<div id ="biography">
					<p class ="underlinedCenter">About Me</p>
					<p><?php echo $Bio?> </p>
				</div>
				<div id= "scoresWrapper">
					<div id ="profileTitle" class ="underlinedCenter">
						<p>Top Scores for <?php echo $Name?></p>
					</div>
					<div id ="profileScores">
						<p><?php topTenScoresforUser($ID) ?></p>
					</div>
					<div id ="profileGames">
						<p><?php topTenGamesforUser($ID) ?></p>
					</div>
				</div>
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