<?php
/*
 * Huy write
 */
	// controller

	class NewsControllersNews extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			$model = $this -> model;

			$data = $model->getNews();
			if(!$data)
				setRedirect(URL_ROOT,'Không tồn tại bài viết này','Error');
			$ccode = FSInput::get('ccode');

			$category_id = $data -> category_id;

			$category = $model -> get_category_by_id($category_id);
			if(!$category)
				setRedirect(URL_ROOT,'Không tồn tại danh mục này','Error');
            $list_new_desc = $model->get_new_();

            $is_home = $model->getis_hot();
			$danhmuc = $model->getdanhmuc();
			$tinchitiet = $model->gettinchitiet();
//			 var_dump($tinchitiet);
			$tinlienquan = $model->gettinlienquan($data->category_id);
			// var_dump($tinlienquan);
			$Itemid = 7;
			// relate
			$relate_news_list = $model->getRelateNewsList($category_id);
            // relate
			//$relate_aq_list = $model->get_records(' published = 1 AND category_id_wrapper LIKE "%,'.$category_id.',%" ','fs_aq','title,content');
            // new relate
            //$news_related = $model->get_news_related($data->news_related,$data->id);
            // products relate
            //$products_related = $model->get_products_related($category->products_related);
			// tin liên quan theo tags
			//$relate_news_list_by_tags = $model->get_relate_by_tags($data -> tags,$data -> id,$category_id);

			//$total_content_relate  = count($relate_news_list);
//			$str_ids = '';
//			for($i = 0; $i < $total_content_relate; $i ++){
//				$item = $relate_news_list[$i];
//				if($i > 0) $str_ids .= ',';
//				$str_ids .= $item -> category_id;
//			}
            $link = FSRoute::_('index.php?module=news&view=news&code=' . $data->alias . '&id=' . $data->id);
//			$content_category_alias = $model->get_content_category_ids($str_ids);
			$str = $data->tags;
			$tag1 = explode(',', $str);
//			var_dump($tag1);die;
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>FSText::_('Tin tức'), 1 => FSRoute::_('index.php?module=news&view=home') );
			$breadcrumbs[] = array(0=>$category -> name, 1 => FSRoute::_('index.php?module=news&view=cat&id='.$data -> category_id.'&ccode='.$data -> category_alias));
            //$breadcrumbs[] = array(0=>$category -> name, 1 => '');
			$breadcrumbs[] = array(0=>$data->title, 1 => '');
			global $tmpl,$module_config;
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			$tmpl -> assign('title', $data->title);
			$tmpl -> assign('tags', $data->tags);
			$tmpl -> assign('og_image', URL_ROOT.str_replace('/original/', '/large/', $data -> image));
			$tmpl -> assign('og_url', $link);

			// seo
			$tmpl -> set_data_seo($data);

			// call views
		include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

		// check captcha
		function check_captcha(){
			$captcha = FSInput::get('txtCaptcha');

			if ( $captcha == $_SESSION["security_code"]){
				return true;
			} else {
			}
			return false;
		}

		function rating(){
			$model = $this -> model;
			if(!$model -> save_rating()){
				echo '0';
				return;
			} else {
				echo '1';
				return;
			}
		}
		function count_views(){
			$model = $this -> model;
			if(!$model -> count_views()){
				echo 'hello';
				return;
			} else {
				echo '1';
				return;
			}
		}
		// update hits
		function update_hits(){
			$model = $this -> model;
			$news_id = FSInput::get('id');
			$model -> update_hits($news_id);
		}

	}

?>
