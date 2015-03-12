<!-- Start Footer -->
<div id="footer">
<p class="lefty">&copy; Copyright 2015, Capstone Arcade.</p>
<p class="righty"><a href="../pages/home.php">Home</a> | 
<?php
			if (isset($_SESSION['loggedin'])&& $_SESSION['loggedin'] == true) {
			$_SESSION['userID'] = getUserID($_SESSION['email']);
			echo '<a href="../pages/profile.php">Profile</a>'; ?> | <?php
            echo '<a href="../pages/logout.php">Logout</a>';
			} else {
			echo '<a href="../pages/signup.php">Join</a>'; ?> | <?php
			echo '<a href="../pages/login.php">Login</a>';
			}
			?></p>
</div><!-- End Footer -->