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
<style>

body { background-color: #000000; color: #ffffff; font-family: "lucida sans unicode"; font-size: 14px }

div#p_post { border: 0px solid gold; padding: 10px }

a:link { color: green; text-decoration: none }
a:active { color: red; text-decoration: none }
a:visited { color: green; text-decoration: none }
a:hover { color: orange; text-decoration: none }

span#p_date { color: orange; font-weight: bold }

input { background-color: #1E1E1E; color: white; border: 0; padding: 5px; }
textarea { background-color: #1E1E1E; color: white; border: 0; padding-left: 5px; padding-top: 10px; padding-right: 10px; padding-bottom: 5px; overflow: auto; }
#submit:hover { background-color: #5C5C5C; color: orange }

ul#topnav { list-style-type: none; }
li.top-nav { display: inline; margin-right: 20px; }

#title { width: 370px; font-family: "lucida sans unicode" }
#contents { width: 365px; height: 300px; font-family: "lucida sans unicode" }
#submit { padding: 2px }

</style>
<title><?php echo $post[0]['title']; ?></title>
</head>
<body>
<ul id="topnav">
	<li class="top-nav"><a href="index.php">Home</a></li>
</ul>
<h1>Edit This post</h1>

<?php

if(isset($errors) && !empty($errors)){
	echo '<ul><li>', implode('</li><li>', $errors), '</li></ul>';
}

?>
<form method="post" action="">
<table border="0" cellspacing="5" cellpadding="5">
<tr>
<td><label for="title">Title<font color="red">*</font>: </label></td>
<td><input type="text" name="title" id="title" autocomplete="off" value="<?php echo $post[0]['title']; ?>" /></td>
</tr>
<tr>
<td><label for="contents">Contents<font color="red">*</font>: </label></td>
<td><textarea name="contents" id="contents"><?php echo $post[0]['contents']; ?></textarea></td>
</tr>
<tr>
<td colspan="2"><input type="submit" id="submit" value="Add Post" name="submit" /></td>
</tr>
</table>
</form>

</body>
</html>
