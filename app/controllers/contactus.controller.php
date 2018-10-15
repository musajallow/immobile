<?php
class Contactus extends Base_Controller
{
    public function index() {
        $this->initModel('Contactus_model');
        // Render the correct view
        $this->reqView('contactus');
        
    }

}
