<!-- 
	Bop It Color Game
	Gives color options in different color and prompts user to select the correct color
	block. User is on a time limit and must select the block on time or loose.
	Taylor Roberts: Create sql stubs, created html/php stubs, set up code sharing for all team members, 
                        created html base for all php code. Colored buttons, header, username form that
                        disappears, instuctions button.
	Joey Campbell:
- April, 2022
-->

<!DOCTYPE html>
<html>
	<head>
		<style>
			html { height: 100%; }
			body { background-color: white; font-family: Helvetica; height: 95%; }
		</style>
		<title>Unscrambler</title>
	<body style ="background-image: url(gameBackground.jpeg)">
	<audio autoplay loop>
	<source src="foam.mp3"/>
	</audio>
	<?php
	$display = true;
	$dbName = "websiteproject";
	//$score;

	if ($display) {
		$dbc = @mysqli_connect("websiteproject.cxm26v0zu83h.us-east-1.rds.amazonaws.com", "admin", "password", $dbName);
		
		if (!$dbc) { 
			die ("Connection failed: ". mysqli_connect_errno() . ": ".mysqli_connect_error());
		}
		
		// ====================== USERS ========================

		$username = $_POST["username"]; // retrieve username from login screen

		$selectUser = "SELECT * FROM USERS WHERE USERNAME = \"" . $username . "\"";
		if (!$result = mysqli_query($dbc, $selectUser)) {
			die ("Error with select query: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
		}

		// If the user does not exist, create a new user
		if(mysqli_num_rows($result) == 0) {
			$insertUser = "INSERT INTO USERS (USERNAME) VALUES (\"" . $username . "\");";

			if (!$result = mysqli_query($dbc, $insertUser)) {
				die ("Error with insertion query: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
			}
		}

		$selectHighScore = "SELECT HIGH_SCORE FROM USERS WHERE USERNAME = \"" . $username . "\";";
		if (!$result = mysqli_query($dbc, $selectHighScore)) {
			die ("Error with select query: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
		}
		$row = mysqli_fetch_assoc($result);
		
		$score = $row ["HIGH_SCORE"];

		echo '<h1 style = "text-align: center; margin:auto; padding: 8px; background-color: rgb(47, 57, 85); border-radius: 25px; color: rgb(245, 210, 154); width:950px;">Welcome ' . $username . ", you have unscrambled " . $score . " words!</h1><br>";

		// =====================================================


		// ====================== WORDS ========================

		$randNum = rand(1, 204);

		// GETS RANDOM WORD FROM DATABASE
		$getShuffledWord = "SELECT SHUFFLED_WORD FROM WORDS WHERE ID = " . $randNum . ";";
		if (!$result = mysqli_query($dbc, $getShuffledWord)) {
			die ("Error with select query: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
		}
		$row = mysqli_fetch_assoc($result);
		
		$shuffled = $row ["SHUFFLED_WORD"];

		echo '<br><h1 style = "text-align: center; margin:auto; padding: 8px; background-color: rgb(47, 57, 85); border-radius: 25px; color: rgb(245, 210, 154); width:400px;">Un-Scramble: ' . $shuffled . "</h1><br>";

		// =====================================================


		echo '<form action="game.php" method="post">';
		echo '<input type="hidden" name="score" value="' . $score . '">';
		echo '<input type="hidden" name="wordNum" value="' . $randNum . '">';
		echo '<input type="hidden" name="username" value="' . $username . '">';
		echo '<h1 style = "margin:auto;  border-radius: 25px; padding: 5px; background-color: rgb(47, 57, 85); width:310px; height: 53px;">';
		echo '<input style = "font-weight: bold; border-radius: 25px; padding: 13px; background-color: rgb(245, 210, 154); width:200px;"id="input-gues" placeholder="GUESS HERE" type="text" name="guess" required />';
		echo '<input style = "font-weight: bold; border-radius: 25px; padding: 13px; background-color: rgb(71, 101, 71); width:80px; color: rgb(245, 210, 154)" id="btn-guess" type="submit" name="Submit" /><br><br>';
		echo '</form>';

		echo '<form action="index.php" method="post">';
		echo '<h1></h1>';
		echo '<p align="right">';
		echo '<button style = "font-weight: bold; border-radius: 25px; padding: 13px; background-color: rgb(71, 101, 71); width:100px; color: rgb(245, 210, 154)" id="btn-guess" type="submit">Log Out</button><br><br>';
		echo '</p>';
		echo '</h1>';
		echo '</form>';

		$display = false;
	}


	if (isset($_POST['Submit'])) {
		$guess = $_POST['guess'];
		$wordNum = $_POST['wordNum'];
		$username = $_POST['username'];
		$score = $_POST['score'];

		$dbc = @mysqli_connect("websiteproject.cxm26v0zu83h.us-east-1.rds.amazonaws.com", "admin", "password", $dbName);
		$getWord = "SELECT WORD FROM WORDS WHERE ID = " . $wordNum . ";";
		if (!$result = mysqli_query($dbc, $getWord)) {
			die ("Error with select query: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
		}
		$row = mysqli_fetch_assoc($result);

		$word = $row ["WORD"];

		
		// Check if guess was correct
		if ($guess == $word) {
			echo '<h1></h1>';
			$myAudioFile = "myAudiofile2.mp3";
			echo '<audio autoplay="true" style="display:none;">
         	<source src="'.$myAudioFile.'" type="audio/mp3">
      		</audio>';
			echo '<h1 style = "text-align: center; margin:auto;  border-radius: 25px; padding: 5px; background-color: rgb(47, 57, 85); width:150px; color: rgb(245, 210, 154)"> Correct!</h1>';

			$score = $score + 1;

			$updateHighScore = "UPDATE USERS SET HIGH_SCORE = " . $score . " WHERE USERNAME = \"" . $username . "\";";
			if (!$result = mysqli_query($dbc, $updateHighScore)) {
				die ("Error with update query: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
			}
		} else {
			echo '<h1></h1>';
			$myAudioFile = "myAudiofile.mp3";
			echo '<audio autoplay="true" style="display:none;">
         	<source src="'.$myAudioFile.'" type="audio/mp3">
      		</audio>';
			echo '<h1 style = "text-align: center; margin:auto;  border-radius: 25px; padding: 5px; background-color: rgb(47, 57, 85); width:650px; color: rgb(245, 210, 154)"> Incorrect, the answer was: '. $word;'</h1>';
		}
		// $display = false;
	}
	?>
</form>
</body>

