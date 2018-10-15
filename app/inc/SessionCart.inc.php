<?php
/**
* Class that manges list of SKUs in Session
*/
class SessionCart {
	private $products = [];
	private $totalPrice;

	public function addProduct($sku, $amount = 1) 
	{
	
		if (array_key_exists($sku, $this->products)) {
			$this->products[$sku] += $amount;
		} else {
			$this->products[$sku] = $amount;
		}
	}	

	public function setTotalPrice($totalPrice)
	{
		$this->totalPrice = $totalPrice;
	}

	public function getTotalPrice()
	{
		return $this->totalPrice;
	}

	public function getProdList()
	{
		return $this->products;
	}

	public function deleteItem($sku, $amount) 
	{
		unset($this->products[$sku]);
	}

	public function update($sku, $amount) 
	{
		if (array_key_exists($sku, $this->products)) {
			$this->products[$sku] = $amount;
		}
	}
}
