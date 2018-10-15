<?php

class AddProduct extends Base_controller
{

public function Index()
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
        
    }

}