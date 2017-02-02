<?php
/**
	* traits to clean value
	* 
	* simple test use
	* 
	*/
	
trait Clean_string {
  
  /*
	* function to clean value
	* 
	* here we simply use only triming.
	* 
	*/
	 
	public function clean_value($value)
	{
		return trim($value);
	}
	
	/*
	* function to remove blank space
	* 
	* 
	* 
	*/
	 
	public function string_space_remove($value)
	{
		return strtoupper(preg_replace('/[^a-z]/i', '', $value));
	}
	
	/*
	* function to formet price value
	* 
	* 
	* 
	*/
	 
	public function formet_price_value($value)
	{
		return '$'.number_format($value, 2, '.','');
	}
	
}
