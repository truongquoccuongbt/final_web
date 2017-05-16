<?php
	include 'user.php';
	include 'progress.php';
	
	class SignUp {
		public function View() {
			if (isset($_GET['checkUserName'], $_GET['checkPassword'], $_GET['checkFirstName'], $_GET['checkLastName'], $_GET['checkEmail'])) {
				$_GET['checkUserName'] == 1 ? $textUserName = "" : $textUserName = "Only characters A-Z or number";
				$_GET['checkPassword'] == 1 ? $textPassword = "" : $textPassword = "Only characters A-Z or number";
				$_GET['checkFirstName'] == 1 ? $textFirstName = "" : $textFirstName = "Only characters A-Z or number";
				$_GET['checkLastName'] == 1 ? $textLastName = "" : $textLastName = "Only characters A-Z or number";
				$_GET['checkEmail'] == 1 ? $textEmail = "" : $textEmail = "Format incorrect";
				$_GET['checkConfirm'] == 1 ? $textConfirm = "" : $textConfirm = "Incorrect password";
			}

			

			echo "
				<div class='form-group'>
							<span id='noticeUserName' style='color: red;'></span>
							<label for='reg_username' class='sr-only'>Username</label>
							<input type='text' class='form-control' id='reg_username' name='reg_username' placeholder='username'>
						</div>
						<div class='form-group'>
							<span id='noticePassword' style='color: red;'></span>
							<label for='reg_password' class='sr-only'>Password</label>
							<input type='password' class='form-control' id='reg_password' name='reg_password' placeholder='password'>
						</div>
						<div class='form-group'>
							<span id='noticeConfirm' style='color: red;'></span>
							<label for='reg_password_confirm' class='sr-only'>Password Confirm</label>
							<input type='password' class='form-control' id='reg_password_confirm' name='reg_password_confirm' placeholder='confirm password'>
						</div>

						<div class='form-group'>
							<span id='noticeEmail' style='color: red;'></span>
							<label for='reg_email' class='sr-only'>Email</label>
							<input type='text' class='form-control' id='reg_email' name='reg_email' placeholder='email'>
						</div>
						<div class='form-group'>
							<span id='noticeFirstName' style='color: red;'></span>
							<label for='reg_firstname' class='sr-only'>First Name</label>
							<input type='text' class='form-control' id='reg_firstname' name='reg_firstname' placeholder='first name'>
						</div>
						<div class='form-group'>
							<span id='noticeLastName' style='color: red;'></span>
							<label for='reg_lastname' class='sr-only'>Last Name</label>
							<input type='text' class='form-control' id='reg_lastname' name='reg_lastname' placeholder='last name'>
						</div>

						<div class='form-group login-group-checkbox'>
							<input type='checkbox' class='' id='reg_agree' name='reg_agree'>
							<label for='reg_agree'>i agree with <a href='term.php'>terms</a></label>
						</div>
			";
			if (isset($_GET['CheckEmpty'])) {
				self::DisplayInforAgain($_SESSION['tmpIdUser'], $_SESSION['tmpPassword'], $_SESSION['tmpEmail'], $_SESSION['tmpFirstName'], $_SESSION['tmpLastName']);
			}

			if (isset($_GET['checkUserName'], $_GET['checkPassword'], $_GET['checkFirstName'], $_GET['checkLastName'], $_GET['checkEmail'])) {
				echo "
					<script>
						document.getElementById('noticeUserName').innerHTML = '{$textUserName}';
						document.getElementById('noticePassword').innerHTML = '{$textPassword}';
						document.getElementById('noticeEmail').innerHTML = '{$textEmail}';
						document.getElementById('noticeFirstName').innerHTML = '{$textFirstName}';
						document.getElementById('noticeLastName').innerHTML = '{$textLastName}';
						document.getElementById('noticeConfirm').innerHTML = '{$textConfirm}';
					</script>
				";
				self::DisplayInforAgain($_SESSION['tmpIdUser'], $_SESSION['tmpPassword'], $_SESSION['tmpEmail'], $_SESSION['tmpFirstName'], $_SESSION['tmpLastName']);
			}
		}

		private function DisplayInforAgain($idUser, $password, $email, $firstName, $lastName) {
			echo "
				<script>
					document.getElementById('reg_username').value = '{$idUser}';
					document.getElementById('reg_password').value = '{$password}';
					document.getElementById('reg_email').value = '{$email}';
					document.getElementById('reg_firstname').value = '{$firstName}';
					document.getElementById('reg_lastname').value = '{$lastName}';
				</script>
			";
		}

		public function SignUpUser() {
			$idUser = $_GET['reg_username'];
			$password = $_GET['reg_password'];
			$confirm = $_GET['reg_password_confirm'];
			$email = $_GET['reg_email'];
			$firstName = $_GET['reg_firstname'];
			$lastName = $_GET['reg_lastname'];
			$totalScore = 0;

			self::CheckInput($idUser) ? $checkUserName = 1 : $checkUserName = 0;
			self::CheckInput($password) ? $checkPassword = 1 : $checkPassword = 0;
			self::CheckInput($firstName) ? $checkFirstName = 1 : $checkFirstName = 0;
			self::CheckInput($lastName) ? $checkLastName = 1 : $checkLastName = 0;
			self::CheckEmail($email) ? $checkEmail = 1 : $checkEmail = 0;
			$confirm == $password ? $checkConfirm = 1 : $checkConfirm = 0;

			if ($checkUserName && $checkPassword && $checkFirstName && $checkLastName && $checkEmail && $checkConfirm) {
				$checkInsertUser = User::InsertUser($idUser, $password, $email, $firstName, $lastName, $totalScore);
				if ($checkInsertUser) {
					echo "
						<script>
							alert('Register success');
						</script>
					";
					self::SignInAfterSignUp($idUser, $password, $totalScore);
				}
				else {
					echo "
						<script>
							alert('User name exist');
						</script>
					";
					self::DisplayInforAgain($idUser, $password, $email, $firstName, $lastName);
				}
			}
			else {
				$_SESSION['tmpIdUser'] = $idUser;
				$_SESSION['tmpPassword'] = $password;
				$_SESSION['tmpEmail'] = $email;
				$_SESSION['tmpFirstName'] = $firstName;
				$_SESSION['tmpLastName'] = $lastName;

				if (self::CheckEmpty($idUser, $password, $confirm, $email, $firstName, $lastName)) {
					echo "
						<script>
							alert('Exist empty filed');
							window.location='signup.php?CheckEmpty=1';
						</script>
					";
					exit();
				}
				else if (!isset($_GET['reg_agree'])) {
					echo "
						<script>
							alert('Don\\'t check agree');
							window.location='signup.php?CheckEmpty=1';
						</script>
					";
					exit();
				}

				echo "
					<script>
						alert('Register fail');
						window.location='signup.php?checkUserName={$checkUserName}&checkPassword={$checkPassword}&checkConfirm={$checkConfirm}&checkFirstName={$checkFirstName}&checkLastName={$checkLastName}&checkEmail={$checkEmail}';
					</script>
				";
			}
		}

		private function CheckEmpty($idUser, $password, $email, $firstName, $lastName) {
	
			if (empty($idUser) || empty($password) || empty($email) || empty($firstName) || empty($lastName)) {
				return true;
			}
			return false;
		}

		private function SignInAfterSignUp($idUser, $password, $totalScore) {

			$_SESSION['idUser'] = $idUser;
			$_SESSION['password'] = $password;
			$_SESSION['score'] = $totalScore;
			$_SESSION['inforUser'] = array();
			$inforUser = Progress::GetProgressOfUser($idUser);
			array_push($_SESSION['inforUser'], $inforUser);

			header("Location: index_learning.php");
			exit();
		}

		private function CheckInput($input) {
			$pattern = "/[\\$\\&\\^\\<\\>\\?\\*\\#\\<\\>]/";
			return preg_match($pattern, $input) ? false : true;
		}

		private function CheckEmail($email) {
			$pattern = "/[a-zA-Z0-9\\_\\-]+@[\\.a-z]+[\\.a-z]*/";
			return preg_match($pattern, $email) ? true : false;
		}


	} 
?>