<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<h2>Log in <small>Returning Visitors</small></h2>
			<br class="spacer-lg">
			<form method="POST">
				<fieldset>
					<div class="form-group">
						<label for="loginEmail">Username</label>
						<input class="form-control" name="username" type="text" id="loginEmail" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="loginPassword">Password</label>
						<input class="form-control" name="pass" type="password" id="loginPassword" placeholder="Password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default">Log Me In</button>
					</div>
				</fieldset>
			</form>
		</div><!--/span6-->
		
		<div class="col-sm-6">
			<h2>Create an account <small>New Visitors</small></h2>
			<br class="spacer-lg">
			<form method="POST">
				<fieldset>
					<div class="form-group">
						<label for="createEmail">Your email</label>
						<input class="form-control" type="text" name="email" id="createEmail" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="createUsername">Your username</label>
						<input class="form-control" type="text" name="newUsername" id="createUsername" placeholder="Username">
					</div>
					<div class="form-group">
						<label for="createPassword">Create a password</label>
						<input class="form-control" type="password" name="password" id="createPassword" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="confirmPassword">Confirm password</label>
						<input class="form-control" type="password" name="passwordConfirm" id="confirmPassword" placeholder="Password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default">Create account</button>
					</div>
					<div class="form-group">
						<strong>Or create an account with your social profiles:</strong><br/>
						<a href="#" class="btn btn-facebook"><i class="icon icon-facebook"></i> Facebook</a> 
						<a href="#" class="btn btn-twitter"><i class="icon icon-twitter"></i> Twitter</a>
					</div>
				</fieldset>
			</form>
		</div><!--/span6-->
	</div><!--/row-fluid-->