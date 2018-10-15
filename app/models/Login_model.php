<?php
/**
* 
*/
class Login_model extends base_model
{
	
	public function login()
    {
		
		// Validation of login form
        if (empty($_POST['login']['username']) || empty($_POST['login']['password'])) {
        	echo "Please, fill out the required fields";
        } else { 
        	if (!preg_match('/^[a-zA-Z]*$/', $_POST['login']['username'])) {
        		echo "Please, check input";
            } else { 
            			$username = $_POST['login']['username'];
						$hashedPassword = md5($_POST['login']['password']);
						
						$this->sql = "SELECT username, account.uid, password, level_id FROM account 
						JOIN user ON account.uid = user.uid WHERE username = :username AND password = :password";
						$paramBinds = [':username' => $username, ':password' => $hashedPassword];
						$this->prepQuery($this->sql, $paramBinds);
						$result = $this->getOne();
						if ($result == 0) { 
							echo "Username or password is incorrect";
							header("Location: {$_SERVER['HTTP_REFERER']}");
						} else { 
							if ($result['username'] === $username && $result['password'] === $hashedPassword) {
								$_SESSION['loggedIn']['username'] = $username;
								$_SESSION['loggedIn']['uid'] = $result['uid'];
								$_SESSION['loggedIn']['level'] = $result['level_id'];
								header('Location:'.URLrewrite::BaseURL().'account/index');
							}
					}
						
					
                }
        }
	}

	public function logout()
	{
		unset($_SESSION["loggedin"]['username']);
		
		session_destroy();
		
		header('Location:'.URLrewrite::BaseURL().'index');
	}
}