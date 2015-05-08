<div class="wrapper-lg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1><?php echo $this->song[0]['name']; ?></h1>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<!-- main col -->
		<div class="col-lg-12">
			<!--first post-->
			<?php foreach($this->playlist as $key=>$value): ?>
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
					<h2 class="post-heading"><a href="/vox/voxApplication/public/index.php/playlists/info/<?php echo $value['id'];?>"><?php echo ($value['name'] ? $value['name'] : 'No name'); ?></a></h2>
					<ul class="playlist-songs">
						<?php foreach($this->songs as $k=>$v): ?>
							<li><a href="/vox/voxApplication/public/index.php/songs/info/<?php echo $v['id'];?>"><i class="icon-music"> </i><?php echo $v['name'];?></a></li>
						<?php endforeach; ?>
					</ul>
					<span id="<?php echo $value['id']; ?>" class="upvotes"><?php echo ($value['upvotes'] ? $value['upvotes'] : '0'); ?></span>
					<? if ($this->username): ?>
						<form method="post" class="like-form">
							<input type="hidden" name="actionplay" value="<?php echo $value['id']; ?>">
							<input type="submit" class="btn btn-success like-button" value="Like it!">
						</form>
					<? endif; ?>
				</div>

					<!-- comments -->
					<h2 id="comment-section">Latest comments:</h2>
					<br class="spacer-lg">

					<ul class="media-list media-comments">
						<?php foreach($this->comments as $key=>$value): ?>
							<li class="media">
								<a class="pull-left" href="#">
									<img class="media-object" src="/vox/voxApplication/public/assets/img/default-user.png">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href=""><?php echo $value['username']; ?></a></h4>
									<p><?php echo $value['content']; ?></p>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
					<!-- comment form -->
					<? if ($this->username): ?>
					<h2>Leave a comment:</h2>
					<div>
						<form method="post">
							<fieldset>
								<div class="form-group">
									<textarea class="form-control" name="comment" cols="30" rows="5" placeholder="Your comment" ></textarea>
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-default btn-lg" value="Submit Now &raquo;">
								</div>
							</fieldset>
						</form>
					</div>
					<? endif; ?>
				</div><!--end post-->
			</article><!--/row-->
			<?php endforeach; ?>
			<hr>
		</div><!--/span9-->
	</div><!--/row-->
</div><!--/container-->