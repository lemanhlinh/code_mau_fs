<?php
/*
 * Huy write
 */
	// controller

	class FieldControllersField extends FSControllers
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
//			$tmpl -> set_data_seo($data);

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Lĩnh vực hoạt động'), 1 => FSRoute::_('index.php?module=field&view=home'));
			$breadcrumbs[] = array(0=>$data->name, 1 => '');
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
            $tmpl -> addTitle($data->name);
//            $tmpl -> assign('og_image', URL_ROOT.str_replace('/original/', '/large/', $data -> image));
//            $tmpl -> assign('og_url', FSRoute::_('index.php?module=field&view=field&code='.$data->alias.'&id='.$data->id));
			// seo
//            $tmpl -> set_data_seo($data);
//			 var_dump($menusitem);
			// call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}

?>
