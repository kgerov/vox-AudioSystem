<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Vox</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="/assets/styles/css/bootstrap.min.css">
		<link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/assets/styles/css/style.css">
		<link rel="stylesheet" href="/css/main.css">
		<link rel="shortcut icon" href="/assets/img/code.png">
		<!--[if lt IE 9]>
			<script src="/assets/js/html5shiv.js"></script>
			<script src="/assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<nav class="navbar navbar-default navbar-fixed-top <?php if($this->isAdmin == '1') echo 'navbar-custom'; ?>" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/index.php/songs">
						<img src="/assets/img/logo.png" alt="logo">
						Vox
					</a>
				</div>
				<?php $url = explode('/',$_SERVER['PHP_SELF']); ?>
				<div class="collapse navbar-collapse navbar-ex1-collapse myNav">
					<ul class="nav navbar-nav">
						<li class="<?php echo (in_array('songs', $url) && !strpos($_SERVER['PHP_SELF'], 'my') ? 'active' : ''); ?>"><a href="/index.php/songs">Songs</a></li>
						<li class="<?php echo (in_array('playlists', $url) && !strpos($_SERVER['PHP_SELF'], 'my') ? 'active' : ''); ?>"><a href="/index.php/playlists">Playlists</a></li>
						<li class="<?php echo (in_array('genres', $url) ? 'active' : ''); ?>"><a href="/index.php/genres">Genres</a></li>
						<li class="<?php echo (in_array('trending', $url) ? 'active' : ''); ?>"><a href="/index.php/trending">Trending</a></li>
						<?php if ($this->username): ?>
						<li class="<?php echo (strpos($_SERVER['PHP_SELF'], 'songs/my') ? 'active' : ''); ?>"><a href="/index.php/songs/my">My Songs</a></li>
						<li class="<?php echo (strpos($_SERVER['PHP_SELF'], 'playlists/my') ? 'active' : ''); ?>"><a href="/index.php/playlists/my">My Playlists</a></li>
						<?php endif; ?>
						<li class="<?php echo (in_array('search', $url) ? 'active' : ''); ?>"><a href="/index.php/search">Search</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<?php if ($this->isAdmin != '1'): ?>
		<section class="wrapper-sm bg-primary">
			<div class="container">
				<div class="row">
					<div class="col-lg-11">
						<i class="icon icon-user"></i> Hello, <?php echo ($this->username ? $this->username : 'Guest.'); 
						if(!$this->username) { echo '<a class="btn btn-login btn-user" href="/index.php/login">Login here &raquo;</a>';}
						else {echo '<a class="btn btn-login btn-user" href="/index.php/profile">Profile &raquo;</a>';} ?>
					</div>
					<div class="col-lg-1">
						<?php 
						if($this->username) echo '<a class="btn btn-warning" href="/index.php/logout">Logout &raquo;</a>';
						?>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<section id="msgBox">
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

		<?php if ($this->isAdmin == '1'): ?>
		<section class="wrapper-sm bg-primary custom-greet">
			<div class="container">
				<div class="row">
					<div class="col-lg-11">
						<i class="icon icon-user"></i> Hello, <?php echo ($this->username ? $this->username : 'Guest.'); 
						if(!$this->username) { echo '<a class="btn btn-login btn-user" href="/index.php/login">Login here &raquo;</a>';}
						else {echo '<a class="btn btn-login btn-user" href="/index.php/profile">Profile &raquo;</a>';} ?>
					</div>
					<div class="col-lg-1">
						<?php 
						if($this->username) echo '<a class="btn btn-warning" href="/index.php/logout">Logout &raquo;</a>';
						?>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<footer class="wrapper-sm bg-secondary <?php if($this->isAdmin == '1') echo 'admin-footer'; ?>">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p><a href="https://softuni.bg" target="_blank">SoftUni</a></p>
					</div>
				</div>
			</div>
		</footer>
		<script src="/assets/js/jquery-1.8.0.min.js"></script>
		<script>window.jQuery || document.write('<script src="/assets/js/jquery-1.8.0.min.js"><\/script>')</script>
		<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
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
				});
		}

		$('#msgBox').delay(3000).fadeOut('slow');
	</script>
	</body>
</html>
