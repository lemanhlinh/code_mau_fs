<?php

include 'blocks/manager_account/models/manager_account.php';

class Manager_accountBControllersManager_account {

    function __construct() {
        
    }

    function display($parameters, $title) {
        global $user;
        $style = $parameters->getParams('style');
        $style = $style ? $style : 'default';
        $model = new Manager_accountBModelsManager_account();
        $contents_id = $parameters->getParams('contents_id');

        $id = FSInput::get('id', 0, 'int');
        $module = FSInput::get('module');

        if ($module == 'contents' && $id) {
            if (strpos(',' . $contents_id . ',', ',' . $id . ',') === false)
                return false;
        }


        include 'blocks/manager_account/views/manager_account/' . $style . '.php';
    }

    function get_count($where = '', $table_name = '', $select = '*') {
        if (!$where)
            return;
        if (!$table_name)
            $table_name = $this->table_name;
        $query = ' SELECT count(' . $select . ')
    					  FROM ' . $table_name . '
    					  WHERE ' . $where;

        global $db;
        $sql = $db->query($query);
        $result = $db->getResult();
        return $result;
    }

}

?>
