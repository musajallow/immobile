<?php

// Klassen kollar url och kör rätt controller, metoder och hanterar eventuella parametrar
class App
{
    protected $controller = 'home';
    protected $method = 'index'; 
    protected $params = [];

    //vid instansiering körs funktionen parseUrl som hanterar url'en
    public function __construct()
    {
        $url = $this->parseUrl();
        // kollar om första parametern i url'en matchar en controller
        // om den matchar sätts $controller till det 
        if (file_exists(CONTROLLER_PATH . $url[0] . '.controller.php'))
        {
            
            $this->controller = $url[0];
            unset($url[0]);
        }

        if (!is_file(CONTROLLER_PATH . $this->controller . '.controller.php')) {
            $this->controller = DEAFULT_CONTROLLER;
        }
        require_once CONTROLLER_PATH . $this->controller . '.controller.php';
    
        $this->controller = new $this->controller;
        //var_dump($this->controller);
        
        // kollar om någon metod finns i url
        // om det finns en metod i url, kolla om metoden finns i klassen(objektet)
        // som nu är instansierad i $this->controller
        // och ge $this->method den metoden
        if(isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        } else {
            unset($url[1]);
        }
    
        //om det finns (kvar) några parametrar i url'en, omnumreras de från 0 till en array
        // dessa kan sen skickas in i metoder(funktioner) i controllers        
        $this->params = $url ? array_values($url) : [];
        //var_dump($url);
        call_user_func_array([$this->controller, $this->method], $this->params);
        
        
    }


    // Filtrerar url, tar bort eventuellt / på slutet samt delar upp (explode) url vid /. 
    // Skapar alltså en indexbaserad array där alla delar i url'en finns med.
    // På så sätt kan man kolla vilken eventuell controller samt metod som ska köras
    // Kortfattat är detta grunden till routingen
    protected function parseUrl()
    {
        if(isset($_GET['url']))
        {
            return $url = explode('/' , filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}