<?php
class SearchProducts extends Base_controller
{
    public function index()
    {
    if(!isset($_POST['search-database'])) {
        $this->reqView('Products');
    }else
        {
        $this->initModel('SearchProducts_model');
        $data['searchResult'] = $this->modelObj->searchAllProducts();
        $this->reqView('SearchProducts', $data['searchResult']);
        }
    }
}