<?php
/*
 * Huy write
 */
	// controller
	
	class NewsControllersCat extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
			// call models
			$model = $this -> model;
			$cat  = $model->getCategory();
            $fs_table = FSFactory::getClass('fstable');
			if(!$cat)
			{
				setRedirect(URL_ROOT,'Không tồn tại danh mục này','error');
			}
			global $tags_group;
//            $tags_group = $cat -> tags_group;
            $list_new_desc = $model->get_new_($cat->id);
			$query_body = $model->set_query_body($cat->id);
			$list = $model->getNewsList($query_body);
			$total = $model->getTotal($query_body);
			$pagination = $model->getPagination($total);
			
			$breadcrumbs = array();
            if($cat->parent_id){
                
                $list_cat_parent = $model->get_record_by_id($cat->parent_id,$fs_table->_('fs_news_categories'),'id,alias,name');
                $breadcrumbs[] = array(0=>$list_cat_parent->name, 1 => FSRoute::_('index.php?module=news&view=cat&ccode='.$list_cat_parent->alias.'&id='.$list_cat_parent->id.'&Itemid=3'));
            }
			$breadcrumbs[] = array(0=>FSText::_('Tin tức'), 1 => FSRoute::_('index.php?module=news&view=home'));
			$breadcrumbs[] = array(0=>$cat->name, 1 => '');
			global $tmpl,$config;
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
            $tmpl -> assign('og_image', URL_ROOT.$config['banner_new']);

            // seo
			$tmpl -> set_data_seo($cat);
			// echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
//			var_dump($danhmuc->name);die;
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
        
        function ajax_session(){
            $type = FSInput::get('type');
            if($type){
                $_SESSION['type'] = $type;
                echo 1;
            }else{
                echo 0;
            }
        }
        function download()
        {

//        $id = FSInput::get('id');
//        if (!$id)
//            return;
//        $model = $this->model;
//        //print_r($id);
//        $record = $model->get_download($id);
            $record = $_GET['file_download'];
            $name = ltrim($record, 'images/upload_file/2019/');
//                var_dump($name);die;

            $record_name = $_GET['name_download'];

//        var_dump($record_name);die;
            $link = FSRoute::_('');
            if (!$record) {
                setRedirect($link, 'Không có file upload');
                return;
            }

            $path_file = URL_ROOT . $record;

//        var_dump($path_file);die;
            $fsstring = FSFactory::getClass('FSString');

            $name_file = strtolower(substr($record, (strripos($record, '/') + 1), strlen($record)));

//        $file_export_name = @$name_file ? $fsstring->stringStandart(@$name_file) : 'Catalog' . $record->id;

//        lay duoi file
//        $file_ext = $this->getExt(($record->upload));
            //print_r($file_ext);die;
//        $file_export_name = $file_export_name . '.' . $file_ext;
            $file_export_name = strtolower($record_name);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-type: application/force-download");
            header("Content-Disposition: attachment; filename=" . $name);
            header("Content-Transfer-Encoding: binary");
//			header("Content-Length: ".filesize($path_file));
            ob_clean();
            flush();
            readfile($path_file);

//        $up = $model->addDown($id);
            exit();
        }
	}
	
?>