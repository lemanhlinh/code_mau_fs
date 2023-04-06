<?php 
	class ImagesModelsImg extends FSModels
	{
		function __construct()
		{
		
			$fstable = FSFactory::getClass('fstable');
			$this->table_name  = $fstable->_('fs_image');
//			$this->table_category  = $fstable->_('fs_contents_categories');
            $this -> table_add = $fstable->_('fs_address');
            $this -> table_menus = $fstable->_('fs_menus_items');
            $this -> table_images = $fstable->_('fs_image_images');

        }


		/*
		 * get Article
		 */
		function get_data()
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
			$query = " SELECT id,title,image,source,content,category_id,category_id_wrapper,category_alias,category_name,
                                summary, alias, created_time, updated_time,seo_title,seo_keyword,seo_description,show_map,tags
						FROM ". $fs_table -> getTable('fs_image') ." 
						WHERE published = 1 AND category_published = 1
						".$where ;
			global $db;
		$sql = $db->query($query);
			$result = $db->getObject();
			return $result;
		}
        
        function get_address_list(){
			$query = ' select * from '. $this -> table_add.' where published = 1 AND show_contact = 0';
			global $db;
			$sql = $db->query($query);
			$list = $db->getObjectList();
			return $list;
		}
        
        function getRelateNewsList($cid)
		{
			if(!$cid)
				die;
			$code = FSInput::get('code');	
			$where = '';
			if($code){
				$where .= " AND alias <> '$code' ";
			} else {
				$id = FSInput::get('id',0,'int');
				if(!$id)
					die('Not exist this url');
				$where .= " AND id <> '$id' ";
			}
			
			global $db;
			$limit = 10;
			$fs_table = FSFactory::getClass('fstable');
			
			$query = " SELECT id,title,alias, category_id,updated_time ,image,category_alias
						FROM ". $this->table_name ."
						WHERE alias <> '".$code."'
							AND category_id = $cid
							AND published = 1
							".$where."
						ORDER BY  id DESC, ordering DESC
						LIMIT $limit
						";
			$db->query($query);
			$result = $db->getObjectList();
			
			return $result;
		}
		function getdanhmuc()// không sử dụng limit để show danh sách
		{
			$query = "SELECT * FROM fs_contents_categories WHERE published = 1";
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
        function getimages()// không sử dụng limit để show danh sách
        {
            $query = "SELECT * FROM " . $this->table_name ." WHERE published = 1  ORDER BY ordering DESC , created_time DESC limit 6";
            global $db;
            $db->query($query);
            $result = $db->getObjectList();
            return $result;
        }
        function getall_list()// không sử dụng limit để show danh sách
        {
            $query = "SELECT * FROM " . $this->table_name . " WHERE published = 1  ORDER BY ordering DESC , created_time DESC";
            global $db;
            $db->query($query);
            $result = $db->getObjectList();
            return $result;
        }
        function getimageschitiet($id)// không sử dụng limit để show danh sách
        {
            $query = "SELECT * FROM ".$this -> table_images ." WHERE record_id = ".$id."";
            global $db;
            $db->query($query);
            $result = $db->getObjectList();
            return $result;
        }
		function getmenusitem()// không sử dụng limit để show danh sách
		{
				$where = " AND group_id = 4 ";
				$query = "SELECT * FROM ". $this -> table_menus." WHERE published = 1".$where;
			// $query = "SELECT * FROM fs_news WHERE published = 1 and id = 13";//câu lệnh truyền vào pải chỉ rõ đang gọi đến 1 đối tượng nào
			global $db;
			$db->query($query);
			$result = $db->getObjectList();
			return $result;
		}
        function get_ajax_loadmore()
        {
            global $db;
            $fs_table = FSFactory::getClass('fstable');

            $pagecurrent = FSInput::get('pagecurrent');
            $limit = FSInput::get('limit');
//            $type_id = FSInput::get('type_id');
            $total_old = $pagecurrent * $limit;

            $gt = $total_old . ',' . $limit;

            $sql_where = '';
//            if ($type_id)
//                $sql_where .= ' AND type_id=' . $type_id;

            $query = '  SELECT *
	                        FROM ' . $fs_table->getTable('fs_image') .'
	                        WHERE published = 1 ' . $sql_where . '
	                        ORDER BY ordering DESC , created_time DESC
	                        LIMIT ' . $gt;
            $sql = $db->query($query);
            $result = $db->getObjectList();
            return $result;
        }
	}
	
?>