<?php

class User extends Base_Controller
{
    
    public function index()
    {
        // instansiate new model using the function built in from the Base Controller
        $this->initModel('User_model');

        //We request modelObjs from the database
        $data = $this->modelObj->getAllProducts();
        
    }

    public function getUser($uid) 
    {
        // instansiate new model using the function built in from the Base Controller
        $this->initModel('User_model');

        //We request modelObjs from the database
        $data = $this->modelObj->getUser($uid);
    }


}
