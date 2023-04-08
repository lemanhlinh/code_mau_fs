<?php 
	class ProductsModelsPrices extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'prices';
			//$this -> arr_img_paths = array();
			$this -> table_name = 'fs_products_prices';
            $this->table_category = 'fs_products_categories';
			$this -> check_alias = 1;
			//$this -> img_folder = 'images/products/prices/';
			//$this -> arr_img_paths = array(array('resized',322,165,'resized_not_crop'));
			//$this -> field_img = 'image';
			parent::__construct();
			// đồng bộ dữ liệu ngoài bảng extend. Viết dang  array(tablename => array(field1_curent => field1_remote, field2_curent =>field2_remote,...)): 
			//trường 1 dùng để so sánh với id của dữ liêu
			$this -> array_synchronize = array('fs_products'=>array('id'=>'price_id','alias'=>'price_alias','name'=>'price_name')); 
		}
        
        function setQuery()
		{
			// ordering
			$ordering = '';
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
            
            //if (isset ( $_SESSION [$this->prefix . 'filter0'] )) {
//    			$filter = $_SESSION [$this->prefix . 'filter0'];
//    			if ($filter) {
//    				$where .= ' AND category_id = ' . $filter ;
//    			}
//    		}
			
			if(!$ordering)
				$ordering .= " ORDER BY created_time DESC , id DESC ";
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND name LIKE '%".$keysearch."%' ";
				}
			}
			$query = " 	   SELECT * 
						
						  FROM ".$this -> table_name." 
						  	WHERE 1=1 ".
						 $where.
						 $ordering. " ";
			return $query;
		}
        
        function get_categories_tree() {
    		global $db;
    		$sql = " SELECT id, name, parent_id AS parent_id 
    				FROM " . $this->table_category;
    		$db->query ( $sql );
    		$categories = $db->getObjectList ();
    		
    		$tree = FSFactory::getClass ( 'tree', 'tree/' );
    		$rs = $tree->indentRows ( $categories, 1 );
    		return $rs;
    	}
        
        //function save(){
//            
//            $category_id = FSInput::get ( 'category_id',0, 'int' );
//            if($category_id){
//                $cat = $this -> get_record_by_id($category_id ,'fs_products_categories');
//                $row ['category_id'] = $category_id;
//    			$row ['category_name'] = $cat->name;
//    		    $row ['category_alias'] = $cat->alias;
//                $row ['category_id_wrapper'] = $cat->list_parents;
//        		$row ['category_root_alias'] = $cat->root_alias;
//        		$row ['category_alias_wrapper'] = $cat->alias_wrapper;
//            }
//            
//			$rid = parent::save($row);
//			return $rid;
//		}
	}
?>