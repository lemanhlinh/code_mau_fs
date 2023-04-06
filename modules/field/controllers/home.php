<?php
/*
 * Huy write
 */
	// controller
	class FieldControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
            $fstable = FSFactory::getClass('fstable');
			// call models
			$model = $this -> model;
			$list_ct =  $model->get_records('published = 1  ORDER BY ordering ASC, created_time DESC',$fstable->_('fs_field'));
            $breadcrumbs = array();
            $breadcrumbs[] = array(0=> FSText::_('Lĩnh vực hoạt động'), 1 => '');
            global $tmpl;
            $tmpl -> assign('breadcrumbs', $breadcrumbs);
            $tmpl->set_seo_special();

            // call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}
?>

