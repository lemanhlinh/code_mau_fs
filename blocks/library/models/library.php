<?php 
	class LibraryBModelsLibrary
	{
		function __construct()
		{
		  	$fstable = FSFactory::getClass('fstable');
            $this->table_name = $fstable->_('fs_libraries');
            $this->table_categories = $fstable->_('fs_libraries_categories');
		}
        
        function setQuery($str_cats,$ordering,$limit)
        {
			$where = '';			
			$order = '';
			if($str_cats)
				$where .= ' AND (category_id = '.$str_cats.' OR category_id_wrapper LIKE "%,'.$str_cats.',%" ) ';
				
			$order .= ' ordering ASC , created_time DESC';
			$query = ' SELECT id, name, alias, image, summary,video
						  FROM '. $this->table_name .'
						 WHERE  published = 1 '.$where.'
						  ORDER BY  '.$order.'
						 LIMIT '.$limit  
						 ;

			return $query;
		}

		function get_list($str_cats,$ordering,$limit){
			global $db;
			$query = $this->setQuery($str_cats,$ordering,$limit);
			if(!$query)
				return;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}

		function get_cats(){
			global $db;
			$query = ' SELECT id, name, alias, list_parents, image, level, parent_id, summary
					FROM '. $this->table_categories .' 
					WHERE published = 1 AND parent_id = 0
					ORDER BY ordering
							';
			$db->query($query);
			$result = $db->getObjectList();
			return $result;	
		}

	}
?>