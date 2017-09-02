<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Content page</title>
<link rel="stylesheet" href="pro1style.css">
<link href="https://fonts.googleapis.com/css?family=Exo:100,300,400,500" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php
	// hvis man logger ud, og trykker på "pilen tilbage" vil man blive bedt om at logge ind igen, da bruger id'et nu er krypteret.  
	if(empty($_SESSION['uid'])){
		echo '<h2><b>Du skal være logget ind, for at få adgang til din profil</b></h2>';
		echo '<br> <a href="start_login.php">
							<input name="submit" type="submit" value="Log ind" /></a><br>';
	}
	//Hvis det er lykkedes brugeren at logge ind, vil der komme en personlig besked til brugeren. 
	else {
		echo '<h2>Velkommen til denne hemmelige side...<br> <i class="fa fa-user"></i> '.$_SESSION['username'];
		echo '<br><a href="logout_ls.php">
		<input name="submit" type="button" value="Log ud" /></a><br>';
	}
?><br>

</body>
</html>