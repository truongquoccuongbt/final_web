<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign in Admin</title>
	<link type="text/css" href="../public/css/custom-signin.css" rel="stylesheet">
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
<?php require_once 'routes_index.php'; ?>
<body>
	<header>
		<a href="index.php">
			<img id="../public/header-logo" src="../public/image/logo.PNG">
		</a>
		<nav class="site-nav">
		</nav>
	</header>
	<section class="header-sec">
	</section>	
	<div class="text-center" style="padding:50px 0">
		<div class="logo">hi ! admin</div>
		<!-- Main Form -->
		<div class="login-form-1">
			<form id="login-form" class="text-left" method="post">
				<div class="login-form-main-message"></div>
				<div class="main-login-form">
					<div class="login-group">
						<div class="form-group">
							<label for="lg_username" class="sr-only">Username</label>
							<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
						</div>
						<div class="form-group">
							<label for="lg_password" class="sr-only">Password</label>
							<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
						</div>
					</div>
					<button type="submit" class="login-button" name="login"><i class="fa fa-chevron-right"></i></button>
				</div>
			</form>
		</div>
		<!-- end:Main Form -->
	</div>
	<section class="footer-sec">
			<p>[Đồ án môn Phát Triển Ứng Dụng Web - Website học tiếng Anh online]</p>
			<p>[Trương Quốc Cường - 51403013 | Trần Trung Tín - 51403320]</p>
	</section>
</body>
</html>