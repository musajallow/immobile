<?php
class DeleteUser_model extends Base_model
{
       
    // query the database for one persons id passed in the url
    public function deletePerson($uid) 
    {
        $this->sql = 
        "SELECT * FROM user INNER JOIN account WHERE user.uid AND account.uid = :uid"; //display user info and connects url-id with user id
        
        
        // parameters to be bound, is sent to the prepQuery method (doesn't always have to be included)
        $paramBinds = [':uid' => $uid];
        $base = new Base_model;
        
        $base->prepQuery($this->sql, $paramBinds);
        $base->getAll();
        //returns an array of the data from the database which is then printed to the client in the view
        return self::$data;
    }

} 

?>