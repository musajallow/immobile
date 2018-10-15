<?php include ADMIN_VIEW.'adminPanelNav.view.php'; ?>

<section class="main-container">

	<div class="main-wrapper">
		<h2>Signup for Company</h2>
		<form class="signup-form" action="<?php echo URLrewrite::BaseAdminURL('Manageusers/createUser')?>" method="POST">
			<input type="hidden" name="user[level_id]" value="1">
			<label for="firstname-input">Firstname <span class="text-danger">*</span></label>
			<input type="text" name="user[fname]" placeholder="Firstname" required>
			<label for="lastnamename-input">Lastname <span class="text-danger">*</span></label>
			<input type="text" name="user[lname]" placeholder="Lastname" required>
			<label for="email-input">Email <span class="text-danger">*</span></label>
			<input type="text" name="user[email]" placeholder="E-mail" required>
			<label for="telephone-input">Telephone <span class="text-danger">*</span></label>
			<input type="text" name="user[phone]" placeholder="Telephone" required>
			<label for="username-input">Username <span class="text-danger">*</span></label>
			<input type="text" name="user[username]" placeholder="Username" required>
			<label for="password-input">Password <span class="text-danger">*</span></label>
			<input type="password" name="user[password]" placeholder="Password" required>
			<button type="submit" class="btn btn-warning" name="submit">Sign up</button>
		</form>
	</div>
</section>