<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="image_style.css">
<link rel="stylesheet" href="grids.css">
</head>

<body>


<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){
	if($cmd == 'rename_title') {
		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal cid parameter');
		$title = filter_input(INPUT_POST, 'title') 
			or die('Missing/illegal catname parameter');
		
		require_once('db_con.php');
		$sql = 'UPDATE image SET title=? WHERE id=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('si', $title, $id);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Changed category name to '.$title;
		}
		else {
			echo 'Could not change the name of the category';
		}	
		
		
	}
}
?>



<?php
	if (empty($id)){
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal cid parameter');	
	}
	require_once('db_con.php');
	$sql = 'SELECT title FROM image WHERE id=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $id1);
	$stmt->execute();
	$stmt->bind_result($title);
	while($stmt->fetch()){} 
?>

<div class="grid grid-pad">
	<div class="col-1-1 renamestyle">
<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
		<legend><h1>Reename title</h1></legend>
    	<input name="id" type="hidden" value="<?=$id?>" />
    	<input name="title" type="text" value="<?=$title?>" required/>
    	<button class="button" name="cmd" type="submit" value="rename_title">Save new title </button>
	</fieldset>
</form>
</p>

	<a href="viewimages.php"><h2>View images</h2></a>
	</div>
	</div>
</body>
</html>