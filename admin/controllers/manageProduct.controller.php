<?php

class manageProduct extends base_controller
{
    public function Index()
    {
        $this->initModel('ProdOptions_model');
        
        $data['products'] = $this->modelObj->getProducts();

        $this->reqView('manageProduct', $data);
    }

    public function viewProductVariants($pid)
    {

        $this->initModel('Variant_model');

        $data['variants'] = $this->modelObj->getSpecificProdVariants($pid);

        $this->initModel('ProdOptions_model');

        $data['product'] = $this->modelObj->getProduct($pid);

        Registry::setStatus(['editProduct' => 'edit']);

        $this->reqView('manageProduct', $data);
    }

    public function deleteVariant($vid, $pid)
    {
        $this->initModel('Variant_model');

        $this->modelObj->deleteVariant($vid, $pid);

        $this->viewProductVariants($pid);
    }

    public function editVariant($pid, $vid)
    {
        $this->initModel('Variant_model');

        $data = $this->modelObj->getSpecificProdVariant($pid, $vid);

        $this->initModel('prodOptions_model');

        $data['optionValues'] = $this->modelObj->getOptionValues();

        $this->initModel('ProdOptions_model');        

        $data['optionType'] = $this->modelObj->getOptionType();
      
        $this->reqView('editVariant', $data);
    }

    public function editVariantOption($pid, $option_id, $vid)
    {
        $this->initModel('Variant_model');

        $this->modelObj->editVariantOption($pid, $option_id, $vid);
            
        $this->editVariant($pid, $vid);

    }

    public function removeVariantOption($pid, $option_id, $vid)
    {
        $this->initModel('Variant_model');

        $this->modelObj->removeVariantOption($pid, $option_id);

        $this->editVariant($pid, $vid);
    }

}