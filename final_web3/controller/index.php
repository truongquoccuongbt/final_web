<?php
	require_once 'user.php';
	require_once 'models/progress.php';
	class Index {
		public static function View () {
		}

		public static function GetProgressOfUser () {
			$infor = ProgressModel::GetProgressOfUser($_SESSION['idUser']);
			return $infor;
		}

		public static function Login() {
			$_SESSION['idUser'] = $_POST['idUser'];
			$_SESSION['password'] = $_POST['password'];
			$user = User::GetUserByUserNameAndPass($_POST['idUser'], $_POST['password']);

			if (sizeof($user) == 1) {
				$inforUser = self::GetProgressOfUser();
				$_SESSION['score'] = $inforUser[0]['score'];
				$_SESSION['date'] = $inforUser[0]['date'];
				header("Location: views/index_learning.php");
				exit();
			}
			else {
				echo 
				" <script>
					alert('Username or password is wrong!! Please check again');
				</script>
				";
			}		
		}

		
	}
?>