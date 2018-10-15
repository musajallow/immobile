<?php 

class Forgotpassword extends Base_Controller {

    public function Index()
    {
    $this->reqView('forgotpassword');
        
    }
    
    public function resetPassword()
    {
    $this->initModel('ForgotPassword_model');

    $data = $this->modelObj->verifyEmail();
    if($data['status'])
    {
        $userInfo = $this->getUserInfo($data['uid']);
        $params = ['uid' =>$data['uid'],'email' => $data['email'],  'userInfo' => $userInfo];
        $this->sendEmail($params);
    }

    }

    public function getUserInfo($uid)
    {
        $this->initModel('User_model');
        $data = $this->modelObj->getUser($uid);
        return $data;
    }

    public function sendEmail($params)
    {
        $this->initModel('forgotPassword_model');

        $this->modelObj->sendEmail($params);

    }

    public function resetForm($token)
    {
        $this->initModel('ForgotPassword_model');

        $data = $this->modelObj->resetPassword($token);

        if ($data['status']) {
            $this->reqView('resetPassForm', $data);
        } else {
            echo '<div class="alert alert-danger alert-dismissible grid-alert" role="alert">The link has expired!</div>';
            header('Refresh:5;'. URLrewrite::BaseURL());
        }
    }

}


?>