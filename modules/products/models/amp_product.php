
<?php
	class ProductsModelsAmp_product extends FSModels
	{
		function __construct()
		{
			$limit = 10;
			$page = FSInput::get('page');
			$this->limit = $limit;
			$this->page = $page;
			$fstable = FSFactory::getClass('fstable');
			$this->table_name  = $fstable->_('fs_products');
			$this->table_category  = $fstable->_('fs_products_categories');
            $this -> table_comment = $fstable->_('fs_products_comments');
		}
//		function setQuery()
//		{
//			$query = " SELECT id,name,summary,image, categoryid, tag
//						  FROM fs_contents
//						  WHERE categoryid = $cid
//						  	AND published = 1
//						ORDER BY  id DESC, ordering DESC
//						 ";
//			return $query;
//		}
		/*
		 * get Category current
		 */
		function get_category_by_id($category_id)
		{
			if(!$category_id)
				return "";
			$query = " SELECT id,name, alias,updated_time
						FROM ".$this->table_category ."
						WHERE id = $category_id ";
			global $db;
			$sql = $db->query($query);
			$result = $db->getObject();
			return $result;
		}

		/*
		 * get Article
		 */
		function getproducts()
		{
			$id = FSInput::get('id',0,'int');
			if($id){
				$where = " AND id = '$id' ";
			} else {
				$code = FSInput::get('code');
				if(!$code)
					die('Not exist this url');
				$where = " AND alias = '$code' ";
			}
			$fs_table = FSFactory::getClass('fstable');
			$query = " SELECT id,name,alias,category_id,products_related,tags,category_alias,price_old,discount,price,
                              summary,description,drawing,video,image,created_time,edited_time   
						FROM ".$fs_table -> getTable('fs_products')."
						WHERE published = 1
						".$where." ";
            //print_r($query) ;
			global $db;
			$sql = $db->query($query);
			$result = $db->getObject();
			return $result;
		}


        function getImages($product_id) {
    		if (! $product_id)
    			return;
    		//$limit = 10;
    		//LIMIT $limit
    		$fs_table = FSFactory::getClass ( 'fstable' );
    		$query = " SELECT id,image, record_id
    						  FROM " . $fs_table->getTable ( 'fs_products_images' ) . "
    						  WHERE record_id =  $product_id

    						 ";
    		global $db;
    		$sql = $db->query ( $query );
    		$result = $db->getObjectList ();
    		return $result;
    	}


		function update_hits($products_id){
			if(USE_MEMCACHE){
				$fsmemcache = FSFactory::getClass('fsmemcache');
				$mem_key = 'array_hits';

				$data_in_memcache = $fsmemcache -> get($mem_key);
				if(!isset($data_in_memcache))
					$data_in_memcache = array();
				if(isset($data_in_memcache[$products_id])){
					$data_in_memcache[$products_id]++;
				}else{
					$data_in_memcache[$products_id] = 1;
				}
				$fsmemcache -> set($mem_key,$data_in_memcache,10000);

			}else{
				if(!$products_id)
					return;

				if(!empty($_SESSION['products_view'])){
				    if( strpos($_SESSION['products_view'],$products_id) === false){
				       $_SESSION['products_view'] = $_SESSION['products_view'].$products_id.',';
				    }
				}else{
				   $_SESSION['products_view'] = ','.$products_id.',';
				}
				// count
				global $db,$econfig;
				$sql = " UPDATE fs_products
						SET hits = hits + 1
						WHERE  id = '$products_id'
					 ";
				$db->query($sql);
				$rows = $db->affected_rows();
				return $rows;
			}
		}

	}

?>
