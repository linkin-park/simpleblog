<?php 

include_once('resources/init.php');

session_start();

if(!isset($_SESSION['username'])){

	header('Location: index.php');

}

$post = get_posts($_GET['id']);

if(isset ($_POST['title'], $_POST['content'])){
	
	$errors = array();
	
	$title = trim($_POST['title']);
	$contents = trim($_POST['content']);
	
	if ( empty($title) ){
		$errors[] = 'You need to supply a title.';
	}else if(strlen($title) > 255){
		$errors[] = 'The title cannot be longer than 255 characters';
	}
	if ( empty($contents) ){
		$errors[] = 'You need to supply the contents';
	}
	
	if($_FILES['upload']['name'] != ''){
	$file_type	=	$_FILES['upload']['type']; //returns the mime type
	$allowed	=	array("image/jpeg", "image/gif", "image/png", "application/pdf");
		if(!in_array($file_type, $allowed)){
			$errors[] = "Only jpg, gif, png and pdf files are allowed";
		}
	}	
	
	if( empty($errors) ){
	edit_post($_GET['id'], $title, $contents);
	$file = add_attachment();
	header("Location: user.php?id={$post[0]['id']}");
	die();
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $post[0]['title']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="css/mystyle.css" media="screen" type="text/css" />
</head>
<body>
<div id="wrapper">

<div id="logo">
<a href="#"><img src="images/logo.png" border="0" /></a>
</div>

<div id="navbar">
<ul id="topnav">
	<a href="index.php"><li class="top-nav">HOME</li></a>
	<a href="add_post.php"><li class="top-nav">ADD POST</li></a>
	<a href="login.php"><li class="top-nav">LOGIN</li></a>
	<a href="register.php"><li class="top-nav">REGISTER</li></a>
</ul>
</div>

<div id="contents">
<h2><?php echo $post[0]['title']; ?></h2>
<form method="post" action="" enctype="multipart/form-data">
<table id="add_post">
<tr>
<td colspan="2">
<?php

if(isset($errors) && !empty($errors)){
	echo '<ul><li>', implode('</li><li>', $errors), '</li></ul>';
}

?>
</td>
</tr>
<tr>
<td class="le_ft" align="right"><label for="title">TITLE<font color="red">*</font> </label></td>
<td><input type="text" name="title" id="title" autocomplete="off" value="<?php echo $post[0]['title']; ?>" required /></td>
</tr>
<tr>
<td class="le_ft" align="right"><label for="content">CONTENTS<font color="red">*</font> </label></td>
<td><textarea name="content" id="content" required><?php echo $post[0]['contents']; ?></textarea></td>
</tr>
<tr>
<td class="le_ft" align="right">ATTACHMENTS</td>
<td><input type="file" name="upload" size="30" id="upload" /></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" id="submit" value="UPDATE POST" name="submit" /></td>
</tr>
</table>
</form>
</div>

</div>
</body>
</html>
