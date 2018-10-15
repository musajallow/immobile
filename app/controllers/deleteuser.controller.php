<?php

class deleteUser extends base_controller 
{

    public function index($uid = "") //the users id url displays here 
    {
        //echo "account index";

        //connects controller with the right model
        $this->initModel('DeleteUser_model');
        //var_dump($this->modelObj);

        $data = $this->modelObj->deletePerson($uid);

        //connects controller with the right view
        $this->reqView('deleteuser',$data);

        
    }

}
