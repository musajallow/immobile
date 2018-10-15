<?php

class Base_model
{
    private $db;    
    protected $dbh;
    
    protected $sql;
    private $stmt;

    protected $lastInsertId;

    // uncertain howerver the $data actually needs to be static.
    // at the moment the content is not sent to the view if declared as non static
    protected static $data;

    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->dbh = $this->db->getConnection();
        
    }

    public function prepQuery($sql, $paramBinds = [])
    {
        try {
            $this->stmt = $this->dbh->prepare($sql);
            
            if($paramBinds != []){
                // bindParam needs a variable, therefore the value to be bound is passed by reference
                foreach ($paramBinds as $key => &$value) {
                    $this->stmt->bindParam($key, $value);
                      
                }
            
            }            
            if($this->stmt->execute())
            {
                // save the last auto incremented id from the last insert statement
                $this->lastInsertId = $this->dbh->lastInsertId();        
                return true;
            } else {
                return false;
            }
    }
    catch (PDOException $e) {
        echo "Error with query : " . $e;
    }
    }

    public function getAll()
    {
        self::$data = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return self::$data;
    }

    public function getOne()
    {
        self::$data = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return self::$data;
    }
}
