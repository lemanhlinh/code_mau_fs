<?php 
	class DocumentsModelsDocument extends FSModels
	{
		var $limit;
		var $prefix ;
		function __construct()
		{
			$this -> limit = 20;
			$this -> view = 'document';
			$this -> table_name = FSTable_ad::_('fs_documents');

			$this -> arr_img_paths = array(array('small',265,160,'resize_image'));
			$cyear = date('Y');
			$cmonth = date('m');
			//$cday = date('d');
			$this -> img_folder = 'images/document/'.$cyear.'/'.$cmonth;
			$this -> check_alias = 0;
			$this -> field_img = 'image';

			parent::__construct();
		}

		function setQuery(){
			
			// ordering
			$ordering = "";
			if(isset($_SESSION[$this -> prefix.'sort_field']))
			{
				$sort_field = $_SESSION[$this -> prefix.'sort_field'];
				$sort_direct = $_SESSION[$this -> prefix.'sort_direct'];
				$sort_direct = $sort_direct?$sort_direct:'asc';
				$ordering = '';
				if($sort_field)
					$ordering .= " ORDER BY $sort_field $sort_direct, date_created DESC, id DESC";
					
			}
			if(!$ordering)
				$ordering .= " ORDER BY date_created DESC , id DESC ";
			
			$where = "  ";
			
			if(isset($_SESSION[$this -> prefix.'keysearch'] ))
			{
				if($_SESSION[$this -> prefix.'keysearch'] )
				{
					$keysearch = $_SESSION[$this -> prefix.'keysearch'];
					$where .= " AND a.name LIKE '%".$keysearch."%'  OR a.coursename LIKE '%".$keysearch."%'";
				}
			}
			 if (isset($_SESSION[$this->prefix . 'filter0'])) {
	            $filter = $_SESSION[$this->prefix . 'filter0'];
	            if ($filter) {
	                $where .= ' AND a.filetype = '. $filter .' ';
	            }
	        }
			

            $query = " SELECT a.*
						  FROM 
						  	" . $this->table_name . " AS a
						  	WHERE 1=1 " . $where . $ordering . " ";
						
			return $query;
		}
		function getMenuItems() {
			$query = " SELECT id,coursename as name, parent_id
					  	FROM fs_course
				  		WHERE 1=1"
					  	;
			global $db;
			$sql = $db->query ( $query );
			$menus_item = $db->getObjectList ();
			//print_r($menus_item);die;
			$fstree = FSFactory::getClass ( 'tree', 'tree/' );
			$list = $fstree->indentRows ( $menus_item, 3 );

			return $list;
		}            		
		function save($row = array(), $use_mysql_real_escape_string = 1){
            
			// file downlaod
            global $db; 
            $cyear = date ( 'Y' ); 
    		$path = PATH_BASE.'images'.DS.'upload_file'.DS.$cyear.DS;
            require_once(PATH_BASE.'libraries'.DS.'upload.php');
            $upload = new  Upload();
            $upload->create_folder ( $path );
            
            $file_upload = $_FILES["urlfile"]["name"];
			if($file_upload){
				$path_original = $path;
				// remove old if exists record and img
				if($id){
					$img_paths = array();
					$img_paths[] = $path_original;
					// special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
				}
				$fsFile = FSFactory::getClass('FsFiles');
				// upload
				$file_upload_name = $fsFile -> upload_file("urlfile", $path_original ,6000000, '_'.time());
				if(!$file_upload_name)
					return false;
				$row['urlfile'] = 'images/upload_file/'.$cyear.'/'.$file_upload_name;
			}

			$image_name_image = $_FILES["image"]["name"];
    		if($image_name_image){
    			$image_image = $this->upload_image('image','_'.time(),2000000,$this -> arr_img_paths);
    			if($image_image){
    				$row['image'] = $image_image;
    			}
    		}

			$menus_items = FSInput::get ( 'menus_items', array (), 'array' );

			$where = '';
			if($menus_items){
				for ($i=0;$i<count($menus_items);$i++) {
					if($i==0){
						$where = ' AND id = '.$menus_items[$i].'';
					}else{
						$where .= ' OR id = '.$menus_items[$i].'';
					}
				}
				$query = " SELECT coursename
						  	FROM fs_course
					  		WHERE 1=1 ".$where."" 
						  	;
				global $db;
				$sql = $db->query ( $query );
				$list_item = $db->getObjectList();
			}
			$listItemid = implode ( ',', $menus_items );
			if ($listItemid) {
				$listItemid = ',' . $listItemid . ',';
			}			
			$row['courseid'] = $listItemid;

			$coursename='';
			if($list_item){
				$i=0;
				foreach ($list_item as $key) {
					$i++;
					if($i==1){
						$coursename = $key->coursename;
					}else{
						$coursename .= ','.$key->coursename;
					}
					
				}	
			}
			$row['coursename'] = $coursename;
			//print_r($row);die;
            
			return parent::save($row);
		}


	}
	
?>