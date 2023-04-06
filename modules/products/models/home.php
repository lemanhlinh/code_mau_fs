<?php

class ProductsModelsHome extends FSModels
{
    function __construct()
    {

        parent::__construct();
        global $module_config;
        FSFactory::include_class('parameters');
        $current_parameters = new Parameters ($module_config->params);
        $limit = $current_parameters->getParams('limit');
        //$limit_ = FSInput::get('limit',0,'int')
        $this->limit = !empty($limit) ? $limit : 15;

        $fs_table = FSFactory::getClass('fstable');
        $this->table_name = $fs_table->getTable('fs_products',1);
        $this->table_cate = $fs_table->getTable('fs_products_categories',1);
        $this->table_manu = $fs_table->getTable('fs_manufactories',1);
        $this->table_app = $fs_table->getTable('fs_application',1);
        $this->table_type = $fs_table->getTable('fs_products_types',1);
        $this->table_city = $fs_table->getTable('fs_cities',1);
        $this->table_products_filters = $fs_table->getTable('fs_products_filters',1);
        //$this->limit = 8;
    }

    function set_query_body()
    {
        return $this->set_query_body_filter('', $this->table_name);
    }

    function set_query_body_filter($category_id, $tablename)
    {
        if (!$tablename)
            return;
        global $db;
        $where = '';
        // filter
        $filter = FSInput::get('filter');
        if ($filter) {
            $arr_filter = explode(',', $filter);
            $arr_standart_filter = array();
            for ($i = 0; $i < count($arr_filter); $i++) {
                $filter_item = $arr_filter [$i];
                if ($filter_item) {
                    $arr_standart_filter [] = "'" . $filter_item . "'";
                }
            }
            if (count($arr_standart_filter)) {
                $str_standart_filter = implode(",", $arr_standart_filter);

                // get filter in table fs_products_filter follow request
                $filter_from_db = $this->getFilterFromRequest($str_standart_filter, $tablename);

                $filter_name_current = '';

                for ($i = 0; $i < count($filter_from_db); $i++) {
                    $item = $filter_from_db [$i];
                    $calculator = $item->calculator;
                    $field_name = $item->field_name;
                    if ($filter_name_current != $field_name) {
                        if ($i)
                            $where .= ') AND ( ';
                        else
                            $where .= ' AND ( ';
                        $filter_name_current = $field_name;
                    } else {
                        $where .= ' OR ';
                    }

                    $filter_value = '';
                    $filter_value1 = '';
                    $filter_value2 = '';
                    if ($calculator > 9) {
                        $filter_value = $item->filter_value;
                        $arr_value = explode(",", $filter_value, 2);
                        $filter_value1 = @$arr_value [0] ? $arr_value [0] : "";
                        $filter_value2 = @$arr_value [1] ? $arr_value [1] : "";
                    } else {
                        $filter_value = $item->filter_value;
                    }
//					if($item->field_name == 'price'){
//						$item->field_name = $item->field_name.'+('.$item->field_name.'*'.$cat->vat.')/100';
//					}
                    switch ($calculator) {
                        case '1' :
                            break;
                        case '2' :
                            $where .= " a." . $field_name . " LIKE '%" . $filter_value . "%' ";
                            break;
                        case '3' :
                            $where .= " a." . $field_name . " is NULL  ";
                            break;
                        case '4' :
                            $where .= " a." . $field_name . " is NOT NULL  ";
                            break;
                        case '5' :
                            $where .= " a." . $field_name . " = '" . $filter_value . "' ";
                            break;
                        case '6' :
                            $where .= " a." . $field_name . " > " . $filter_value . " ";
                            break;
                        case '7' :
                            $where .= " a." . $field_name . " < " . $filter_value . " ";
                            break;
                        case '8' :
                            $where .= " a." . $field_name . " >= " . $filter_value . " ";
                            break;
                        case '9' :
                            $where .= " a." . $field_name . " <= " . $filter_value . " ";
                            break;
                        case '10' :
                            $where .= "  a." . $field_name . " > " . $filter_value1 . "  ";
                            $where .= " AND a." . $field_name . " < " . $filter_value2 . "  ";
                            break;
                        case '11' :
                            $where .= "  a." . $field_name . " > " . $filter_value1 . "  ";
                            $where .= " AND a." . $field_name . " <= " . $filter_value2 . "  ";
                            break;
                        case '12' :
                            $where .= "  a." . $field_name . " >= " . $filter_value1 . "  ";
                            $where .= " AND a." . $field_name . " < " . $filter_value2 . "  ";
                            break;
                        case '13' :
                            $where .= "  a." . $field_name . " >= " . $filter_value1 . "  ";
                            $where .= " AND a." . $field_name . " <= " . $filter_value2 . "  ";
                            break;
                        case '14' ://FOREIGN_ONE
                            $where .= " $field_name = '" . $filter_value . "' ";
                            break;
                        case '15' ://FOREIGN_MULTI
                            $where .= "  $field_name like  '%," . $filter_value . ",%' ";
                            break;
                        default :
                            break;
                    }
                }
                $where .= ')  ';
            }
        }

        // manufactory
        $manufactories_request = FSInput::get('manu', '');
        if ($manufactories_request) {
            $arr_manufactories_request = explode(',', $manufactories_request);
            if (count($arr_manufactories_request)) {
                $where .= " AND (";
                $m = 0;
                foreach ($arr_manufactories_request as $item) {
                    if ($item) {
                        if ($m)
                            $where .= " OR ";
                        $where .= " manufactory_alias = '" . $item . "' ";
                        $m++;
                    }
                }
                $where .= " ) ";
            }
        }

        if ($category_id) {
            $where .= 'AND category_id_wrapper like "%,' . $category_id . ',%" ';
        }

        //$key = FSInput::get('keyword');
        //if($key){
        //	$where .= 'AND name like "%'.$key.'%" ';
        //}
        $keyword = FSInput::get('keyword');
        if ($keyword) {
            $arr_tags = explode(' ', $keyword);
            $total_tags = count($arr_tags);
            if ($total_tags) {
                $where .= ' AND (';
                $j = 0;
                for ($i = 0; $i < $total_tags; $i++) {
                    $item = trim($arr_tags [$i]);
                    if ($item) {
                        if ($j > 0)
                            $where .= ' AND ';
                        $where .= " `name` like '%" . $item . "%'";
                        $j++;
                    }
                }
                $where .= ' ) ';
            }
        }

        $sql = " 	FROM $tablename AS a
						WHERE published = 1 " . $where;
        // print_r($sql);
        return $sql;
    }

