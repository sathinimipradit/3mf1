<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Tilmelding</title>
<link rel="stylesheet" href="pro1style.css"> <!--Kontakt med stylesheet-->
<link href="https://fonts.googleapis.com/css?family=Exo:100,300,400,500" rel="stylesheet"> <!--Skrifttype fra google fonts-->
<meta name="viewport" content="width=device-width, initial-scale=1"> <!--Icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<?php 
	

	if(filter_input(INPUT_POST, 'submit')){
		
		$un = filter_input(INPUT_POST, 'un')
			or die('Ugyldig brugernavn'); //oprette en ny bruger
		
		
		$pw = filter_input(INPUT_POST, 'pw') //indtaste kodeord
			or die('Ugyldig kodeord');
		
		$pw = password_hash($pw, PASSWORD_DEFAULT); // kryptografisk funktion. Sørger for at man ikke kan hacke kodeordet. 
			 
		/*Kontakt med database*/
		require_once('db_con_online.php'); //Min database
		$sql = 'INSERT INTO users (username, pwhash) VALUES (?, ?)'; 
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss', $un, $pw);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){ // hvis det er lykkedes brugeren, at oprette en bruger
			//udskriver dette
			echo '<h2>Bruger: '.$un.', er nu oprettet.</h2>';
			echo '<br>';
			echo '<br> <a href="start_login.php">
							<input name="submit" type="submit" value="Log ind" /></a><br>';
			echo '<hr class="hr1">';
	
		}
		
		else{// hvis det ikke lykkedes bruger, at oprette en bruger
			//udskriver dette
			echo '<h2>Kunne ikke oprette bruger - er du allerede tilmeldt?</h2>';
		}
				
	}
		
?>	
<!--START: Tilmelding formular, HTML-->
<p>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post">

		
		<h1>...Tilmelding til log-in system...</h1>
			<div class="center">
    			<label><b><i class="fa fa-user-plus"></i> Brugernavn</b></label><br>
   			 	<input type="text" placeholder="Udfyld brugernavn" name="un" required><br>

    			<label><b><i class="fa fa-unlock"></i> Kodeord</b></label><br>
    			<input type="password" placeholder="Udfyld kodeord" name="pw" required><br>
        
    			<input name="submit" type="submit" value="Tilmeld" />
    			
    			<a href="start_login.php">
				<input name="submit" type="button" value="Log ind" /></a>
    			
	</div>
</form>
</p>
<!--SLUT: Tilmelding formular-->

</body>
</html>