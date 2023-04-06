<?php
/*
 * Huy write
 */
// models 
include 'blocks/library/models/library.php';

class LibraryBControllersLibrary {
	function __construct() {
	}
	function display($parameters, $title) {
		$style = $parameters->getParams ( 'style' );
		$ordering = $parameters->getParams('ordering'); 
		$limit = $parameters->getParams('limit');
        $limit = $limit ? $limit:3; 
		$style = $style ? $style : 'default';
		
		// call models
		$model = new LibraryBModelsLibrary ();

        $list_cats = $model -> get_cats();
        if(!$list_cats)
            return;

        $total_cat = count($list_cats);
        $array_cats = array();
        $array_by_cat = array();
        $children_cat_array = array();
        $i = 0;
        foreach (@$list_cats as $item)
        {
            $pro_in_cat = $model -> get_list($item->id,$ordering,$limit);
            if(count($pro_in_cat)){
            	$array_cats[] = $item;
            	$array_by_cat[$item->id] = $pro_in_cat;
            	$i ++;
            }
        }


		include 'blocks/library/views/library/'.$style.'.php';
	}

}

?>