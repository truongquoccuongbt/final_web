<?php
	require_once '../controller/'.$controller.'.php';

	switch ($controller) {
		case 'learning':
			$controller = new Learning();
			break;
		case 'signin':
			$controller = new SignIn();
			break;
		case 'signup':
			$controller = new SignUp();
			break;
	}
	$controller-> {$action}();
?>