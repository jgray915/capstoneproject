<!-- Start Footer -->
<div id="footer">
<p class="lefty">&copy; Copyright 2015, Capstone Arcade.</p>
<p class="righty"><a href="index.php">Home</a> | 
<?php
			if (isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true) {
			$_SESSION['userID'] = getUserID($_SESSION['email']);
			//echo session_id();
			//var_dump($_SESSION['loggedin']);
			//var_dump($_SESSION['userID']);
			echo '<a href="profile.php">Profile</a>'; ?> | <?php
            echo '<a href="logout.php">Logout</a>';
			} else {
			echo '<a href="signup.php">Join</a>'; ?> | <?php
			echo '<a href="login.php">Login</a>';
			}
			?></p>
</div><!-- End Footer -->