<?php
	session_start(); 
	require_once 'config/db.php';
	if (isset($_GET['controller'], $_GET['action'])) {
		$controller = $_GET['controller'];
		$action = $_GET['action'];
	}
	else {
		$controller = 'index';
		$action = 'view';
	}

	if (isset($_POST['login'])) {
		$controller = 'index';
		$action = 'Login';
	}

	if (isset($_POST['get_started'])) {
	}

	require_once 'views/index.php';
?>