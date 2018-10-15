<?php
echo "<div class='col-md-12'>";
echo "<div class='col-md-12'>";

//If a user is logged in, autofill all her/his info
if(isset($data['userInfo']))
{
//Attach the data to a variable
  $first_name = $data['userInfo']['fname'];
  $last_name = $data['userInfo']['lname'];
  $telephone_Number = $data['userInfo']['phone'];
  $email_Address = $data['userInfo']['email'];
?>

            <div class="container">
                    <h1>Great to see you, 
                    <?php echo $_SESSION['loggedIn']['username']?>
                    ! <br>The total amount of your order:<br><?php echo $_SESSION['cart']->getTotalPrice();?> SEK
                    </h1>
            </div>

<?php
}else
{
                printf("<div><h1>Hi, Customer!<br>The total amount of your order:<br>".$_SESSION['cart']->getTotalPrice()." SEK</h1></div>");
                    $first_name = "";
                    $last_name = "";
                    $telephone_Number = "";
                    $email_Address = "";
                    }
                echo "</div>";


            
if(!isset($_SESSION['checkout']['step']) || $_SESSION['checkout']['step'] < 1) {

?>

                <!-- Skickar formen till tempCustomerUserinfo funktionen -->
<form action="<?= URLrewrite::BaseURL().'checkout/tempCustomerUserInfo'?>" method='post'>

    <div class="container">
    <h1>Fill in Your Information</h1>

            <div class="form-row">
                                    <div class="mb-3 control-group">
                                    <label for="user[first_Name]">Firstname: </label>
                                    <input type="text" name="user[first_Name]" class="form-control" value="<?php echo $first_name?>" id="resultOfFirstName" placeholder="<?php echo $first_name?>"  required>
            </div>

            <div class="form-group mb-3 ">
                                    <label for="user[last_Name]">Surname: </label>
                                    <input type="text" class="form-control"  name="user[last_Name]" id="lastName" value="<?php echo $last_name?>" placeholder="<?php echo $last_name?>"  required>
                                    </div>
            </div>
                    

            <div class="form-row">
                                    <div class="form-group mb-3 ">
                                    <label for="user[email_Address]">Email Adress: </label>
                                    <input type="email" class="form-control" name="user[email_Address]"  value="<?php echo $email_Address?>" placeholder="<?php echo $email_Address?>" id="resultOfEmailAddress" size="50" required/>
            </div>

                        <input type="hidden" class="form-control" name="user[level_id]"/>
                        <input type="hidden" class="form-control" name="step" value="1"/>

                                    <div class="form-group mb-3 ">
                                    <label for="user[telephone_Number]">Telephone: </label>
                                    <input type="tel" class="form-control" name="user[telephone_Number]" value="<?php echo $telephone_Number?>" placeholder="<?php echo $telephone_Number?>"  id="resultOfPhoneNumber" size="50" required/>
                                    </div>



                                <div class="control-group">			
                                    <input type="submit" class="btn btn-success" value="Continue to Address"/>
                                    </div>
</div>

</form>
<!--End of first formula regarding personal information -->


<!-- Start for Delivery Address Information -->
<?php
}

if(isset($_SESSION['checkout']['step']) && $_SESSION['checkout']['step'] == 1) { ?>

<form action="<?= URLrewrite::BaseURL().'checkout/tempCustomerAccountInfo'?>" method='post'>
<div class="container">
			<div class="mb-3 control-group">

              <label for="order[street_address_1]">Address</label>
              <input type="text" class="form-control" id="address" name="order[street_address_1]" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

			<br>
            <div class="mb-3 control-group">
              <label for="order[street_address_2]">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name="order[street_address_2]">
            </div>


			<br>
              <div class="control-group col-md-3 mb-3">
                <label for="zip" class="control-label">Zip</label>
                <input type="text" class="form-control" id="zip" name="order[zip]" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
			</div>

			<div class="control-group col-md-3  mb-3">
			  <label for="order[city]" class="control-label">	
				  City </label>
              <input name="order[city]" class="form-control" type="text" id="city" required>
			  <div class="invalid-feedback">
                  City required.
                </div>
		 	 </div>
			<div class="control-group col-md-3  mb-3">
			  <label for="order[country]" class="control-label">	
				  Country </label>
              <input name="order[country]" class="form-control" type="text" id="country" required>
              <input type="hidden" class="form-control" name="step" value="2"/>              
			  <div class="invalid-feedback">
                    Country required.
                </div>
		 	 </div>


<div class="control-group">			
<input type="submit" class="btn btn-success form-control" value="Continue to Payment Options"/>
</div>
</div>
</form>

<?php
}

