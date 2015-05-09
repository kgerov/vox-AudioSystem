<?php 
	if (!$this->username) {
		header('Location: /index.php/playlists');
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<h2>Your account</h2>
			<br class="spacer-lg">
			<form method="POST">
				<fieldset>
					<div class="form-group">
						<label for="createEmail">Your email</label>
						<input class="form-control" type="text" name="email" id="createEmail" placeholder="<?php echo $this->email; ?>">
					</div>
					<div class="form-group">
						<label for="createUsername">Your username</label>
						<input class="form-control" type="text" name="username" id="createUsername" value="<?php echo $this->username; ?>" disabled>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default">Edit account</button>
					</div>
				</fieldset>
			</form>
		</div><!--/span6-->
		<div class="col-sm-6">
			<h2>Change pass</h2>
			<br class="spacer-lg">
			<form method="POST">
				<fieldset>
					<div class="form-group">
						<label for="createPassword">Old password</label>
						<input class="form-control" type="password" name="oldPass" id="createPassword" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="confirmPassword">New password</label>
						<input class="form-control" type="password" name="newPass" id="confirmPassword" placeholder="Password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default">Change password</button>
					</div>
				</fieldset>
			</form>
		</div><!--/span6-->
	</div><!--/row-fluid-->
</div>