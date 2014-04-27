<?php

include_once('resources/init.php');

$posts = ( isset ($_GET['id']) ) ? get_posts($_GET['id']) : get_posts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Welcome To My Blog Page</title>
<style>

ul { list-style-type: none; }
li { display: inline; margin-right: 20px; }

</style>
</head>
<body>
<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="add_post.php">Add Post</a></li>
</ul>
<h1>Blog</h1>
<?php foreach ($posts as $post){ ?>
<h2><a href="index.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
<p>Posted on <?php echo date('d-m-Y h:i:s', strtotime($post['posted_date'])); ?></p>
<div><?php echo nl2br($post['contents']); ?></div>
<menu><ul>	<li><a href="delete_post.php?id=<?php echo $post['id']; ?>">Delete the post</a></li>
			<li><a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit This Post</a></li></ul>
</menu>
<?php } ?>
</body>
</html>
