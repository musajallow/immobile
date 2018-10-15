<?php
class URLrewrite
{
    /**        Call the class in view with:              
    *          URLrewrite::method()                      
    *                                                    
    *          Returns a url (http://host/public/admin/),
    *          removes the current method and            
    *          replaces it with the requested method     
    */
    private static $prefix = "http://";
    
    public static function adminURL($controller) {

        //filter the url from "" and explode it to array
        $arr = array_filter( explode("/", $_SERVER['REQUEST_URI']));

        // remove the last element in array, i.e the method
        array_pop($arr);        

        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
        {    
            self::$prefix = "https://";   
        }

        // create a url
        $url = self::$prefix . $_SERVER['HTTP_HOST'] . "/" . implode('/', $arr) . "/" . $controller;

        return $url;

    }

    /***** Returns a url (http://host/public/) with the requested controller *****/

    public static function URL($controller)
    {
        $string =  preg_replace('~admin/~', null,rtrim($_SERVER['REQUEST_URI'], "/"));

        $arr = explode('/', $string);
        
        if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
        {    
            self::$prefix = "https://";   
        }

        $url = self::$prefix . $_SERVER['HTTP_HOST'] . implode('/', $arr) . "/";
        return $url . $controller;
        
    }

        // returns a base url (http://localhost/projekt_grupp5/public/) for
        // use to href/src css and js
        public static function BaseURL() 
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 
        
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
        
        // replace admin with public if on admin site
        if (in_array('/projekt_grupp5/admin', $pathInfo)) {
            
            $pathInfo['dirname'] = '/projekt_grupp5/public';
        }

        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 
        
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        
        // return: http://localhost/myproject/
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }

    public static function BaseAdminURL($controllerMethod) 
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 
        
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
        
        // replace public with admin if on admin site
        if (in_array('/projekt_grupp5/public', $pathInfo)) {
            
            $pathInfo['dirname'] = '/projekt_grupp5/admin';
        }

        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 
        
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        
        // return: http://localhost/myproject/ + the provided controller and method.
        return $protocol.$hostName.$pathInfo['dirname']."/".$controllerMethod;
    }
}

?>