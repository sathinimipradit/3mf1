<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="image_style.css">
<link rel="stylesheet" href="grids.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
<div class="grid grid-pad">
	
	<h1>...all images</h1>
	<div class="col-1-1 goback">
	<a href="categoryimage.php"><h1>&#8592;</h1></a>
	</div>
	
<?php
	if($submit = filter_input(INPUT_POST, 'submit')){
	if($submit == 'del_image') {
		
		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) 
			or die('Missing/illegal id parameter');
		
		$url = filter_input(INPUT_POST, 'url') 
			or die('Missing/illegal id parameter');
		
		require_once('db_con.php');
		$sql = 'DELETE FROM image WHERE id=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();
	
		if($stmt->affected_rows > 0){
			echo 'Deleted image number '.$id;
			unlink($url);
		}
		else {
			echo 'Could not delete image '.$id;
		}
	}
	else {
		die('Unknown cmd: '.$submit);
	}
	}
	require_once('db_con.php');
	$sql = 'SELECT i.id, i.imageurl, i.title, i.category_category_id, c.category_id, c.name 
FROM image i, category c
WHERE i.category_category_id = c.category_id
ORDER BY i.last_update DESC';
	$stmt =$con->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($id, $url, $title, $category_id, $cid, $name);
	
	while($stmt->fetch()){ ?>
	
	<div class="col-1-1 allpic">		
		<h3><br>Category // <?=$name?><br> Title: <u><?=$title?></u></h3>
	<img class="billede" src="<?=$url?>" width="300px" />
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	<input type="hidden" name="url" value="<?=$url?>" />
	<a href="reename_titlen.php?id=<?=$id?>"> Rename title </a>
	<input type="hidden" name="id" value="<?=$id?>" />
	<button class="button2" name="submit" type="submit" value="del_image">Delete</button>
	
	</form>
<?php } ?>
		</div>
	</div>
	
</body>
</html>