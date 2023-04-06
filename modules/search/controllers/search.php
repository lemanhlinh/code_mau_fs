<?php
/*
 * Huy write
 */
	// controller
	
	class SearchControllersSearch extends FSControllers
	{
		var $module;
		var $view;
		function __construct()
		{
			parent::__construct ();
		}
		function display()
		{
			// call models
			$keyword = FSInput::get('keyword');
			$model = $this->model;
			$query_body = $model -> set_query_body();
//			echo $query_body;
			$list = $model -> get_list($query_body);
//var_dump($list);
			$news_query_body = $model -> set_new_query_body();
			$news_list = $model -> get_list($news_query_body);

			$total = $model -> getTotal($query_body);
			//$load_more = $model->getLoadmore($total);
			$pagination = $model->getPagination($total);
			
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Tìm kiếm'), 1 => '');
			global $tmpl,$module_config;
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
		
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}
	
?>