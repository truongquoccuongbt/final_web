<?php
	session_start();
	require_once '../config/db.php';
	require_once 'fbConfig.php';
	require_once '../controller/user.php';
	require_once '../controller/progress.php';

	if (isset($_SESSION['idUser'])) {
	  	header("Location: http://localhost/final_web3/views/index_learning.php");
	  	exit();
	}

	if (isset($_GET['controller'],$_GET['action'])) {
	 	$controller = $_GET['controller'];
	 	$action = $_GET['action'];
	 }
	 else {
	 	$controller = "signin";
	 	$action = "View";
	 }

	 if (isset($_POST['login'])) {
	 	$action = "Login";
	 }

	 require_once 'signin-gui.php';
?>