<?php
	include 'user.php';
	include 'progress.php';
	class SignIn {
		public static function Login() {
			if ($_POST['lg_username'] == "" || $_POST['lg_password'] == "") {
				echo 
		 		" <script>
		 			alert('Mustn\\'t empty username or password!! Please check again');
		 		  </script>
		 		";
		 		return;
			}

		 	$_SESSION['idUser'] = $_POST['lg_username'];
		 	$_SESSION['password'] = $_POST['lg_password'];
			$user = User::GetUserByUserNameAndPass($_POST['lg_username'], $_POST['lg_password']);

		 	if (sizeof($user) == 1) {
		 		$inforUser = Progress::GetProgressOfUser($_SESSION['idUser']);
				
	
		 		$_SESSION['inforUser'] = array();
		 		array_push($_SESSION['inforUser'], $inforUser);
		 		header("Location: index_learning.php");
				exit();
		 	
		 	  	
		 	}
		 	else {
		 		echo 
		 		" <script>
		 			alert('Username or password is wrong!! Please check again');
		 		</script>
		 		";
		 		$_SESSION = array();
				session_destroy();
			}		
		}

		public static function View() {	
		}

		public static function GetProgressOfUser () {
		 	$infor = ProgressModel::GetProgressOfUser($_SESSION['idUser']);
		 	return $infor;
		}
	} 
?>