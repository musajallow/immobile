<?php

    // Print response on product option insert
    if(Registry::getStatus('addVariantValues') !== null && Registry::getStatus('addVariantValues') == 'success')
    {
        echo '<div class="alert alert-success alert-dismissible grid-alert" role="alert">New option values added!</div>';

    } elseif (Registry::getStatus('addVariantValues') !== null && Registry::getStatus('addVariantValues') == 'fail') {
        echo '<div class="alert alert-danger alert-dismissible grid-alert" role="alert">Failed to add option values!</div>';
    }

// new form
$form = new Form(); ?>
<div class="form-container">

<?php
$productIndex = ['pid', 'title'];
$optionIndex = ['option_id', 'option_name'];
$optionValuesIndex = ['value_id', 'value_name'];
$variantIndex = ['variant_id', 'sku'];
// select product
$form->select("newProdOption[product_id]", 'All products', 'newOption', $data['products'], $productIndex);

//select variant
$form->select("newProdOption[variant_id]", 'Variants', 'newOption', $data['variants'], $variantIndex);
// select option
$form->select("newProdOption[option_id]", 'All options', 'newOption', $data['options'], $optionIndex);

// select option value
$form->select("newProdOption[value_id]", 'Option Values', 'newOption', $data['optionValues'], $optionValuesIndex);

$form->button('Add option');
$action = URLrewrite::BaseAdminURL('variantvalues/addvariantoption'); 
$form->render($action, 'Add variant option values', 'g-form', 'newOption'); ?>
</div>





