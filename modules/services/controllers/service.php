<?php
/*
 * Huy write
 */
	// controller

	class ServicesControllersService extends FSControllers
	{
		var $module;
		var $view;

		function display()
		{
//			echo 1;
			// call models
			$model = $this->model;

			$data = $model->get_data();
//			var_dump($data);
//			if(!$data)
//                setRedirect(URL_ROOT,'Không tồn tại bài viết này','Error');

            //$address=$model->get_address_list();
            //$category_id = $data -> category_id;
            //$relate_news_list = $model->getRelateNewsList($category_id);

            // $cities
            //$cities = $model->get_records(' published = 1 AND is_chargeable = 1 ','fs_cities','id,name',' ordering ASC ');
            
            global $tmpl,$module_config;
			$tmpl -> set_data_seo($data);

			$breadcrumbs = array();
			//$breadcrumbs[] = array(0=>$data -> category_name, 1 => 'javascript: void(0)');
			$breadcrumbs[] = array(0=>$data->title, 1 => '');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);

			// seo
			$tmpl -> set_data_seo($data);
			$menusitem = $model->getmenusitem();
			$danhmuc = $model->getdanhmuc();
			$is_home = $model->getis_hot();
            $tmpl -> addTitle($data->title);
//			 var_dump($menusitem);
			// call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}

?>
