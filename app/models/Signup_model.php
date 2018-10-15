<?php

class Signup_Model extends base_model
{
	public function signupUser()
    {
		//var_dump($_POST);
		
    	    if (empty($_POST['user']['fname']) || empty($_POST['user']['lname']) || empty($_POST['user']['email']) || empty($_POST['user']['phone']) || empty($_POST['user']['username']) || empty($_POST['user']['password'])) {
				echo "Please, fill out the required fields";
				
            } else {
            	if (!preg_match('/^[a-zA-Z]*$/', $_POST['user']['fname']) || !preg_match('/^[a-zA-Z]*$/', $_POST['user']['lname']) || !preg_match('/^[a-zA-Z]*$/', $_POST['user']['username'])) {
            		echo "Please, check input";
            	} else {
            		if (!filter_var($_POST['user']['email'], FILTER_VALIDATE_EMAIL)) {
            			echo "The provided email is invalid";
            		} else {
            			$level_id = $_POST['user']['level_id'];
            			$fname = $_POST['user']['fname'];
            			$lname = $_POST['user']['lname'];
            			$email = $_POST['user']['email'];
            			$phone = $_POST['user']['phone'];
            			$username = $_POST['user']['username'];
            			$sql = "SELECT * FROM `projekt_klon`.`account` WHERE username = ':username'";
                        $paramBinds = [':username' => $username];
                        $this->prepQuery($sql, $paramBinds);
            			$resultCheck = $this->getAll();
                        var_dump($resultCheck);
            			if (!empty($resultCheck)) {
            				echo "username already taken, please try again";
                            //var_dump($resultCheck);
            			} else {
            				$hashedPassword = md5($_POST['user']['password']);
            				$sql = "INSERT INTO projekt_klon.user (level_id, fname, lname, phone, email) VALUES (:level_id, :fname, :lname, :phone, :email)";
            				$paramBinds = [':level_id' => $level_id, ':fname' => $fname, ':lname' => $lname, ':phone' => $phone, ':email' => $email];
					        $this->prepQuery($sql, $paramBinds);
					        $userId = $this->lastInsertId;
					        
					       	$sql = "INSERT INTO projekt_klon.account (uid, username, password) VALUES (:userId, :username, :hashedPassword)";
					        $paramBinds = [':userId' => $userId, ':username' => $username, ':hashedPassword' => $hashedPassword,];
					        $this->prepQuery($sql, $paramBinds);
							return true;

						}
            		}
            	}
            }
	}
	


    public function createUserFromOrder() {

        /* Create account when a new customer places order */
       	$first_Name = $_POST['customer']['first_Name'];
       	$last_Name = $_POST['customer']['last_Name'];
	   	$telephone_Number = $_POST['customer']['telephone_Number'];
        $email_Address = $_POST['customer']['email_Address'];
        $level_id = 1;
	   
        $sql = "INSERT INTO projekt_klon.user (level_id, fname, lname, phone, email) VALUES (:level_id, :fname, :lname, :phone, :email)";
        $paramBinds = [':level_id' => $level_id, ':fname' => $first_Name, ':lname' => $last_Name, ':phone' => $telephone_Number, ':email' => $email_Address];
	

		if($this->prepQuery($sql, $paramBinds))
		{
			$userId = $this->lastInsertId;
			$returnValues = ['status' => true, 'userId' => $userId];
			return $returnValues;		
		} else {
			return false;
		}
	}
	
	public function createAccountFromOrder($userId)
	{
		$user_Name= $_POST['newmember']['username'];
		$hashed_password = md5($_POST['newmember']['password']);
				
		$sql = "INSERT INTO projekt_klon.account (uid, username, password) VALUES (:userId, :username, :hashedPassword)";
		$paramBinds = [':userId' => $userId, ':username' => $user_Name, ':hashedPassword' => $hashed_password];
		
		   if($this->prepQuery($sql, $paramBinds))
		   {
			   // debugging
			   echo "account created";

			   // send new user to account page
		   } else {
			   echo "failed to create account";
		   }
	}

}
  

