<?php 
	class Products_buyModelsAcreages extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'acreage';
			//$this -> arr_img_paths = array();
			$this -> table_name = 'fs_products_acreage';
			$this -> check_alias = 0;
			$this -> img_folder = 'images/products/acreage/';
			//$this -> arr_img_paths = array(array('resized',322,165,'resized_not_crop'));
			//$this -> field_img = 'image';
			parent::__construct();
		}
	}
?>