<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "blog";

$connect = mysql_connect($host, $user, $pass);
mysql_select_db($db, $connect);


include_once("func/blog.php");
