<?php
$pid = isset($_POST['products']) ? $_POST['products'] : null;

?>

<div class="form-container">
<?php include ADMIN_VIEW.'adminPanelNav.view.php'; ?>


<?php
    // display message if insert of new option was succssessful or not
    if(isset($_POST['optiontype']['status']) && $_POST['optiontype']['status'] === 'true')
    {
        echo "<h4>New option type successfully added!</h4>";

    } elseif(isset($_POST['optiontype']['status']) && $_POST['optiontype']['status'] = 'false')
    {
        echo "<h4 class='grid-alert'>Failed to insert new option type, try again or contact site administrator</h4>";
    }
    
    // instantiate new form object
    $optionform = new Form;
    
    // output existing options from db:
    // $data is queried in the model, sent to controller and the to the view.
    // valueindex is the $data array key names so the form-class can identify
    // which values in the data array is given to the select's option element's
    // value and text output = <option value="option_id">option_name</option> 

    $valueindex = ['option_id', 'option_name'];
    $optionform->select('Options','Available Options', 'optionform', $data['optionType'], $valueindex);

        
    // input of new option
    $optionform->textInput('optiontype[new]', 'Option', 'Add Option'); 

    // form action
    $action = URLrewrite::adminURL('productoptions/addoption');

    // submit button
    $optionform->button('Save New Option');
    
    // render and output complete form element
    $optionform->render($action, 'Options', 'g-form', 'optionform');




//  Form to choose product and option to add

    // Print response on product option insert
    if(Registry::getStatus() !== null && Registry::getStatus('addProdStatus') == 'success')
    {
        echo '<div class="status-alert alert alert-success alert-dismissible grid-alert" role="alert">New product option added!</div>';

    } elseif (Registry::getStatus('addProdStatus') !== null && Registry::getStatus('addProdStatus') == 'fail') {
        echo '<div class="status-alert alert alert-danger alert-dismissible grid-alert" role="alert">Failed to add option type!</div>';
    }
    $products = $data['products'];
    $options = $data['optionType'];
    $productsList = new Form;
    $productIndex = ['pid', 'title'];
    $optionIndex = ['option_id', 'option_name'];
    $productsList->select("newProdOption[product_id]", 'All products', 'newOption', $products, $productIndex);
    $productsList->select("newProdOption[option_id]", 'All options', 'newOption', $options, $optionIndex);
    $productsList->hiddenInput('newProdOption[status]', 'sent');        
    $productsList->button('Add option');
    $action = URLrewrite::BaseAdminURL('productoptions/addProductOption');
    $productsList->render($action, 'Add option to product', 'g-form', 'newOption');

// <!-- Output <select> element with all products -->

    $products = $data['products'];
    $productsList = new Form;
    $valueIndex = ['pid', 'title'];
    $productsList->select('products', 'All products', 'prodInfo', $products, $valueIndex);
    $productsList->button('Show info');
    $action = URLrewrite::BaseAdminURL('productoptions');
    $productsList->render($action, 'Product Option Info', 'g-form', 'prodInfo');

    if (isset($_POST['products'])) {


// <!-- Output title and info for chosen product if the product have options -->


if(isset($data['options'][0]['title']))
{
    echo '<div class ="status-alert alert alert-success"><h1 class="prod-title">Available Options for: '.$data['options'][0]['title']."</h1>".
    '<h1 class=""><small> PID:'.$data['options'][0]['product_id']."</small></h1></div>";?>

<!-- Table with info for chosen product -->

    <table class="grid-table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Option Name</th>
                <th scope="col">Option ID</th>
            </tr>
        </thead>
        <tbody class="">
            <?php
                $optionInfo = "";
                foreach ($data['options'] as $key => $value) {
                    $optionInfo .= "<tr><td>".$value['option_name']."</td>"."<td>".$value['option_id']."</td>"
                    .'<td><a href="'
                    .URLrewrite::BaseAdminURL('productoptions/removeProductOption').'/'.$data['options'][0]['product_id'].'/'.$value['option_id']
                    .'"<span class="glyphicon glyphicon-remove"></span></a></td>'."</tr>";                                 
                }?>
                
                <?php echo $optionInfo ?>

        </tbody>
    </table>
    
    <!-- Error message if no options for chosen product  -->
    <?php } elseif (isset(($_POST['products']))) {
    echo '<div class="status-alert alert alert-warning"><h1 class="prod-title">No options in database for PID: '.$_POST['products'].'</h1></div>';
    }
}

$optionValForm = new Form();

$optionValForm->select('optionValues[option_id]','Select option', 'addOptionValue', $data['optionType'], ['option_id', 'option_name']);
$optionValForm->textInput('optionValues[value_name]', 'Type option value', 'Value Name');
$optionValForm->button('Save');
$action = URLrewrite::BaseAdminURL('ProductOptions/addOptionValue');
$optionValForm->render($action, 'Add option values', 'g-form', 'addOptionValue');
?>

