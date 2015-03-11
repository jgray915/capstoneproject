<html>
<head>
<title>Breakout</title>
</head>
<body>

<?php
//incluse header and sessions
$path = $_SERVER['DOCUMENT_ROOT'];
include ($path.'/capstoneproject/mark/header.php');


//function to insert into scores table

    $userID = getUserID($_SESSION['userID']);
    $gameID = 3;   
    $userID = filter_input(INPUT_POST,'userID');    
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
    
    //echo $gameID.$userID.$score;
    
    //var_dump($userID);
?>
    
<script src="breakout.js"></script>
</body>
</html>
