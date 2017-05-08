<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign up</title>
	<link type="text/css" href="../public/css/custom-signup.css" rel="stylesheet">
	<link type="text/css" href="../public/css/bootstrap-grid.css" rel="stylesheet">
	<link type="text/css" href="../public/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="../public/css/bootstrap.css" rel="stylesheet">
	<link type="text/css" href="../public/css/bootstrap-grid.min.css" rel="stylesheet">
	<link type="text/css" href="../public/css/bootstrap-reboot.css" rel="stylesheet">
	<link type="text/css" href="../public/css/bootstrap-reboot.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<script src="../public/js/bootstrap.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
	<script src="../public/js/js-signup.js"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<a href="index.php">
			<img id="header-logo" src="../public/image/logo.PNG">
		</a>
		<nav class="site-nav">
		</nav>
	</header>
	<section class="header-sec">
	</section>	
	<div class="text-center">
		<div class="logo">register</div>
		<!-- Main Form -->
		<div class="login-form-1">
			<form id="register-form" class="text-left">
				<div class="login-form-main-message"></div>
				<div class="main-login-form">
					<div class="login-group">
						<div class="form-group">
							<label for="reg_username" class="sr-only">Username</label>
							<input type="text" class="form-control" id="reg_username" name="reg_username" placeholder="username">
						</div>
						<div class="form-group">
							<label for="reg_password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password">
						</div>
						<div class="form-group">
							<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
							<input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password">
						</div>

						<div class="form-group">
							<label for="reg_email" class="sr-only">Email</label>
							<input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="email">
						</div>
						<div class="form-group">
							<label for="reg_firstname" class="sr-only">First Name</label>
							<input type="text" class="form-control" id="reg_firstname" name="reg_firstname" placeholder="first name">
						</div>
						<div class="form-group">
							<label for="reg_lastname" class="sr-only">Last Name</label>
							<input type="text" class="form-control" id="reg_lastname" name="reg_lastname" placeholder="last name">
						</div>

						<div class="form-group login-group-checkbox">
							<input type="checkbox" class="" id="reg_agree" name="reg_agree">
							<label for="reg_agree">i agree with <a href="term.php">terms</a></label>
						</div>
					</div>
					<button type="submit" class="login-button" name="signUp" onclick="CheckInput()"><i class="fa fa-chevron-right"></i></button>
				</div>
				<div class="etc-login-form">
					<p>already have an account? <a href="signin.php">login here</a></p>
				</div>
			</form>
		</div>
		<!-- end:Main Form -->
	</div>
	<section class="footer-sec">
			<p>[Đồ án môn Phát Triển Ứng Dụng Web - Website học tiếng Anh online]</p>
			<p>[Trương Quốc Cường - 51403013 | Trần Trung Tín - 51403320]</p>
	</section>
	<?php require_once 'routes.php'; ?>;
</body>
</html>