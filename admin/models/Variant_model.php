<?php

class Variant_model extends Base_model
{
    public function addVariant()
    {
        $this->sql = 
        "INSERT INTO product_variants (product_id, sku, price, img_url)
        VALUES (:pid, :sku, :price, :img_url)";

        $paramBinds = [
            ':pid' => $_POST['addVariant']['product_id'],
            ':sku' => $_POST['addVariant']['sku'],
            ':price' => $_POST['addVariant']['price'],
            ':img_url' => $_POST['addVariant']['img_url'],
        ];

        if($this->prepQuery($this->sql, $paramBinds))
        {
            return true;
        } else {
            return false;
        }
    }

    public function getProdVariants()
    {
        $this->sql = "SELECT variant_id, product_id, sku, price FROM product_variants ORDER BY product_id";

        $this->prepQuery($this->sql);

        $data = $this->getAll();

        return $data;
    }
    
    // ALL variants for a specific product
    public function getSpecificProdVariants($pid)
    {
        $this->sql = "SELECT variant_id, product_id, sku, price FROM product_variants WHERE product_id = :pid";

        $paramBinds = [':pid' => $pid];
        $this->prepQuery($this->sql, $paramBinds);

        $data = $this->getAll();

        return $data;
    }

    // ONE specific variant
    public function getSpecificProdVariant($pid, $vid)
    {
        $sql[] = "SELECT product.pid, product_variants.variant_id, product.title, product.info, product.manufacturer,
        product_variants.price, product_variants.sku, product_variants.img_url 
        FROM projekt_klon.product_variants
        INNER JOIN product ON product.pid = product_variants.product_id
        AND product_variants.product_id = :pid AND product_variants.variant_id = :vid";

        $sql[] = "SELECT option_values.option_id, option_name, option_values.value_id, option_values.value_name, variant_id, product_id FROM projekt_klon.option_values
        JOIN option_type ON option_values.option_id = option_type.option_id
        JOIN variant_values ON variant_values.value_id = option_values.value_id
        WHERE product_id = :pid AND variant_id = :vid";
        $paramBinds = [':pid' => $pid, ':vid' => $vid];
        
        $this->prepQuery($sql[0], $paramBinds);

        $data['variantInfo'] = $this->getOne();

        $this->prepQuery($sql[1], $paramBinds);

        $data['variantOptions'] = $this->getAll();

        return $data;
    }

    public function deleteVariant($vid, $pid)
    {
        $this->sql = "DELETE FROM product_variants WHERE variant_id= :vid and`product_id`= :pid";

        $paramBinds = [":vid" => $vid, ':pid' => $pid];

        // set registry status on query execution
        $this->prepQuery($this->sql, $paramBinds) ? Registry::setStatus(['deleteVariant' => 'true']) : Registry::setStatus(['deleteVariant' => 'false']);
    }

    public function updateVariant()
    {

        $data = $_POST;

        $this->sql = "UPDATE projekt_klon.product_variants SET ";

        // count and $i variables to keep track of number of items in array
        $count = count($data['variant']);
        $i = 0;

        //loop trough the submitted vaulues to create an sql-query string
        foreach ($data['variant'] as $key => $value) {
            
            $this->sql .= $key. " = '$value'";

            //skip the , after the last element in the $data['variant] array
            if (++$i === $count) {
                $this->sql .= " ";
            } else {
                $this->sql .= ", ";
                
            }

        }

        $this->sql .= "WHERE product_id = ". $data['hidden']['variant']['product_id'];

        echo $this->sql;
    }

    
    //This method updates the variant value in (manageProduct/editVariant)
    public function editVariantOption($pid, $option_id, $vid)
    {

        $value_id = $_POST['option']['value_id'];
        $this->sql = "UPDATE `projekt_klon`.`variant_values` SET `value_id`= :value_id WHERE `product_id`= :pid and`option_id`= :option_id";

        $paramBinds = [':pid' => $pid, ':option_id' => $option_id, ':value_id' => $value_id];

        // set status depending on sql query result and redirect to previous page
        if ($this->prepQuery($this->sql, $paramBinds)) {
            Registry::setStatus(['editVariantOption' => true]);            
            return true;
        } else {
            Registry::setStatus(['editVariantOption' => false]);
            return false;            
        }
        
    }

    public function removeVariantOption($pid, $option_id)
    {
        $this->sql = "DELETE FROM `projekt_klon`.`variant_values` WHERE `product_id`= :pid and`option_id`= :option_id;
        ";

        $paramBinds = [':pid' => $pid, ":option_id" => $option_id,];

        // set registry status on query execution
        if ($this->prepQuery($this->sql, $paramBinds)) {
            Registry::setStatus(['removeVariantOption' => 'true']);            
            return true;
        } else {
            Registry::setStatus(['removeVariantOption' => 'false']);
            return false;            
        }
    }

    public function addVariantValue()
    {
        // echo "<pre>";
        // var_dump($_POST);
        $pid = $_POST['variantValues']['pid'];
        $vid = $_POST['variantValues']['variant_id'];

        foreach ($_POST['variantValues']['options'] as $key => $value) {

            // if values are set for an option, loop trough it
            if (isset($value['value_id'])) {                
                $this->sql = 
                "INSERT INTO `projekt_klon`.`variant_values` (product_id, variant_id, option_id, value_id) 
                VALUES (:product_id, :variant_id, :option_id, :value_id)";

                $paramBinds = [
                    ':product_id' => $pid,
                    ':variant_id' => $vid,
                    ':option_id' => $value['option_id'],
                    ':value_id' => $value['value_id'],
                ];

                // echo $this->sql;
                // var_dump($paramBinds);
                // set registry status on query execution
                if ($this->prepQuery($this->sql, $paramBinds)) {
                    Registry::setStatus(['addVariantValue' => true]);            
                    return true;
                } else {
                    Registry::setStatus(['addVariantValue' => false]);
                    return false;            
                }
            }
        }
    }

}