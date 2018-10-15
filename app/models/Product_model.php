<?php

class Product_Model extends Base_model
{

       
    // query the database for one product, pid(product id) and vid(variation id) is passed in the url
    public function getProduct($pid, $vid)
    {

        $this->sql = 
        "SELECT product.info, pid, cid, variant_values.variant_id, option_values.option_id, 
        group_concat(value_name separator '/') AS property, title, manufacturer, price, img_url, sku
        FROM projekt_klon.variant_values
        JOIN option_values ON variant_values.value_id = option_values.value_id
        JOIN product ON variant_values.product_id = product.pid
        JOIN product_variants ON product_variants.product_id = variant_values.product_id
        WHERE variant_values.product_id = :pid AND variant_values.variant_id = :vid
        AND product_variants.product_id = :pid AND product_variants.variant_id = :vid";
        
        // params to be bound, is sent to the prepQuery method
        $paramBinds = [':pid' => $pid, ':vid' => $vid];
        
        $this->prepQuery($this->sql, $paramBinds);

        $this->getAll();

        //returns an array of the data from the database which is then printed to the client in the view
        return self::$data;
    }
}
