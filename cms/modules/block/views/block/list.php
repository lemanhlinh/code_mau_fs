<?php  
	global $toolbar;
	$toolbar->setTitle(FSText :: _('Danh sách các  block hiển thị') );
    $toolbar->addButton('save_all',FSText :: _('Save'),'','fa-save'); 
	$toolbar->addButton('add',FSText :: _('Add'),'','fa-plus-square'); 
	//$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
	$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'fa-remove'); 
	$toolbar->addButton('published',FSText :: _('Published'),FSText :: _('You must select at least one record'),'fa-check-square');
	$toolbar->addButton('unpublished',FSText :: _('Unpublished'),FSText :: _('You must select at least one record'),'fa-pause');
    //	FILTER
	$filter_config  = array();
	$fitler_config['search'] = 1; 
	$fitler_config['filter_count'] = 2;

	$filter_listmoduletype = array();
	$filter_listmoduletype['title'] = FSText::_('type'); 
	$filter_listmoduletype['list'] = @$listmoduletype; 
	$filter_listmoduletype['field'] = 'name'; 
    
    $filter_position = array();
	$filter_position['title'] = FSText::_('position'); 
	$filter_position['list'] = @$positions; 
	$filter_position['field'] = 'name'; 
    
	
	$fitler_config['filter'][] = $filter_listmoduletype;
    $fitler_config['filter'][] = $filter_position;																																																																																																																																																																																																																																																																																																																																																																																																																								
	//	CONFIG
	
    $list_config[] = array('title'=>'Title','field'=>'title', 'type'=>'text','col_width' => '20%','align'=>'left');
	$list_config[] = array('title'=>'Loại','field'=>'module', 'type'=>'text','col_width' => '20%','align'=>'left');
    $list_config[] = array('title'=>'Position','field'=>'position', 'type'=>'text','col_width' => '20%','align'=>'left');
	//$list_config[] = array('title'=>'Group','field'=>'group_name','ordering'=> 1, 'type'=>'text','col_width' => '10%');
	$list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');
	$list_config[] = array('title'=>'Edit','type'=>'edit','field_value'=>'id');
	//$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
    
    TemplateHelper::genarate_form_liting($this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>

