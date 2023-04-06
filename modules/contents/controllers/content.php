<?php
/*
 * Huy write
 */
	// controller

	class ContentsControllersContent extends FSControllers
	{
		var $module;
		var $view;

		function display()
		{
			// call models
			$model = $this->model;

			$data = $model->get_data();
			if(!$data)
                setRedirect(URL_ROOT,'Không tồn tại bài viết này','Error');

            //$address=$model->get_address_list();
            //$category_id = $data -> category_id;
            //$relate_news_list = $model->getRelateNewsList($category_id);

            // $cities
            //$cities = $model->get_records(' published = 1 AND is_chargeable = 1 ','fs_cities','id,name',' ordering ASC ');
            
            global $tmpl,$module_config;
			$tmpl -> set_data_seo($data);

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Về Plaschem'), 1 => FSRoute::_('index.php?module=contents&view=home'));
			$breadcrumbs[] = array(0=>$data->title, 1 => '');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);

			// seo
			$tmpl -> set_data_seo($data);
			$menusitem = $model->getmenusitem();
//			 var_dump($menusitem);
			// call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}

?>
