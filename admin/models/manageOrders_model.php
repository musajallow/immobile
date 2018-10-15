<?php

class manageOrders_model extends base_model
{
    public function getAllOrders()
    {
        $this->sql = "SELECT * FROM projekt_klon.orders";

        $this->prepQuery($this->sql);

        $this->getAll();

        return self::$data;
    }

    public function getOrderItems($oid)
    {
        $this->sql = "SELECT * FROM projekt_klon.order_items WHERE order_id = :oid";
        $paramBinds = [':oid' => $oid];

        $this->prepQuery($this->sql, $paramBinds);
        $this->getAll();
        return self::$data;
    }

    public function deleteOrder($oid)
    {
        $this->sql = "DELETE FROM `projekt_klon`.`orders` WHERE `order_id`= :oid";
        $paramBinds = [':oid' => $oid];

        if($this->prepQuery($this->sql, $paramBinds))
        {
            return true;
        } else {
            return false;
        }

    }
}