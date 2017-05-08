<?php
	session_start(); 
	// require_once 'config/db.php';

	// if (isset($_SESSION['idUser'])) {
	// 	header("Location: views/learning.php");
	// 	exit();
	// }

	if (isset($_GET['controller'], $_GET['action'])) {
		$controller = $_GET['controller'];
		$action = $_GET['action'];
	}
	else {
		$controller = 'index';
		$action = 'view';
	}

	if (isset($_GET['login']) || isset($_GET['started'])) {
		$controller = 'index';
		$action = 'Login';
	}

	if (isset($_GET['signup'])) {
	 	$controller = 'index';
	 	$action = 'SignUp';
	}

	require_once 'views/index.php';
?>