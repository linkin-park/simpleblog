<?php 

session_start();

if(!isset($_SESSION['username'])){

	header('Location: index.php');

}

include_once('resources/init.php');

$user = $_SESSION['username'];
$fname = $_SESSION['f_name'];
$lname = $_SESSION['l_name'];

if(isset($_POST['chg_pass'])){

$errors = 	array();

$old_pass = md5(mysql_real_escape_string($_POST['old_pass']));
$new_pass = md5(mysql_real_escape_string($_POST['pwd1']));

$query = mysql_query("SELECT password FROM users WHERE username = '$user'") or die(mysql_error());

$row = mysql_fetch_assoc($query);

if($old_pass == $row['password']){

	mysql_query("UPDATE users SET password = '$new_pass' WHERE username = '$user'") or die(mysql_error());
	echo "<script>alert('Password Change Successfully!');</script>";
	session_destroy();
	echo "<script>location.href='login.php';</script>";
}else{
	$errors[] = 'The old password entered is incorrect';
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CHANGE PASSWORD | tlotr's Simple Blog</title>
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
</ul>
</div>

<div id="contents">
<h2>CHANGE PASSWORD FOR <?php echo strtoupper($fname) . ' ' . strtoupper($lname); ?></h2>
<form method="POST" name="chg_pass" action="chg_pass.php">
<table id="cg_pass">
<tr>
<td colspan="2">
<?php
	if(isset($errors) && !empty($errors))
{
	echo '<ul><li>', implode('</li><li>', $errors), '</li></ul>';
}
?>
</td>
</tr>
<tr>
<td class="le_ft"><label for="old_pass">OLD PASSWORD</label></td>
<td><input type="password" name="old_pass" id="old_pass" autocomplete="off" required  />
</tr>
<tr>
<td class="le_ft"><label for="new_pass">NEW PASSWORD</label></td>
<td><input type="password" id="new_pass" autocomplete="off" required name="pwd1" onchange="form.pwd2.pattern = this.value;" />
</tr>
<tr>
<td class="le_ft"><label for="new_pass_2">CONFIRM NEW PASSWORD</label></td>
<td><input type="password" id="new_pass_2" autocomplete="off" required name="pwd2" />
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="CHANGE PASSWORD" id="submit_pass" name="chg_pass" />
</table>
</form>
</div>

</div>
</body>
</html>
