<!-- Opening Hours information -->
<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:50px">CONTACT IM’MOBILÉ</h1>
    <p>IM'MOBILÉ is ready to assist you. 
    Please choose from the following options of communication for information about your order, our product information, or returns and more. 
</p>
  </div>
</div>
<br><br>
<?php

if(isset($_POST['open'])) {


$body = '
<div class="form-group col-md-6">
<p>Our weekday opening hours are: 08:00-20:00</p>
<p>Our weekend opening hours are: 10:00-16:00</p>
';

$weekdays=$_POST['open']['weekdays'];
$weekend=$_POST['open']['weekend'];

//echo $weekdays." are not as good as ".$weekend;

$words = array('08:00-20:00', '10:00-16:00');
$replacements = array($weekdays, $weekend);

foreach($words as $i=>$word) {
    $replacements[]="<span class='$word-$i'>$word</span>";
}

//Split up the page inot chunks delimited by a reasonable approximation of what an HTML elemnt looks like.
$parts = preg_split("{(<(?:\"[^\"]*\"|'[^']*'|[^'\">])*>)}",
$body,
-1, //Split the given string by a regular expression
PREG_SPLIT_DELIM_CAPTURE);

foreach($parts as $i=>$part) {
//Skip if this part is  an HTML element
if (isset($part[0]) && ($part[0] == '<')) {
    continue;
}
//Wrap the words with <span/>s
$parts[$i] = str_replace($words, $replacements, $part);
}

//Reconstruct the body
$body = implode('', $parts);

print $body;
}
else {
    var_dump($_POST);
?>
    <div class="form-group col-md-6">
    <p>Our weekday opening hours are: 08:00-20:00</p>
    <p>Our weekend opening hours are: 10:00-16:00</p>
   
<?php
}

if(isset($_POST['contact_list'])){
    echo '<p>We are currently located in the beautiful city of Stockholm at:';
    echo '<br>';
    echo $_POST['contact_list'];
    echo '</p>
    <img style="width:500px;height:500px;" src="https://www.poshliving.se/wp-content/uploads/2014/11/sveavagen-41.jpg">
    </div>';
}else{
?>
    <p>We are currently located in the beautiful city of Stockholm at:
    <br>
    Sveavägen 2018, 12345 Stockholm.
    </p>
    <img style="width:500px;height:500px;" src="https://upload.wikimedia.org/wikipedia/commons/f/f9/Sveav%C3%A4gen%2C_Stockholm_%28Palme%29.svg">
    </div>
<?php
}
?>

<?php
$errors = [];
$missing = [];
//If POST send is set, please save the following variables
if (isset($_POST['send'])) {
    $expected = ['name', 'email', 'comments'];
    $required = ['name', 'comments'];
    $to = 'Sarangua <sarangua97@gmail.com>';
    $subject = 'Question to IM´MOBILÉ';
    $headers = [];
    $headers[] = 'From: sarangua97@gmail.com';
    $headers[] = 'Cc: gustaf@backers.fi';
    $headers[] = 'Content-type: text/plain; charset=utf-8';
    $authorized = '-fsarangua97@gmail.com';
    require 'process_mail.php';
    if ($mailSent) {
        echo "Your email has been successfully sent";
        echo "<pre>";
        echo "Message sent is: \n\n";
        echo htmlentities($message);
        echo "Subject: \n\n";
        echo htmlentities($subject);
        echo "Headers: \n\n";
        echo htmlentities($headers);
        echo "</pre>";
    }
        //header('Location:'.URLrewrite::BaseURL());
        exit;
}
?>

<div class="main_Contact col-md-6">

<h1>Contact Us</h1>
<p>We reply within 24 hours.</p>
<?php if ($_POST && ($suspect || isset($errors['mailfail']))) : ?>
<p class="warning">Sorry, your mail couldn't be sent.</p>
<?php elseif ($errors || $missing) : ?>
<p class="warning">Please fix the item(s) indicated</p>
<?php endif; ?>

<div class="wrapper">
<form method="post" action="#">

<div class="form-row">
  <div class="form-group">
    <label for="name">Name:
    <!-- If the posted name is empty or missing -->
    <?php if ($missing && in_array('name', $missing)) : ?>
        <span class="warning">Please enter your name</span>
    <?php endif; ?>
    </label>
    <input type="text" name="name" id="name"
        <?php
        if ($errors || $missing) {
            echo 'value="' . htmlentities($name) . '"';
}
        ?>
        >
    </div>

 <!-- If the posted email is empty or missing -->
   <div class="form-group">
    <label for="email">Email:
        <?php if ($missing && in_array('email', $missing)) : ?>
            <span class="warning">Please enter your email address</span>
        <?php elseif (isset($errors['email'])) : ?>
            <span class="warning">Invalid email address</span>
        <?php endif; ?>
    </label>
    <input type="email" name="email" id="email"
        <?php
        if ($errors || $missing) {
            echo 'value="' . htmlentities($email) . '"';
        }
        ?>
        >
    </div>

    </div>
    
 <!-- If the question is empty or missing -->
  <div class="form-group">
    <label for="comments">Comments:
        <?php if ($missing && in_array('comments', $missing)) : ?>
            <span class="warning">You forgot to add any comments</span>
        <?php endif; ?>
    </label>
      <textarea name="comments" id="comments"><?php
          if ($errors || $missing) {
              echo htmlentities($comments);
          }
          ?></textarea>
  </div>

  <div class="form-group">
    <input type="submit" name="send" id="send_My_Comments" value="Send Comments">
        </div>

</form>

        </div>
        </div>