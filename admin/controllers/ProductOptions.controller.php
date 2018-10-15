<?php

class ProductOptions extends Base_controller
{
    // default method that get all required data for forms
    public function Index()
    {
        $this->initModel('ProdOptions_model');
    
        // show all products in a <select>
        $data['products'] = $this->modelObj->getProducts();
        
        // get options for chosen product     
        $data['options'] = $this->modelObj->getSpecificOptions();

        // get all options available in option_type in DB
        $data['optionType'] = $this->modelObj->getOptionType();

        $data['option_values'] = $this->modelObj->getOptionValues();

        $this->reqView('ProdOptions', $data);
    }

    // add new option
    public function addOption()
    {
        // Instantiate model
        $this->initModel('ProdOptions_model');

        // Insert new option
        $this->modelObj->insertOptionType();

        // Redirect back to index method in this controller
        header('Location:'.$_SERVER['HTTP_REFERER']);

    }

    public function addProductOption()
    {
        $this->initModel('ProdOptions_model');

        if ($this->modelObj->insertProductOption())
        {
            // set a status for index method
            // using the Registry class
            Registry::setStatus(['addProdStatus' => 'success']);
            // Redirect back to index method in this controller
            $this->Index();
        } else {
            
            Registry::setStatus(['addProdStatus' => 'fail']);
            $this->Index();
            
        }
    
    }

    public function removeProductOption($pid = "", $product_id = "")
    {
        $this->initModel('ProdOptions_model');

        $this->modelObj->removeProductOption($pid, $product_id);

        $this->index();
    }

    public function addOptionValue()
    {
        $this->initModel('ProdOptions_model');

        $this->modelObj->addOptionValue();

        $this->index();
    }


}
