<?php
/*
 * Huy write
 */
	// controller
	class SubsidiariesControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
            $fstable = FSFactory::getClass('fstable');
			// call models
			$model = $this -> model;
            $bout =  $model->get_record('published = 1 and id = 4',$fstable->_('fs_contents'));

            $list_field =  $model->get_records('published = 1  ORDER BY ordering ASC, created_time DESC',$fstable->_('fs_field'));
			foreach ($list_field as $item){
				$list_sub[$item->id] =   $model->get_records('published = 1 AND field_id = '.$item->id.'  ORDER BY ordering ASC, created_time DESC',$fstable->_('fs_subsidiaries'));
			}
            $breadcrumbs = array();
            $breadcrumbs[] = array(0=> FSText::_('Về Plaschem'), 1 => FSRoute::_('index.php?module=contents&view=home'));
            $breadcrumbs[] = array(0=> FSText::_('Công ty thành viên'), 1 => '');
            global $tmpl;
            $tmpl -> assign('breadcrumbs', $breadcrumbs);
            $tmpl->set_seo_special();

            // call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}
?>

