<?php 

include_once('resources/init.php');

$post = get_posts($_GET['id']);

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
		edit_post($_GET['id'], $title, $contents);
		
		header("Location: index.php?id={$post[0]['id']}");
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
<h1>Edit This post</h1>

<?php

if(isset($errors) && !empty($errors)){
	echo '<ul><li>', implode('</li><li>', $errors), '</li></ul>';
}

?>
<form method="post" action="">
<label for="title">Title</label>
<input type="text" name="title" value="<?php echo $post[0]['title']; ?>" />
<br /><br />
<textarea name="contents" rows="15" cols="50"><?php echo $post[0]['contents']; ?></textarea>
<br /><br />
<input type="submit" value="Submit" name="submit" />
</form>

</body>
</html>
