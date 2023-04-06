<?php
/*
 * Huy write
 */
	// models 
	include 'blocks/newslist/models/newslist.php';
	class NewslistBControllersNewslist
	{
		function __construct()
		{
		}
		function display($parameters,$title)
		{
			$cat_id = $parameters->getParams('category_id'); 
			$ordering = $parameters->getParams('ordering'); 
		    $type  = $parameters->getParams('type'); 
			$limit = $parameters->getParams('limit');
			$limit = $limit ? $limit:6; 
            $style = $parameters->getParams('style');
			// call models
			$model = new NewslistBModelsNewslist();

            $list = $model -> get_list($cat_id,$ordering,$limit,$type);
            
			$style = $style?$style:'default';
			// call views
			include 'blocks/newslist/views/newslist/'.$style.'.php';
		}
        
        /*
    	 * get record by rid
    	 */
    	function get_record_by_id($id, $table_name = '', $select = '*') {
    		if (! $id)
    			return;
    		if (! $table_name)
    			$table_name = $this->table_name;
                
            $fstable = FSFactory::getClass('fstable');
            $this->table_name = $fstable->_($table_name);    
    		$query = " SELECT " . $select . "
    					  FROM " . $this->table_name . "
    					  WHERE id = $id ";
    		
    		global $db;
    		$sql = $db->query ( $query );
    		$result = $db->getObject ();
    		return $result;
    	}
	}
	
?>