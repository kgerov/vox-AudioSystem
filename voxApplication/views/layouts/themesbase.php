<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Vox</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="/vox/voxApplication/public/assets/styles/css/bootstrap.min.css">
		<link rel="stylesheet" href="/vox/voxApplication/public/assets/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="/vox/voxApplication/public/assets/styles/css/style.css">
		<!--[if lt IE 9]>
			<script src="/vox/voxApplication/public/assets/js/html5shiv.js"></script>
			<script src="/vox/voxApplication/public/assets/js/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.myNav {
				float: right;
			}

			.upload-btn {
				text-align: center;
			}

			.upload-btn button {
				width: 100%;
			}

			footer {
				margin-top: 10%;
			}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">
						<img src="/vox/voxApplication/public/assets/img/logo.png" alt="logo">
						Vox
					</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse myNav">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/vox/voxApplication/public/index.php/songs">Songs</a></li>
						<li><a href="/vox/voxApplication/public/index.php/songs">Playlists</a></li>
						<li><a href="/vox/voxApplication/public/index.php/songs">Genres</a></li>
						<li><a href="/vox/voxApplication/public/index.php/songs">Profile</a></li>
						<li><a href="portfolio.html">Portfolio</a></li>
						<li><a href="contact.html">Contact</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>

		<section class="wrapper-sm bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<i class="icon icon-user"></i> Hello, Guest. <a class="btn btn-login" href="/vox/voxApplication/public/index.php/login">Login here &raquo;</a>
					</div>
				</div>
			</div>
		</section>

		<main><?=$this->getLayoutData('body');?></main>

		<footer class="wrapper-sm bg-secondary">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p><a href="https://softuni.bg" target="_blank">SoftUni</a></p>
					</div>
				</div>
			</div>
		</footer>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="/vox/voxApplication/public/assets/js/jquery-1.8.0.min.js"><\/script>')</script>
		<script type="text/javascript" src="/vox/voxApplication/public/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		var Client_ID = '8291464f6b2fb0824953670f99fe23eb';

		function autofill() {
			var trackUrl = document.getElementById('slink').value;
			if (trackUrl.indexOf('soundcloud') == -1) {
				return;
			}
				$.get(
					'http://api.soundcloud.com/resolve.json?url=' + trackUrl + '&client_id=' + Client_ID, 
					function (result) {
						console.log(result);
						document.getElementById('sname').value = result.title;
						document.getElementById('salbum').value = result.label_name;
						document.getElementById('sartist').value = result.user.username;
						document.getElementById('sgenre').value = result.genre;
						document.getElementById('sid').value = result.id;
						//$(".videowrapper, .exhibitions-image, iframe").replaceWith('<iframe width="100%" height="100%" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' + result.id +'&amp;color=ff6600&amp;auto_play=false&amp;show_artwork=true"></iframe>');
				}

);}</script>
	</body>
</html>
