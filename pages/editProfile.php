<?php include ('header.php');
$Name = getUserName($_SESSION['email']);

if (isset($_POST['email'])) {
$email = $_POST['email'];} else {
$email = $_SESSION['email'];}

if (isset($_POST['biography'])) {
$biography = $_POST['biography'];} else {
$biography = getUserBio($_SESSION['email']);}


?>

<!-- Start Inner Wrapper for site content -->
<!-- Start Inner Wrapper for site content -->
<div id="container">
<h1 class="titleMain">Capstone Arcade</h1>

<!-- Main content div -->
<div id="main-content">
	<div id="article-wrapper">
        <h1 class="titleArticle">Edit Profile for <?php echo $Name ?>:</h1>
        <form action="../validations/updateProfileCheck.php" method="post"></select>
        <br />
					<label>Email:</label> </br>
                    <textarea id="editEmail" type="text" name="email"><?php echo $email ?></textarea>
                    </br>
					
					<label>Biography:</label> </br>
                    <textarea id="editBio" type="text" name="biography"><?php echo $biography ?></textarea>
                    </br> </br>
			
                    <input type="submit" value="Update"/>
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
	<a class="sponsors">Visit Our Sponsors</a></br>
	<a class="ads" href="http://smokefree.gov/" target="_blank"><img src="../media/advertisements/smoking.jpg" alt="Stop Smoking" title="Stop Smoking"/></a>
	<a class="ads" href="http://www.match.com/" target="_blank"><img src="../media/advertisements/match.jpeg" alt="Match" title="Match.com"/></a>
</div><!--  end sidebar -->
</div><!-- end container -->
<?php include ('footer.php');?>
</div><!-- End wrapper -->

</body>
</html>