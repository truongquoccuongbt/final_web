<?php
	require_once 'controller/'.$controller.'.php';

	switch ($controller) {
		case 'index':
			$controller = new Index();
			break;
	}

	$controller->{$action}();
?>