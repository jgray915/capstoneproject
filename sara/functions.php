<?php
 
    function insertScore()
    {    
        //php code for inserting into scores table
            $gameID = filter_input(INPUT_POST,'gameID');
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

            echo $gameID.$userID.$score;
    }

    function topTenScoresGame1(){
        // php code for retrieving data from the Scores table (Breakout)
        $userID = filter_input(INPUT_POST,'userID');
        $gameID = filter_input(INPUT_POST,'gameID');
        $score = filter_input(INPUT_POST,'score');
	$error_message = '';    
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.userName 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID WHERE GameID =1 ORDER BY score DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
                            $i++;
                            echo $i;
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                        
    }
    
    function topTenScoresGame2(){
        // php code for retrieving data from the Scores table (Space Invaders)
        $userID = filter_input(INPUT_POST,'userID');
        $gameID = filter_input(INPUT_POST,'gameID');
        $score = filter_input(INPUT_POST,'score');
	$error_message = '';    
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.userName FROM Scores INNER JOIN Users ON Scores.userID = Users.userID WHERE GameID =2 ORDER BY score DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
                            $i++;
                            echo $i;
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                        
    }
    
    function topTenScoresGame3(){
        // php code for retrieving top 10 all time scores from game 3 from the Scores table (Helicopter)
        $userID = filter_input(INPUT_POST,'userID');
        $gameID = filter_input(INPUT_POST,'gameID');
        $score = filter_input(INPUT_POST,'score');
	$error_message = '';    
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.userName FROM Scores INNER JOIN Users ON Scores.userID = Users.userID WHERE GameID =3 ORDER BY score DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
                            $i++;
                            echo $i;
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                        
    }
  
    function topTenScoresGameforDay(){
        // php code for retrieving top 10 scores for the day from the Scores table
        $userID = filter_input(INPUT_POST,'userID');
        $gameID = filter_input(INPUT_POST,'gameID');
        $score = filter_input(INPUT_POST,'score');
	$error_message = '';    
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.username, Scores.date FROM Scores INNER JOIN Users ON Scores.userID = Users.userID WHERE GameID =1 AND datediff(curdate(), date) <= 1 ORDER BY score DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
                            $i++;
                            echo $i;
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                        
    }
                        
       
    function topTenScoresGameforWeek(){
        // php code for retrieving top 10 scores for the week from the Scores table
        $userID = filter_input(INPUT_POST,'userID');
        $gameID = filter_input(INPUT_POST,'gameID');
        $score = filter_input(INPUT_POST,'score');
	$error_message = '';    
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.username, Scores.date 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID =1 AND datediff(curdate(), date) <= 7 ORDER BY score DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
                            $i++;
                            echo $i;
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                        
    }
        
    
    function topTenScoresGameforMonth(){
        // php code for retrieving top 10 scores for the month from the Scores table
        $userID = filter_input(INPUT_POST,'userID');
        $gameID = filter_input(INPUT_POST,'gameID');
        $score = filter_input(INPUT_POST,'score');
        $error_message = '';    
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.username, Scores.date 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID =1 AND Month(`date`) = Month(curdate()) ORDER BY score DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
                            $i++;
                            echo $i;
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                        
    }
    
    function topTenScoresforUsers(){
        // php code for retrieving top 10 scores for a user for a specific game from the Scores table
        $userID = filter_input(INPUT_POST,'userID');
        $gameID = filter_input(INPUT_POST,'gameID');
        $score = filter_input(INPUT_POST,'score');
			$error_message = '';    
        $i = 0;
        $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.username, Scores.date 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE gameID =1 AND Scores.userID=1 AND datediff(curdate(), date) <= 1 ORDER BY score DESC LIMIT 10'); 

        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
                            $i++;
                            echo $i;
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['username'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                        
    }

// php code for retrieving top 10 scores for a user from the Scores table
function topTenScoresforUser($userID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT scores.score, games.GameName 
		FROM scores INNER JOIN games ON scores.gameID = games.gameID  
		WHERE userID = :userID
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':userID', $userID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			?> Score: <?php echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
		else { echo 'You have no records to display!';}
}

// php code for retrieving top 10 scores for a user from the Scores table
function topTenGamesforUser($userID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT scores.score, games.GameName 
		FROM scores INNER JOIN games ON scores.gameID = games.gameID  
		WHERE userID = :userID
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':userID', $userID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			?> <?php echo '<td>', $value['GameName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
		else { echo 'You have no records to display!';}
}

function getGameNameByGameID ($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT gameName
		FROM games WHERE gameID = :gameID');
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		return gameName;
		}
}

// Function created by Mark to get User ID for display purposes
function getUserID($email)
{
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT userID FROM users WHERE email = :email'); 
		$dbs->bindParam(':email', $email);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC); 
		return $value;
		}
}

// Function created by Mark to get the Games Description for Display Purposes
function getGameDescriptionByGameID ($gameID){

	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Description	FROM games WHERE gameID = :gameID');
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC);
		echo $value['Description'];
		}
}

// Function created by Mark to get User Name for display purposes
function getUserName($email)
{
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT userName FROM users WHERE email = :email'); 
		$dbs->bindParam(':email', $email);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC); 
		return $value;
		}
}

// Function created by Mark to get User Biography for display purposes
function getUserBio($email)
{
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT bio FROM users WHERE email = :email'); 
		$dbs->bindParam(':email', $email);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC); 
		return $value;
		}
}

// Function created by Mark to get the top scores for the day for Display purposes
function topTenScoresGameforDayAll($gameID){
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.gameID, Scores.score, Users.userName 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID =:gameID AND datediff(curdate(), date) <= 1 ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                       
    }

// Function created by Mark to get the top scores for the week for Display purposes
function topTenScoresGameforWeekAll($gameID){
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.gameID, Scores.score, Users.userName 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID = :gameID AND datediff(curdate(), date) <= 7 ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                       
    }
	
// Function created by Mark to get the top scores for the month for Display purposes
function topTenScoresGameforMonthAll($gameID){
    $db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.gameID, Scores.score, Users.userName 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID = :gameID AND Month(`date`) = Month(curdate()) ORDER BY score DESC LIMIT 10');
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			?><ul> Top 10 Scores:</br><?php
			foreach ($scores as $value) {
			?> Score: <?php echo '<td>', $value['score'],'</td>';?> 
			User Name: <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}                       
    } 	
?>  