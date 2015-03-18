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
				<div id ="biography">
                                    <div id ="profileTitle" class ="underlinedCenter">
                                        <p>All About <?php echo $Name?></p>
                                    </div>
					<p ><?php echo $Bio?> </p>
				</div>
				<form>
				<input id= "editButton" type="button" value="Edit Profile" onclick="parent.location='editProfile.php'">
				</form>
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
		<a class="sponsors">Visit Our Sponsors</a></br>
		<a class="ads" href="http://smokefree.gov/" target="_blank"><img src="../media/advertisements/smoking.jpg" alt="Stop Smoking" title="Stop Smoking"/></a>
		<a class="ads" href="http://www.match.com/" target="_blank"><img src="../media/advertisements/match.jpeg" alt="Match" title="Match.com"/></a>
		<a class="ads" href="http://www.apple.com/" target="_blank"><img src="../media/advertisements/iphone.jpeg" alt="Apple" title="Apple.com"/></a>
	</div><!--  end sidebar -->
</div><!-- end container -->
<?php include ('footer.php');?>
</div><!-- End wrapper -->

</body>
</html>