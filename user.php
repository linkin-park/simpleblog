<?php 

session_start();
include_once('resources/init.php');
if(!isset($_SESSION['username'])){

	header('Location: index.php');

}
$user = $_SESSION['username'];
$fname = $_SESSION['f_name'];
$lname = $_SESSION['l_name'];

$posts = ( isset ($_GET['id']) ) ? get_posts($_GET['id']) : get_posts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo strtoupper($fname). " " .strtoupper($lname); ?> | tlotr's Simple Blog</title>
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
	<a href="chg_pass.php"><li class="top-nav">CHANGE PASSWORD</li></a>
	<a href="logout.php"><li class="top-nav">LOGOUT</li></a>
	</ul>
</div>

<div id="contents">
<h2>WELCOME <?php echo strtoupper($fname) . '&nbsp;' . strtoupper($lname); ?></h2>
<br>
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
<tr>
<td class="left" align="center"><a href="delete_post.php?id=<?php echo $post['id']; ?>"><img src="images/erase.png" height="16" border="0"></a> &nbsp; &nbsp; &nbsp; <a href="edit_post.php?id=<?php echo $post['id']; ?>"><img src="images/edit.png" height="16" border="0"></a></td>
<td></td>
</tr>
</table>
<br />
<?php } ?>
</div>

</div>
</body>
</html>
