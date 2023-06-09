<?php  
	global $toolbar;
	$toolbar->setTitle(FSText :: _('User list') );
	$toolbar->addButton('add',FSText :: _('Add'),'','fa-plus-square'); 
	//$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
	$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'fa-remove'); 
	$toolbar->addButton('published',FSText :: _('Published'),FSText :: _('You must select at least one record'),'fa-check-square');
	$toolbar->addButton('unpublished',FSText :: _('Unpublished'),FSText :: _('You must select at least one record'),'fa-pause');
    
    $filter_config  = array();
	$fitler_config['search'] = 1; 
	$fitler_config['filter_count'] = 0;
    
    $list_config[] = array('title'=>'Username','field'=>'username', 'type'=>'text','col_width' => '20%','align'=>'left');
    //$list_config[] = array('title'=>'Image','field'=>'image','type'=>'image','arr_params'=>array('search'=>'/original/','replace'=>'/small/','width'=>'30'));
    $list_config[] = array('title'=>'Email','field'=>'email', 'type'=>'text','col_width' => '20%','align'=>'left');
    $list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');
	$list_config[] = array('title'=>'Phân quyền','type'=>'view','module'=>'users','view'=>'users','task'=>'permission','field_value'=>'cid');
    $list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
    
    TemplateHelper::genarate_form_liting($this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>