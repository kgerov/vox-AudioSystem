<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Vox</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="/vox/voxApplication/public/assets/styles/css/bootstrap.min.css">
		<link rel="stylesheet" href="/vox/voxApplication/public/assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/vox/voxApplication/public/assets/styles/css/style.css">
		<!--[if lt IE 9]>
			<script src="/vox/voxApplication/public/assets/js/html5shiv.js"></script>
			<script src="/vox/voxApplication/public/assets/js/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
		
			.like-form {
				display: inline-block;
			}
			.myNav {
				float: right;
			}

			.upload-btn {
				text-align: center;
			}

			.upload-btn button {
				width: 100%;
			}

			.btn-user {
				margin-left: 2%;
			}

			.like-button {
				margin-right: 2%;
			}

			footer {
				margin-top: 10%;
			}

			.row-centered {
			    text-align:center;
			}

			.col-centered {
			    display:inline-block;
			    float:none;
			    /* reset the text-align */
			    text-align:left;
			    /* inline-block space fix */
			    margin-right:-4px;
			}

			.notyMsg {
				width: 100%;
				padding: 4%;
				color: white;
				border-radius: 2%;
				margin-top: 2.5%;
				margin-bottom: 3.5%;
				text-align: center;
				font-size: 1.3em;
				max-height: 
			}

			.notyGreen {
				background-color: #2ECC71;
			}

			.notyRed {
				background-color: #D91E18;
			}

			.upvotes {
				border-right: 3px solid black;
				padding-right: 1.5%;
				font-size: 1.3em;
				margin-right: 2.5%;
				vertical-align: middle;
			}

			.soundlinkinput {
				text-align: center;
				margin-bottom: 5%;
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
					<a class="navbar-brand" href="/vox/voxApplication/public/index.php/songs">
						<img src="/vox/voxApplication/public/assets/img/logo.png" alt="logo">
						Vox
					</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse myNav">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/vox/voxApplication/public/index.php/songs">Songs</a></li>
						<li><a href="/vox/voxApplication/public/index.php/playlists">Playlists</a></li>
						<li><a href="/vox/voxApplication/public/index.php/genres">Genres</a></li>
						<li><a href="/vox/voxApplication/public/index.php/trending">Trending</a></li>
						<?php if ($this->username): ?>
						<li><a href="/vox/voxApplication/public/index.php/songs/mysongs">My Songs</a></li>
						<li><a href="/vox/voxApplication/public/index.php/songs/mysongs">My Playlists</a></li>
						<?php endif; ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>

		<section class="wrapper-sm bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-lg-11">
						<i class="icon icon-user"></i> Hello, <?php echo ($this->username ? $this->username : 'Guest.'); 
						if(!$this->username) { echo '<a class="btn btn-login btn-user" href="/vox/voxApplication/public/index.php/login">Login here &raquo;</a>';}
						else {echo '<a class="btn btn-login btn-user" href="/vox/voxApplication/public/index.php/profile">Profile &raquo;</a>';} ?>
					</div>
					<div class="col-lg-1">
						<?php 
						if($this->username) echo '<a class="btn btn-warning" href="/vox/voxApplication/public/index.php/logout">Logout &raquo;</a>';
						?>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="row row-centered" style="text-align:center;">
					<div class="col-lg-6 col-centered">

					<?php
						if ($this->notyVal) {
							$arr = explode('|', $this->notyVal);
							foreach($arr as $key => $value) {
							if (!$value) {
								break;
							}
							?><div class="notyMsg <?php echo (intval(substr($value, 0, 1)) == 1 ? 'notyGreen' : 'notyRed')?>">
								<?php echo substr($value, 1); ?>
							</div><?php
							}

							$this->clearNotys();
						}
					?>
					</div>
				</div>
			</div>
		</section>

		<main><?=$this->getLayoutData('body');?></main>
		<main><?=$this->getLayoutData('body2');?></main>

		<footer class="wrapper-sm bg-secondary">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p><a href="https://softuni.bg" target="_blank">SoftUni</a></p>
					</div>
				</div>
			</div>
		</footer>
		<script src="/vox/voxApplication/public/assets/js/jquery-1.8.0.min.js"></script>
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
				});
		}
	</script>
	</body>
</html>
