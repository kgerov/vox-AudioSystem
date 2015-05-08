<?php 
	if (!$this->username) {
		header('Location: /vox/voxApplication/public/index.php/playlists');
	}
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Create Playlist</h2>
			<br class="spacer-lg">
			<form action="" method="POST">
				<fieldset>
					<div class="form-group">
						<label for="loginEmail">Playlist Name</label>
						<input class="form-control" id="sname" type="text" name="name" required placeholder="Name">
					</div>
					<?php foreach($this->songs as $key=>$value): ?>
						<div class="checkbox">
						    <label>
						      <input type="checkbox" name="songs[]" value="<?php echo $value['id']; ?>"> <?php echo $value['name']; ?>
						    </label>
					  	</div>
					<?php endforeach; ?>
					<div class="form-group">
						<button type="submit" class="btn btn-default">Create</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>