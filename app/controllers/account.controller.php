<?php

class Account extends base_controller 
{

    public function index($uid = "") //the users id url displays here 
    {
        //echo "account index";

        //connects controller with the right model
        $this->initModel('Account_model');
        //var_dump($this->modelObj);

        $uid = $_SESSION['loggedIn']['uid']; //

        $data = $this->modelObj->getPerson($uid);

        //connects controller with the right view
        $this->reqView('account',$data);

        
    }

    public function deletePerson($uid) {
        $this->initModel('Account_model');
        $this->modelObj->deletePerson($uid);
        $this->index();
    } 

    public function saveAddress() {

        $this->initModel('Account_model');
    
        if($this->modelObj->saveAddress($uid = ""))
        {
            echo '<div class="alert alert-success alert-dismissible grid-alert" role="alert">Address Saved!</div>';              
            header('Refresh:3;'.URLrewrite::BaseURL().'account');
        } else {
            echo '<div class="alert alert-danger alert-dismissible grid-alert" role="alert">Failed to Save address!</div>';              
            header('Refresh:3;'.URLrewrite::BaseURL().'account');
        }
    
    }

}
