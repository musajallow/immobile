<?php
class Orderhistory_model extends Base_model
{
    public function displayOrders($uid)
    {
        $this->sql = 
        "SELECT * FROM projekt_klon.orders WHERE projekt_klon.orders.user_id = :uid";
        $binds = [':uid' => $uid];
        $this->prepQuery($this->sql, $binds);
        $data = $this->getAll();
        return $data;
    }

    public function getOrderItems($oid) {

        $this->sql = "SELECT * FROM projekt_klon.order_items WHERE order_id = :oid";
        $paramBinds = [':oid' => $oid];

        $this->prepQuery($this->sql, $paramBinds);
        $this->getAll();
        return self::$data;

    }

    public function getProductVariants($orderItems) {
        $count = count($orderItems);
        $i = 0;
        $this->sql = 
        "SELECT * FROM projekt_klon.product_variants WHERE sku IN (";
            foreach($orderItems as $key => $value)
            {
                $this->sql .= "'".$value['sku']."'";
                
                if(++$i === $count)
                {
                   $this->sql .= "";
                } else {
                    $this->sql .= ", ";
            }
        }
        $this->sql .= ")";
        $this->prepQuery($this->sql);
        $data = $this->getAll();
        return $data;
    }
}