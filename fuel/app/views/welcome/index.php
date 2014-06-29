<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ssFramework</title>
	<?php echo Asset::css('bootstrap.css'); ?>
	<style>

		header{
			width: 100%;
			background:#eee;
			color:#8e8e8e;
			margin-bottom:40px;
			padding:10px;
		}
		body { margin: 0 0 40px 0; color:#4e4e4e; }
	</style>
</head>
<body>
	<header>
		<div class="container">
			<div id="logo">SsFramework</div>
		</div>
	</header>

	<div class="container">
		<div class="jumbotron">
			<h1>Excellent</h1>
			<p>Framework Installed. </p>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h2>Front-end is Ready</h2>
				<p>Configure the rest in the admin area, then delete <code>APPPATH/views/welcome/index.php</code>.</p>
			</div>

			<div class="col-md-6">
				<h2>Admin is Ready</h2>
				<p><a class="btn btn-default" href="/admin/login">Log In</a></p>
			</div>
		</div>
		<hr/>
		<footer>
			<p>
				SsFramework
				<small>FuelPHP Core Version: <?php echo Fuel::VERSION; ?></small>
			</p>
		</footer>
	</div>
</body>
</html>
