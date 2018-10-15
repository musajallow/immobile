<body>    
    <div id="mainContainer">
       <h2 class="titleCart">Shopping Cart</h2>
        <div id="cartContainer">
            <?php
            $skus = "";
            $count = count($data);
            $i = 0;
            $totalPrice = 0;
            //$skuAmount = "";
            foreach ($data as $products => $product) {
                    printf("<div class='col-md-8' id='%s'>", $product['sku']);
                    printf('<div class="col-md-4" id="imgUrl">');
                    printf('<img src="%s" alt="picture" class="col-md-12", "img-fluid prod_img">', $product['img_url']);
                    printf('</div>');
                    printf('<div class="col-md-4" id="prodInfo">');
                    printf('<span>%s<br> %s<br> %s<br> %s<br> %s SEK<br></span>', $product['manufacturer'], $product['title'], $product['info'], $product['properties'], $product['price']);
                    printf('<form method="POST" action="%s">', URLrewrite::BaseURL().'cart/update');
                    printf('<input type="text" name="amount" value="%s">', $product['amounts']);
                    printf('<input type="hidden" name="sku" value="%s"/>', $product['sku']);
                    printf('<button type="submit">Update</button></form>');
                    printf("</form>");
                    printf("</div>");
                    printf('<div class="col-md-4" id="removeItem">');
                    printf("<form method='POST' action='%s'>", URLrewrite::BaseURL().'cart/deleteItem/');
                    printf("<button class='btn btn-danger' type='submit'>Delete Item</button>");
                    printf('<input type="hidden" name="sku" value="%s"/>', $product['sku']);
                    printf('<input type="hidden" name="amount" value="%s"/>', $product['amounts']);
                    printf("</form>");
                    printf("</div>");
                    printf("</div>");
                }
            ?>
        </div>
    </div>
            <div id="orderInfo">
                <div id="totalAmount">
                    <?php 
                    // Vi använder inte detta just nu men sparar för framtiden
                    foreach ($data as $products => $product) {
                        $totalPrice += $product['price'] * $product['amounts'];
                        /*$skuAmount = $product['sku'];
                        $skuAmount .= $product['amounts'];
                        $skuAmount = array($product['sku'] => $product['amounts']);
                        $skuAmountString = serialize($skuAmount);*/
                        //var_dump($skuAmountString);
                        $skus .= "'".$product['sku']."'";

                        if (++$i === $count) {
                            $skus .= " ";
                        } else {
                            $skus .= ", ";
                            
                        }
                    }
                        printf('<span>TOTAL: %s SEK</span>', $totalPrice);
                        $_SESSION['cart']->setTotalPrice($totalPrice);
                        ?>
                </div>
                <div id="confirmCart">
                    <?php
                        printf("<form method='POST' action='%s'>", URLrewrite::BaseURL().'checkout');
                        printf("<button class='btn btn-success' type='submit'>Checkout</button>");
                        printf('<input type="hidden" name="order_set[totalPrice]" value="%s" />', $totalPrice);
                        printf("</form>");  
                      ?>
                    <article>
                       Terms & conditions
                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed orci et ligula dapibus malesuada. Sed ipsum odio, lobortis et tortor id, commodo porta purus. Pellentesque volutpat eros vitae ligula laoreet, nec condimentum turpis venenatis. Vestibulum hendrerit egestas lectus, a viverra velit iaculis sit amet. Integer sit amet nunc eros. Suspendisse interdum luctus turpis, sed consequat turpis dictum vel. Nam scelerisque justo pellentesque dolor molestie commodo. Nulla at sapien aliquet, tincidunt dui eu, consectetur libero. Morbi ac nibh condimentum, gravida elit eu, consequat quam. Nulla bibendum purus sed mi laoreet, sit amet gravida lectus efficitur.
                    </article>
                </div>
            </div>
        </div>
    </div>	
</body>