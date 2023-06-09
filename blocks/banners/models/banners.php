<?php 
	class BannersBModelsBanners
	{
		function __construct()
		{
		    $fstable = FSFactory::getClass('fstable');
            $this->table_name = $fstable->_('fs_banners');
            $this->table_categories = $fstable->_('fs_banners_categories');
            
		}
		function getList($category_id){
			$where = '';
			if(!$category_id)
				return;
			$where .= ' AND category_id = '.$category_id.' ';
			$module = FSInput::get('module');
			$view = FSInput::get('view');
			$ccode = FSInput::get('ccode');
			$cat = $this->get_cats($ccode);
			$filter = FSInput::get('filter');
			

			//if($module == 'products' && $view != 'home' && $view != 'search' && $view != 'cart'){
//				 $where .= 'AND  products_categories_alias like "%,'.$ccode.',%"  ';
//			}else if($module == 'news' && $view != 'home' ){
//				$where .= 'AND  news_categories_alias like "%,'.$ccode.',%" ';
//			}else if($module== 'contents' && $view != 'home'){
//			     $where .= 'AND  contents_categories_alias like "%,'.$ccode.',%"  ';
//			}
			
			// Itemid
			$Itemid = FSInput::get ( 'Itemid', 1, 'int' );
			$where .= " AND (listItemid = 'all'
							OR listItemid like '%,$Itemid,%')
							";
			
			$query = ' SELECT `name`,id,category_id,`type`,image,flash,content,link,height,width,description
						  FROM '. $this->table_name .' AS a
						  WHERE published = 1
						 '. $where .' ORDER BY ordering, id ';
            //print_r($query);             
			global $db;
			$db->query($query);
			$list = $db->getObjectList();
			
			return $list;
		}
		function getFilterFromRequest($str_filter,$tablename = '',$set_key_alias = 0) {
			if (! $str_filter)
				return;
			global $db;
			$where = '';
			if($tablename)
				$where .= " AND tablename = '".$tablename."' ";
			else 
				$where .= " AND ( tablename = '' OR tablename = 'fs_products' )  ";
			$query = " SELECT *
							FROM fs_products_filters
							WHERE alias IN ($str_filter)
							AND published = 1
							".$where."
							";
			$db->query ( $query );
			if($set_key_alias)
				$result = $db->getObjectListByKey('alias');
			else
				$result = $db->getObjectList ();
				
			return $result;
		}
		function get_cats($ccode){
			if (! $ccode)
				return;
			$query = " SELECT `name`,`id`,'alias'
						  FROM fs_products_categories AS a
						  WHERE published = 1 AND alias='".$ccode."'
						  ";	
			global $db;
			$db->query($query);
			$result = $db->getObject();
			
			return $result;
		}
	}
?>