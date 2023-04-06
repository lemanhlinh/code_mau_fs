<?php 
//module_view_task
$config_module['field_field'] = array(
	// Các trường hỗ trợ cho lấy SEO TITLE
	'fields_seo_title' => 
		array('fields'=>	array('seo_title'=>'Seo Title','title'=>'Tên','category_name'=>'Tiêu đề danh mục'),
				'help'=> 'Cấu hình cho Seo Title. AND: có lấy trường này. OR: Nếu trước nó có rồi thì ko lấy tới nó nữa'
		),
	'fields_seo_keyword'=> 
		array('fields'=> array('seo_keyword'=>'Seo Keyword','title'=>'Tên','tags'=>'Tag '),
				'help'=> 'Cấu hình cho Seo Title. AND: có lấy trường này. OR: Nếu trước nó có rồi thì ko lấy tới nó nữa'
		),
	'fields_seo_description' => 
		array('fields'=> array('seo_description'=>'Seo Description','title'=>'Tên','summary'=>'Mô tả'),
			'help'=> 'Cấu hình cho thẻ Meta keywword. AND: có lấy trường này. OR: Nếu trước nó có rồi thì ko lấy tới nó nữa'
		)	
);

$config_module['field_home'] = array(
    // Thông số này giúp cho các trang không nhập được  SEO như trang "trang chủ sp, trang chủ tin tức,...)
    'seo_special' => 1,
//    'params' => array (
//        'limit' => array(
//            'name' => 'Giới hạn',
//            'type' => 'text',
//            'default' => '6'
//        )
//    )
);


?>