<?php

class SearchModelsSearch extends FSModels
{
    var $limit;
    var $page;

    function __construct()
    {
        $page = FSInput::get('page');
        $this->page = $page;
        $limit = 30;
        $this->limit = $limit;
    }


    /* return query run
     * get products list in category list.
     * These categories is Children of category_current
     */
    function set_query_body($cat_id = 0)
    {
        global $db;
        $keyword = FSInput::get('keyword');
        if (!$keyword)
            return;
        $keyword = $db->escape_string($keyword);
        $where = "";
        $where .= " AND name like '%" . $keyword . "%' or summary like '%" . $keyword . "%' ";
        if ($cat_id)
            $where .= " AND category_id_wrapper like '%," . $cat_id . ",%' ";

        $fs_table = FSFactory::getClass('fstable');
        $sql = "	SELECT `name`,alias,image,summary,hits,id,category_alias,created_time,is_new,icon,
                            discount,price,price_old,code,category_id,category_name,discount_unit,landing_page
					    FROM " . $fs_table->getTable('fs_products') . "
						WHERE published = 1 " . $where;
//			 echo $sql.'<br />';
        return $sql;

    }

    /* return query run
         * get products list in category list.
         * These categories is Children of category_current
         */
    function set_new_query_body()
    {
        global $db;
        $keyword = FSInput::get('keyword');
        if (!$keyword)
            return;

        $keyword = $db->escape_string($keyword);
        $fs_table = FSFactory::getClass('fstable');
        $where = "";

        $where .= " AND ( title like '%" . $keyword . "%' OR tags like '%" . $keyword . "%' ) ";
        $sql = "	SELECT id,title,summary,image, created_time,category_id, category_alias, alias,comments_total,comments_published
						FROM " . $fs_table->getTable('fs_news') . "
						WHERE published = 1 " .
            $where."order by created_time DESC , ordering DESC ";
        return $sql;

    }

    function get_list($query_body)
    {
        if (!$query_body)
            return;
//        $query_ordering = $this->set_query_order_by();
        $query = $query_body;
//        $query .= $query_ordering;
        global $db;
        $sql = $db->query_limit($query, $this->limit, $this->page);
        $result = $db->getObjectList();
        return $result;
    }

    /*
         * Insert order by into query select
         */
    function set_query_order_by()
    {
        $order = FSInput::get('order');
        $query_ordering = '';
        if ($order) {
            switch ($order) {
                case 'asc':
                    $query_ordering = 'ORDER BY price ' . $order;
                    break;
                case 'desc':
                    $query_ordering = 'ORDER BY price ' . $order;
                    break;
                case 'old':
                    $query_ordering = 'ORDER BY status ASC';
                    break;
                case 'new':
                    $query_ordering = 'ORDER BY status DESC';
                    break;
                case 'alpha':
                    $query_ordering = 'ORDER BY name asc';
                    break;
                case 'promotion':
                    $query_ordering = 'ORDER BY is_promotion asc';
                    break;
            }
        } else {
            $query_ordering = 'ORDER BY  ordering DESC,created_time DESC, id DESC ';
        }

        return $query_ordering;
    }

    function getTotal($query_body)
    {
        global $db;
//			$query = "SELECT count(*) ";
        $query = $query_body;
        $db->query($query);
        $result = $db->getObjectList();
//			$total = $db->getResult();
        return count($result);
    }

    function getPagination($total)
    {
        FSFactory::include_class('Pagination');
        $pagination = new Pagination ($this->limit, $total, $this->page);
        return $pagination;
    }

    function getLoadmore($total)
    {
        FSFactory::include_class('Loadmore');
        $loadmore = new Loadmore ($this->limit, $total, $this->page);
        return $loadmore;
    }

    function get_types()
    {
        return $list = $this->get_records('published = 1', 'fs_products_types', 'id,name,image,alias', 'ordering ASC');
    }

    /*
     * select cat list is children of catid
     */
    function getCats()
    {
        global $db;
        $query = " SELECT id,name, alias,tags_group,tablename,root_id, list_parents,image,level,parent_id
					FROM fs_products_categories
					WHERE 
						published = 1
					ORDER BY ordering
							";
        $db->query($query);
        $list = $db->getObjectList();

        return $list;
    }
}