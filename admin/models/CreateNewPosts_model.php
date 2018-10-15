<?php
class CreateNewPosts_model extends Base_model
{
    public function CreateNewPosts()
    {
        //Get product title etc... to suggest it in the select dropdown
        $this->sql = "SELECT product.title, variant_id, product_id, sku FROM product_variants 
        JOIN projekt_klon.product ON 
        product_variants.product_id = product.pid ORDER BY product_id;";

        $this->prepQuery($this->sql);
        $this->getAll();

        return self::$data;
    }
}
