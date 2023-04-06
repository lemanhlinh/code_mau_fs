<?php

class ProductslistBModelsProductslist
{
    function __construct()
    {
        $fstable = FSFactory::getClass('fstable');
        $this->table_name = $fstable->_('fs_products');
        $this->table_categories = $fstable->_('fs_products_categories');
    }

    function setQuery($str_cats, $ordering, $limit, $type)
    {
        $ccode = FSInput::get('ccode');
        $id = FSInput::get('id', 0, 'int');
        $module = FSInput::get('module');
        $view = FSInput::get('view');
        $where = '';
        $order = '';

        //if($ccode){
//              $where .= ' AND category_alias_wrapper LIKE "%,'.$ccode.',%" ';  
//            }	
        if ($str_cats) {
            //$str_cats = '0,'.$str_cats.',0';
            $str_cats = explode(',', $str_cats);
            $where_cat = '';
            if (count($str_cats)) {
                for ($i = 0; $i < count($str_cats); $i++) {
                    if ($i == 0) {
                        $where_cat .= ' category_id_wrapper LIKE "%,' . $str_cats[$i] . ',%" ';
                    } else {
                        $where_cat .= ' OR category_id_wrapper LIKE "%,' . $str_cats[$i] . ',%" ';
                    }
                }
                $where .= ' AND (' . $where_cat . ') ';
            }
        }

        switch ($type) {
            case 'hit_most':
                $limit_day = $limit;
                $where .= '  AND published_time >= DATE_SUB(CURDATE(), INTERVAL ' . $limit_day . ' DAY) ';
                break;
            case 'ramdom':
                $order .= ' RAND(),';
                break;
            case 'newest':
                $order .= ' ordering DESC, created_time DESC, ';
                break;
            case 'show_in_homepage':
                $where .= '  AND show_in_home = 1 ';
                break;
            case 'is_hot':
                $where .= ' AND is_hot = 1';
                break;
            case 'is_new':
                $where .= ' AND is_new = 1';
                break;
            case 'is_sell':
                $where .= ' AND is_sell = 1';
                break;
            case 'related':
                if ($id && $module == 'products' && $view == 'product') {
                    $data = $this->get_record_by_id($id, $this->table_name, 'category_id');
                    if ($data) {
                        $where .= ' AND category_id_wrapper LIKE "%,' . $data->category_id . ',%" ';
                    }
                }
                break;
            case 'is_sale':
                $where .= ' AND is_sale = 1';
                break;
            case 'grid':
                $where .= '  AND is_view = 1 ';
                $order .= ' hits DESC , ';
                break;
        }
        $order .= ' ordering DESC , created_time DESC';
        $query = ' SELECT `name`,alias,image,summary,hits,id,category_alias,created_time,is_new,
                            discount,price,price_old,code,category_id,category_name,discount_unit
						  FROM ' . $this->table_name . '
						 WHERE  published = 1 ' . $where . '
						  ORDER BY  ' . $order . '
						 LIMIT ' . $limit;
        //print_r($query);
        return $query;
    }

    function get_list($str_cats, $ordering, $limit, $type)
    {
        global $db;
        $query = $this->setQuery($str_cats, $ordering, $limit, $type);
        if (!$query)
            return;
        $sql = $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function get_cats()
    {
        global $db;
        $query = ' SELECT id,name, alias, list_parents,image,level,parent_id
    					FROM ' . $this->table_categories . ' 
    					WHERE published = 1 AND show_in_homepage = 1
    					ORDER BY ordering
					';
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    /*
 * get record by rid
 */
    function get_record_by_id($id, $table_name = '', $select = '*')
    {
        if (!$id)
            return;
        if (!$table_name)
            $table_name = $this->table_name;
        $query = " SELECT " . $select . "
    					  FROM " . $table_name . "
    					  WHERE id = $id ";

        global $db;
        $sql = $db->query($query);
        $result = $db->getObject();
        return $result;
    }
}

?>