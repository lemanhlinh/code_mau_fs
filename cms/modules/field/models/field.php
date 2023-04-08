<?php

class FieldModelsField extends FSModels
{
    var $limit;
    var $page;

    function __construct()
    {
        $limit = FSInput::get('limit', 20, 'int');
        $page = FSInput::get('page');
        $this->limit = $limit;
        //$this -> table_name = 'fs_manufactories';
        $this->table_name = FSTable_ad::_('fs_field');
        //synchronize
        $this->check_alias = 1;
        //$this -> table_product = 'fs_products';
        $this->table_product = FSTable_ad::_('fs_products');
        $this->arr_img_paths = array(array('resized', 640, 360, 'resize_image_fix_height'),
                                     array('small', 180, 100, 'cut_image'),
        );
        $this->img_folder = 'images/field';
        $this->field_img = 'image';
        parent::__construct();
    }

    function setQuery()
    {
        // ordering
        $ordering = '';
        $where = "  ";
        if (isset($_SESSION[$this->prefix . 'sort_field'])) {
            $sort_field = $_SESSION[$this->prefix . 'sort_field'];
            $sort_direct = $_SESSION[$this->prefix . 'sort_direct'];
            $sort_direct = $sort_direct ? $sort_direct : 'asc';
            $ordering = '';
            if ($sort_field)
                $ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
        }
        if (!$ordering)
            $ordering .= " ORDER BY created_time DESC , id DESC ";

        if (isset($_SESSION[$this->prefix . 'keysearch'])) {
            if ($_SESSION[$this->prefix . 'keysearch']) {
                $keysearch = $_SESSION[$this->prefix . 'keysearch'];
                $where .= " AND name LIKE '%" . $keysearch . "%' ";
            }
        }
        $query = " 	   SELECT * 
						
						  FROM " . $this->table_name . " 
						  	WHERE 1=1 " .
            $where .
            $ordering . " ";
        return $query;
    }


    /*
     * get Tablename product
     */
    function get_tablenames()
    {
        global $db;
        $query = " 	   SELECT DISTINCT(a.table_name) as table_name
						  FROM fs_products_tables AS a 
						 ";
        $db->query($query);
        $result = $db->getObjectList();

        return $result;
    }


    /*
     * Save into tble fs_manufactories
     */
    function save($row = array(), $use_mysql_real_escape_string = 0)
    {

        $record_id = parent::save($row, 1);

        return $record_id;
    }



// 		function published($value)
// 		{
// 			$ids = FSInput::get('id',array(),'array');
// 			if(count($ids))
// 			{
// 				global $db;
// 				$str_ids = implode(',',$ids);
// 				$sql = " UPDATE ".$this -> table_product."
// 							SET manufactory_published = $value
// 						WHERE manufactory IN ( $str_ids ) " ;
// 				$db->query($sql);
// 				$result = $db->getResult();
// 				$tables = $this -> get_records('','fs_products_tables',' DISTINCT(table_name)  AS table_name');
// 				if(count($tables)){
// 					foreach($tables as $table){
// 						$table_name = $table -> table_name;

// 						if(!$table_name)
// 							continue;
// //						$row['manufactory_published'] = $value;

// 						$this -> _update($row,$table_name,' manufactory IN ('.$str_ids.' )' );				
// 					}
// 				}
// 			}
// 			return parent::published($value);
// 		}
    /*
         * value: == 1 :old
         * value  == 0 :unold
         * published record
         */
    function is_retail($value)
    {
        $ids = FSInput::get('id', array(), 'array');
        if (count($ids)) {
            global $db;
            echo $str_ids = implode(',', $ids);
            $sql = " UPDATE " . $this->table_name . "
							SET is_retail = $value
						WHERE id IN ( $str_ids ) ";
            $db->query($sql);
            $rows = $db->affected_rows();


            if ($rows) {
                $row['is_retail'] = $value;
                $this->_update($row, 'fs_products', ' manufactory = ' . $str_ids);
            }

            return $rows;
        }
        // 	update sitemap
        if ($this->call_update_sitemap) {
            $this->call_update_sitemap();
        }
        return 0;
    }
}

?>