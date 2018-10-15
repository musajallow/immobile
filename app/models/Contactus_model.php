<?php
class Contactus_model extends Base_model
{
    public function index()
    {
        /*Initially thought to bring logged in user data inside the contact form*/
        $this->sql = 
        "SELECT user.uid, user.level_id, user.fname, user.lname, user.phone, user.email, user_levels.level_type FROM user
        INNER JOIN  user_levels ON user.level_id = user_levels.level_id";
        $this->prepQuery($this->sql);
        $this->getAll();
        return self::$data;
    }

}
