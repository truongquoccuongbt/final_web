<?php
	session_start(); 
	require_once '../config/db.php';

	if (isset($_SESSION['idUser'])) {
		header("Location: views/learning.php");
		exit();
	}

	if (isset($_GET['controller'], $_GET['action'])) {
		$controller = $_GET['controller'];
		$action = $_GET['action'];
	}
	else {
		$controller = 'index';
		$action = 'View';
	}

	if (isset($_POST['login'])) {
		$controller = 'index';
		$action = 'Login';
	}

	require_once 'views/index.php';
?>