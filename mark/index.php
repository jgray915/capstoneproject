<?php include ('header.php');?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
<h1 class="titleMain">Capstone Arcade Presents:</h1>

<!-- Main content div -->
<div id="main-content">

<div id="article-wrapper">
    <h1 class="titleArticle">Breakout</h1>
    <p class= "descriptionArticle"><?php getGameDescriptionByGameID(1)?></p>
    <img src="../media/Breaker.jpg" alt=""/>
	<div id ="scores-wrapper">
        <div id="mainScores" class="scoresArticle">
		<?php
		$sortOption = '';
		$sortOption = $_GET['sortOption'];
		// Retrieve top 10 scores
		//if ($sortOption = 'month'){
		//	topTenScoresGameforMonthAll(1);
		//	}
		//else if ($sortOption = 'week'){
		//	topTenScoresGameforWeekAll(1);
		//	}
		//else if ($sortOption = 'day'){
		//	topTenScoresGameforDayAll(1);
		//	}
		//else {
			topTenScoresGame1();
		//	}
        ?>
		</div>
			<p class="sortLinks"><a>Sort By: </a>
				<a href ="index.php?sortOption=day" method = "get">Day </a> |
				<a href ="index.php?sortOption=week"> Week </a> |
				<a href ="index.php?sortOption=month"> Month </a> |
				<a href ="index.php?sortOption=allTime"> All Time</a>
				<?php //var_dump($sortOption);?> 
			</p>
        </div>
		<a class="play" href="../games/breakout/index.html"> </a>
		
		
</div><!-- end article -->

<div id="article-wrapper">
    <h1 class="titleArticle">Helicopter</h1>
    <p class= "descriptionArticle"><?php getGameDescriptionByGameID(3)?></p>
    <img src="../media/Helicopter.jpg" alt=""/>
        <div id="mainScores" class="scoresArticle">
            <?php
            // Retrieve top 10 scores
			topTenScoresGame3();
            ?>
        </div>
		<a class="play" href="../games/helicopter/index.html"> </a>
</div><!-- end article -->

<div id="article-wrapper">
    <h1 class="titleArticle">Space Invaders</h1>
    <p class= "descriptionArticle"><?php getGameDescriptionByGameID(2)?></p>
    <img src="../media/Invaders.jpeg" alt=""/>
        <div id="mainScores" class="scoresArticle">
             <?php
            // Retrieve top 10 scores
			topTenScoresGame2();
            ?>
			</div>
			<a class="play" href="../games/spaceinvaders/index.html"> </a>
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
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="../media/ad.jpg" alt=""/></div>
	
</div><!--  end sidebar -->
</div><!-- end inner container -->
<?php include ('footer.php');?>
</div><!-- End Main Wrapper -->
	

</body>
</html>