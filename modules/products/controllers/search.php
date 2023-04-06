<?php
/*
 * Huy write
 */
	// controller
	
	class ProductsControllersSearch extends FSControllers
	{
		var $module;
		var $view;
        
		function display()
		{
			// call models
			$model = $this -> model;
			$query_body = $model -> set_query_body();
			$list = $model -> get_list($query_body);
			
			$total = $model -> getTotal($query_body);
			$total_list = count($list);
			$pagination = $model->getPagination($total);
			
			$breadcrumbs = array();
            $breadcrumbs[] = array(0=>'Sản phẩm', 1 => FSRoute::_('index.php?module=products&view=home'));
			$breadcrumbs[] = array(0=>FSText::_('Tìm kiếm'), 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> set_seo_special();
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
	}
	
?>