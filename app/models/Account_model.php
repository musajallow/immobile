<?php
class Account_model extends Base_model
{
       
    // query the database for one persons id passed in the url
    public function getPerson($uid) 
    {
        $this->sql = 
        "SELECT * FROM user WHERE user.uid = :uid"; //display user info and connects url-id with user id        
        // parameters to be bound, is sent to the prepQuery method (doesn't always have to be included)
        $paramBinds = [':uid' => $uid];
        $base = new Base_model;
        
        $base->prepQuery($this->sql, $paramBinds);
        $base->getAll();
        //returns an array of the data from the database which is then printed to the client in the view
        return self::$data;
    }

    public function deletePerson($uid) {
        
        $this->sql = "DELETE FROM `projekt_klon`.`account` WHERE uid= :uid";

        $paramBinds = [':uid' => $uid]; 
        
        if($this->prepQuery($this->sql, $paramBinds))
        {
            echo "working";
        } else {
            echo "fail";
        }
        
        unset($_SESSION['loggedIn']);
        session_destroy();
        header('Location:'.URLrewrite::baseURL()); //rewrites the deleted user to the default-page

}

   /* Save address to user's account */
   public function saveAddress($uid = "")
   {
        $address = $_POST['customer']['address'];
        $zip = $_POST['customer']['zip'];
        $city = $_POST['customer']['city'];
        $country= $_POST['customer']['country'];
        $user_id = $uid != "" ? $uid : $_POST['customer']['uid'];
        $this->sql = "INSERT INTO `projekt_klon`.`private_adress` (adress, post_nr, stad, land, uid) VALUES (:adress, :post_nr, :stad, :land, :user_id)";
        $paramBinds = [':adress' => $address, ':post_nr' => $zip, ':stad' => $city, ':land' => $country, ':user_id' => $user_id];
        //var_dump($user_id);
        if($this->prepQuery($this->sql, $paramBinds))
        {
            return true;
        } else {
            return false;

        }

    }
}





?>