<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/productscat/models/productscat.php';
	class ProductscatBControllersProductscat
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$cat_id = $parameters->getParams('catid'); 
			$ordering = $parameters->getParams('ordering'); 
		    $type  = $parameters->getParams('type'); 
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:3; 
			// call models
			$model = new ProductscatBModelsProductscat();
			$list = $model -> get_list($cat_id,$ordering,$limit,$type);
			$style = $parameters->getParams('style');
			$style = $style?$style:'default';
			
			// call views
			include 'blocks/productscat/views/productscat/'.$style.'.php';
		}
	}
	
?>