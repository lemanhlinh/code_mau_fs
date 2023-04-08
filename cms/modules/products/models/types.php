<?php 
	class ProductsModelsTypes extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$limit = 100;
			$page = FSInput::get('page');
			$this->limit = $limit;
			$this -> arr_img_paths = array(array('resized',0,32,'resized_not_crop'));
			$this -> table_name = 'fs_products_types';
			$this -> img_folder = 'images/products/types/';			
			$this -> check_alias = 0;
			$this -> field_img = 'image';
			parent::__construct();
		}
	}
	
?>