<?php
	require_once 'controller/'.$controller.'.php';

	switch ($controller) {
		case 'index':
			$controller = new Index();
			break;
	}

	if (isset($_POST['submit'])) {
		$action = 'Login';
	}
	$controller->{$action}();
?>