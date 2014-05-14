<?php 

	session_start();

	include_once('resources/init.php');

	if(isset($_SESSION['username'])){

	header('Location: user.php');

	}

	if(isset($_POST['register'])){

	$errors = array();
	
	$user = mysql_real_escape_string($_POST['username']);
	$pass = mysql_real_escape_string(md5($_POST['password']));
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$email = mysql_real_escape_string($_POST['email']);
	
	$u = mysql_query("SELECT * FROM users WHERE username = '$user'") or die(mysql_error());
	
	$u_total = mysql_num_rows($u);
	
	if($u_total > 0){
	
	$errors[] = 'That username already exists';
	
	}
	
	$e = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());
	
	$e_total = mysql_num_rows($e);
	
	if($e_total > 0){
	
	$errors[] = 'That email address already exists';
	
	}
	
	if(empty($errors)){
	
	mysql_query("INSERT INTO users (username, password, f_name, l_name, email) VALUES ('$user', '$pass', '$fname', '$lname', '$email')") or die(mysql_error());
	echo "<script>alert('Registration Successfully!');</script>";
	echo "<script>location.href='login.php';</script>";
	
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>REGISTER | tlotr's Simple Blog</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="css/mystyle.css" media="screen" type="text/css" />
<script>
function emptyElement(x){
	document.getElementById('status').innerHTML = "";
}
</script>
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
</ul>
</div>

<div id="contents">
<h2>REGISTER</h2>
<form method="POST" action="register.php" name="register">
<table id="reg">
<tr>
<td colspan="2" id="status">
<?php
if(isset($errors) && !empty($errors)){
echo '<ul class="error"><li class="error">', implode('</li><li class="error">', $errors), '</li></ul>';
}
?>
</td>
</tr>
<tr>
<td class="le_ft" align="right"><label for="username">USERNAME</label></td>
<td><input type="text" name="username" id="username" placeholder="Username" onfocus="emptyElement()" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" autocomplete="off" pattern="\w+" required />
</tr>
<tr>
<td class="le_ft" align="right"><label for="password">PASSWORD</label></td>
<td><input type="password" name="password" id="password" placeholder="Password" autocomplete="off" onchange="form.password2.pattern = this.value;" required />
</tr>
<tr>
<td class="le_ft" align="right"><label for="password2">CONFIRM PASSWORD</label></td>
<td><input type="password" name="password2" id="password2" placeholder="Confirm Password" autocomplete="off" required />
</tr>
<tr>
<td class="le_ft" align="right"><label for="fname">FIRST NAME</label></td>
<td><input type="text" name="fname" id="fname" placeholder="First Name" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>" autocomplete="off" pattern="\w+" required />
</tr>
<tr>
<td class="le_ft" align="right"><label for="lname">LAST NAME</label></td>
<td><input type="text" name="lname" id="lname" placeholder="Last Name" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>" autocomplete="off" pattern="\w+" required />
</tr>
<tr>
<td class="le_ft" align="right"><label for="email">E-MAIL</label></td>
<td><input type="email" name="email" id="email" onfocus="emptyElement()" placeholder="E-Mail" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" autocomplete="off" required />
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="register" id="register" value="REGISTER" />
</tr>
</table>
</form>
</div>

</div>
</body>
</html>
