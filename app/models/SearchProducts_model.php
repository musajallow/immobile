<?php

class SearchProducts_model extends Base_model
{
    
    public function searchAllProducts()
    {
        //$search = mysqli::real_escape_string($_POST['search-database']);
        $search = $_POST['search-database'];
        $this->sql = 
        "SELECT title FROM product WHERE title LIKE '%$search%'";

        $this->prepQuery($this->sql);
        $this->getAll();

        return self::$data;
    }
}