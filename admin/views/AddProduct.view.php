<div class="form-container">
<?php include ADMIN_VIEW.'adminPanelNav.view.php'; ?>

        <?php
        
        $ProdForm = new Form;
        $ProdForm->textInput('newProd[title]','Product Title','Product Title or Name');
        $ProdForm->textAreaInput('newProd[info]','Product Info','Product Information');
        $ProdForm->textInput('newProd[manufacturer]','Manufacturer','Product Manufacturer');
        $ProdForm->button('Save');
        $action = URLrewrite::adminURL('addproduct');
        $ProdForm->render($action,'Add Product Information', 'g-form');
        

        // $ProdForm->validate();
        // if (!$ProdForm)
        //     $ProdForm->render();
        // ?>

            <!-- Output the last auto incremented product id -->
    <h4 id="last-id"><?php if(isset($_POST['newProdId'])) {echo "The last inserted product id: " . $_POST['newProdId'];} ?></h4>
    
    <?php 
            //show add variant form after new product has been added
        //     if(isset($_POST['newProdId']))
        //     {
                $variantForm = new Form;
                $variantForm->textInput('addVariant[product_id]', 'Product Id', 'Product ID');
                $variantForm->textInput('addVariant[sku]', 'SKU', 'Stock Keeping Unit');
                $variantForm->numInput('addVariant[price]', 'Price', 'Product Price');
                $variantForm->textInput('addVariant[img_url]', 'Image Url', 'Url to product image');
                $variantForm->button('Save Variant');
                $action = URLrewrite::adminURL('addvariant');
                $variantForm->render($action,'Add Variant Information', 'g-form');

           // }
    ?>
    </div>