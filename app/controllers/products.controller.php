<?php 

class Products extends Base_controller
{
    public function index()
    {
        // instansiate new model using the function built in from the Base Controller
        $this->initModel('Products_model');

        //We request modelObjs from the database
        $data = $this->modelObj->getAllProducts();

        
        $this->initModel('ProductFilter_model');

        $data['brands'] = $this->modelObj->getBrands();
  

        //This will be shown on our products page
        $this->reqView('Products', $data);

        
    }
}
