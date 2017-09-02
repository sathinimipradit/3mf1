<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Startside - Login</title>
<link rel="stylesheet" href="pro1style.css">
<link href="https://fonts.googleapis.com/css?family=Exo:100,300,400,500" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	
	// Kontakt med min database
	require_once('db_con_online.php');
	$sql = 'SELECT id, pwhash FROM users WHERE username=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);
	
	while($stmt->fetch()) { }
	
		//Her finder serveren bruger id fra databasen. Altså den finder/husker tilmeldte brugerprofiler. Serveren bestemmer hvor lang tid bruger id'et er tilgængelig. 
	if (password_verify($pw, $pwhash)){
		echo "<script>window.open('baseside.php','_self')</script>";
		$_SESSION['uid'] = $uid;
		$_SESSION['username'] = $un;
		
	}
	//Hvis ikke serveren kan finde det indstastet informationer, bliver der udskrevet dette: 
	else{
		echo '<p><b>Ugyldig brugernavn eller kodeord</b></p>';
	}
	echo '<hr>';
}
	
?>



<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	
<!--START: Min log ind formular-->
	<h1>...Log ind...</h1>
   	
 <div class="center">
   	<label><i class="fa fa-user"></i> Brugernavn</label><br>
    	<input name="un" type="text"placeholder="Brugernavn" required /><br>
    <label><i class="fa fa-unlock"></i> Kodeord</label><br>
    	<input name="pw" type="password" placeholder="Password" required /><br>
    	
    	<input name="submit" type="submit" value="Log ind" />
		
	 <p>Eller...</p>
	
	<a href="tilmelding.php">
		<input name="submit" type="button" value="Opret en ny bruger" /></a>
	</div>
	
	</form>
<!--SLUT: Min log ind formular-->


</body>
</html>