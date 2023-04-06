<?php
$params = array(
    'suffix' => array(
        'name' => 'Hậu tố',
        'type' => 'text',
        'default' => '_products_list'
    ),
    'limit' => array(
        'name' => 'Giới hạn',
        'type' => 'text',
        'default' => '6'
    ),
    'type' => array(
        'name' => 'Lấy theo',
        'type' => 'select',
        'value' => array(
            'is_sell' => 'Sản phẩm bán chạy',
            'is_sale' => 'Sản phẩm khuyến mại',
            'ramdom' => 'Sản phẩm ramdom',
        ),
    ),
    'style' => array(
        'name' => 'Style',
        'type' => 'select',
        'value' => array(
            'default' => 'Mặc định',
            'home' => 'Sản phẩm bán chạy'
        )
    ),
    'category_id' => array(
        'name' => 'Nhóm danh mục',
        'type' => 'select',
        'value' => get_category(),
        'attr' => array('multiple' => 'multiple'),
    ),

);
function get_category()
{
    global $db;
    $query = " SELECT name, id 
						FROM fs_products_categories 
						";
    $sql = $db->query($query);
    $result = $db->getObjectList();
    if (!$result)
        return;
    $arr_group = array();
    foreach ($result as $item) {
        $arr_group[$item->id] = $item->name;
    }
    return $arr_group;
}