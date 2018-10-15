<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:50px">Welcome to IM’MOBILÉ</h1>
    <p>We offer best quality mobile products.</p>
    <a href="<?php echo URLrewrite::BaseURL().'products'?>"><button>Explore our products</button></a>
  </div>
</div>

<?php 
                      /* Admin skulle kunna ändra innehåll på index sidan */
if(isset($_POST["chosen_Item"]))
{
      $title= $_POST['header_Title'];
      $content=$_POST['header_Content'];
      $id= $_POST["chosen_Item"];
}else {
                    /* Borde ha sparat variablerna i databasen, så att man kunde bwhålla ändringarna gjorda */
      $id= 'SAMGLS964BK';
      $title= 'The best Android phones around';
      $content= "Samsung has once again taken the top spot of the best Android phone in the world right now.
      Samsung's latest Galaxy S9 Plus is in the top position of this list thanks to an incredible design, amazing display and some truly great power packed into the phone.
      Everything that has made Samsung phones great over the last few years has been packed into this 6.2-inch device - that's almost bezeless too - and comes with top of the range hardware and some easy to use Android software.
      ";
}

                /*Loopa att visa enskilda produkter */
  foreach ($data as $key => $products) {

    foreach ($products as $product) {

        if($id == $product["sku"]) {
        printf("<div class='col-md-12' style='padding:50px;'><div class='col-md-4'><h2>Featured product of the month: </h2>");
        printf("<img class='prodImg shake' alt='%s' style='' src='%s'>", $product['title'], $product['img_url']);
        printf("<h1><a href='".URLrewrite::BaseURL()."product/".$product['product_id']."/".$product['variant_id']."'>".$product['title']."</a></h1></div>");
        echo "<div class='col-md-8'><h3>".$title."</h3>";
        echo "<br>".$content."</div>";
        }
       
    }    
}
?>
<button type="button" class="btn"><a href="<?php echo URLrewrite::BaseURL().'products'?>">Explore our products</a></button>
</div>


</div>

<div class="col-md-6" style="padding-top: 100px;">
<h2>OUR VERDICT</h2>
The iPhone X was a huge gamble from Apple, yet one that really paid off six months into our testing. Losing the home button and altering the design was a dangerous move, but one that was sorely needed after years of similarity and the premium design, extra power, all-screen front mix together to create - by far - the best iPhone Apple's ever made. It's impossible to give a perfect score to something that costs this much - but this is the closest to smartphone perfection Apple has ever got.
</div>

<div class="col-md-6" style="float: right;">

<?php
//https://sourcey.com/youtube-html5-embed-from-url-with-php/
    $url = 'https://www.youtube.com/watch?v=mW6hFttt_KE';
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
    $id = $matches[1];
    $width = '800px';
    $height = '450px';
?>

<iframe id="ytplayer" type="text/html" width="<?php echo $width ?>" height="<?php echo $height ?>"
    src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen></iframe> 
</div>

                <!--Visa Bara vanliga produkter -->
<div class="col-md-12" style='padding:50px;'>
  <h2>Latest Products</h2>
  
    <?php
    foreach ($data['products'] as $product) {
    ?>
      <div class="col-md-3">
        <img src="<?php echo $product['img_url']?>" alt="<?php echo $product['title']?>" style="width:200px; height:200px;">
        <div>
          <h3><?php echo $product['title']?></h3>
          <p><?php echo $product['info']?><br><?php echo $product['price']?>SEK</p>
        </div>
      </div>
    <?php 
    }
  //}
    ?>
    </div>


    <div class="col-md-12" style='padding:50px;'>
  <h2>Recommended Products For You</h2>
  

    <?php
    $shuffled = shuffle($data['products']);

    foreach ($data['products'] as $product) {
    ?>
      <div class="col-md-3">
        <img src="<?php echo $product['img_url']?>" alt="<?php echo $product['title']?>" style="width:200px; height:200px;">
        <div>
          <h3><?php echo $product['title']?></h3>
          <p><?php echo $product['info']?><br><?php echo $product['price']?>SEK</p>
        </div>
      </div>
    <?php 
    }
    ?>
    </div>

</body>
</html>



