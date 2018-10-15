<h3 class ='text-center'>Enter the Email of Your Account to Reset New Password</h3><br>

<!-- <div id="body-b"> -->
    <div class="reset-container">
    
    <form method="POST" class="resetPass reset-form" action="<?php echo URLrewrite::BaseURL().'forgotpassword/resetPassword/'?>">
      <div class="">
        <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <h1 class="h3 mb-3 font-weight-normal">Request password</h1>
      </div>

      <div class="form-label-group">
        <input id="email" class="form-control" type='email' name='forgot[email]' required placeholder='Please enter your email'>
        <label for="email">Email</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" value="RESET" type="submit">Send</button>
    </form>
</div>
<!-- </div> -->