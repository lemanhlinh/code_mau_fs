<?php 
	class SlideshowBModelsSlideshow
	{
		function __construct()
		{
		    $fstable = FSFactory::getClass('fstable');
            $this->table_name = $fstable->_('fs_slideshow');
            $this->table_categories = $fstable->_('fs_slideshow_categories');
		}
		
		function get_data($cat_id){
		    $where = '';
            //var_dump($cat_id);
            if($cat_id){
                $where .= ' AND category_id = '. $cat_id;
            }
			$query = '  SELECT id,name,image,url,summary,video,image_thumb
					FROM '. $this->table_name .'
					WHERE published = 1 '. $where .'
					ORDER BY ordering ';
                    
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
		function get_records($where = '',$table_name = '',$select = '*',$ordering = '', $limit = '',$field_key = ''){
			$sql_where = " ";
			if($where){
				$sql_where .= ' WHERE '.$where ;
			}
			if(!$table_name)
				$table_name = $this -> table_name;
			$query = " SELECT ".$select."
						  FROM ".$table_name.$sql_where;
			if($ordering)
				$query .= ' ORDER BY '.$ordering;
			if($limit)
				$query .= ' LIMIT '.$limit;
			global $db;

			if(!$field_key)
				$result = $db->getObjectList($query);
			else 
				$result = $db->getObjectListByKey($field_key,$query);
	    
			return $result;
		}
	}
	
?>