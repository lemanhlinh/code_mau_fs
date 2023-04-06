<?php
/*
 * Huy write
 */
	// controller
	class ContentsControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
            $fstable = FSFactory::getClass('fstable');
			// call models
			$model = $this -> model;

			$list_ct =  $model->get_records('published = 1 and category_id = 1 AND id <> 1 ORDER BY ordering ASC',$fstable->_('fs_contents'));
//var_dump($news);
            $breadcrumbs = array();
            $breadcrumbs[] = array(0=> FSText::_('Về Plaschem'), 1 => '');
            global $tmpl;
            $tmpl -> assign('breadcrumbs', $breadcrumbs);
            $tmpl->set_seo_special();

            // call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}
?>

