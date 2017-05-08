<?php
	session_start();
	require_once '../config/db.php';

	if (isset($_GET['controller'],$_GET['action'])) {
		$controller = $_GET['controller'];
		$action = $_GET['action'];
	}
	else {
		$controller = "signup";
		$action = "View";
	}


	require_once 'signup-gui.php'; 
?>