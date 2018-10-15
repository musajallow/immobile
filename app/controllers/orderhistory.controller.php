<?php
class orderhistory extends base_controller 
{
    public function index($uid = "") //the users id url displays here 
    {
        //echo "account index";
        //connects controller with the right model
        $this->initModel('Orderhistory_model');
        //var_dump($this->modelObj);

        $uid = $_SESSION['loggedIn']['uid']; //
        
        //the SQL-array is named $data but alos 'orderInfo'
        $data['orderInfo'] = $this->modelObj->displayOrders($uid);
        //connects controller with the right view
        $this->reqView('orderhistory',$data);
        
    }

    public function orderInfo($oid){
        
        $this->initModel('Orderhistory_model');

        $data['order_items'] = $this->modelObj->getOrderItems($oid);


        $data['prodInfo'] = $this->modelObj->getProductVariants($data['order_items']);
        
        $this->reqView('orderhistory', $data);


    }
}