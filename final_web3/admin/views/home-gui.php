<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
	<link type="text/css" href="../../public/css/bootstrap-grid.css" rel="stylesheet">
	<link type="text/css" href="../../public/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="../../public/css/bootstrap.css" rel="stylesheet">
	<link type="text/css" href="../../public/css/bootstrap-grid.min.css" rel="stylesheet">
	<link type="text/css" href="../../public/css/bootstrap-reboot.css" rel="stylesheet">
	<link type="text/css" href="../../public/css/bootstrap-reboot.min.css" rel="stylesheet">
	<script src="../../public/js/bootstrap.js"></script>
	<script src="../../public/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="contener-div">
		<header>
			<a href="../index.php">
				<img id="header-logo" src="../../public/image/logo.PNG">
			</a>
			<nav class="site-nav">
				<form id="signin" class="navbar-form navbar-right" role="form">
					<ul>	
                        <li>
                        	<button type="submit" class="btn btn-success" name="signOut">Sign Out</button>
						</li>
					</ul>
				</form>
			</nav>
		</header>	
		<section class="header-sec">
		</section>
		<section class="info1-sec">
			<?php require_once 'routes.php'; ?>
		</section>
		<section class="footer-sec">
			<p>[Đồ án môn Phát Triển Ứng Dụng Web - Website học tiếng Anh online]</p>
			<p>[Trương Quốc Cường - 51403013 | Trần Trung Tín - 51403320]</p>
		</section>
	</div>
</body>
</html>
