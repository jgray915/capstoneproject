<!-- Start Header -->
<div id="header">
    <div id="nav">
        <div id="buttons">
            <a class="btn" href="../index.php">HOME</a>
            <a class="btn" href="signup.php">JOIN</a>
            <?php
            session_start();
            if ( !empty($_SESSION['loggedin']) ) {
            echo '<a class="btn" href="logout.php">Logout</a>';
            } else {
            echo '<a class="btn" href="login.php">LogIn</a>';
            }
            ?>
        </div>
    </div><!-- close nav -->
</div><!-- End Header -->