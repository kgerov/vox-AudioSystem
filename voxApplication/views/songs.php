<div class="wrapper-lg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Songs</h1>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<!-- Main col-->
		<div class="col-lg-9">
			<!--first post-->
			<?php foreach($this->songs as $key=>$value): ?>
			<article class="row post-container">
				<!--meta col-->
				<aside class="col-md-4 col-lg-3">
					<div class="post-author">
						<img class="pull-left avatar" src="/vox/voxApplication/public/assets/img/default-user.png" alt="user"/>
						<strong>Uploaded by:</strong>
						<p><?php echo ($value['user'] ? $value['user'] : 'anonymous'); ?></p>
					</div>
					<div class="post-meta">
						<p>In Playlists:</p>
						<ul class="tags">
							<?php foreach(explode(',', $value['playlists']) as $k=>$v): ?>
							<li><a href=""><i class="icon-double-angle-right"> </i><?php echo $v;?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</aside>
				<!--content col-->
				<div class="col-md-8 col-lg-9">
					<h2 class="post-heading"><a href="single-post.html"><?php echo ($value['name'] ? $value['name'] : 'No name'); ?></a></h2>
					<a href="single-post.html"><img class="post-thumbnail" src="assets/img/post-image-1.png" alt="blog post"></a>
					<p>Artist: <?php echo ($value['artist'] ? $value['artist'] : ' - '); ?> | 
						Album: <?php echo ($value['album'] ? $value['album'] : ' - '); ?>| 
						Genre: <?php echo ($value['genre'] ? $value['genre'] : ' - '); ?></p>
					<p><a class="btn btn-primary" href="single-post.html">Comments &raquo;</a></p>
					<p><a href="#" class="btn btn-success like-button">Like it!</a></p>
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
		</aside><!--/sidebar-->
	</div><!--/.row-->
</div><!--/.container-->