<?php
	require_once '../controller/'.$controller.'.php';

	switch ($controller) {
		case 'learning':
			$controller = new Learning();
			break;
	}
	$controller-> {$action}();
?>