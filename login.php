<?php 

session_start();

include_once('resources/init.php');

if(isset($_SESSION['username'])){

	header('Location: user.php');

}

if(isset($_POST['login'])){

	$errors = 	array();
	
	$user = mysql_real_escape_string($_POST['user']);
	$pass = md5(mysql_real_escape_string($_POST['pass']));
	
	$query = mysql_query("SELECT * FROM users WHERE username = '$user' AND password = '$pass'") or die(mysql_error());
		 
	$total = mysql_num_rows($query);
		 
	if($total > 0){
		 
	session_start();
		$row = mysql_fetch_assoc($query);
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['f_name'] = $row['f_name'];
        $_SESSION['l_name'] = $row['l_name'];
		header('Location: user.php');
	}
	else
	{
		$errors[] = 'Invalid username or password';
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>LOGIN | tlotr's Simple Blog</title>
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
	<a href="register.php"><li class="top-nav">REGISTER</li></a>
</ul>
</div>

<div id="contents">
<h2>LOGIN</h2>
<form method="POST" name="lo_gin" id="lo_gin" action="login.php">
<table id="log_in">
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
<!--<td align="right" class="le_ft"><label for="user">USERNAME</font></label></td>-->
<td colspan="2"><input type="text" name="user" id="user" placeholder="Username" autocomplete="off" required /></td>
</tr>
<tr>
<!--<td align="right" class="le_ft"><label for="pass">PASSWORD</font></label></td>-->
<td colspan="2"><input type="password" name="pass" id="pass" placeholder="Password" autocomplete="off" required /></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" id="login" value="LOGIN" name="login" /></td>
</tr>
</table>
</form>
</div>

</div>
</body>
</html>
