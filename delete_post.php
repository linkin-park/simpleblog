<?php 

include_once('resources/init.php');

session_start();

if(!isset($_SESSION['username'])){

	header('Location: index.php');

}

if ( ! isset($_GET['id'])){
	header('Location: user.php');
	die();
}

delete('posts', $_GET['id']);

header('Location: user.php');
die();

?>