    /*
         * get Filter from request
         */
    function getFilterFromRequest($str_filter, $tablename = '')
    {
        if (!$str_filter)
            return;
        global $db;
        $where = '';
        if ($tablename)
            $where .= " AND tablename = '" . $tablename . "' ";
        else
            $where .= " AND ( tablename = '' OR tablename = '$this->table_name' )  ";

        $fs_table = FSFactory::getClass('fstable');
        $table_filters = $fs_table->getTable('fs_products_filters');

        $query = " SELECT *
						FROM $table_filters
						WHERE alias IN ($str_filter)
						AND published = 1
						" . $where . "
						ORDER BY field_name
						";
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function get_list($query_body)
    {
        if (!$query_body)
            return;
        $query_ordering = $this->set_query_order_by();
        $query_select = $this->set_query_select();
        $query = $query_select;
        $query .= $query_body;
        $query .= $query_ordering;

        global $db;
        $db->query_limit($query, $this->limit, $this->page);
        $result = $db->getObjectList();
        return $result;


    }

    function ajax_get_list($query_body)
    {

        if (!$query_body)
            return;
        $query_ordering = $this->set_query_order_by();
        $query_select = $this->set_query_select();
        $query = $query_select;
        $query .= $query_body;
        $query .= $query_ordering;
        global $db;
        $pagecurrent = FSInput::get('pagecurrent', 0, 'int');
        $db->query_limit_export($query, $pagecurrent, 4);


        $result = $db->getObjectList();
        return $result;
    }


    /*
         * Insert order by into query select
         */
    function set_query_order_by()
    {
        $order = FSInput::get2('order');
        $query_ordering = ' ORDER BY created_time DESC';
        switch ($order) {
            case 'price-asc':
                $query_ordering = ' ORDER BY price ASC ';
                break;
            case 'price-desc':
                $query_ordering = ' ORDER BY price DESC ';
                break;
            case 'alpha-asc':
                $query_ordering = ' ORDER BY name ASC ';
                break;
            case 'alpha-desc':
                $query_ordering = ' ORDER BY name DESC ';
                break;
            case 'created-asc':
                $query_ordering = ' ORDER BY created_time ASC';
                break;
            case 'created-desc':
                $query_ordering = ' ORDER BYcreated_time DESC';
                break;
            default:
                $query_ordering = ' ORDER BY created_time DESC';
                break;
        }
        return $query_ordering;
    }

    function getTotal($query_body='')
    {
        $key = FSInput::get('key');
        if($key){
            $where2 = " and name like '%".$key."%' or summary like '%".$key."%'";
        }
        $linhvuc = FSInput::get('linhvuc');
//        var_dump($linhvuc);
        $hangsx = FSInput::get('hangsx');
        $ungdung = FSInput::get('ungdung');
        $loaisp = FSInput::get('loaisp');
        $where1 = "";
        if($linhvuc){
            $where1 .= " AND category_alias like '%".$linhvuc."%'";
        }
        if($hangsx){
            $where1 .= " AND manufactory_alias like '%".$hangsx."%'";
        }
        if($loaisp){
            $where1 .= " AND types_alias like '%".$loaisp."%'";
        }
        if($ungdung){
            $where1 .= " AND application_alias like '%".$ungdung."%'";
        }
        $order = FSInput::get('order');
        if($order){
            $where = " ORDER BY name ASC";
        }
        global $db;
        $query = "SELECT count(*)  FROM $this->table_name WHERE published = 1".$where1.$where2.$where. " ORDER BY ordering ASC";
        $db->query($query);
        $total = $db->getResult();
        return $total;
    }

    function getPagination($total)
    {
        FSFactory::include_class('Pagination');
        $pagination = new Pagination ($this->limit, $total, $this->page);
        return $pagination;
    }

    function get_types()
    {
        return $list = $this->get_records('published = 1', 'fs_products_types', 'id,name,image,alias', 'ordering ASC');
    }

    /*
             * Insert select into query select
             * 1: fs_products
             */
    function set_query_select()
    {
        $query = ' SELECT `name`,alias,image,summary,hits,id,category_alias,created_time,is_new,
                            discount,price,price_old,code,category_id,category_name,discount_unit, icon ';
        return $query;
    }

    /*
         * select cat list is children of catid
         */
    function getCats()
    {
        global $db;
        $query = " SELECT id,name, alias,tags_group,tablename,root_id, list_parents,image,level,parent_id
					FROM $this->table_cate
					WHERE
						published = 1
						AND parent_id = 0
					ORDER BY ordering
							";
        $db->query($query);
        $list = $db->getObjectList();

        return $list;
    }

    /*
         * select Relate cats
         */
    function get_cats_relates($str_cats_rootid)
    {
        if (!$str_cats_rootid)
            return false;

        global $db;
        $query = " SELECT id ,parent_id, root_id, name, image,icon, root_alias
					FROM $this->table_cate
					WHERE
						root_id IN ($str_cats_rootid)
							";
        $db->query($query);
        $list = $db->getObjectList();

        return $list;
    }

    /*
         * return products list in category list.
         * These categories is Children of category_current
         */
    function getProducts($cat_id)
    {
        global $db;
        if (!$cat_id)
            return false;

        $order = " ORDER BY id DESC, created_time DESC ";
        $query = " SELECT *
						FROM $this->table_name
						WHERE category_id_wrapper like '%" . $cat_id . "%' AND published = 1 " . $order . "
						LIMIT " . $this->limit_per_cat . " ";

        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_hot()// không sử dụng limit để show danh sách
    {
        $key = FSInput::get('key');
        if($key){
            $where2 = " and (name like '%".$key."%' or summary like '%".$key."%')";
        }
        $linhvuc = FSInput::get('linhvuc');
        $hangsx = FSInput::get('hangsx');
        $ungdung = FSInput::get('ungdung');
        $loaisp = FSInput::get('loaisp');
        $where1 = "";
        if($linhvuc){
            $where1 .= " AND category_alias like '%".$linhvuc."%'";
        }
        if($hangsx){
            $where1 .= " AND manufactory_alias like '%".$hangsx."%'";
        }
        if($loaisp){
            $where1 .= " AND types_alias like '%".$loaisp."%'";
        }
        if($ungdung){
            $where1 .= " AND application_alias like '%".$ungdung."%'";
        }
        $order = FSInput::get('order');
//        var_dump($order);
        if($order){
            $where = " ORDER BY name ASC";
        }
//        else{
//            $where = " ORDER BY ordering ASC";
//        }
        $query = "SELECT * FROM $this->table_name WHERE published = 1 and is_hot = 1".$where1.$where2.$where. " order by RAND() LIMIT 9";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_all()// không sử dụng limit để show danh sách
    {
        $key = FSInput::get('key');
        if($key){
            $where2 = " and (name like '%".$key."%' or summary like '%".$key."%')";
        }
        $linhvuc = FSInput::get('linhvuc');
//        var_dump($linhvuc);
        $hangsx = FSInput::get('hangsx');
        $ungdung = FSInput::get('ungdung');
        $loaisp = FSInput::get('loaisp');
        $where1 = "";
        if($linhvuc){
            $where1 .= " AND category_alias like '%".$linhvuc."%'";
        }
        if($hangsx){
            $where1 .= " AND manufactory_alias like '%".$hangsx."%'";
        }
        if($loaisp){
            $where1 .= " AND types_alias like '%".$loaisp."%'";
        }
        if($ungdung){
            $where1 .= " AND application_alias like '%".$ungdung."%'";
        }
        $order = FSInput::get('order');
        if($order){
            $where = " ORDER BY name ASC";
        }
        $query = "SELECT * FROM $this->table_name WHERE published = 1".$where1.$where2.$where. " ORDER BY ordering ASC" ;

        global $db;
        $db->query_limit($query, $this->limit, $this->page);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_az()// không sử dụng limit để show danh sách
    {
//        $key = FSInput::get('key');
//        if($key){
//            $where2 = " and name like '%".$key."%'";
//        }
//        $linhvuc = FSInput::get('linhvuc');
//        $hangsx = FSInput::get('hangsx');
//        $ungdung = FSInput::get('ungdung');
//        $loaisp = FSInput::get('loaisp');
//        $where1 = "";
//        if($linhvuc){
//            $where1 .= " AND category_id = ".$linhvuc."";
//        }
//        if($hangsx){
//            $where1 .= " AND manufactory = ".$hangsx."";
//        }
//        if($loaisp){
//            $where1 .= " AND types_id = ".$loaisp."";
//        }
//        if($ungdung){
//            $where1 .= " AND application = ".$ungdung."";
//        }
        $query = "SELECT * FROM $this->table_name WHERE published = 1  ORDER BY name ASC";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_categories()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_cate WHERE published = 1 AND ordering != 1000 ORDER BY name ASC";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_categories_orther()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_cate WHERE published = 1 AND ordering = 1000";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_lv()// không sử dụng limit để show danh sách
    {
        $linhvuc = FSInput::get('linhvuc');
        $query = "SELECT * FROM $this->table_cate WHERE published = 1 AND alias = '".$linhvuc."'";
        global $db;
        $db->query($query);
        $result = $db->getObject();
        return $result;
    }
    function getproducts_manufactories()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_manu WHERE published = 1 ORDER BY name ASC";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_application()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_app WHERE published = 1 AND ordering != 1000 ORDER BY name ASC";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_application_orther()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_app WHERE published = 1 AND ordering = 1000";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
     function getproducts_types()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_type WHERE published = 1 AND ordering != 1000 ORDER BY name ASC";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getproducts_types_orther()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_type WHERE published = 1  AND ordering = 1000";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getcity()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_city WHERE published = 1";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
}

?>