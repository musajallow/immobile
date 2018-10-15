<?php

class ForgotPassword_model extends Base_model {

        // random password 
    public function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    
    }

    public function verifyEmail()
    {
        $email = $_POST['forgot']['email'];

        $this->sql = "SELECT email, uid FROM projekt_klon.user WHERE email = :email";
        $parambinds = [':email' => $email];

        $this->prepQuery($this->sql, $parambinds);

        $this->getOne();

        $uid = self::$data['uid'];
        if (!empty(self::$data)) {

            $returnValues = ['status' => true,'uid' => $uid, 'email' => $email];
            return $returnValues;
        }else {
            return false;
            //echo "The email address you enter could not be found in the database";
        }
        
    }

    public function SendEmail($params) {

        // create token
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);

        // insert token to db
        $this->sql = "UPDATE `projekt_klon`.`account` SET `token`= :token WHERE `username`= :username and`uid`= :uid";
        $parambinds = [':token' => $token, ':username' => $params['userInfo']['username'], ':uid' => $params['uid']];

        $this->prepQuery($this->sql, $parambinds);
    
        // link to reset password
        $resetLink = URLrewrite::BaseURL().'forgotPassword/resetForm/'.$token;

        // build email
        $to      = $params['email'];
        $subject = 'Reset Password';
        $text = 'Hello ' . $params['userInfo']['fname'] . " " . $params['userInfo']['lname'] .
                '! Click the link to reset your password: ' . $resetLink;
        // prevent removed lines on  windows. http://php.net/manual/en/function.mail.php 'message' 
        $text = str_replace("\n.", "\n..", $text);

        $message = 'Hello ' . $params['userInfo']['fname'] . " " . $params['userInfo']['lname'] .
                    '! Click the link to reset your password: ' . $resetLink;

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'From: noreply@immobile.com' . "\r\n" .
            'Reply-To: help@immobile.com' . "\r\n";

        if(mail($to, $subject, $message, $headers))
        {
            echo '<div class="alert alert-success alert-dismissible grid-alert" role="alert">Email sent! Redirect in 5s</div>';
            header('Refresh:5;'. URLrewrite::BaseURL());
        } else {
            echo '<div class="alert alert-danger alert-dismissible grid-alert" role="alert">Failed to send Email! Contact customer service</div>';
            header('Refresh:5;'. URLrewrite::BaseURL());
        }
        
    }


    public function resetPassword($token) {

        //check if token is correct
        $this->sql = "SELECT token, modification_time AS time, timestampdiff(MINUTE, modification_time, NOW()) AS diff FROM projekt_klon.account WHERE token = :token";
        $paramBinds = [':token' => $token];
        $this->prepQuery($this->sql, $paramBinds);
        $this->getOne();
        $dbToken = self::$data['token'];
        $returnValues = ['status' => true, 'dbToken' => $dbToken, 'token' => $token];
        // if token is identical and minutes passed is not greater than 60
        if ($dbToken === $token && !(self::$data['diff'] > 10)) {
            return $returnValues;
        } else {
            return false;
        }
    }

}