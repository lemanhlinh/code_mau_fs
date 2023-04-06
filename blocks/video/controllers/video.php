<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/video/models/video.php';
	class VideoBControllersVideo
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$limit = $parameters->getParams('limit');
            $type  = $parameters->getParams('type'); 
			$style = $parameters->getParams('style');
            $ordering = $parameters->getParams('ordering');
			$limit = $limit? $limit : '4';
			$style = $style ? $style : 'default';
			// call models
			
			$model = new VideoBModelsVideo();
			$list = $model -> get_list($ordering,$limit,$type);
//                        var_dump($data);die;
			if(!count($list))
				return;
			include 'blocks/video/views/video/'.$style.'.php';
		}
	}
	
?>