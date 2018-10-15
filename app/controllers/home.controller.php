<?php
class Home extends base_controller 
{
    public function index($name = "")
    {
        $this->initModel('User_model');
        //var_dump($this->modelObj);
        $this->modelObj->name = $name;

        $data['products'] = $this->modelObj->getAllProducts();
        $this->reqView('home', $data);

        //$this->reqView('home', ['name' => $this->modelObj->name]);
        
        //var_dump($this->modelObj);
    }


}