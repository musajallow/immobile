<?php

require_once '../app/init.php';

function autoloader($className)
{
    //include CONTROLLER_PATH . $className . '.controller.php';
    //include MODEL_PATH . $className . '.php';
    //include INC_PATH . $className . '.inc.php';
    //include CORE_PATH . $className . '.php';
    //require_once PRIVATE_PATH . $className . '.php';

    if (file_exists(INC_PATH . $className . '.inc.php')) {
        include INC_PATH . $className . '.inc.php';        
    }

    if (file_exists(CORE_PATH . $className . '.php'))
    {
        include CORE_PATH . $className . '.php';    
    }

    // admin controllers
    if (file_exists(ADMIN_CONTROLLER . $className . '.controller.php'))
    {
        include ADMIN_CONTROLLER . $className . '.controller.php';    
    }
    // public controllers
    if (file_exists(CONTROLLER_PATH . $className . '.controller.php'))
    {
        include CONTROLLER_PATH . $className . '.controller.php';    
    }
    // public models
    if (file_exists(MODEL_PATH . $className . '.controller.php'))
    {
        include MODEL_PATH . $className . '.controller.php';    
    }
    
}

spl_autoload_register('autoloader');