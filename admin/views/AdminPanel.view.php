<?php if (isset($_SESSION['loggedIn']['level']) && $_SESSION['loggedIn']['level'] === '4')
{?>
    <div class="form-container">
    <?php include ADMIN_VIEW.'adminPanelNav.view.php'; ?>
    <h1>Welcome <?php echo $_SESSION['loggedIn']['username'];?></h1>
    </div>
<?php
} else {
    echo "You do not have permission";
    echo "<br>";
    echo "<a href='".URLrewrite::BaseURL().'login'."'>Log In</a>";
}