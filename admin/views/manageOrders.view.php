<div class="form-container">
<?php include ADMIN_VIEW.'adminPanelNav.view.php';

if (!empty($data['orders'])) {

?>

<table class="grid-table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Total</th>
                <th scope="col">Order date</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody class="">
            <?php
                $tabel = "";
                foreach ($data['orders'] as $key => $value) {
                    $tabel .= "
                    <tr>
                    <td>".$value['order_id']."</td>".
                    "<td>".$value['total_amount']." kr</td>".
                    "<td>".$value['order_time']."</td>".
                    "<td>".$value['payment_status']."</td>"
                    .'<td><a href="'
                    .URLrewrite::BaseAdminURL('manageOrders/orderDetails').'/'.$value['order_id']
                    .'"<span class="glyphicon glyphicon-pencil"></span></a></td>'
                    .'<td><a href="'
                    .URLrewrite::BaseAdminURL('manageOrders/deleteOrder').'/'.$value['order_id']
                    .'"<span class="glyphicon glyphicon-remove"></span></a></td>'."</tr>".
                    "</tr>";                                 
                }?>
                
                <?php echo $tabel ?>

        </tbody>
    </table>
</div>

<?php
} elseif(!isset($data['order_items'])) {
    echo "<h1 class='status-alert'>No orders</h1>";
}
if (isset($data['order_items'])) {

    ?>
    
    <table class="grid-table table-striped table-bordered">
    <thead class="thead-light">
            <tr>
                <th colspan="1">Order ID: <?php echo $data['order_items'][0]['order_id']; ?></th>
                <th colspan="1"><a href="<?php echo URLrewrite::BaseAdminURL('manageOrders') ?>"><button>Go back</button></a></th>

            </tr>
        </thead>
            <thead class="thead-light">
                <tr>
                    <th scope="col">SKU</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                    $tabel = "";
                    foreach ($data['order_items'] as $key => $value) {
                        $tabel .= "
                        <tr>
                        <td>".$value['sku']."</td>".
                        "<td>".$value['quantity']."</td>".
                        "</tr>";                                 
                    }?>
                    
                    <?php echo $tabel ?>
    
            </tbody>
        </table>
    </div>
    <?php
    }