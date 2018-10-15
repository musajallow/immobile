<?php

class Base_controller
{

    // the instance of the called model - is set in the initModel method
    protected $modelObj;

    
    public function initModel($model)
    {
        $url = (array_filter( explode("/", $_SERVER['REQUEST_URI'])));

        if(file_exists(ADMIN_MODEL . $model . '.php'))
        {
            require_once ADMIN_MODEL . $model . '.php';         
        } else {
            require_once MODEL_PATH . $model . '.php'; 
        }
        $this->modelObj = new $model();
    }

    // call a view and send data if needed
    public function reqView($view, $data = [])
    {
        $url = (array_filter( explode("/", $_SERVER['REQUEST_URI'])));

        if(in_array('admin', $url))
        {
            require_once ADMIN_VIEW . $view . '.view.php';
        } else {
            require_once VIEW_PATH . $view . '.view.php';
        }
        
        
    }
}

