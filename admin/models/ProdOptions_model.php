<?php

class ProdOptions_model extends Base_model
{
    // fetch all products, used in <select> tag to be able to show
    // options for chosen product
    public function getProducts()
    {
        $this->sql = "SELECT pid, title FROM product";

        $this->prepQuery($this->sql);

        $products = $this->getAll();

        return $products;
    }

    public function getProduct($pid)
    {
        $this->sql = "SELECT pid, title FROM product WHERE pid = :pid";

        $paramBinds = [':pid' => $pid];
        $this->prepQuery($this->sql, $paramBinds);

        $products = $this->getOne();

        return $products;
    }
    
    // fetch options and types for specific (chosen) product
    public function getSpecificOptions()
    {
        $this->sql = 
        "SELECT title, product_id, product_options.option_id, option_name FROM product_options
        JOIN projekt_klon.option_type ON 
        product_options.option_id = option_type.option_id
        JOIN product ON product_options.product_id = product.pid WHERE product_id = :pid ORDER BY product_id, option_id";

        $pid = isset($_POST['products']) ? $_POST['products'] : null;
        $paramBinds = [':pid' => $pid];
        $this->prepQuery($this->sql, $paramBinds);

        $data = $this->getAll();

        return $data;
        unset($_POST['products']);
    }

    // get all options available in option_type in DB
    public function getOptionType()
    {
        $this->sql = "SELECT * FROM option_type";

        $this->prepQuery($this->sql);

        $data = $this->getAll();

        return $data;

    }

    public function getOptionValues()
    {
        $this->sql = "SELECT * FROM option_values";

        $this->prepQuery($this->sql);

        $data = $this->getAll();

        return $data;
    }

    // add new option value to db
    public function addOptionValue()
    {
        $optionId = isset($_POST['optionValues']['option_id']) ? $_POST['optionValues']['option_id'] : null;
        $valueName = isset($_POST['optionValues']['value_name']) ? $_POST['optionValues']['value_name'] : null;
        $this->sql = "INSERT INTO `projekt_klon`.`option_values` (`option_id`, `value_name`) VALUES (:optionId, :valueName)";

        $paramBinds = [':optionId' => $optionId, ':valueName' => $valueName];

        // set status depending on sql query result
        if ($this->prepQuery($this->sql, $paramBinds)) {
            Registry::setStatus(['addOptionValue' => true]);            
            return true;
        } else {
            Registry::setStatus(['addOptionValue' => false]);
            return false;            
        }
    }

    // insert new option
    public function insertOptionType()
    {
        $value = isset($_POST['optiontype']['new']) ? $_POST['optiontype']['new'] : null;
        $this->sql = "INSERT INTO option_type (option_name) VALUES (:option_name)";
        $paramBinds = [':option_name' => $value];

        $this->prepQuery($this->sql, $paramBinds) ? $_POST['optiontype']['status'] = 'true' : $_POST['optiontype']['status'] = 'false';

    }
    

    public function insertProductOption()
    {

        $values = [$_POST['newProdOption']['product_id'], $_POST['newProdOption']['option_id']];

        $this->sql = "INSERT INTO product_options (product_id, option_id) values (:product_id, :option_id)";
        
        $paramBinds = [':product_id' => $values[0], ':option_id' => $values[1]];

        if ($this->prepQuery($this->sql, $paramBinds))
        {
            return true;
        } else {
            return false;
        }
       
    }

    public function removeProductOption($pid, $option_id)
    {
        $this->sql = "DELETE FROM projekt_klon.product_options WHERE product_id= :pid and option_id = :option_id;";

        $paramBinds = [
            ':pid' => $pid,
            ':option_id' => $option_id,
        ];

        $this->prepQuery($this->sql, $paramBinds);
    }
}