<?php
	session_start();
	require_once '../config/db.php';

	if (isset($_SESSION['idUser'])) {
	  	header("Location: index_learning.php");
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