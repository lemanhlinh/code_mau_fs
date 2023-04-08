<?php
	class LocationModelsWards extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 1000;
			$this -> view = 'wards';
			$this -> table_name = 'fs_wards';
			$this -> table_districts = 'fs_districts';
            $this -> table_city = 'fs_cities';
            $this -> check_alias = 0;
			parent::__construct();
		}

		function setQuery(){

			// ordering
			$ordering = "";
			$where = "  ";
			if(isset($_SESSION[$this -> prefix.'sort_field']))
			{
				$sort_field = $_SESSION[$this -> prefix.'sort_field'];
				$sort_direct = $_SESSION[$this -> prefix.'sort_direct'];
				$sort_direct = $sort_direct?$sort_direct:'asc';
				$ordering = '';
				if($sort_field)
					$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
			}
			if(isset($_SESSION[$this -> prefix.'filter'])){
				$filter = $_SESSION[$this -> prefix.'filter'];
				if($filter){
					$where .= ' AND b.id =  "'.$filter.'" ';
				}
			}

            if(isset($_SESSION[$this -> prefix.'filter0'])){
				$filter = $_SESSION[$this -> prefix.'filter0'];
				if($filter){
					$where .= ' AND a.city_id = '.$filter ;
				}
			}

			if(!$ordering)
				$ordering .= " ORDER BY  id DESC ";


			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND a.name LIKE '%".$keysearch."%' ";
				}
			}

			$query = ' SELECT a.*, b.name as districts_name
						  FROM
						  	'.$this -> table_name.' AS a
						  	LEFT JOIN '.$this -> table_districts.' AS b ON a.districts_id = b.id
						  	WHERE 1=1 '.
						 $where.
						 $ordering. " ";

			return $query;
		}
        
        function save($row = array(),$use_mysql_real_escape_string = 0)
        {
            $name  = FSInput::get ( 'name' );
    		if (! $name) {
    			Errors::_ ( 'You must entere name' );
    			return false;
    		}
    		
    		$id = FSInput::get ( 'id', 0, 'int' );
            // Huyện / thị xã.
            $city_id = FSInput::get ( 'city_id',0,'int' );
            if($city_id){
                $cities = $this-> get_record_by_id ( $city_id, 'fs_cities' );
    			$row ['city_id'] = $city_id;
    			$row ['city_name'] = $cities-> name;
    			$row ['city_alias'] = $cities-> alias;
                
        		$districts_id = FSInput::get ( 'districts_id',0,'int' );
        		if ($districts_id) {
        			$district = $this->get_record_by_id ( $districts_id, 'fs_districts' );
        			$row ['districts_id'] = $districts_id;
        			$row ['districts_name'] = $district-> name;
        			$row ['districts_alias'] = $district-> alias;
        		}
            }
            
            
            $id = parent::save ( $row ,1);
    		if (!$id) {
    			Errors::setError ( 'Not save' );
    			return false;
    		}
    
    		return $id;
        }
        
        // ajax load quận/huyện (theo tỉnh thành))
        function ajax_get_product_district($city_id) {
    		if (! $city_id)
    			return;
    		global $db;
    		$query = ' SELECT id,name
    						FROM fs_districts 
    						WHERE city_id  = '.$city_id
    	             ;
    		$sql = $db->query ( $query );
    		$rs = $db->getObjectList ();
    		return $rs;
    	}

	}

?>
