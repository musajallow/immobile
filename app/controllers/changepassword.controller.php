<?php

class changepassword extends base_controller 
{

    public function index($uid = "") //the users id url displays here 
    {

        //connects controller with the right model
        $this->initModel('Changepassword_model');
        //var_dump($this->modelObj);

        $uid = $_SESSION['loggedIn']['uid']; //

        //connects controller with the right view
        $this->reqView('changepassword');

        
    }

    public function changeUserPassword($uid)
    {
        $this->initModel('Changepassword_model');

        $data = $this->modelObj->getAccount($uid);        

        $this->modelObj->changeUserPassword($data);
    }


}
