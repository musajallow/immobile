<?php 

class ProductFilter extends Base_controller
{
    public function index()
    {
    if(!isset($_POST['manufacturer'])) {
        $this->reqView('Products');
    }else
        {
        $this->initModel('ProductFilter_model');
        $data = $this->modelObj->getChosenCategory();
        $data['variants'] = $this->modelObj->getProductVariants();
        $this->reqView('ProductFilter', $data);
        }
    }
}


