<?php

class Product extends Base_controller
{

    public function index($pid = "", $vid = "")
    {
        // initModel method is located in the base_controller  

        $this->initModel('Product_model');
        //var_dump($this->modelObj);

        // $pid and $vid is parameters in the url and sent to the model with the getProduct method.
        // The model is then responible for checking the parameters and query the database.
        // modelObj is the instance of the requested model
        $data = $this->modelObj->getProduct($pid, $vid);
        // The reqView method is located in the base_controller
        $this->reqView('product',$data);
    }
    
}