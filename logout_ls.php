<?php
// Initalisere sessionen.
// Glem ikke din session_navn!
session_start();
// Sluk alle session variablerne.
$_SESSION = array();
// Hvis du ønsker at dræbe sessionen, skal du også slette session cookie.
// Dette vil ødelægge sessionen, og ikke kun sessiondata!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// Ødelægger sessionen.
session_destroy();
?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Logout</title>
<link rel="stylesheet" href="pro1style.css">
<link href="https://fonts.googleapis.com/css?family=Exo:100,300,400,500" rel="stylesheet">
</head>

<body>

	<h1>Du er nu logget ud.</h1>
	<a href="start_login.php">
				<input name="submit" type="button" value="Tilbage til startside" /></a>


</body>
</html>