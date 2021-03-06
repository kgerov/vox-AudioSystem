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
			<?php foreach($this->song as $key=>$value): ?>
			<article class="row post-container">
				<!--meta col-->
				<aside class="col-md-4 col-lg-3">
					<div class="post-author">
						<img class="pull-left avatar" src="/assets/img/default-user.png" alt="user"/>
						<strong>Uploaded by:</strong>
						<p><?php echo ($value['username'] ? $value['username'] : 'anonymous'); ?></p>
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
					<h2 class="post-heading"><a href="/index.php/songs/info/<?php echo $value['id'];?>"><?php echo ($value['name'] ? $value['name'] : 'No name'); ?></a></h2>
					<?php 
						echo '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' . $value['sc_id'] . '&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>';
					?>
					<p>Artist: <?php echo ($value['artist'] ? $value['artist'] : ' - '); ?> | 
						Album: <?php echo ($value['album'] ? $value['album'] : ' - '); ?>| 
						Genre: <?php echo ($value['genre'] ? $value['genre'] : ' - '); ?></p>
						<span id="<?php echo $value['id']; ?>" class="upvotes"><?php echo ($value['upvotes'] ? $value['upvotes'] : '0'); ?></span>
						<? if ($this->username): ?>
							<form method="post" class="like-form">
								<input type="hidden" name="action" value="<?php echo $value['id']; ?>">
								<input type="submit" class="btn btn-success like-button" value="Like it!">
							</form>
						<? endif; ?>
						<? if ($this->isAdmin == '1'): ?>
							<form method="post" class="like-form">
								<input type="hidden" name="deleteAction" value="<?php echo $value['id']; ?>">
								<input type="submit" class="btn btn-danger like-button" value="Delete">
							</form>
						<? endif; ?>

					<!-- comments -->
					<h2 id="comment-section">Latest comments:</h2>
					<br class="spacer-lg">

					<ul class="media-list media-comments">
						<?php foreach($this->comments as $key=>$value): ?>
							<li class="media">
								<a class="pull-left" href="#">
									<img class="media-object" src="/assets/img/default-user.png">
								</a>
								<div class="media-body">
									<div class="container">
										<div class="row">
											<div class="col-md-5">
												<h4 class="media-heading"><a href=""><?php echo $value['username']; ?></a></h4>
												<p><?php echo $value['content']; ?></p>
											</div>
											<div class="col-md-7">
												<? if ($this->isAdmin == '1'): ?>
													<div class="container">
														<div class="row">
															<div class="col-md-10 line">
																<form method="post">
																	<input type="hidden" name="editCommentAction" value="<?php echo $value['cid']; ?>">
																	<input class="genre-edit" type="text" name="editedComment" required>
																	<input type="submit" class="btn btn-warning like-button" value="EDIT">
																</form>
															</div>
															<div class="col-md-2">
																<form method="post">
																	<input type="hidden" name="deleteCommentAction" value="<?php echo $value['cid']; ?>">
																	<input type="submit" class="btn btn-danger like-button" value="Delete">
																</form>
															</div>
														</div>
													</div>
												<? endif; ?>
											</div>
										</div>
									</div>
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