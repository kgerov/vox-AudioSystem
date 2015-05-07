<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Upload Song</h2>
			<br class="spacer-lg">
			<form action="" method="POST" enctype="multipart/form-data">
				<fieldset>
					<div class="form-group">
						<label for="loginEmail">SoundCloud Link</label>
						<input class="form-control" id="slink" type="text" name="link" placeholder="Email" oninput="autofill(this); return false;">
					</div>
					<div class="form-group">
						<label for="loginEmail">Song Name</label>
						<input class="form-control" id="sname" type="text" name="name" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="loginPassword">Artist</label>
						<input class="form-control" id="sartist" type="text" name="artist" placeholder="Artist">
					</div>
					<div class="form-group">
						<label for="loginPassword">Album</label>
						<input class="form-control" id="salbum" type="text" name="album" placeholder="Album">
					</div>
					<div class="form-group">
						<label for="loginPassword">Genre</label>
						<input class="form-control" id="sgenre" type="text" name="album" placeholder="Album">
					</div>
					<!-- <div class="form-group">
						<label for="loginPassword">Choose file</label>
						<input type="file" name="song_file" accept="audio/*">
					</div> -->
					<input type="hidden" id="sid">
					<div class="form-group">
						<button type="submit" class="btn btn-default">Upload</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>