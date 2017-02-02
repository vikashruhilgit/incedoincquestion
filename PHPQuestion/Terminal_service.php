<?php
/**
 * Main parent class at top point.
 * 
 * 
 * 
 */ 

class Terminal_service {
	
	use Clean_string;
	/**
	 * Contain all product
	 * 
	 * eg. A,B,C,D
	 */
	 
	private $products = array();
	
	/**
	 * Contain all product details
	 * 
	 * eg. A,B,C,D
	 */
	 
	private $product_details;
	
	/**
	 * var for scan code price
	 * 
	 * access via get_scan_price.
	 */
	 
	private $final_price;
	
	//final price getter
	public function get_scan_price()
	{
		return $this->formet_price_value($this->final_price);
	}
		
	//product getter
	public function get_products()
	{
		return $this->products;
	}
	
	//product details getter
	public function get_product_detailss()
	{
		return $this->product_details;
	}
	
	//product seter
	public function set_products($product = NULL)
	{	
		$pro = explode(',', $product);
		foreach($pro as $single){
			if(!in_array($single, $this->products)){
				$this->products[] = $this->clean_value($single);
			}
		}
	}
	
	/**
	 * set product and it's price
	 * 
	 * eg. (A ,2)
	 * where A is product
	 * and '2' is its price.
	 */
	
	public function set_product_price($product, $price)
	{
		$this->set_products($product);
		$this->product_details[array_search($product, $this->products)]['price'] = $price;
	}
	
	/**
	 * set product, pack and it's price
	 * 
	 * eg. (A, 4, 7)
	 * where A is product
	 * and '4' is pack value.
	 * and '7' is price.
	 */
	
	public function set_product_pack_price($product, $pack, $price)
	{	
		if(in_array($product, $this->products))
		{
			$this->product_details[array_search($product, $this->products)]['packsize'] = $pack;
			$this->product_details[array_search($product, $this->products)]['packprice'] = $price;
		}else{
			//error handling and exception handling.
			die('product does\'t exist');
		}
	}	
	/*
	 * final price process
	 * scan code process
	 * 
	 * only accept alphabet else will be removed.
	 */
	public function scan_code($scan_list)
	{
		$scan_bar = $this->string_space_remove($scan_list);
		$scan_bar_pro = str_split($scan_bar);
		$scan_pro_count = array_count_values($scan_bar_pro);
		foreach($scan_pro_count as $pro=>$count)
		{
			if(in_array($pro, $this->products))
			{	
				$pro_key = array_search($pro, $this->products);
				$product_price = $this->product_details[$pro_key]['price'];
				$product_pack_price = $this->product_details[$pro_key]['packprice'];
				if($count>1)
				{	
					$product_package_count = $this->product_details[$pro_key]['packsize'];
					if($product_package_count<=$count && $product_package_count!=NULL)
					{	
						$remainder = $count % $product_package_count;
						$package_count = floor($count / $product_package_count);
						$this->final_price += ($package_count * $product_pack_price)+($product_price * $remainder);
					}else
					{
						$this->final_price += ($product_price)*$count;
					}
				}else
				{	
					$this->final_price += $product_price;
				}
			}
		}
	}

}
