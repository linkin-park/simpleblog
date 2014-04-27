<?php

include_once('resources/init.php');
$image = checkUpload();
if(isset ($_POST['title'], $_POST['contents']) ){
	
	$errors = array();
	
	$title = trim($_POST['title']);
	$contents = trim($_POST['contents']);
	
	if ( empty($title) ){
		$errors[] = 'You need to supply a title.';
	}else if(strlen($title) > 255){
		$errors[] = 'The title cannot be longer than 255 characters';
	}
	if ( empty($contents) ){
		$errors[] = 'You need to supply the contents';
	}
	
	if( empty($errors) ){
		add_post($title, $contents);
		$id = mysql_insert_id();
		header("Location: index.php?id={$id}");
		die();
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title> </title>
</head>
<body>
<h1>Add a post</h1>
<?php

if(isset($errors) && !empty($errors)){
	echo '<ul><li>', implode('</li><li>', $errors), '</li></ul>';
}

?>
<form method="post" action="" enctype="multipart/form-data">
<label for="title">Title</label>
<input type="text" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>" />
<br /><br />
<textarea name="contents" rows="15" cols="50"><?php if(isset($_POST['contents'])) echo $_POST['contents']; ?></textarea>
<br /><br />
<input type="file" name="upload" size="30" id="upload" />
<br /><br />
<input type="submit" value="Add Post" name="submit" />
</form>
</body>
</html>
