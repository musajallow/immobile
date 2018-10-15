<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/bootstrap.css';?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/account.css';?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/product.css';?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/products.css';?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/grid_table.css';?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/home.css';?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/admin.css';?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo URLrewrite::BaseURL().'css/floating_labels.css';?>" type="text/css"/>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="<?php echo URLrewrite::BaseURL().'javascript/ajax.js';?>"></script>
    
</head>

<body>

<nav class="navbar navbar-default" style="margin-bottom: 0;">
  <div class="container-fluid">
    <div class="navbar-header col-md-1">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Mobile website</span>
        <span class="icon-bar active">Model</span>
      </button>
      <a class="navbar-brand" href="<?php echo URLrewrite::BaseURL()?>">IM’MOBILÉ</a>
    </div>

  
    <div class="collapse navbar-collapse col-md-7" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo URLrewrite::BaseURL().'products'?>">Products</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo URLrewrite::BaseURL().'contactus'?>">Contact Us</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <form class="navbar-form navbar-left" action="<?php echo URLrewrite::BaseURL().'searchProducts'?>" method="post">
        <div class="form-group">
          <input type="text" id="search" name="search-database" autocomplete="off" class="form-control" placeholder="Search" onkeyup="searchMobile();">
          <button type="submit" class="btn btn-success" type="btn" >Search</button>
          <div class="display"></div>
        </div>
      </form>

   
      <?php
       if (isset($_SESSION['loggedIn']['username'])) { ?>
      <div class= "navbar-form navbar-right">
      <a href="
      <?php echo URLrewrite::BaseURL().'account'?>"><button class="btn" type="btn">My account</button></a>
       </div>
      <?php }?>

      <div class= "navbar-form navbar-right">
          <ul class="navbar-nav" style="list-style-type: none;">
              <li class="dropdown">
              <a href="<?php echo URLrewrite::BaseURL().'login'?>"class="dropdown-toggle signup" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><button class="btn signup" type="btn">Log in / Sign Up</button></a>
          
          <ul class="dropdown-menu">
            <?php
              if (isset($_SESSION['loggedIn']['username'])) { ?>
              <li><a href="<?php echo URLrewrite::BaseURL().'login/logout'?>">Log out</a></li>
            <?php }?>
              
            <?php
              if (!isset($_SESSION['loggedIn']['username'])) { ?>
             <li><a href="<?php echo URLrewrite::BaseURL().'login'?>" >Log in</a></li>
            <?php }?>
              <li><a href="<?php echo URLrewrite::BaseURL().'signup'?>" >Sign Up</a></li>
              <li><a href="<?php echo URLrewrite::BaseURL().'companysignup'?>" >Company</a></li>
          </ul>
              </li>
          </ul>

      
          <a href="<?php echo URLrewrite::BaseURL().'cart'?>"><button class="btn btn-default btn-sm" type="btn"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</button></a>
              </div>

 
</div><!-- End for -navbar-header-->
</div><!-- End for .container-fluid -->
</nav>