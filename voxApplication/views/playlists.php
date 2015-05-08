<div class="wrapper-lg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Playlists</h1>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<!-- Main col-->
		<div class="col-lg-9">
			<!--first post-->
			<?php foreach($this->playlists as $key=>$value): ?>
			<article class="row post-container">
				<!--meta col-->
				<aside class="col-md-4 col-lg-3">
					<div class="post-author">
						<img class="pull-left avatar" src="/vox/voxApplication/public/assets/img/default-user.png" alt="user"/>
						<strong>Uploaded by:</strong>
						<p><?php echo ($value['username'] ? $value['username'] : 'anonymous'); ?></p>
					</div>
				</aside>
				<!--content col-->
				<div class="col-md-8 col-lg-9">
					<h2 class="post-heading"><a href="single-post.html"><?php echo ($value['name'] ? $value['name'] : 'No name'); ?></a></h2>
					<ul class="playlist-songs">
						<?php foreach(explode(',', $value['songs']) as $k=>$v): ?>
							<li><a href=""><i class="icon-music"> </i><?php echo $v;?></a></li>
						<?php endforeach; ?>
					</ul>
					<span id="<?php echo $value['id']; ?>" class="upvotes"><?php echo ($value['upvotes'] ? $value['upvotes'] : '0'); ?></span>
					<? if ($this->username): ?>
						<form method="post" class="like-form">
							<input type="hidden" name="actionplay" value="<?php echo $value['id']; ?>">
							<input type="submit" class="btn btn-success like-button" value="Like it!">
						</form>
					<? endif; ?>
					<a class="btn btn-primary" href="single-post.html">Comments &raquo;</a>
				</div>
			</article>
			<?php endforeach; ?>
		</div><!--end main col-->

		<!--sidebar-->
		<aside class="col-lg-3">
			<section class="widget">
				<h4>Filter</h4>
				<hr>
				<ul class="list-unstyled">
					<li><a href=""><i class="icon icon-chevron-right"></i> Playlists</a></li>
					<li><a href=""><i class="icon icon-chevron-right"></i> Genres</a></li>
					<li><a href=""><i class="icon icon-chevron-right"></i> Artists</a></li>
				</ul>
				<hr>
			</section><!--/well-->
			<? if ($this->username): ?>
			<section class="widget upload-btn">
				<hr>
					<a href="/vox/voxApplication/public/index.php/playlists/create"><button class="btn btn-danger">CREATE PLAYLIST</button></a>
				<hr>
			</section><!--/well-->
			<? endif; ?>
		</aside><!--/sidebar-->
	</div><!--/.row-->
</div><!--/.container-->