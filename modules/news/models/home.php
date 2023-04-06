<?php

class NewsModelsHome extends FSModels
{
    function __construct()
    {

        parent::__construct();
        global $module_config;
        FSFactory::include_class('parameters');
        $current_parameters = new Parameters($module_config->params);
        $limit = $current_parameters->getParams('limit');
        $limit = 5;
        $this->limit = $limit;
        $fs_table = FSFactory::getClass('fstable');
        $this->table_name = $fs_table->getTable('fs_news');
        $this->table_cat = $fs_table->getTable('fs_news_categories');
    }

    /*
     * select cat list is children of catid
     */
    function set_query_body()
    {
        $date1 = FSInput::get("date_search");
        $where = "";
        $fs_table = FSFactory::getClass('fstable');
        $query = " FROM " . $fs_table->getTable('fs_news') . "
						  WHERE 
						  	 published = 1
						  	" . $where .
            " ORDER BY  ordering DESC,created_time DESC, id DESC 
						 ";
        return $query;
    }

    function get_list($query_body)
    {
        if (!$query_body)
            return;

        global $db;
        $query = " SELECT id,title,summary,image, created_time,category_id, category_alias, alias,comments_total,comments_published";
        $query .= $query_body;
        $sql = $db->query_limit($query, $this->limit, $this->page);
        $result = $db->getObjectList();
        return $result;
    }

    function get_listcat()// mẫu hàm phân trang
    {
        global $db;// bắt buôc phải khai báo để kết nói với data
        $query = 'SELECT * FROM ' . $this->table_cat . ' WHERE published = 1 ORDER BY ordering ASC, id ASC';// câu lệnh query truyền vào
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function mauham()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE published = 1";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }


    function get_hot()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE published = 1 and is_hot = 1 ORDER BY ordering ASC, created_time DESC LIMIT 3";//câu lệnh truyền vào pải chỉ rõ đang gọi đến 1 đối tượng nào
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function get_listnew($cid)
    {
        if (!$cid){
            return;
        }
        $keyword = FSInput::get('key');
        if($keyword){
            $where2 = " and title like '%".$keyword."%' or summary like '%".$keyword."%'";
        }
        $query = "SELECT * FROM " . $this->table_name . " WHERE published = 1 and category_id =". $cid . $where2 ." ORDER BY ordering ASC, created_time DESC LIMIT 3";//câu lệnh truyền vào pải chỉ rõ đang gọi đến 1 đối tượng nào
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function get_tinnoibat1($id)// mẫu hàm để gọi chính xác 1 mảng
    {
        $query = "select * FROM " . $this->table_name . "
						  WHERE 
						  	 published = 1 and category_id = " . $id . " and is_hot = 1 ORDER BY  ordering DESC,created_time DESC, id DESC limit 4
						 ";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }


    function get_tinnoibat()// mẫu hàm để gọi chính xác 1 mảng
    {
        $query = "SELECT * FROM " . $this->table_cat . " WHERE published = 1 AND parent_id = 0 AND id != 11";//câu lệnh truyền vào
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    /*
     * return products list in category list.
     * These categories is Children of category_current
     */

    function getTotal($query_body)
    {
        if (!$query_body)
            return;
        global $db;
        $query = "SELECT count(*)";
        $query .= $query_body;
        $sql = $db->query($query);
        $total = $db->getResult();
        return $total;
    }

    function getPagination($total)
    {
        FSFactory::include_class('Pagination');
        $pagination = new Pagination($this->limit, $total, $this->page);
        return $pagination;
    }
}

?>