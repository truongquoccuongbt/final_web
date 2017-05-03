<?php
	 session_start();
	 require_once '../config/db.php';

	 if (!isset($_SESSION['idUser'])) {
	 	header("Location: ../index.php");
	 	exit();
	 }

	 if (isset($_GET['controller'],$_GET['action'])) {
	 	$controller = $_GET['controller'];
	 	$action = $_GET['action'];
	 }
	 else {
	 	$controller = "learning";
	 	$action = "View";
	 }

	 

	 if (isset($_GET['start'])) {
	 	$controller = "learning";
	 	$action = "StartQuestion";
	 	$_SESSION['idLesson'] = $_GET['start'];
	 }

	 if (isset($_POST['signOut'])) {
	 	$controller = "learning";
	 	$action = "SignOut";
	 	echo $action;
	 }
	 
	 require_once 'learning.php';
?>