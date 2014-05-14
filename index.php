<?php 

session_start();

include_once('resources/init.php');

if(isset($_SESSION['username'])){

	header('Location: user.php');

}

$posts = ( isset ($_GET['id']) ) ? get_posts($_GET['id']) : get_posts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>tlotr's Simple Blog</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="css/mystyle.css" media="screen" type="text/css" />
</head>
<body>
<div id="wrapper">

<div id="logo">
<a href="index.php"><img src="images/logo.png" border="0" /></a>
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
<h2>POSTS</h2>
<?php foreach ($posts as $post){ ?>
<table id="index">
<tr>
<td class="left">TITLE</td>
<td><a href="index.php?id=<?php echo $post['id']; ?>"><?php echo "<span id=\"p_title\">" .$post['title']. "</span>"; ?></a></td>
<tr>
<tr>
<td class="left">POSTED ON</td>
<td><span id="p_date"><?php echo date('D d-M-Y h:i:s A', strtotime($post['posted_date'])); ?></span></td>
</tr>
<tr>
<td class="left">CONTENTS</td>
<td><?php echo nl2br($post['contents']); ?></td>
</tr>
<tr>
<td class="left">ATTACHMENTS</td>
<td><?php if($post['names'] != 'null'): ?> <span class="attach"><a href="upload/<?=$post['names'];?>" target="blank"><?=$post['names'];?></a></span> <?php endif; ?> </td>
</tr>
</table>
<br />
<?php } ?>
</div>

</div>
</body>
</html>
