<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/productslist/models/productslist.php';
	class ProductslistBControllersProductslist
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$cat_id = $parameters->getParams('category_id'); 
			$ordering = $parameters->getParams('ordering'); 
		    $type  = $parameters->getParams('type'); 
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:3; 
			// call models
			$model = new ProductslistBModelsProductslist();
			
			$style = $parameters->getParams('style');
			if($style == 'default_tab'){
				$list_new = $model->get_list('','',4,'is_new');
                $list_sell = $model->get_list('','',4,'is_sell');
			}else{
			    $list = $model -> get_list($cat_id,$ordering,$limit,$type); 
			}
			$style = $style?$style:'default';
			
			// call views
			include 'blocks/productslist/views/productslist/'.$style.'.php';
		}
	}
	
?>