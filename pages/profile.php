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
					<div id ="bio">
					<p ><?php echo $Bio?> </p>
					</div>
				</div>
				<form>
				<input id= "editButton" type="button" value="Edit Profile" onclick="parent.location='editProfile.php'">
				</form>
				<div id= "scoresWrapper">
					<div id ="profileTitle" class ="underlinedCenter">
						<p>Top Scores for <?php echo $Name?></p>
					</div>
					<div id ="scores-wrapperProfile">
            <div class="tabs">
                <div class="tab">
				<a>Sort By: </a>
                    <input type="radio" id="allTime1" name="tabGroup1" checked="true">
                    <label for="allTime1">All Time</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforAllTimeByUser($ID) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenGameNamesforAllTimeByuser($ID) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="day1" name="tabGroup1">
                    <label for="day1">Day</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforDayByUser($ID) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenGameNamesforDayByuser($ID) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="week1" name="tabGroup1">
                    <label for="week1">Week</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforWeekByUser($ID) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenGameNamesforWeekByuser($ID) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="month1" name="tabGroup1">
                    <label for="month1">Month</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforMonthByUser($ID) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenGameNamesforMonthByuser($ID) ?></p>
                            </div>
                        </div>
                </div>
            </div>
				</div>
				</div>
			</div><!-- end article -->
		</div><!-- end main content -->
		
<!-- Advertisements -->		
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