<?php
class Companysignup extends Base_controller
{
	
	public function index() {

        // instantiated model
        $this->initModel('companysignup_model');
        // instantiated method
        $this->modelObj->companysignup();
        // Render the correct view
        $this->reqView('companysignup');
    }
}