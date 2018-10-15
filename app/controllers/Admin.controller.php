<?php

class Admin extends Base_controller
{
    
    public function Index()
    {
        
        $this->reqView('AdminPanel');
    }

    public function addProduct()
    {

        // require view with form for new product
        if (!isset($_POST['newProd'])) {
            
            $this->reqView('AddProduct');

        } else {
            
            // instantiate admin model
            $this->initModel('NewProduct_model');
            
            // call addProduct method in model and check if the model successfuly added a new product to database
            if($this->modelObj->addProduct() || $_POST['newProdStatus'] == 'success')
            {

                // require the add product view
                $this->reqView('AddProduct');
                
            } else {

                echo 'Error, contact site administrator';
            }
        }
        
        // check if user selected the add variant option(pushed button)
        if(isset($_POST['addVariant']['status']) && $_POST['addVariant']['status'] == 'true')
        {
            //call model to handle new variant input
            $this->initModel('AddVariant_model');
        }
    }

    public function addVariant()
    {
        
        $this->modelObj->addVariant();
        
    }


}