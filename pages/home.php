<?php include ('header.php');?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
<h1 class="titleMain">Capstone Arcade Presents:</h1>

<!-- Main content div -->
<div id="main-content">

<!-- Set each games' data in a different div -->
<div id="article-wrapper">
    <h1 class="titleArticle">Breakout</h1>
    <p class= "descriptionArticle"><?php getGameDescriptionByGameID(1)?></p>
    <img src="../media/Breaker.jpg" alt=""/>
	<div id ="scores-wrapper">
            <div class="tabs">
                <div class="tab">
				<a>Sort By: </a>
                    <input type="radio" id="allTime1" name="tabGroup1" checked="true">
                    <label for="allTime1">All Time</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforAllTime(1) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforAllTime(1) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="day1" name="tabGroup1">
                    <label for="day1">Day</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforDay(1) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforDay(1) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="week1" name="tabGroup1">
                    <label for="week1">Week</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforWeek(1) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforWeek(1) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="month1" name="tabGroup1">
                    <label for="month1">Month</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforMonth(1) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforMonth(1) ?></p>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
		<a class="play" href="../games/game.php?gameID=1"> </a>
</div><!-- end article -->

<!-- Set each games' data in a different div -->
<div id="article-wrapper">
    <h1 class="titleArticle">Space Invaders</h1>
    <p class= "descriptionArticle"><?php getGameDescriptionByGameID(2)?></p>
    <img src="../media/Invaders.jpeg" alt=""/>
        <div id ="scores-wrapper">
            <div class="tabs">
                <div class="tab">
				<a>Sort By: </a>
                    <input type="radio" id="allTime3" name="tabGroup3" checked="true">
                    <label for="allTime3">All Time</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforAllTime(2) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforAllTime(2) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="day3" name="tabGroup3">
                    <label for="day3">Day</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforDay(2) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforDay(2) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="week3" name="tabGroup3">
                    <label for="week3">Week</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforWeek(2) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforWeek(2) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="month3" name="tabGroup3">
                    <label for="month3">Month</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforMonth(2) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforMonth(2) ?></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
		<a class="play" href="../games/game.php?gameID=2"> </a>
</div><!-- end article -->

<!-- Set each games' data in a different div -->
<div id="article-wrapper">
    <h1 class="titleArticle">Helicopter</h1>
    <p class= "descriptionArticle"><?php getGameDescriptionByGameID(3)?></p>
    <img src="../media/Helicopter.jpg" alt=""/>
        <div id ="scores-wrapper">
            <div class="tabs">
                <div class="tab">
				<a>Sort By: </a>
                    <input type="radio" id="allTime2" name="tabGroup2" checked="true">
                    <label for="allTime2">All Time</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforAllTime(3) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforAllTime(3) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="day2" name="tabGroup2">
                    <label for="day2">Day</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforDay(3) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforDay(3) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="week2" name="tabGroup2">
                    <label for="week2">Week</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforWeek(3) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforWeek(3) ?></p>
                            </div>
                        </div>
                </div>
                <div class="tab">
                    <input type="radio" id="month2" name="tabGroup2">
                    <label for="month2">Month</label>
                        <div class="content">
                            <div id = "numbers"></br> 1. </br> 2. </br> 3. </br> 4. </br> 5. </br> 6. </br> 7. </br> 8. </br> 9. </br> 10. </br></div>
                            <div id ="mainScores">
                                    <p><?php topTenGameScoresforMonth(3) ?></p>
                            </div>
                            <div id ="mainUsers">
                                    <p><?php topTenUserNamesforMonth(3) ?></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
		<a class="play" href="../games/game.php?gameID=3"> </a>
</div><!-- end article -->

</div><!-- end main content -->
<!-- sidebar -->

<!-- Advertisements -->
<div id="sidebar">
	<a class="sponsors">Visit Our Sponsors</a></br>
	<a class="ads" href="http://www.penny-arcade.com/" target="_blank"><img src="../media/advertisements/penny.jpg" alt="Penny Arcade" title="Penny Arcade"/></a>
	<a class="ads" href="http://www.penny-arcade.com/" target="_blank"><img src="../media/advertisements/arcade.jpg" alt="Penny Arcade" title="Penny Arcade"/></a>
	<a class="ads" href="http://www.apple.com/" target="_blank"><img src="../media/advertisements/iphone.jpeg" alt="Apple" title="Apple.com"/></a>
	<a class="ads" href="http://jayandsilentbob.com/" target="_blank"><img src="../media/advertisements/stash.jpg" alt="Secret Stash" title="Secret Stash"/></a>
	<a class="ads" href="http://smokefree.gov/" target="_blank"><img src="../media/advertisements/smoking.jpg" alt="Stop Smoking" title="Stop Smoking"/></a>
	<a class="ads" href="http://google.com/" target="_blank"><img src="../media/advertisements/google.jpg" alt="Google.com" title="Google.com"/></a>	
</div><!--  end sidebar -->
</div><!-- end inner container -->
<?php include ('footer.php');?>
</div><!-- End Main Wrapper -->
	

</body>
</html>