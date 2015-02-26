<?php
if (!isset($_POST['email'])) {
$email = "";}
if (!isset($_POST['password'])) {
$password = "";}
?>        
<?php include ('header.php');?>
<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
	<h1 class="title">Capstone Arcade Presents:</h1>
	<!-- Main content div -->
		<div id="main-content">
			<div id="article-wrapper">
                    <h1 class="title2">Log In</h1>
                    <form action="login2.php" method="post"></select>
                    <br />

                    <label>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="email" value="<?php echo $email; ?>" />
                    <br />
                    <br />

                    <label>Password:&nbsp;&nbsp;</label>
                    <input type="password" name="password" value="<?php echo $password;?>"/>
                    <br />
                    <br />
                
                    <input type="submit" value="Log In"/>
                    <br />
					
                    <?php 
                    if (isset($errors)&& count($errors)> 0) : ?>
                    <h2>Errors:</h2>
                    <ul>
                    <?php foreach($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    </form>
			</div><!-- end article wrapper -->
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
