<?php include ('header.php');?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->

<div id="container">
<h1 class="title">Capstone Arcade Presents:</h1>

<!-- Main content div -->
<div id="main-content">

<div id="article-wrapper">
    <h1 class="title2">Breakout</h1>
    <p>Smash a wall of bricks by deflecting a bouncing ball with a paddle. Score points with each broken brick.  When all the bricks have been destroyed, you’ll advances to a new level. Miss the ball and you’ll lose a life.  Once all lives are lost, the game will end.</p>
    <img src="../media/Breaker.jpg" alt=""/>
        <div id="scores">
		<?php
		// Retrieve top 10 scores
         topTenScoresGame1();			
        ?>
			<a class="play" href="../games/breakout/index.html"> </a>
        </div>
</div><!-- end article -->

<div id="article-wrapper">
    <h1 class="title2">Tetris</h1>
    <p>Geometric shapes composed of four square blocks each fall down the playing field.  Manipulate the pieces by moving each one sideways (if the player feels the need) and rotating it by 90 degree units, with the aim of creating a horizontal line of ten blocks without gaps. When such a line is created, it disappears, and any block above the deleted line will fall. When a certain number of lines are cleared, the game enters a new level. The game ends when the stack reaches the top of the playing field and no pieces are able to enter.</p>
    <img src="../media/Tetris.jpg" alt=""/>
        <div id="scores">
            <?php
            // Retrieve top 10 scores
			topTenScoresGame2();
            ?>
			<a class="play" href="../games/tetris/index.html"> </a>
        </div>
</div><!-- end article -->

<div id="article-wrapper">
    <h1 class="title2">Space Invaders</h1>
    <p>Control a laser cannon by moving it across the bottom of the screen and firing at descending aliens. Defeat aliens as they advance towards you. Earns points by shooting them with the laser cannon. As more aliens are defeated, the aliens' movement speeds up.  If they reach the bottom, the alien invasion is successful and the game ends. </p>
    <img src="../media/Invaders.jpeg" alt=""/>
        <div id="scores">
             <?php
            // Retrieve top 10 scores
			topTenScoresGame3();
            ?>
			<a class="play" href="../games/spaceinvaders/index.html"> </a>
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
</div><!-- end inner container -->
<?php include ('footer.php');?>
</div><!-- End Main Wrapper -->
	

</body>
</html>