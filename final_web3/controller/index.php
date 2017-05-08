<?php
	class Index {
		public static function View () {
		}

		public static function Login() {
			header("Location: views/signin.php");
			exit();
		}

		public static function SignUp() {
			header("Location: views/signup.php");
			exit();
		}
	}
?>