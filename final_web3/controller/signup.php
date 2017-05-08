<?php
	include 'user.php';
	include 'progress.php';
	
	class SignUp {
		public function View() {
			// echo "
			// 	<script>
			// 		function CheckInput() {
			// 			CheckUserName();
			// 		}

			// 		function CheckUserName() {
			// 			var userName = document.getElementById('reg_username').value;
			// 			var pattern = '/[A-Za-z0-9]/';
			// 			pattern.test(userName);
			// 		}
			// 	</script>
			// ";
		}

		public function SignUp() {
			$idUser = $_GET['reg_username'];
			$password = $_GET['reg_password'];
			$email = $_GET['reg_email'];
			$firstName = $_GET['reg_firstname'];
			$lastName = $_GET['reg_lastname'];
			$totalScore = 0;

			$checkInsertUser = User::InsertUser($idUser, $password, $email, $firstName, $lastName, $totalScore);
			// if ($checkInsertUser == true) {
			// 	self::SignInAfterSignUp($idUser, $password, $totalScore);
			// }
		}

		// private function SignInAfterSignUp($idUser, $password, $totalScore) {
		// 	$_SESSION['idUser'] = $idUser;
		// 	$_SESSION['password'] = $password;
		// 	$_SESSION['score'] = $totalScore;

		// 	header("Location: index_learning.php");
		// 	exit();
		// }
	} 
?>