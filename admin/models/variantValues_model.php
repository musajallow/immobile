<?php

class VariantValues_model extends Base_model
{
    public function newVariantValues()
    {
        $this->sql = 
            "INSERT INTO variant_values (product_id, variant_id, option_id, value_id) 
            VALUES (:pid, :variant_id, :option_id, :value_id)";

        $paramBinds = [
            ':pid' => $_POST['newProdOption']['product_id'],
            ':variant_id' => $_POST['newProdOption']['variant_id'],
            ':option_id' => $_POST['newProdOption']['option_id'],
            ':value_id' => $_POST['newProdOption']['value_id'],            
        ];

        if($this->prepQuery($this->sql, $paramBinds))
        {
            return true;
        } else {
            return false;
        }
    }
}