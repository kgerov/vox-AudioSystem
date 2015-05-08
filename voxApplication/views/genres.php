<div class="wrapper-lg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1>Genres</h1>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<!-- Main col-->
		<div class="col-lg-9">
			<!--first post-->
			<?php foreach($this->genres as $key=>$value): ?>
			<article class="row post-container">
				<div class="col-md-8 col-lg-9">
					<h2 class="post-heading"><a href="single-post.html"><?php echo ($value['name'] ? $value['name'] : 'No name'); ?></a></h2>
					<ul class="playlist-songs">
						<?php foreach(explode(',', $value['songs']) as $k=>$v): ?>
							<li><a href=""><i class="icon-music"> </i><?php echo $v;?></a></li>
						<?php endforeach; ?>
					</ul>
					<? if ($this->username): ?>
						<form method="post">
							<input type="hidden" name="actionDelete" value="<?php echo $value['name']; ?>">
							<input type="submit" class="btn btn-danger like-button" value="Delete">
						</form>
					<? endif; ?>
					<? if ($this->username): ?>
						<form method="post">
							<input type="hidden" name="actionEdit" value="<?php echo $value['name']; ?>">
							<input class="genre-inp" type="text" name="newName" required>
							<input type="submit" class="btn btn-warning like-button" value="EDIT">
						</form>
					<? endif; ?>
				</div>
			</article>
			<?php endforeach; ?>
		</div><!--end main col-->
		<aside class="col-lg-3">
			<? if ($this->username): ?>
			<section class="widget upload-btn">
				<hr>
					<form method="post">
						<input class="genre-inp" type="text" name="name" required>
						<input class="btn btn-danger create-genre" type="submit" value="CREATE GENRE">
					</form>
				<hr>
			</section><!--/well-->
			<? endif; ?>
		</aside><!--/sidebar-->
	</div><!--/.row-->
</div><!--/.container-->