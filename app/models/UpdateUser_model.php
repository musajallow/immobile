<?php

class UpdateUser_model extends Base_model
{

    public function getUser($uid) 
    {
        $this->sql = 
        "SELECT * FROM user WHERE user.uid = :uid"; //display user info and connects url-id with user id
        
        //"SELECT * FROM user JOIN account ON account.uid = user.uid WHERE user.uid = :uid"; // both the clients info and password
        
        // parameters to be bound, is sent to the prepQuery method (doesn't always have to be included)
        $paramBinds = [':uid' => $uid];
        $base = new Base_model;
        
        $base->prepQuery($this->sql, $paramBinds);
        $base->getAll();
        //returns an array of the data from the database which is then printed to the client in the view
        return self::$data;
    }
    
    public function UpdateUser($uid) {

        $fname = ($_POST['fname']);
        $lname = ($_POST['lname']);
        $phone = ($_POST['phone']);
        $email = ($_POST['email']);


        $this->sql = "UPDATE `projekt_klon`.`user` SET user.fname = :fname, user.lname = :lname, user.phone = :phone, user.email = :email WHERE uid = :uid";
        $parambinds = [':fname' => $fname, ':lname' => $lname, ':phone' => $phone, ':email' => $email, ':uid' => $uid];
        if($this->prepQuery($this->sql, $parambinds)){
         Registry::setStatus(['UpdateUser' => true]); //alert for if the database got the sql string or not
            //header('Location:'.URLrewrite::BaseURL());
        } else {
         Registry::setStatus(['UpdateUser' => false]);
            
        }
    
        
            }

}



?>