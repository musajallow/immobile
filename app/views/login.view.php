<?php
var_dump(md5('pass'));
var_dump($_SESSION);
?>


<section class="main-container text-center">
	<div class="main-wrapper">
	<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
		<form class="signup-form form-signin" action="<?php echo URLrewrite::BaseURL().'login/loginUser'?>" method="POST">
			<label for="login[username]" class="sr-only">Username <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="login[username]" placeholder="Username"  required autofocus>
			<label for="login[password]" class="sr-only">Password <span class="text-danger">*</span></label>
			<input type="password" name="login[password]" class="form-control" placeholder="********" required>
			<div class="checkbox mb-3">
			<label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
			<button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
			<a href="<?php echo URLrewrite::BaseURL().'signup'?>" class="btn btn-link">Not a member? Signup here</a>
			<a href="<?php echo URLrewrite::BaseURL().'forgotpassword'?>" class="btn btn-link">Forgot password?</a>
		</form>
	</div>
</section>



