<?php
// A function used to insert user scores in the database after a user has completed a game. 
function insertScore()
    {    
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

//*****************************************************************************************************************************************	
//********** The following block of functions all retrieve and sort scores from the Scores table and are used as a way ******************** 
//**********           To filter and sort the data to display only the information the user is requesting.             ********************
//*****************************************************************************************************************************************	
	
//Function for retrieving top 10 overall scores, regardless of user or date, from the Scores table.  Filtered by Game.
function topTenGameScoresforAllTime($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT scores.score
		FROM scores INNER JOIN games ON scores.gameID = games.gameID  
		WHERE games.gameID = :gameID
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}

//Function for retrieving top 10 scores for the day, regardless of user, from the Scores table.  Filtered by Game.
function topTenGameScoresforDay($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.username, Scores.date 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID =:gameID AND datediff(curdate(), date) <= 1 
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}

//Function for retrieving top 10 scores for the week, regardless of user, from the Scores table.  Filtered by Game.
function topTenGameScoresforWeek($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.username, Scores.date 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID =:gameID AND datediff(curdate(), date) <= 7 
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}

//Function for retrieving top 10 scores for the month, regardless of user, from the Scores table.  Filtered by Game.
function topTenGameScoresforMonth($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Scores.userID, Scores.gameID, Scores.score, Users.username, Scores.date 
		FROM Scores INNER JOIN Users ON Scores.userID = Users.userID 
		WHERE GameID =:gameID AND Month(`date`) = Month(curdate()) 
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}

//Function for retrieving top 10 overall Usernames, regardless of date, from the Scores table.  Filtered by Game but sorted by the score for association.
function topTenUserNamesforAllTime($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT users.userName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE games.gameID = :gameID
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			?> <?php echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}

//Function for retrieving top 10 Usernames for the Day from the Scores table.  Filtered by Game but sorted by the score for association.
function topTenUserNamesforDay($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT users.userName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE games.gameID = :gameID AND datediff(curdate(), date) <= 1 
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);		
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}

//Function for retrieving top 10 Usernames for the Week from the Scores table.  Filtered by Game but sorted by the score for association.
function topTenUserNamesforWeek($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT users.userName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE games.gameID = :gameID AND datediff(curdate(), date) <= 7 
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}

//Function for retrieving top 10 Usernames for the Month from the Scores table.  Filtered by Game but sorted by the score for association.
function topTenUserNamesforMonth($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT users.userName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE games.gameID = :gameID AND Month(`date`) = Month(curdate()) 
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['userName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}
// Function created by Mark to get a games name for display purposes
function getGameNameByGameID ($gameID){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT gameName
		FROM games WHERE gameID = :gameID');
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		return gameName;
		}
}
//*****************************************************************************************************************************************	
//*****************************************************************************************************************************************	


//*****************************************************************************************************************************************	
//********** The email is stored in sessions as soon as a user logs in.  The following code uses that email to pull    ******************** 
//**********             other user related information from the database for display purposes.                        ********************
//*****************************************************************************************************************************************	

//Function used to get User ID for use by games to record scores in the Scores table
function getUserID($email)
{
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT userID FROM users WHERE email = :email'); 
		$dbs->bindParam(':email', $email);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC); 
		return $value['userID'];
		}
}
//Function used to get User Name for display in scores tables as well as for greeting purposes and profile display
function getUserName($email)
{
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT userName FROM users WHERE email = :email'); 
		$dbs->bindParam(':email', $email);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC); 
		return $value['userName'];
		}
}
//Function used to get User Biography for display in the profile page.
function getUserBio($email)
{
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT bio FROM users WHERE email = :email'); 
		$dbs->bindParam(':email', $email);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC); 
		return $value['bio'];
		}
}
//*****************************************************************************************************************************************	
//*****************************************************************************************************************************************	


//*****************************************************************************************************************************************	
//********** Sometimes, the email cannot be used to retrieve data, such as when a user is trying to update or change   ******************** 
//**********         their email.  These functions pull data using other variables stored in sessions.                 ********************
//*****************************************************************************************************************************************	

// Function to get User Email using UserID
function getEmailByID($userID)
{
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT email FROM users WHERE userID = :userID'); 
		$dbs->bindParam(':userID', $userID);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC); 
		return $value['email'];
		}
}

//Function that gets the Game's Description for Display Purposes
function getGameDescriptionByGameID ($gameID){

	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT Description	FROM games WHERE gameID = :gameID');
		$dbs->bindParam(':gameID', $gameID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
		$value = $dbs->fetch(PDO::FETCH_ASSOC);
		echo $value['Description'];
		}
}
//*****************************************************************************************************************************************	
//*****************************************************************************************************************************************	


//Function created to allow users to update their profile data.  It takes in the UserID from sessions and then takes in the new email and
// Biography information from the text boxes on the edit pages.
function updateProfile($userID, $email, $bio){
	$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('UPDATE users
			SET Email= :email, Bio = :bio
			WHERE UserID =:userID');
		$dbs->bindParam(':bio', $bio);
		$dbs->bindParam(':email', $email);
		$dbs->bindParam(':userID',$userID);

		if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            return true;
				}                       
	}

//*****************************************************************************************************************************************	
//********** The following block of functions all retrieve and sort scores from the Scores table and are used as a way ******************** 
//**********         To filter and sort the data on the profile page based on a user specified time frame.             ********************
//*****************************************************************************************************************************************
	
//Top ten scores overall
function topTenGameScoresforAllTimeByUser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT scores.score 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
} 
//Top ten game names overall to accompany the scores
function topTenGameNamesforAllTimeByuser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT games.GameName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['GameName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}
//Top ten scores for the day
function topTenGameScoresforDayByUser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT scores.score 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		AND datediff(curdate(), date) <= 1
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
} 
//Top ten game names for the day to accompany the scores
function topTenGameNamesforDayByuser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT games.GameName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		AND datediff(curdate(), date) <= 1
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['GameName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}
//Top ten scores for the week
function topTenGameScoresforWeekByUser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT scores.score 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		AND datediff(curdate(), date) <= 7
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
} 
//Top ten game names for the week to accompany the scores
function topTenGameNamesforWeekByuser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT games.GameName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		AND datediff(curdate(), date) <= 7
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['GameName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}
//Top ten scores for the month
function topTenGameScoresforMonthByUser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT scores.score 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		AND datediff(curdate(), date) <= 30
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['score'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
} 
//Top ten game names for the month to accompany the scores
function topTenGameNamesforMonthByuser($UserID){
		$db = new PDO("mysql:host=localhost;dbname=capstonegames", "root", "");
        $dbs = $db->prepare('SELECT games.GameName 
		FROM (scores INNER JOIN games ON scores.gameID = games.gameID )
		INNER JOIN users ON(users.userID = scores.userID)
		WHERE users.UserID = :UserID
		AND datediff(curdate(), date) <= 30
		ORDER BY score DESC LIMIT 10'); 
		$dbs->bindParam(':UserID', $UserID);
		
        if ( $dbs->execute() && $dbs->rowCount() > 0 ) {
            $scores = $dbs->fetchAll(PDO::FETCH_ASSOC); 
			foreach ($scores as $value) {
			echo '<td>', $value['GameName'],'</td>';?></br><?php
			echo '</tr>';
				}
			}
}	
//*****************************************************************************************************************************************	
//*****************************************************************************************************************************************	
?>  