<?php
	include '../controller/user.php';
	class Index {
		public static function View () {
		}

		public function Login () {
			$_SESSION['idAdmin'] = $_POST['lg_username'];
			$_SESSION['password'] = $_POST['lg_password'];
			$user = User::GetUserByUserNameAndPass($_POST['lg_username'], $_POST['lg_password']);

			if (sizeof($user) == 1 && self::CheckUserName($_POST['lg_username'])) {
				header("Location: views/home.php");
				exit();
			}
			else {
				$_SESSION = array();
				session_destroy();
				echo "
					<script>
						alert('Username or Password was wrong');
					</script>
				";
			}
		}

		private function CheckUserName($userName) {
			if ($userName == "admin") {
				return true;
			}
			return false;
		}
	} 
?>