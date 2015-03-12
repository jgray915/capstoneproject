<html>
<head>
<title>Breakout</title>
</head>
<body>

<?php
//include header and sessions
$path = $_SERVER['DOCUMENT_ROOT'].'/capstoneproject';
include ($path.'/pages/header.php');

//function to insert into scores table
    if(!empty($_SESSION)){
    $userID = getUserID($_SESSION['email']);   
     
    $gameID = 1;   
    $score = filter_input(INPUT_POST,'score');
    $date = date("Y-m-d H:i:s"); 
    
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
    $dbs = $db->prepare('INSERT into scores set gameID=:gameID, userID=:userID, score=:score, date=:date');
    
     $dbs->bindParam(':gameID', $gameID, PDO::PARAM_STR);
     $dbs->bindParam(':userID', $userID, PDO::PARAM_STR);
     $dbs->bindParam(':score', $score, PDO::PARAM_STR);
     $dbs->bindParam(':date', $date, PDO::PARAM_STR);
     
		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
        $dataSaved = true;
		}     
	}
?>
    
<script src="breakout.js"></script>
</body>
</html>
