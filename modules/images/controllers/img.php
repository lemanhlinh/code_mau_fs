<?php
/*
 * Huy write
 */
	// controller

	class ImagesControllersImg extends FSControllers
	{
		var $module;
		var $view;
//		$this->view = img;
//		$this->module = images;

		function display()
		{
			// call models
			$model = $this->model;
//			echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
//			$data = $model->get_data();
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
			$image = $model->getimages();
//			var_dump($image);
			$all_list = $model->getall_list();

			// call views
//			echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';

		}
	function loadmore()
	{
		// call models
		$model = $this->model;

		$pagecurrent = FSInput::get('pagecurrent');
		$limit = FSInput::get('limit');
		$type_id = FSInput::get('type_id');
		$type_alias = FSInput::get('type_alias');

		$total_old = $pagecurrent * $limit;
		$gt = $total_old . ',' . $limit;

		$fs_table = FSFactory::getClass('fstable');
		$table_name = $fs_table->getTable('fs_image');

		$list = $model->get_ajax_loadmore();
//        if (count($list) < $limit)
//            echo '<script>$(".c-view-more .load_more").hide();</script>';
//var_dump($list);
		if (!$list)
			return;


		include 'modules/images/views/img/loadmore.php';
	}


}

?>
