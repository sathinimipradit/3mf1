<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="image_style.css">
<link rel="stylesheet" href="grids.css">
</head>

<body>

<div class="grid grid-pad">
<div class="col-1-1 catepil">
	<?php
	$cname = filter_input(INPUT_GET, 'category_name')
		or die ('Missinge category name');
		echo '<h1>Category: ' .$cname. '</h1>'; 
	?>
	
	<a href="categoryimage.php"><h1>&#8592;</h1></a>
	</div>
	
	<?php
	
	$cid = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT) 
		or die('Missing/illegal category parameter');	

	
	require_once('db_con.php');
	$sql = 'SELECT c.category_id, i.category_category_id, i.imageurl, i.title, i.id
FROM category c, image i
WHERE c.category_id = i.category_category_id
AND c.category_id =?
ORDER BY i.last_update DESC';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $cid);
	$stmt->execute();
	$stmt->bind_result($cid, $categorynumber, $url, $title, $id);
	while ($stmt->fetch()){ 

	
	?>
	<div class="col-1-1 imageliste">
	<h2> <?=$id?>: <?=$title?></h2>
	<img class="imagepic" src="<?=$url?>" width="300px" />
	
<?php } ?>
	
	</div>
	</div>
</body>
</html>