<?php

require_once 'settings.inc.php';

// ---- Singleton database connection class ----

class Db
{
    private $connection; // kopplingen
    private static $instance; // instansen av classen
    private $host = DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $database = DB_NAME;

    public static function getInstance()
    {
        // om det inte finns en instans av klassen skapas det
        if(!self::$instance)
        {
            self::$instance = new self(); 
        }

        return self::$instance;
    }

    private function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database",$this->username, $this->password);
            // Prevents empty string insertion in database 
            //$this->connection->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "connection established";
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // tom clone-funktion för att förhindra flera instanser
    private function __clone()
    {
    }

    public function getConnection()
    {
        return $this->connection;
    }
}