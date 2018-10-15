<?php 
echo "<h2>".$_POST['manufacturer']."</h2>";
//echo "<pre>";
//var_dump($_POST);
//var_dump($data[0]['sku']);
//var_dump($data['variants']);
//var_dump($data);
 foreach ($data['variants'] as $product) {
    if(isset($product['sku'])){
    $properties = explode("/", $product['properties']);
    echo "<div class='prodBox'>";
    //var_dump($product);
    printf('<h1><a href="'.URLrewrite::BaseURL().'product/'.$product['pid'].'/'.$product['variant_id'].'">'. $product['title'] . "</a></h1>");
    //printf('<h3><a href="'.URLrewrite::BaseURL().'product/'.$product['product_id'].'/'.$product['variant_id'].'">' . $product['title'] . '</a></h3>');
    printf("<img class='prodImg' alt='%s' src='%s'>", $product['title'], $product['img_url']);
    echo "<ul>";
    foreach ($properties as $value) {
        printf("<li>%s</li>", ucfirst($value));
    }
    echo "<li>".$product['price']." SEK</li>";
    echo "</ul>";
    ?>
    <?php
    echo "</div>";
    } 
}
?>
