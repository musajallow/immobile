<?php

class manageUsers_model extends base_model
{
    public function getAllUsers()
    {
        $this->sql ="SELECT user.uid, user.level_id, user_levels.level_type, fname, lname, phone, username, creation_time, modification_time, password
        FROM projekt_klon.user JOIN account
        ON user.uid = account.uid JOIN user_levels
        ON user.level_id = user_levels.level_id";

        $this->prepQuery($this->sql);

        $this->getAll();

        return self::$data;
    }

    public function getSpecificUser($uid)
    {
        $this->sql = "SELECT user.uid, user.level_id, email, user_levels.level_type, fname, lname, phone, username, creation_time, modification_time, password
        FROM projekt_klon.user JOIN account
        ON user.uid = account.uid JOIN user_levels
        ON user.level_id = user_levels.level_id
        WHERE user.uid = :user_id";

        $paramBinds = [':user_id' => $uid];

        $this->prepQuery($this->sql, $paramBinds);

        $this->getOne();

        return self::$data;
    }
    
    public function deleteUser($uid)
    {
        $this->sql ="DELETE FROM projekt_klon.user WHERE uid = :userId";

        $paramBinds = [':userId' => $uid];

        // set status depending on sql query result
        if ($this->prepQuery($this->sql, $paramBinds)) {
            Registry::setStatus(['deleteUser' => true]);            
            return true;
        } else {
            Registry::setStatus(['deleteUser' => false]);
            return false;            
        }

    }

    public function getUserAdress($uid)
    {
        $this->sql = "SELECT * FROM projekt_klon.private_adress WHERE uid = :uid";

        $paramBinds = [":uid" => $uid];

        $this->prepQuery($this->sql, $paramBinds);

        $this->getOne();

        // set status depending on sql query result
        if ($this->prepQuery($this->sql, $paramBinds)) {
            Registry::setStatus(['getUserAdress' => true]);            
            return self::$data;
        } else {
            Registry::setStatus(['getUserAdress' => false]);
            return false;            
        }

    }

    public function updateUserInfo($uid)
    {
        /* Update user information */
        $userInfo = $_POST['userInfo'];
        $this->sql = "UPDATE `projekt_klon`.`user` SET ";

        
        // remove items from array which are empty
        
        foreach ($userInfo as $key => $value) {
            if ($value === "") {
                unset($userInfo[$key]);
            }
        }
        // count and $i variables to keep track of number of items in array
        //loop trough data for user table in db
        $i = 0;
        $count = count($userInfo);
        foreach ($userInfo as $key => $value) {
            if($value != ''){
            //     $arr[] = $key; 
            // $count = count($arr);
            $this->sql .= $key. " = '$value'";
            //skip the , after the last element in the array
            if (++$i === $count) {
                $this->sql .= " ";
            } else {
                $this->sql .= ", ";         
            }
        } else {
            continue;
        }
    }
        $this->sql .= "WHERE uid = :uid";
        $paramBinds = [':uid' => $uid];

        // set status depending on sql query result
        if ($this->prepQuery($this->sql, $paramBinds)) {
            Registry::setStatus(['updateUserInfo' => true]);            
            return true;
        } else {
            Registry::setStatus(['updateUserInfo' => false]);
            return false;            
        }  
    }

    public function updateUserName($uid)
    {

        /* Update username */
        $this->sql = "UPDATE `projekt_klon`.`account` SET `username`= :newUserName WHERE `username`= :oldUserName and`uid`= :uid";
        
        $paramBinds = [':oldUserName' => $_POST['hidden']['oldUserName'], ':uid' => $uid, ':newUserName' => $_POST['accountInfo']['username']];
        // set status depending on sql query result
        if ($this->prepQuery($this->sql, $paramBinds)) {
            Registry::setStatus(['updateUserName' => true]);            
            return true;
        } else {
            Registry::setStatus(['updateUserName' => false]);
            return false;            
        }  
    }

    public function updateAddress($uid)
    {

        /* Update user adress */
        $userAdress = isset($_POST['userAdress']) ? $_POST['userAdress'] : null;
        $this->sql = "UPDATE `projekt_klon`.`private_adress` SET ";
        
        // remove items from array which are empty
        foreach ($userAdress as $key => $value) {
            if ($value === "") {
                unset($userAdress[$key]);
            }
        }
        // count and $i variables to keep track of number of items in array        
            $count = count($userAdress);
            $i = 0;
            // if user has adress
            if(isset($userAdress)){
            //loop trough data for user table in db
            foreach ($userAdress as $key => $value) {
                if ($key === 'aid' || $value == '') {
                    continue;
                } elseif($value != ''){      
                $this->sql .= $key. " = '$value'";
                //skip the , after the last element in the $data['variant] array
                if (++$i === $count) {
                    $this->sql .= " ";
                } else {
                    $this->sql .= ", ";         
                }
                } else {
                    continue;
                }
        }
   
            $this->sql .= "WHERE `aid`= :aid and`uid`= :uid";
            $paramBinds = [':uid' => $uid, ':aid' => $_POST['hidden']['aid']];
        
            // set status depending on sql query result
            if ($this->prepQuery($this->sql, $paramBinds)) {
                Registry::setStatus(['updateUserAdress' => true]);            
                return true;
            } else {
                Registry::setStatus(['updateUserAdress' => false]);
                return false;            
            }
    }
    }

    public function updatePassword($uid)
    {
        $newPass = $_POST['userPass']['new'];
        $confirmPass = $_POST['userPass']['confirm'];
        $username = $_POST['hidden']['username'];
        if ($newPass === $confirmPass) {
            // skapa kod för att fylla skapa nytt password till db
            $hashedPass = md5($newPass);
            $this->sql = "UPDATE `projekt_klon`.`account` SET `password`= :password WHERE `username`= :username and `uid`= :uid";

            $paramBinds = [':password' => $hashedPass, ':username'=> $username, ':uid' => $uid];

            $this->prepQuery($this->sql, $paramBinds);
            Registry::setStatus(['newPass' => true]);
            return true;
        } else {
            echo "fel";
            $_SESSION['updatePass']['newPass'] = $newPass;
            $_SESSION['updatePass']['status'] = false;
            header('Location:'.URLrewrite::BaseAdminURL('manageusers/getuserinfo/').$uid);
        }

    }
}