<html>
<head>
<title></title>
</head>
<body>

<?php
//include header and sessions
$path = $_SERVER['DOCUMENT_ROOT'].'/capstoneproject';
include ($path.'/pages/header.php');

switch ($_GET['gameID']) {
    case 1:
        $gameID = 1;
		echo '<script src="breakout/breakout.js"></script>';
        break;
    case 2:
        $gameID = 2;
		echo '<script src="spaceinvaders/spaceinvaders.js"></script>';
        break;
    case 3:
        $gameID = 3;
		echo '<script src="helicopter/helicopter.js"></script>';
        break;
    default:
        echo "Game ID not set. Return to the <a href='../index.php'>home</a> page.";
}

//function to insert into scores table
if(!empty($_SESSION))
{
	$userID = getUserID($_SESSION['email']);   
	$gameID = filter_input(INPUT_POST,'gameID');
	$score = filter_input(INPUT_POST,'score');
	$date = date("Y-m-d H:i:s"); 

	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
	$dbs = $db->prepare('INSERT into scores set gameID=:gameID, userID=:userID, score=:score, date=:date');

	$dbs->bindParam(':gameID', $gameID, PDO::PARAM_STR);
	$dbs->bindParam(':userID', $userID, PDO::PARAM_STR);
	$dbs->bindParam(':score', $score, PDO::PARAM_STR);
	$dbs->bindParam(':date', $date, PDO::PARAM_STR);

	if ( $dbs->execute() && $dbs->rowCount() > 0 ) 
	{
		$dataSaved = true;
	}     
}
?>
    
</body>
</html>
