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
	<div class="col-1-1 header"><h1>#Photooftheday</h1></div>
	<div class="col-1-3 pot">

		<h1>Wanna view all the images?</h1><br>
		<a href="viewimages.php"><button class="button3" type="submit"><h2>GALLERY</h2></button></a>
		

	</div>
	
	<div class="col-1-3 cate">
	<h2>...or...</h2>
	<h1>View images by categories</h1>
	<br>
	<ul>
<?php
	require_once('db_con.php');
	
	$sql = 'SELECT category_id, name FROM category';
	$stmt = $con->prepare($sql);
	// $stmt->bind_param();  not needed - no placeholders....
	$stmt->execute();
	$stmt->bind_result($cid, $nam);
	
	while($stmt->fetch()){ 
//  	echo '<li><a href=”filmlist.php?categoryid='.$cid.'”>'.$nam.'</a>';
//		echo '<a href=”renamecategory.php?categoryid='.$cid.'”>Rename</a>';
//		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
//		echo '<input type="hidden" name="cid" value="'.$cid.'" />';
//		echo '<button name="cmd" type="submit" value="del_category">Delete</button>';
//		echo '</form></li>'.PHP_EOL;
?>
<li><a href="imagelist.php?category_id=<?=$cid?>&category_name=<?=$nam?>"><?=$nam?></a>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<input type="hidden" name="cid" value="<?=$cid?>" />
		<button class="button1" name="cmd" type="submit" value="del_category">Delete</button>
	</form>	
</li>
<br>
<?php
	}	
?>
	</ul>
	

	</div>

	<!--Uploade-->	
	<div class="col-1-3 upl">
		
		<h2>...wanna join our community?...</h2><h1>Then upload a new picture</h1>
	<form class="uploade" action="uploade.php" method="post" enctype="multipart/form-data"><br>
		<p>Select image to upload:</p><br>
     	<input type="file" name="fileToUpload" id="fileToUpload"><br>
    	<input type="text" name="title" placeholder="Image title" required />
    	
    	<!--DROP DOWN LISTE-->
 <select class="dropd" name="minegendropdown">
      <?php
	require_once('db_con.php');
	
	$sql = 'SELECT category_id, name FROM category';
	$stmt = $con->query($sql);
		
		if($stmt->num_rows > 0){
			
		while($row = $stmt->fetch_assoc()){ 
			
			 
			echo "<option name='category_id' value='".$row['category_id']."'>".$row['name']."</option>";
		}}
		else {
			echo 'Could not find category '.$cid;
		
		}
	 ?>	
</select>
	

    	<input class="button" type="submit" value="Upload Image" name="submit">
		</form>
    	
   <br><br>
   <hr>
   <br>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	
	<fieldset>
		<legend><h3>Create new category</h3></legend>
    	<input name="catname" type="text" placeholder="Category name" required />
		<button class="button" name="cmd" type="submit" value="add_category">Create</button>
	</fieldset>
	<br>
</form>


	

<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){
	if($cmd == 'add_category') {
		$catname = filter_input(INPUT_POST, 'catname') 
			or die('Missing/illegal catname parameter');
		
		require_once('db_con.php');
		$sql = 'INSERT INTO category (name) VALUES (?)';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $catname);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Added: '.$catname;
		}
		else {
			echo 'Could not create the new category!!!';
		}	
	
}
elseif($cmd == 'del_category') {
		$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT) 
			or die('Missing/illegal cid parameter');
		
		require_once('db_con.php');
		$sql = 'DELETE FROM category WHERE category_id=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('i', $cid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Deleted category number '.$cid;
		}
		else {
			echo 'Could not delete category '.$cid;
		}
	}
	else {
		die('Unknown cmd: '.$cmd);
	}
}
?>
	</div>
	
	</div>
</body>
</html>