<div class="order-container">

<h1>Order history</h1>

<div class="text-center">
<a  href="<?php echo URLrewrite::BaseURL().'account'?>"><button id="" class="btn btn-primary">My details</button></a> 
<a  href="<?php echo URLrewrite::BaseURL().'orderhistory/'?>"><button id="" class="btn btn-primary">My Order History</button></a> <!-- here is the options between the users account and order history -->
<a href="<?php echo URLrewrite::BaseURL().'updateuser' ?>"><button id="updateUser" class="btn btn-primary updateButton">Update User Information</button></a>
<a href="<?php echo URLrewrite::BaseURL().'changepassword' ?>" class="btn btn-primary">Change password</a>
</div><br>

    <p>Below you can see all orders you made at our store. If you don't see some of the orders you might
     have more than one account or you were not logged in when you placed the order.
     Feel free to contact our Costumer Service if you have any problems.</p>


<?php
var_dump($data);
//creates table for specific values in the SQL-array
if (!empty($data['orderInfo'])) { ?>
    <div class="container">
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Ordernumber</th>
                <th scope="col">Total Price</th>
                <th scope="col">Date</th>
                <th scope="col">Inspect</th>


            </tr>
        </thead>
        <tbody class="">
            <?php
            
            $productInfo = "";
            foreach($data['orderInfo'] as $key => $value) {
                $productInfo .= "<tr><td>".$value['order_id']."</td>"."<td>".$value['total_amount']."</td>".
                "<td>".$value['order_time']."</td>".'<td><a href="'.URLrewrite::BaseURL().'orderhistory/orderInfo/'.$value['order_id'].'"<span class="glyphicon 
                glyphicon-arrow-right"></span></a></td>';
                
            }?>

            <?php echo isset($productInfo) ? $productInfo : '' ?>



        </tbody>
    </table>

    </div>
    </div>
<?php
} elseif (empty($data['order_items'])) {
    echo "<font size='4'><center>You don't have any orders to display</center></font>";
    
}
if (isset($data['order_items'])) {

    ?>
    
    <table class="table table-striped table-bordered">
    <thead class="thead-light">
            <tr>
                <th colspan="1" class="text-uppercase">Order ID: <?php echo $data['order_items'][0]['order_id']; ?></th>
                <th colspan="2"><a href="<?php echo URLrewrite::BaseURL().'orderhistory'?>"><button>Go back</button></a></th>

            </tr>
        </thead>
            <thead class="thead-light">
                <tr>
                    <th scope="col">Model:</th>
                    <th scope="col">Quantity:</th>
                    <th scope="col">Image:</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                    $tabel = "";
                    foreach ($data['order_items'] as $key => $value) {
                        $tabel .= "
                        <tr>
                        <td class='col-sm-5'>".$value['sku']."</td>".
                        "<td class='col-sm-5'>".$value['quantity']."</td>".
                        "<td class='col-sm-1'><img class='img-responsive' src='".$data['prodInfo'][$key]['img_url']."'/></td>".
                        "</tr>";                                 
                    }?>
                    
                    <?php echo $tabel ?>
    
            </tbody>
        </table>
    </div>
    
    <?php

                }