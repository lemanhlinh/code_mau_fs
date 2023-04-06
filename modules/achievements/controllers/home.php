<?php
/*
 * Huy write
 */
	// controller
	class AchievementsControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
            $fstable = FSFactory::getClass('fstable');
			// call models
			$model = $this -> model;
			$thanhtich = $model->get_record('published = 1 and id=10',$fstable->_('fs_contents'));
			$list_ct =  $model->get_records('published = 1  ORDER BY ordering ASC, created_time DESC',$fstable->_('fs_achievements'));
            $breadcrumbs = array();
            $breadcrumbs[] = array(0=> FSText::_('Về Plaschem'), 1 => FSRoute::_('index.php?module=contents&view=home'));
            $breadcrumbs[] = array(0=>FSText::_('Thành tích'), 1 => '');
            global $tmpl;
            $tmpl -> assign('breadcrumbs', $breadcrumbs);
            $tmpl->set_seo_special();

            // call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}

	}
?>

