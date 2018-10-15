<?php

/**
* 
*/
class Login extends Base_controller
{
	
	public function index() {

        // Render the correct view
        $this->reqView('login');
        
    }

    public function loginUser() {

        // instantiated model
        $this->initModel('Login_model');
        // instantiated method
        $this->modelObj->login();
        // Render the correct view
        $this->reqView('login');
    }

    public function logout() {

        // instantiated model
        $this->initModel('Login_model');
        // instantiated method
        $this->modelObj->logout();
    }


}