/* End for Delivery Address Information */


if(isset($_SESSION['checkout']['step']) && $_SESSION['checkout']['step'] == 2) { ?>


<!-- Start for Payment Information -->
<form action="<?= URLrewrite::BaseURL().'checkout/tempPaymentMethod'?>" method='post'>

  <div id="paymentMethod" class="container col-md-12">
    
    <h2>Payment details</h2>      

     <div class="form-row">
    <label class="radio-inline"><input type="radio" name="orderPayment[type]" value="PayPal">Paypal</label>
    <label class="radio-inline"><input type="radio" name="orderPayment[type]" value="Klarna">Klarna</label>
    <label class="radio-inline"><input type="radio" name="orderPayment[type]" value="CreditCard">Credit Card</label>
    <input type="hidden" class="form-control" name="step" value="3"/>              

    </div>
       
   
    <div class="control-group">			
    <input type="submit" class="btn btn-success form-control" value="Continue"/>
    </div>
</div>
    </form>

<?php
} 
if(isset($_SESSION['checkout']['step']) && $_SESSION['checkout']['step'] == 3) {
   
?>
    <form action="<?= URLrewrite::BaseURL().'checkout/placeOrder'?>" method='post'>
<?php
/* Credit card */
if ($_SESSION['orderPayment']['type'] == 'CreditCard') {
?>
<h2>Credit Card Information</h2>
<select class="form-control" name="order[payment_type]">
        <option value="Visa">Visa</option>
        <option value="2">Mastercard</option>
        <option value="3">American express</option>
</select>

    
<div>
        <label>
            <span>Card Number</span>
        </label>
        <input type="text" size="20" name="payment[card][number]" value="" autocomplete="off" required />
</div>

<div>
<label>
    <span>Expiration Date (MM/YYYY)</span>
</label>
<input type="text" size="2" id="expMonth" name="payment[card][month]" required />
<span> / </span>
<input type="text" size="2" id="expYear" name="payment[card][year]" required />
</div>


<div>
        <label>
            <span>CVC</span>
        </label>
        <input id="cvv" size="4" type="text" value="" name="payment[card][cvv]" autocomplete="off" required />
</div>

<input type="hidden" name="stage" value="<?= $stage + 1 ?>"/>
<input type="submit" value="Proceed"/>

<?php
} 

/* PayPal */
if ($_SESSION['orderPayment']['type'] == 'PayPal') {
    ?>
    <h2>Pay with PayPal</h2>
    <input id="token" name="token" type="hidden" value="">
    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="">Email Adress: </label>
                        <input type="email" class="form-control" name="payment[paypal][email]" value="<?php echo $email_Address?>" placeholder="<?php echo $email_Address?>" id="resultOfEmailAddress" size="50" required/>
    </div>

                        <div class="form-group col-md-6">
                            <label for="">Password <span class="text-danger">*</span></label>
                            <input type="password" name="payment[paypal][pass]" placeholder="Password">
                        </div>
    <input type="hidden" name="stage" value="<?= $stage + 1 ?>"/>
    <input type="submit" value="Login"/>
</form>
<?php
}

/* Klarna */
if ($_SESSION['orderPayment']['type'] == 'Klarna') {
?>

<div class="form-group col-md-6">
                        <label for="">Personnummer: </label>
                        <input type="text" class="form-control" name="payment[klarna][pnr]" value="<?php echo $email_Address?>" placeholder="<?php echo $email_Address?>" id="resultOfEmailAddress" size="50" required/>
</div>

<div class="form-group col-md-6">
                        <label for="">Email Adress: </label>
                        <input type="email" class="form-control" name="payment[klarna][email]" value="<?php echo $email_Address?>" placeholder="<?php echo $email_Address?>" id="resultOfEmailAddress" size="50" required/>
</div>
 
     <div class="control-group">
    				<label for="" class="control-label">	
    					Zip Code
    			<input name="payment[klarna][zip]" type="text" id="zip"/>
                </label>
    			</div>
     
    			<div class="control-group">
    				<label for="" class="control-label">	
    					City
    				<input name="payment[klarna][city]"  type="text" id="city">
    				</label>
    </div>

 
    <input type="submit" value="Pay"/>
    <?php
}
}
?>
</form>

<!-- End for Payment Information -->