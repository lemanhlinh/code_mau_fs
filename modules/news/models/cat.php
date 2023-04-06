<?php

class NewsModelsCat extends FSModels
{
    function __construct()
    {
        parent::__construct();
        global $module_config;
        $limit = '';
        FSFactory::include_class('parameters');
        if (!empty($module_config->params)) {
            $current_parameters = new Parameters($module_config->params);
            $limit = $current_parameters->getParams('limit');
        }

        $this->limit = $limit ? $limit : 10;
        //$this->limit = 10;
        $fs_table = FSFactory::getClass('fstable');
        $this->table_name = $fs_table->getTable('fs_news');
        $this->table_cat = $fs_table->getTable('fs_news_categories');
    }

    function set_query_body($cid)
    {
        $date1 = FSInput::get("date_search");
        $where = "";
        $order = '';
        $type = !empty($_SESSION['type']) ? $_SESSION['type'] : '';
        if ($type)
            $order = $type . ' DESC, ';
        //$fs_table = FSFactory::getClass('fstable');
        $keyword = FSInput::get('key');
        if ($keyword) {
            $where2 = " and title like '%" . $keyword . "%' or summary like '%" . $keyword . "%'";
        }
        $query = ' FROM ' . $this->table_name . '
						  WHERE ( category_id = ' . $cid . ' 
						  	OR category_id_wrapper like "%,' . $cid . ',%" )
						  	AND published = 1
						  	' . $where . $where2 .
            ' ORDER BY ' . $order . '  ordering DESC,created_time DESC
						 ';
        //print_r($query);
        return $query;
    }

    /*
     * get Category current
     * By Id or By code
     */
//	mẫu lấy tên chỉ mục
    function getCategory()
    {
        $fs_table = FSFactory::getClass('fstable');
        $code = FSInput::get('ccode');
        if ($code) {
            $where = " AND alias = '$code' ";
        } else {
            $id = FSInput::get('id', 0, 'int');
            if (!$id)
                die('Not exist this url');
            $where = " AND id = '$id' ";
        }
        $query = " SELECT id,name, icon, alias,parent_id as parent_id,seo_title,seo_keyword,seo_description
						FROM " . $fs_table->getTable('fs_news_categories') . " 
						WHERE published = 1 " . $where;
        global $db;
        $sql = $db->query($query);
        $result = $db->getObject();
        return $result;
    }

    function getNewsList($query_body)
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

    function getTotal1()
    {
        global $db;
        $category_id = FSInput::get('id');
        $type = $_GET['type'];
        if (!$category_id)
            die('Not exist this url');
        $where = " AND category_id_wrapper LIKE '%" . $category_id . "%' ";
        if ($type) {
            $where1 = " AND category_alias LIKE '%" . $type . "%' ";
        } else {
            $where1 = '';
        }
        $query = "SELECT count(*) FROM " . $this->table_name . " WHERE published = 1 " . $where . $where1 . " order by created_time DESC ";
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

    function getis_hot()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE published = 1 and is_hot =1 order by created_time DESC LIMIT 5";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function gettindanhmuc()// không sử dụng limit để show danh sách
    {
        $category_id = FSInput::get('id');
        if (!$category_id)
            die('Not exist this url');
        $where = " AND category_id = '$category_id' ";
        $query = "SELECT * FROM " . $this->table_name . " WHERE published = 1" . $where . "order by created_time DESC, updated_time DESC ";
        global $db;
//			$db->query($query);
        $sql = $db->query_limit($query, $this->limit, $this->page);
        $result = $db->getObjectList();
        return $result;
    }

    function gettindanhmuc1()// không sử dụng limit để show danh sách
    {
        $category_id = FSInput::get('id');
        $type = $_GET['type'];
        if (!$category_id)
            die('Not exist this url');
        $where = " AND category_id_wrapper LIKE '%" . $category_id . "%' ";
        if ($type) {
            $where1 = " AND category_alias LIKE '%" . $type . "%' ";
        } else {
            $where1 = '';
        }
        $query = "SELECT * FROM " . $this->table_name . " WHERE published = 1 " . $where . $where1 . " order by created_time DESC, updated_time DESC  ";
        global $db;
//			$db->query($query);
        $sql = $db->query_limit($query, $this->limit, $this->page);
        $result = $db->getObjectList();
        return $result;
    }

    function getdanhmuc()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM " . $this->table_cat . " WHERE published = 1 AND parent_id = 0";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function get_new_($cid)// không sử dụng limit để show danh sách
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE published = 1 AND  ( category_id =' . $cid . ' 
						  	OR category_id_wrapper like "%,' . $cid . ',%" ) ORDER BY created_time DESC, id DESC LIMIT 5';
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
}

?>