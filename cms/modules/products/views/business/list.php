<?php  
	global $toolbar;
	$toolbar->setTitle(FSText::_('Nhân viên') );
	$toolbar->addButton('duplicate',FSText :: _('Duplicate'),FSText :: _('You must select at least one record'),'duplicate.png');
	$toolbar->addButton('save_all',FSText :: _('Save'),'','save.png');
	$toolbar->addButton('add',FSText::_('Th&#234;m m&#7899;i'),'','add.png'); 
	$toolbar->addButton('edit',FSText::_('S&#7917;a'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'edit.png'); 
	$toolbar->addButton('remove',FSText::_('X&#243;a'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'remove.png'); 
	$toolbar->addButton('published',FSText::_('K&#237;ch ho&#7841;t'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'published.png');
	$toolbar->addButton('unpublished',FSText::_('Ng&#7915;ng k&#237;ch ho&#7841;t'),FSText::_('B&#7841;n ch&#432;a ch&#7885;n b&#7843;n ghi n&#224;o !'),'unpublished.png');
	//	FILTER
	$filter_config  = array();
	$fitler_config['search'] = 1;
	$fitler_config['filter_count'] = 1;

	$filter_products = array();
	$filter_products['title'] = FSText::_('Sản phẩm');
	$filter_products['list'] = @$products;
	$filter_products['field'] = 'name';

	$fitler_config['filter'][] = $filter_products;
//var_dump($products);
//echo 1;die;

	//	CONFIG	
	$list_config = array();
	
	$list_config[] = array('title'=>'Name','field'=>'name','ordering'=> 1, 'type'=>'text','col_width' => '15%','align'=>'left','arr_params'=>array('have_link_edit'=> 1));
//	$list_config[] = array('title'=>'Loại hỗ trợ','field'=>'khuvuc_name','ordering'=> 1, 'type'=>'text','col_width' => '20%','align'=>'left','arr_params'=>array('have_link_edit'=> 1));
	$list_config[] = array('title'=>'Số điện thoại','field'=>'phone','ordering'=> 1, 'type'=>'text','col_width' => '20%','align'=>'center','arr_params'=>array('have_link_edit'=> 1));
	$list_config[] = array('title'=>'Skype','field'=>'Skype','ordering'=> 1, 'type'=>'text','col_width' => '15%','align'=>'center','arr_params'=>array('have_link_edit'=> 1));
	$list_config[] = array('title'=>'Zalo','field'=>'Zalo','ordering'=> 1, 'type'=>'text','col_width' => '15%','align'=>'center','arr_params'=>array('have_link_edit'=> 1));
	// $list_config[] = array('title'=>'L/s đơn hàng','field'=>'id','type'=>'text','arr_params'=>array('function'=>'view_history'));
	$list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');
	//$list_config[] = array('title'=>'Home','field'=>'show_in_homepage','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'home'));
	$list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
	
	TemplateHelper::genarate_form_liting($this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>
