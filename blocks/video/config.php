<?php 
	$params = array (
		'suffix' => array(
					'name' => 'Hậu tố',
					'type' => 'text',
					'default' => '_video'
		),
		'style' => array(
					'name'=>'Style',
					'type' => 'select',
					'value' => array(
                                    'default' => 'Mặc định',
                                    'hot' => 'Video nổi bật',
                                    //'home'=>'Video trang chủ'
                                    )
		),
        'limit' => array(
					'name' => 'Giới hạn',
					'type' => 'text',
					'default' => '6'
		),    
        'type' => array(
					'name'=>'Lấy theo',
					'type' => 'select',
					'value' => array(
                                    'time'=> 'Mới nhất',
                                    'ordering'=>'Thứ tự',
                                    'is_hot'=>'Video nổi bật',
                                    //'show_in_homepage'=>'Show trang chủ'
                                    ),
//					'attr' => array('multiple' => 'multiple'),
		),   
	);
?>