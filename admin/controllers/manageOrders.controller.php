<?php

class manageOrders extends base_controller
{
    public function Index()
    {
        $this->initModel('manageOrders_model');

        $data['orders'] = $this->modelObj->getAllOrders();

        $this->reqView('manageOrders', $data);
    }

    public function orderDetails($oid)
    {
        $this->initModel('manageOrders_model');

        $data['order_items'] = $this->modelObj->getOrderItems($oid);

        $this->reqView('manageOrders', $data);
    }

    public function deleteOrder($oid)
    {
        $this->initModel('manageOrders_model');

        if ($this->modelObj->deleteOrder($oid))
            {
                echo '<div class="alert alert-success alert-dismissible grid-alert" role="alert">Order deleted!</div>';              
                header('Refresh:3;'.URLrewrite::BaseAdminURL('Manageorders'));
            } else {
                echo '<div class="alert alert-danger alert-dismissible grid-alert" role="alert">Failed to delete order!</div>';              
                header('Refresh:3;'.URLrewrite::BaseAdminURL('Manageorders'));
            }
    }
}