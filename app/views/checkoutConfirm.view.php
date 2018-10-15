<h1>Thank you for your order</h1>
<h1><?php echo $_SESSION['user']['first_Name'].' '.$_SESSION['user']['last_Name'] ?>!</h1>
<p>Order id: <strong><?php echo $_SESSION['order']['orderId'] ?></strong></p>
<p>Delivery address: <?php echo $_SESSION['order']['street_address_1'] .' '. $_SESSION['order']['zip']
.' '. $_SESSION['order']['city'] ?></p>
<?php
if(isset($_SESSION['loggedIn'])) {
?>


    <div class="col-md-6">
<?php
        echo "<form method='POST' action=".URLrewrite::BaseURL()."account/saveAddress>";
        echo "<input type='hidden' name='customer[address]' value='".$_SESSION['order']['street_address_1']."'>";
        echo "<input type='hidden' name='customer[zip]' value='".$_SESSION['order']['zip']."'>";
        echo "<input type='hidden' name='customer[city]' value='".$_SESSION['order']['city']."'>";
        echo "<input type='hidden' name='customer[country]' value='".$_SESSION['order']['country']."'>";
        echo "<input type='hidden' name='customer[uid]' value='". $_SESSION['loggedIn']['uid']."'>";
        echo "<button type='submit' class='btn btn-primary'>Save your address in your account</button>";
        echo "</form>";
        echo "<a href='".URLrewrite::BaseURL()."'><button class='btn btn-primary'>To homepage</button></a>";
?>
    </div>

<?php
} else {
?>


<div class="col-md-6">
    <form method="post" action="<?= URLrewrite::BaseURL().'signup/createUserFromOrder'?>">
    <?php 
        echo "<input type='hidden' name='customer[address]' value='".$_SESSION['order']['street_address_1']."'>";
        echo "<input type='hidden' name='customer[zip]' value='".$_SESSION['order']['zip']."'>";
        echo "<input type='hidden' name='customer[city]' value='".$_SESSION['order']['city']."'>";
        echo "<input type='hidden' name='customer[country]' value='".$_SESSION['order']['country']."'>";
        echo "<input type='hidden' name='customer[first_Name]' value='".$_SESSION['user']['first_Name']."'>";
        echo "<input type='hidden' name='customer[last_Name]' value='".$_SESSION['user']['last_Name']."'>";
        echo "<input type='hidden' name='customer[telephone_Number]' value='".$_SESSION['user']['telephone_Number']."'>";
        echo "<input type='hidden' name='customer[email_Address]' value='".$_SESSION['user']['email_Address']."'>";
        echo "<input type='hidden' name='customer[address]' value='".$_SESSION['order']['street_address_1']."'>";
        echo "<input type='hidden' name='customer[zip]' value='".$_SESSION['order']['zip']."'>";
        echo "<input type='hidden' name='customer[city]' value='".$_SESSION['order']['city']."'>";
        echo "<input type='hidden' name='customer[country]' value='".$_SESSION['order']['country']."'>";
    ?>
        <section class="main-container text-center">
            <div class="main-wrapper">
            <h1 class="h3 mb-3 font-weight-normal">Create an account with us</h1>

            <input type="hidden" name="member[level_id]" value="1">
                <label for="newmember[username]" class="sr-only">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="newmember[username]" placeholder="Username"  required autofocus>
                    <label for="newmember[password]" class="sr-only">Password <span class="text-danger">*</span></label>
                    <input type="password" name="newmember[password]" class="form-control" placeholder="********" required>
                    <div class="checkbox mb-3">
                    <label>
                <input type="checkbox" value="remember-me"> Remember me
                </label>                   
            </div>

            <button id="send_My_Comments" type="submit">Create an account</button>
            </div>
        </section>
    </form>
</div>

<?php
}
//echo "<pre>";
//var_dump($_SESSION);

// unset cart and checkout variables
unset($_SESSION['cart']);
unset($_SESSION['user']);
unset($_SESSION['order']);
unset($_SESSION['orderPayment']);
unset($_SESSION['checkout']);