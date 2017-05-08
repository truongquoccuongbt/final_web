<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Index</title>
	<link type="text/css" href="public/css/custom-index.css" rel="stylesheet">
	<link type="text/css" href="public/css/bootstrap-grid.css" rel="stylesheet">
	<link type="text/css" href="public/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="public/css/bootstrap.css" rel="stylesheet">
	<link type="text/css" href="public/css/bootstrap-grid.min.css" rel="stylesheet">
	<link type="text/css" href="public/css/bootstrap-reboot.css" rel="stylesheet">
	<link type="text/css" href="public/css/bootstrap-reboot.min.css" rel="stylesheet">
	<script src="public/js/bootstrap.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
</head>
<?php require_once 'routes_index.php'; ?>
<body>	
	<div class="contener-div">
		<header>
			<a href="index.php">
				<img id="header-logo" src="public/image/logo.PNG">
			</a>
			<nav class="site-nav">
				<form id="signin" class="navbar-form navbar-right" role="form">
					<ul>	
                        <li>
                        	<button type="submit" class="btn btn-primary" name="login">Login</button>
						</li>
						<li>
							<button type="submit" class="btn btn-warning" name="signup">Sign up</button>
						</li>
					</ul>
				</form>
			</nav>
		</header>	
		<section class="header-sec">
			<div id="info1-div">
				<div id="info1-blank-div">&nbsp;</div>
				<h1 id="info1-title-h1">Learn a language for free. Forever.</h1>
				<div id="info1-start-div">
					<form id="signin" role="role">
						<button type="submit" class="btn btn-primary btn-lg" name="started">Get Started</button>
					</form>
				</div>
			</div>
		</section>
		<section class="info1-sec">
			<div id="info2-image-div"></div>
			<div id="info2-blank-div">&nbsp;</div>
			<div id="info2-text-div">
				<h4>The best new way to learn a language.</h4>
				<h5>Learning with Duolingo is fun and addictive. Earn points for correct answers, race against the clock, and level up. Our bite-sized lessons are effective, and we have proof that it works.</h5>
			</div>
		</section>
		<section class="info2-sec">
			<div id="info3-text-div">
				<font id="info3-text-font">Gamification poured into every lesson.</font>
			</div>
			<div id="info3-image-div"></div>
		</section>
		<section class="info1-sec">
			<div id="info4-image-div"></div>
			<div id="info4-blank-div">&nbsp;</div>
			<div id="info4-text-div">
				<h4>Learn anytime, anywhere.</h4>
				<h5>Make your breaks and commutes more productive with our iPhone and Android apps. Download them and see why Apple and Google gave us their highest accolades.</h5>
			</div>
		</section>
		<section class="info2-sec">
			<div id="info5-image-div"></div>
			<div id="info5-blank-div">&nbsp;</div>
			<div id="info5-text-div">
				<h4>Duolingo for Schools.</h4>
				<h5>The world's most popular language learning platform is now available for the classroom. Thousands of teachers are already using it to enhance their lessons.</h5>
			</div>
		</section>
		<section class="footer-sec">
			<div id="info1-blank-div">&nbsp;</div>
				<h1 id="info5-title-h1">Learn a language with Duolingo.</h1>
				<div id="info1-start-div">
					<p><a class="btn btn-primary" name="get_started" role="button">Get Started</a></p>
				</div>
				<p>[Đồ án môn Phát Triển Ứng Dụng Web - Website học tiếng Anh online]</p>
				<p>[Trương Quốc Cường - 51403013 | Trần Trung Tín - 51403320]</p>
		</section>
	</div>
</body>
</html>