<?php 
if (end($url) === $data['dbToken'] && end($url) === $data['token']) { ?>
    <div class="container">
    
    <form class="resetPass" action="<?php echo URLrewrite::BaseURL().'forgotPassword/newPass' ?>">
      <div class="text-center mb-4">
        <!-- <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
        <h1 class="h3 mb-3 font-weight-normal">Reset Password</h1>
      </div>

      <div class="form-label-group">
        <input id="inputPass" name="resetPass['new']" class="form-control" placeholder="Password" required="" autofocus="" type="password">
        <label for="inputPass">Password</label>
      </div>

      <div class="form-label-group">
        <input id="retypePass" name="resetPass['confirm']" class="form-control" placeholder="Retype Password" required="" type="password">
        <label for="retypePass">Password</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
    </form>
</div>
<?php }else {
    echo "Wrong token";
    header('Refresh:5;' .URLrewrite::BaseURL());
}
?>

