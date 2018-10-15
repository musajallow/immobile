<?php
class Checkout_model extends Base_model
{
    //The index function brings user account information which will automatically fill in the form
    public function index($uid) {
        $this->sql ="SELECT user.uid, user.level_id, user_levels.level_type, email, fname, lname, phone, username, creation_time, modification_time, password
        FROM projekt_klon.user JOIN account
        ON user.uid = account.uid JOIN user_levels
        ON user.level_id = user_levels.level_id WHERE user.uid = :uid";

        $paramBinds = [':uid' => $uid];
        $this->prepQuery($this->sql, $paramBinds);

        $this->getOne();

        return self::$data;
    }

    //Hömta alla user
    public function getUser($uid) 
    {
        $this->sql = 
        "SELECT * FROM user WHERE user.uid = :uid"; 
        
        $paramBinds = [':uid' => $uid];
    
        
        $this->prepQuery($this->sql, $paramBinds);
        $this->getAll();
        var_dump($_SESSION['cart']->getTotalPrice());
        return self::$data;
    }

    //Sätta ordrar
    public function placeOrder() {

        //Spara alla session value till variablar
        $user_id = isset($_SESSION['loggedIn']['uid']) ? $_SESSION['loggedIn']['uid'] : null;
        $fname = $_SESSION['user']['first_Name'];
        $lname = $_SESSION['user']['last_Name'];
        $email=$_SESSION['user']['email_Address'];
        $address_1 = $_SESSION['order']['street_address_1'];
        $address_2 = $_SESSION['order']['street_address_2'];
        $zip = $_SESSION['order']['zip'];
        $city = $_SESSION['order']['city'];
        //Spara addressen till en lång sträng
        $address = $address_1.'/'.$address_2.'/'.$zip.'/'.$city;

        $payment_Type= $_SESSION['orderPayment']['type'];
        $payment_status="unpaid";
        $status="pending";
        //Kör funktionen i cart klassen att hämta ut pris
        $totalAmount= $_SESSION['cart']->getTotalPrice();
    
        //Databasfråga
        $sql = "INSERT INTO projekt_klon.orders (total_amount, payment_status, payment_method, user_id, alternative_address, lname, fname, email) VALUES (:total_amount, :payment_status, :payment_method, :user_id, :alternative_address, :lname, :fname, :email)";
        $paramBinds = [':total_amount' => $totalAmount, ':payment_status' => $payment_status,':payment_method' => $payment_Type, ':user_id' => $user_id, ':alternative_address' => $address, ':lname' => $lname, ':fname' => $fname, ':email' => $email];
       
        //Om succé, sätta en order id och status till true
        if ($this->prepQuery($sql, $paramBinds)) {
            $order_id = $this->lastInsertId;
            $_SESSION['order']['orderId'] = $order_id;
            $returnValues = ['status' => true, 'orderId' => $order_id];
            return $returnValues;
        } else {
            return false;
        }

} //End of Place order function

//Spara order items
    public function saveOrderItems($order_id) {

        $orderItems = $_SESSION['cart']->getProdList();
        $this->sql = "INSERT INTO `projekt_klon`.`order_items` (`order_id`, `quantity`, `sku`) VALUES (:order_id, :quantity, :sku)";

        foreach ($orderItems as $product => $q) {
            $sku = $product;
            $quantity = $q;

            $paramBinds = [':order_id' => $order_id, ':quantity' => $quantity, ':sku' => $sku];

            $this->prepQuery($this->sql, $paramBinds);
        }
    }

//Vi behövde spara customer info i session eftersom vi skickar post flera gånger
    public function tempCustomerUserInfo()
    {
        $_SESSION['user']['first_Name'] = $_POST['user']['first_Name'];
        $_SESSION['user']['last_Name'] = $_POST['user']['last_Name'];
        $_SESSION['user']['email_Address'] = $_POST['user']['email_Address'];
        $_SESSION['user']['telephone_Number'] = $_POST['user']['telephone_Number'];
        $_SESSION['user']['level_id'] = $_POST['user']['level_id'];

        $_SESSION['checkout']['step'] = $_POST['step'];
    }

//Samma som Tempcustomerinfo funktionen
    public function tempCustomerAccountInfo()
    {
        $_SESSION['order']['street_address_1'] = $_POST['order']['street_address_1'];
        $_SESSION['order']['street_address_2'] = $_POST['order']['street_address_2'];
        $_SESSION['order']['zip'] = $_POST['order']['zip'];
        $_SESSION['order']['city'] = $_POST['order']['city'];
        $_SESSION['order']['country'] = $_POST['order']['country'];

        $_SESSION['checkout']['step'] = $_POST['step'];

    }

//Samma som Tempcustomerinfo funktionen
    public function tempPaymentMethod()
    {
        $_SESSION["orderPayment"]["type"] = $_POST["orderPayment"]["type"];

        $_SESSION['checkout']['step'] = $_POST['step'];

    }

    



}

