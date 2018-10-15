<?php

/**
* 
*/
class Cart_model extends Base_model
{
	
	public function showCart()
	{	
		$prodList = $_SESSION['cart']->getProdList();
		$count = count($prodList);
        $i = 0;
        $this->sql = 
        "SELECT variant_values.product_id, variant_values.variant_id, product.title, product.info, product.manufacturer,
       product_variants.price, group_concat(DISTINCT value_name order by option_values.option_id separator '/') AS properties, product_variants.sku, product_variants.img_url
       FROM projekt_klon.option_values
       INNER JOIN variant_values ON variant_values.value_id = option_values.value_id
       INNER JOIN product ON product.pid = variant_values.product_id
       INNER JOIN product_variants ON product_variants.product_id = variant_values.product_id
       WHERE product_variants.variant_id = variant_values.variant_id
       AND product_variants.sku IN (";
        
        //loop trough the submitted values to create an sql-query string
        foreach ($prodList as $sku => $amount) {
            
            $this->sql .= "'".$sku."'";

            //skip the , after the last element in the $data['variant] array
            if (++$i === $count) {
                $this->sql .= " ";
            } else {
                $this->sql .= ", ";
                
            }

        }
        $this->sql .= ") GROUP BY product_variants.sku";
		$paramBinds = [':sku' => $sku];
        
        $this->prepQuery($this->sql, $paramBinds);
		
		$this->getAll();

		foreach (self::$data as $key => $value) {
			if (array_key_exists($value['sku'], $prodList)) {
				self::$data[$key]['amounts'] = $prodList[$value['sku']];
			}
		}
		return self::$data;
	}

	public function add($amount = 1) {
		$sku = $_POST['sku'];
		$this->sql = "SELECT count(*) FROM projekt_klon.product_variants WHERE product_variants.sku = :sku";
		$paramBinds = [':sku' => $sku];
        $this->prepQuery($this->sql, $paramBinds);
        $data = $this->getAll();

		if ($data > 0) {
			$_SESSION['cart']->addProduct($sku, $amount);
		}
	}

	public function update()
	{
		$sku = $_POST['sku'];
		$amount = $_POST['amount'];
		$_SESSION['cart']->update($sku, $amount);
	}

	public function deleteItem()
	{
		$sku = $_POST['sku'];
		$amount = $_POST['amount'];
		$_SESSION['cart']->deleteItem($sku, $amount);
	}
}