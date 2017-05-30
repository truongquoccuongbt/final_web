<?php
	//include 'controller/user.php';
	class Index {
		public static function View () {
		}

		public static function Login() {
			header("Location: http://localhost/final_web3/views/signin.php");
			exit();
		}

		public static function SignUp() {
			header("Location: http://localhost/final_web3/views/signup.php");
			exit();
		}
	}
?>