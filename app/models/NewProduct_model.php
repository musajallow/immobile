<?php

class NewProduct_model extends Base_model
{
    public function AddProduct()
    {
        $this->sql = 
        "INSERT INTO product (cid, title, info, manufacturer)
        VALUES (1, :title, :info, :manufacturer)";

        $paramBinds = [
            ':title' => $_POST['newProd']['title'],
            ':info' => $_POST['newProd']['info'],
            ':manufacturer' => $_POST['newProd']['manufacturer'],
        ];

        if($this->prepQuery($this->sql, $paramBinds))
        {
            // empty the newProd post array
            $_POST['newProd'] = [];

            // set a success status which indicates that a new product was added
            $_POST['newProdStatus'] = 'success';

            // send last inserted id
            $_POST['newProdId'] = $this->lastInsertId;
            return true;
            
        } else {

            // set a failed status that indicates a failure with the insertion of new product
            $_POST['newProdStatus'] = 'failed';            
            return false;
        }

    }
    
}