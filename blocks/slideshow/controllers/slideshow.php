<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/slideshow/models/slideshow.php';
	class SlideshowBControllersSlideshow
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
            $fstable = FSFactory::getClass('fstable');

            $category_id = $parameters->getParams('category_id');
			$limit = $parameters->getParams('limit');
			$style = $parameters->getParams('style');
			$timeout = $parameters->getParams('timeout');
			$limit = $limit? $limit : '4';
			$style = $style ? $style : 'default';
			$timeout = $timeout ? $timeout : '3';
			// call models
			$model = new SlideshowBModelsSlideshow();
			$slideshow =  $model->get_records('published = 1 and category_id = 1 ORDER BY ordering ASC',$fstable->_('fs_slideshow'));
//			var_dump($slideshow);die;
			include 'blocks/slideshow/views/slideshow/'.$style.'.php';
		}
	}
	
?>