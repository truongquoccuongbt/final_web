<?php
	session_start();
	require_once '../../config/db.php';

	if (!isset($_SESSION['idAdmin'])) {
		header("Location: ../index.php");
		exit();
	}

	if (isset($_GET['controller'], $_GET['action'])) {
		$controller = $_GET['controller'];
		$action = $_GET['action'];
	}
	else {
		$controller = 'home';
		$action = 'View';
	}

	if (isset($_GET['signOut'])) {
		$controller = "home";
		$action = "SignOut";
	}

	if (isset($_GET['removeUser'])) {
		$action = "DeleteUser";
	}

	require_once 'home-gui.php';
?>