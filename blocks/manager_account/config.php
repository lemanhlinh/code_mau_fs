<?php

$params = array(
    'suffix' => array(
        'name' => FSText::_('Hậu tố'),
        'type' => 'text',
        'default' => '_manager_account'
    ),
    'style' => array(
        'name' => 'Style',
        'type' => 'select',
        'value' => array(
            'default' => FSText::_('cá nhân'),
        )
    ),
    'contents_id' => array(
        'name' => 'Bài viết',
        'type' => 'select',
        'value' => get_contents(),
        'attr' => array('multiple' => 'multiple'),
    ),
);

function get_contents() {
    $fstable = FSFactory:: getClass('fstable');
    $table_name = $fstable->_('fs_contents');

    global $db;
    $query = ' SELECT title, id 
					FROM ' . $table_name . ' 
					';
    $sql = $db->query($query);
    $result = $db->getObjectList();
    if (!$result)
        return;
    $arr_group = array();
    foreach ($result as $item) {
        $arr_group[$item->id] = $item->title;
    }
    return $arr_group;
}

?>
