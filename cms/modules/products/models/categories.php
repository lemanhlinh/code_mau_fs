<?php 
	class ProductsModelsCategories extends ModelsCategories
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			parent::__construct();
			$limit = FSInput::get('limit',200,'int');
			$this -> limit = $limit;
			$this -> type = 'products';
			$this -> table_items = FSTable_ad::_('fs_'.$this -> type);
			$this -> table_name = FSTable_ad::_('fs_'.$this -> type.'_categories');
            $this -> table_name_table = FSTable_ad::_('fs_'.$this -> type.'_tables');
			$this -> check_alias = 1;
			$this -> call_update_sitemap = 0;
			$this->img_folder = 'images/' . $this->type . '/cat';
			$this->field_img = 'image';
			$this -> arr_img_paths = array(array('resized',48,48,'resize_image'));
			//synchronize
			//$this -> array_synchronize = array('fs_products_filters_values' => array('id'=> 'category_id','alias'=>'category_alias')); // đồng bộ dữ liệu ngoài bảng extend. Viết dang  array(tablename => array(field1, field2,...))
			// exception: key (field need change) => name ( key change follow this field)
			$this -> field_except_when_duplicate = array(array('list_parents','id'),array('alias_wrapper','alias'));
			
			
		}
		
		/*
		 * Show list category of product follow page
		 */
		function get_categories_tree()
		{
			global $db;
			$query = $this->setQuery();
			$sql = $db->query($query);
			$result = $db->getObjectList();
			$tree  = FSFactory::getClass('tree','tree/');
			$list = $tree -> indentRows2($result);
			$limit = $this->limit;
			$page  = $this->page?$this->page:1;
			
			$start = $limit*($page-1);
			$end = $start + $limit;
			
			$list_new = array();
			$i = 0;
			foreach ($list as $row){
				if($i >= $start && $i < $end){
					$list_new[] = $row;
				}
				$i ++;
				if($i > $end)
					break;
			}
			return $list_new;
		}
		/*
		 * Select all list category of product
		 */
		function get_categories_tree_all()
		{
			global $db;
			$query = $this->setQuery();
			$sql = $db->query($query);
			$result = $db->getObjectList();
			$tree  = FSFactory::getClass('tree','tree/');
			$list = $tree -> indentRows2($result);
			
			return $list;
		}
		
		function setQuery(){
			
			// ordering
			$ordering = "";
			$task = FSInput::get ( 'task' );
			if(isset($_SESSION[$this -> prefix.'sort_field']))
			{
				$sort_field = $_SESSION[$this -> prefix.'sort_field'];
				$sort_direct = $_SESSION[$this -> prefix.'sort_direct'];
				$sort_direct = $sort_direct?$sort_direct:'asc';
				$ordering = '';
				if($sort_field)
					$ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
					
			}
			if(!$ordering)
				$ordering .= " ORDER BY created_time DESC , id DESC ";
			
			$where = "  ";
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] && $task != 'edit' && $task != 'add')
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND name LIKE '%".$keysearch."%' ";
				}
			}
			
		$query = " SELECT a.*, a.parent_id as parent_id 
						  FROM 
						  	".$this -> table_name." AS a
						  	WHERE 1=1".
						 $where.
						 $ordering. " ";
						
			return $query;
		}
		function get_tablenames(){
			$query = " 	   SELECT DISTINCT(a.table_name) 
						  FROM $this->table_name_table AS a 
						 ";
			global $db;
			$db->query($query);
			$list = $db->getObjectList();
			$list = array_merge( array(0=>(object) array('table_name'=> FSTable_ad::_('fs_products'))),$list);
			return $list;
		}
		function save($row = array(),$use_mysql_real_escape_string = 0)
		{
		$id = FSInput::get ( 'id', 0, 'int' );
		$cat = $this->get_record_by_id($id);
		$vat = FSInput::get ( 'vat' );
		$tablename = FSInput::get ( 'tablename' );
		
	
		
			// image
		//$image_name_icon = $_FILES["icon"]["name"];
//		if($image_name_icon){
//			$image_icon = $this->upload_image('icon','_'.time(),2000000,$this -> arr_img_paths_icon);
//			if($image_icon){
//				$row['icon'] = $image_icon;
//			}
//		}
		// image
        
		//$image_name = $_FILES["banner"]["name"];
//		if($image_name){
//			$image = $this->upload_image('banner','_'.time(),2000000,$this -> arr_img_paths_banner);
//			if($image){
//				$row['banner'] = $image;
//			}
//		}

		// image
		//$image_name = $_FILES["banner_2"]["name"];
//		if($image_name){
//			$image = $this->upload_image('banner_2','_'.time(),2000000,$this -> arr_img_paths_banner_2);
//			if($image){
//				$row['banner_2'] = $image;
//			}
//		}

		$inheritance_perent_table = FSInput::get('inheritance_perent_table',0,'int');
			$tbl_name = '';
			if(!$inheritance_perent_table){
				$tbl_name = FSInput::get('table_name'); 
				if(!$tbl_name){
					$tbl_name = '';
				}else {
					$tbl_name =  $fsstring -> stringStandart($tbl_name);; 
					$tbl_name = "fs_products_".$tbl_name;
				}
			}
			// parent
			$parent_id = FSInput::get('parent_id');
			
			if(@$parent_id)
			{
				$parent =  $this->get_record_by_id($parent_id,$this -> table_name);
				$parent_level = $parent -> level ?$parent -> level : 0; 
				$level = $parent_level + 1;
				if($inheritance_perent_table){
					$tbl_name = $parent -> tablename; 
				}
			} else {
				$level = 0;
			}
			
			if($tbl_name){
				$this->createProductTbl($tbl_name);
				
				$row['tablename'] = $tbl_name;
			}

			$sizes = FSInput::get ( 'sizes', array (), 'array' );
			$str_sizes = implode ( ',', $sizes );
			if ($str_sizes) {
				$str_sizes = ',' . $str_sizes . ',';
			}
			$row ['sizes'] = $str_sizes;	
			

		$rid = parent::save ($row);
		
		if($tablename){
			$this -> update_table_extend($rid,$tablename);
            $row['tablename'] = $tablename;
            $this-> _update($row,$this -> table_itemsm,' category_id = '.$rid);
		}
		
		return $rid;
		}
		function update_table_extend($cid,$tablename){
			
			$record =  $this->get_record_by_id($cid,$this -> table_name);
			$alias =  $record -> alias;
			if($record -> parent_id){
				$parent =  $this->get_record_by_id($record -> parent_id,$this -> table_name);
				$list_parents = ','.$cid.$parent -> list_parents ;
				$alias_wrapper = ','.$alias.$parent -> alias_wrapper ;
			} else {
				$list_parents = ','.$cid.',';
				$alias_wrapper = ','.$alias.',' ;
			}
			
			// update table items
			$id = FSInput::get('id',0,'int');
			if($id){
				$row2['category_id_wrapper'] = $list_parents;
				$row2['category_alias'] = $record -> alias;
				$row2['category_alias_wrapper'] =  $alias_wrapper;
				$row2['category_name'] =  $record -> name;
				$row2['category_published'] =  $record -> published;
				$this -> _update($row2,$tablename,' category_id = '.$cid.' ');
			}
		}
		function published($value)
		{
			$ids = FSInput::get('id',array(),'array');
		
			if(count($ids))
			{
				global $db;
				foreach ($ids as $id) {
				$record =  $this->get_record_by_id($id,$this -> table_name);
				$tablename = $record->tablename;
					$sql = " UPDATE ".$tablename."
								SET category_published = $value
							WHERE category_id IN ( $id ) " ;
					$db->query($sql);
					$result = $db->getResult();
				}
			}
			return parent::published($value);
		}
		/*
		 * value: == 1 :new
		 * value  == 0 :unnew
		 * published record
		 */
		function is_hot($value)
		{
			$ids = FSInput::get('id',array(),'array');
			
			if(count($ids))
			{
				global $db;
				$str_ids = implode(',',$ids);
				$sql = " UPDATE ".$this -> table_name."
							SET is_hot = $value
						WHERE id IN ( $str_ids ) " ;
				$db->query($sql);
				$rows = $db->affected_rows();
				return $rows;
			}
			// 	update sitemap
			if($this -> call_update_sitemap){
				$this -> call_update_sitemap();
			}
			return 0;
		}
		/*
		 * value: == 1 :new
		 * value  == 0 :unnew
		 * published record
		 */
		function is_menu($value)
		{
			$ids = FSInput::get('id',array(),'array');
			
			if(count($ids))
			{
				global $db;
				$str_ids = implode(',',$ids);
				$sql = " UPDATE ".$this -> table_name."
							SET is_menu = $value
						WHERE id IN ( $str_ids ) " ;
				$db->query($sql);
				$rows = $db->affected_rows();
				return $rows;
			}
			// 	update sitemap
			if($this -> call_update_sitemap){
				$this -> call_update_sitemap();
			}
			return 0;
		}
		function get_size() {
			$where = '';

		
			global $db;
			$query = ' SELECT id,name
							FROM fs_products_sizes 
							WHERE published   = 1 
							 ' . $where . '	OR tablenames="" ';
			$sql = $db->query ( $query );
			$alias = $db->getObjectList ();
			
			return $alias;
		}
	}
	
?>