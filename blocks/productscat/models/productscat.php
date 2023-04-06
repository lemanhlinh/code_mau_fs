
<?php 
	class ProductscatBModelsProductscat
	{
		function __construct()
		{
		  $fstable = FSFactory::getClass('fstable');
            //$this->table_name = $fstable->_('fs_products');
            $this->table_categories = $fstable->_('fs_products_categories');
		}
		
		function setQuery($str_cats,$ordering,$limit,$type){
		    $ccode = FSInput::get('ccode');
			$where = '';
			$order = '';
            //if($ccode){
//              $where .= ' AND category_alias_wrapper LIKE "%,'.$ccode.',%" ';  
//            }	
			if($str_cats)
					$where .= ' AND category_id_wrapper LIKE "%,'.$str_cats.',%" ';	
			switch ($type){
			case 'hit_most':
				$limit_day = $limit;
				$where .= '  AND published_time >= DATE_SUB(CURDATE(), INTERVAL '.$limit_day.' DAY) ';	
				break;
			case 'ramdom':	
				$order .= ' RAND(),';
				break;
			case 'newest':
				$where .= '  created_time DESC, ';
			    break;
       
            case 'highlight':
				$where .= ' AND is_hot = 1';
			    break;
			}
			$order .= ' ordering DESC , created_time DESC';
			$query = ' SELECT name,alias,image,id,created_time
						  FROM '. $this->table_categories .'
						 WHERE  published = 1 '.$where.'
						  ORDER BY  '.$order.'
						 LIMIT '.$limit  
						 ;
            //print_r($query);
			return $query;
		}
		function get_list($str_cats,$ordering,$limit,$type){
			global $db;
			$query = $this->setQuery($str_cats,$ordering,$limit,$type);
			if(!$query)
				return;
			$sql = $db->query($query);
			$result = $db->getObjectList();
			return $result;
		}	
		
	}
	
?>