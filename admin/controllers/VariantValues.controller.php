<?php

class VariantValues extends Base_controller
{
    public function Index()
    {
        // get all products
        $this->initModel('ProdOptions_model');

        $data['products'] = $this->modelObj->getProducts();

        // get variants

        $this->initModel('Variant_model');

        $data['variants'] = $this->modelObj->getProdVariants();

        // get options

        $this->initModel('ProdOptions_model');

        $data['options'] = $this->modelObj->getOptionType();

        // get option values

        $this->initModel('ProdOptions_model');

        $data['optionValues'] = $this->modelObj->getOptionValues();

        $this->reqView('VariantValues', $data);
        
    }

    public function addVariantOption()
    {
        var_dump($_POST['newProdOption']);

        $this->initModel('variantValues_model');

        if($this->modelObj->newVariantValues())
        {
            Registry::setStatus(['addVariantValues' => 'success']);
            $this->Index();
        } else {
            Registry::setStatus(['addVariantValues' => 'fail']);
            $this->Index();
            
        }

    }
}