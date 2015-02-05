<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
<body>
    <div id="wrapper">
        <?php 
        include_once 'header.php'; ?>
        <div id="container ">
            <div id="main-content">
                <div id="article-wrapper">
                    <h1 class="title2">Log In</h1>
                    <form action="login2.php" method="post"></select>
                    <br />

                    <label>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="email" />
                    <br />
                    <br />

                    <label>Password:&nbsp;&nbsp;</label>
                    <input type="password" name="password" />
                    <br />
                    <br />
                
                    <input type="submit" value="Log In" />
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
                </div>
            </div>
        </div>
    </div>
</body>
</html>
