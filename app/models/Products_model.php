<?php

class Products_model extends Base_model
{
    
    public function getAllProducts()
    {
        
        $this->sql = 
        "SELECT variant_values.product_id, variant_values.variant_id, product.title, product.info, product.manufacturer,
        product_variants.price, group_concat(DISTINCT value_name order by option_values.option_id separator '/') AS properties, title, product_variants.sku, product_variants.price,product_variants.img_url 
        FROM projekt_klon.option_values
        INNER JOIN variant_values ON variant_values.value_id = option_values.value_id 
        INNER JOIN product ON product.pid = variant_values.product_id
        INNER JOIN product_variants ON product_variants.product_id = variant_values.product_id
        WHERE product_variants.variant_id = variant_values.variant_id
        GROUP BY product_variants.sku";

        $this->prepQuery($this->sql);
        $this->getAll();

        return self::$data;
    }
}