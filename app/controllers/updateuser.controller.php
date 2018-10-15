<?php

class updateuser extends base_controller 
{

    public function index($uid = "") //the users id url displays here 
    {
        //echo "account index";

        //connects controller with the right model
        $this->initModel('UpdateUser_model');
        //var_dump($this->modelObj);

        $uid = $_SESSION['loggedIn']['uid']; //

        $data = $this->modelObj->getUser($uid);

        //connects controller with the right view
        $this->reqView('updateuser',$data);

        
    }

    //update user function
    public function Update($uid) {

        $this->initModel('UpdateUser_model');

        $this->modelObj->UpdateUser($uid);

        $this->index($uid);
    } 

}