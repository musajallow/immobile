<div class="form-container">
<?php
include ADMIN_VIEW.'adminPanelNav.view.php';

$status = Registry::getStatus('editProduct');
if (!isset($status) || $status != 'edit' )
{
/*
*
*   SHOW ALL PRODUCTS
*/
?>

    <table class="grid-table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Product Id</th>
            </tr>
        </thead>
        <tbody class="">
            <?php
                // loop trough $data and create a table
                $optionInfo = "";
                foreach ($data['products'] as $key => $value) {
                    $optionInfo .= "<tr><td>".$value['title']."</td>"."<td>".$value['pid']."</td>"
                    .'<td><a href="'
                    .URLrewrite::BaseAdminURL('manageProduct/viewProductVariants').'/'.$value['pid']
                    .'"<span class="glyphicon glyphicon-pencil"></span></a></td>'
                    .'<td><a href="'
                    .URLrewrite::BaseAdminURL('manageProduct/removeProduct').'/'.$value['pid']
                    .'"<span class="glyphicon glyphicon-remove"></span></a></td>'."</tr>";                                 
                }?>
                
                <?php echo $optionInfo ?>
        </tbody>
    </table>

<?php } else {
 

    // if no variants print message
    if ($data['variants'] == false) {
        echo "<h1>No variants for ". $data['product']['title']."</h1>"; ?>
        <a href="<?php echo URLrewrite::BaseAdminURL('manageProduct')  ?>"><button>Go back</button></a>
        <?php } else {
    /*
    *
    *   SHOW ALL VARIANTS OF SELECTED PRODUCT
    */
    ?>
    <!-- <div class="form-container"> -->
    <table class="grid-table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
            <?php printf("<th colspan='4'>%s variants</th>", $data['product']['title']); ?>
        </tr>
        </thead>
        <thead class="thead-light">
            <tr>
                <th scope="col">SKU</th>
                <th scope="col">Variant Id</th>
                <th scope="col">Edit</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody class="">
            <?php
            // loop trough $data and create a table
                $variantInfo = "";
                foreach ($data['variants'] as $key => $value) {
                    $variantInfo .= "<tr><td>".$value['sku']."</td>"."<td>".$value['variant_id']."</td>"
                    .'<td><a href="' // button for editing variant
                    .URLrewrite::BaseAdminURL('manageProduct/editVariant').'/'.$value['product_id'].'/'.$value['variant_id']
                    .'"<span class="glyphicon glyphicon-pencil"></span></a></td>'
                    .'<td><a href="' // button for removing variant
                    .URLrewrite::BaseAdminURL('manageProduct/deleteVariant').'/'.$value['product_id'].'/'.$value['variant_id']
                    .'"<span class="glyphicon glyphicon-remove"></span></a></td>'."</tr>";                                 
                }?>
                
                <?php echo $variantInfo; ?>
        </tbody>
    </table>

    <a href="<?php echo URLrewrite::BaseAdminURL('manageProduct');  ?>"><button>Go back</button></a>
<?php }} ?>
</div>
