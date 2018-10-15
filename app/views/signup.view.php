<section class="main-container text-center">
	<div class="main-wrapper col-md-6">
		<h2>Sign Up</h2>
		<form class="signup-form" action="<?php echo URLrewrite::BaseAdminURL('manageUsers/createUser');?>" method="POST">
			<input type="hidden" name="user[level_id]" value="1">

<div class="form-group">
			<label for="firstname-input">Firstname <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="user[fname]" placeholder="Firstname" required>
			<label for="lastnamename-input">Lastname <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="user[lname]" placeholder="Lastname" required>
</div>

<div class="form-group">
			<label for="email-input">Email <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="user[email]" placeholder="E-mail" required>
			<label for="telephone-input">Telephone <span class="text-danger">*</span></label>
			<input type="number" class="form-control" name="user[phone]" placeholder="Telephone" required>
			<label for="username-input">Username <span class="text-danger">*</span></label>
</div>

<div class="form-group">
			<input type="text" name="user[username]" class="form-control" placeholder="Username" required>
			<label for="password-input">Password <span class="text-danger">*</span></label>
			<input type="password" name="user[password]" class="form-control" placeholder="Password" required>
</div>

			<button type="submit" id="send_My_Comments" class="btn form-control" name="submit">Sign up</button>
		</form>
	</div>
</section>
