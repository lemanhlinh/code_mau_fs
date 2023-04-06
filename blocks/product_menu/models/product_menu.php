<?php

class Product_menuBModelsProduct_menu
{
    function __construct()
    {
        $fstable = FSFactory::getClass('fstable');
        $this->table_name = $fstable->_('fs_products');
        $this->table_categories = $fstable->_('fs_products_categories');
    }

    function getListCat()
    {
        $query = ' SELECT `name`,alias,id,`level`,parent_id as parent_id,alias, list_parents,icon ,image,icon
						  FROM ' . $this->table_categories . ' AS a
						  WHERE published = 1
						  ORDER BY ordering ASC
					 ';
        global $db;
        $db->query($query);
        $category_list = $db->getObjectList();

        if (!$category_list)
            return;
        $tree_class = FSFactory::getClass('tree', 'tree/');
        return $list = $tree_class->indentRows($category_list, 3);
    }
}