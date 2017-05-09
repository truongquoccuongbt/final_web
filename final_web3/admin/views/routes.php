<?php
	 require_once '../controller/'.$controller.'.php';

	 switch ($controller) {
	 	case 'home':
	 		$controller = new Home();
	 		break;
	 }

	 $controller->{$action}();
?>