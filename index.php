<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Capstone Arcade</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>

<body>
        
<!-- Main Wrapper -->
<div id="wrapper">
<div id="header">
    <div id="nav">
        <div id="buttons">
            <a class="btn" href="index.php">HOME</a>
            <a class="btn" href="mark/signup.php">JOIN</a>
            <?php
            session_start();
            if ( !empty($_SESSION['loggedin']) ) {
            echo '<a class="btn" href="mark/logout.php">Logout</a>';
            } else {
            echo '<a class="btn" href="mark/login.php">LogIn</a>';
            }
            ?>
        </div>
    </div><!-- close nav -->
</div><!-- End Header -->
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->

<div id="container">
<h1 class="title">Capstone Arcade Presents:</h1>

<!-- Main content div -->
<div id="main-content">

<div id="article-wrapper">
    <h1 class="title2">Breakout</h1>
    <p>Smash a wall of bricks by deflecting a bouncing ball with a paddle. Score points with each broken brick.  When all the bricks have been destroyed, you’ll advances to a new level. Miss the ball and you’ll lose a life.  Once all lives are lost, the game will end.</p>
    <img src="media/Breaker.jpg" alt=""/>
        <div id="scores">
		<?php
        // php code for retrieving data from the Scores table
        $userID = filter_input(INPUT_POST,'userID');
        $score = filter_input(INPUT_POST,'score');
			$error_message = '';    
      
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT * FROM `scores` WHERE `GameID`= 1 ORDER BY `Score` DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:<?php
			foreach ($scores as $value) {
			?><li>Score: <?php echo '<td>', $value['Score'],'</td>';?> 
			UserID: <?php echo '<td>', $value['UserID'],'</td>';?></li><?php
			echo '</tr>';
				}
			}			
        ?>
            </ul>
        </div>
</div><!-- end article -->

<div id="article-wrapper">
    <h1 class="title2">Pac-Man</h1>
    <p>Send Pac-Man through a maze while eating pellets and earning points. When all pellets are eaten, Pac-Man is taken to the next stage.  Four enemies roam the maze trying to catch Pac-Man. If an enemy touches you, a life is lost. When all lives have been lost, the game ends.</p>
    <img src="media/Pacman.jpg" alt=""/>
        <div id="scores">
            <ul>
            <li>Score One</li>
            <li>Score Two</li>
            <li>Score Three</li>
            <li>Score Four</li>
            <li>Score Five</li>
            <li>Score Six</li>
            <li>Score Seven</li>
            <li>Score Eight</li>
            <li>Score Nine</li>
            <li>Score Ten</li>
            </ul>
        </div>
</div><!-- end article -->

<div id="article-wrapper">
    <h1 class="title2">Space Invaders</h1>
    <p>Control a laser cannon by moving it across the bottom of the screen and firing at descending aliens. Defeat aliens as they advance towards you. Earns points by shooting them with the laser cannon. As more aliens are defeated, the aliens' movement speeds up.  If they reach the bottom, the alien invasion is successful and the game ends. </p>
    <img src="media/Invaders.jpeg" alt=""/>
        <div id="scores">
            <ul>
            <li>Score One</li>
            <li>Score Two</li>
            <li>Score Three</li>
            <li>Score Four</li>
            <li>Score Five</li>
            <li>Score Six</li>
            <li>Score Seven</li>
            <li>Score Eight</li>
            <li>Score Nine</li>
            <li>Score Ten</li>
            </ul>
        </div>
</div><!-- end article -->

</div><!-- end main content -->
<!-- sidebar -->

<div id="sidebar">
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
    <div class="thumb"><img src="media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
	<div class="thumb"><img src="media/ad.jpg" alt=""/></div>
    <div class="thumb"><img src="media/ad.jpg" alt=""/></div>

</div><!--  end sidebar -->
</div><!-- end inner container -->
<?php include ('mark/footer.php');?>
</div><!-- End Main Wrapper -->
	

</body>
</html>