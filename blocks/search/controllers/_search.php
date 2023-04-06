<?php

/*
 * Huy write
 */
	// models 
	
	
	class SearchBControllersSearch
	{
		function __construct()
		{
		}
		function display($parameters = array(),$title = '')
		{
			$style = $parameters->getParams('style');
			$style = $style ? $style : 'default';
            
			include 'blocks/search/models/search.php';
			$model = new SearchBModelsSearch();
			$field_work = $model->get_field_work();
			$cities = $model->get_cities();
<<<<<<< .mine
			$qualifications = $this->get_records('published = 1','fs_members_qualifications','id,name,alias',' ordering ASC ');
            $degree = $this->get_records('published = 1','fs_degree','id,name',' ordering ASC ');
            $times = $this->get_records('published = 1','fs_members_time','id,name',' ordering ASC ');
            $organize = $this->get_records('published = 1','fs_members_organize','id,name',' ordering ASC ');
||||||| .r24169
			
=======
			$list_degree = $model -> get_degree();
			$list_academic_status  = $model -> get_academic_status();
			
>>>>>>> .r24197
			// call views
			include 'blocks/search/views/search/'.$style.'.php';
		}
        
		// function get_ajax_search(){
//	        $result =  array();
//	        $list = $this->model->get_ajax_search();
//	        if($list){
//	            foreach($list as $item){
//	                $result[] = array(
//	                    'id' => $item->id,
//	                    'label' => $item->name,
//	                    'value' => $item->name
//	                );
//	            }
//	        }
//	        echo json_encode($result); exit();
//    	}

        function get_count($where = '', $table_name = '', $select = '*') {
    		if (! $where)
    			return;
    		if (! $table_name)
    			$table_name = $this->table_name;
    		$query = ' SELECT count(' . $select . ')
    					  FROM ' . $table_name . '
    					  WHERE ' . $where;
    
            //print_r($query);
    		global $db;
    		$sql = $db->query ( $query );
    		$result = $db->getResult ();
    		return $result;
    	}

		function get_records($where = '', $table_name = '', $select = '*', $ordering = '', $limit = '', $field_key = '') {
			$sql_where = " ";
			if ($where) {
				$sql_where .= ' WHERE ' . $where;
			}
			if (! $table_name)
				$table_name = $this->table_name;
			$query = " SELECT " . $select . "
						  FROM " . $table_name . $sql_where;

			if ($ordering)
				$query .= ' ORDER BY ' . $ordering;
			if ($limit)
				$query .= ' LIMIT ' . $limit;

	//		echo $query;
			global $db;
			$sql = $db->query ( $query );
			if (! $field_key)
				$result = $db->getObjectList ();
			else
				$result = $db->getObjectListByKey ( $field_key );
			return $result;
		}
	}
	
?>