<?php

include_once('resources/init.php');

$posts = ( isset ($_GET['id']) ) ? get_posts($_GET['id']) : get_posts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>tlotr's Simple Blog</title>
<style>

body { background-color: #000000; color: #ffffff; font-family: "lucida sans unicode"; font-size: 14px }

div#p_post { border: 0px solid gold; padding: 10px }

a:link { color: green; text-decoration: none }
a:active { color: red; text-decoration: none }
a:visited { color: green; text-decoration: none }
a:hover { color: orange; text-decoration: none }

span#p_date { color: orange; font-weight: bold }

ul { list-style-type: none; }
li { display: inline; margin-right: 20px; }

</style>
</head>
<body>
<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="add_post.php">Add Post</a></li>
</ul>
<h1>tlotr's Simple Blog</h1>
<hr>
<br />
<h2>Posts</h2>

<?php foreach ($posts as $post){ ?>

<div id="p_post">

<h2><a href="index.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>

<p>Posted on <span id="p_date"><?php echo date('D d-M-Y h:i:s A', strtotime($post['posted_date'])); ?></span></p>

<div><?php echo nl2br($post['contents']); ?></div>
<p> </p>
<menu>
<ul>	
<li><a href="delete_post.php?id=<?php echo $post['id']; ?>">Delete the post</a></li>
<li><a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit This Post</a></li>
</ul>
</menu>
</div>
<br /><br />
<?php } ?>
</body>
</html>
