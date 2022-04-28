<!DOCTYPE html>
<html>
	<head>
		<style>
			html { height: 100%; }
			body { background-color: white; font-family: Helvetica; height: 95%; }
			#top-header-1 { display: flex; justify-content: space-between; width: 100%; height: 20%; }
			#top-header-2 { display: flex; justify-content: space-between; width: 100%; height: 20%; margin-bottom: 5px; }
		</style>
		<title>Unscrambler</title>
	</head>
	
	<body style ="background-image: url(gameBackground.jpeg)">
	<audio autoplay loop>
	<source src="Fluffing-a-Duck.mp3"/>
	</audio>

	<?php
	$beforeLogIn = true;
	
	if ($beforeLogIn) {
		echo '<form style = "text-align: center;" action="game.php" method="post">';
		echo '<h1 style = "padding: 8px; background-color: rgb(47, 57, 85); border-radius: 25px; color: rgb(245, 210, 154)"> WELCOME TO WORD UNSCRAMBLER</h1>';
		echo '<h2 style = "margin:auto;  border-radius: 25px; padding: 8px; background-color: rgb(47, 57, 85); width:400px; border-radius: 25px; color: rgb(245, 210, 154)"> Please enter username to begin:</h2>';
		echo '<h3> </h3>';
		echo '<h1 style = "margin:auto;  border-radius: 25px; padding: 5px; background-color: rgb(47, 57, 85); width:310px;">';
		echo '<input style = "font-weight: bold; border-radius: 25px; padding: 13px; background-color: rgb(245, 210, 154); width:200px;" id="input-username" placeholder="Username" type="text" name="username" required />';
		echo '<button style = "font-weight: bold; border-radius: 25px; padding: 13px; background-color: rgb(71, 101, 71); width:80px; color: rgb(245, 210, 154)" id="btn-username" type="submit">Submit</button>';
		echo '</h1>';
		echo '</form>';
	}
	?>

</body>

</html>