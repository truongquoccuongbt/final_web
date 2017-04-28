<?php
	require_once 'user.php';
	class Index {
		public static function View () {
		}

		public static function Login() {
			$user = User::GetUserByUserNameAndPass($_POST['idUser'], $_POST['password']);
			if (sizeof($user) == 1) {
				$_SESSION['idUser'] = $_POST['idUser'];
				$_SESSION['password'] = $_POST['password'];
			}

			header("Location: views/learning.php");
			exit();
		}
	}
?>