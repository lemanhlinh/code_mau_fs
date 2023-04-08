<?php  
	global $toolbar;
	$toolbar->setTitle(FSText :: _('Products') );
	$toolbar->addButton('duplicate',FSText :: _('Duplicate'),FSText :: _('You must select at least one record'),'duplicate.png');
	$toolbar->addButton('save_all',FSText :: _('Save'),'','save.png'); 
	$toolbar->addButton('add',FSText :: _('Add'),'','add.png'); 
	$toolbar->addButton('edit',FSText :: _('Edit'),FSText :: _('You must select at least one record'),'edit.png'); 
	$toolbar->addButton('remove',FSText :: _('Remove'),FSText :: _('You must select at least one record'),'remove.png'); 
	$toolbar->addButton('published',FSText :: _('Published'),FSText :: _('You must select at least one record'),'published.png');
	$toolbar->addButton('unpublished',FSText :: _('Unpublished'),FSText :: _('You must select at least one record'),'unpublished.png');
	$toolbar->addButton('export',FSText :: _('Export'),'','Excel-icon.png');
	
	//	FILTER
	$filter_config  = array();
	$fitler_config['search'] = 1; 
	$fitler_config['filter_count'] = 4;
	
	$filter_categories = array();
	$filter_categories['title'] = FSText::_('Categories'); 
	$filter_categories['list'] = @$categories; 
	$filter_categories['field'] = 'treename'; 
	
	//Loại sản phẩm
	$filter_type = array();
	$filter_type['title'] = FSText::_('Loại sản phẩm'); 
	$filter_type['list'] = @$type;
	
	//Loại sản phẩm
	$filter_manu = array();
	$filter_manu['title'] = FSText::_('Hãng sản xuất'); 
	$filter_manu['list'] = @$manufactories;
	 
	//SP tiêu biểu
	$filter_hot = array();
	$filter_hot['title'] = FSText::_('SP tiêu biểu'); 
	$filter_hot['list'] = array(1=>'Có',2=>'Không'); 
	
	$fitler_config['filter'][] = $filter_categories;	
	$fitler_config['filter'][] = $filter_type;																																																																																																																																																																																																																																																																																																																																																																																																																							
	$fitler_config['filter'][] = $filter_hot;		
	$fitler_config['filter'][] = $filter_manu;																																																																																																																																																																																																																																																																																																																																																																																																																						
	//	CONFIG	
	$list_config = array();
	$list_config[] = array('title'=>'Tên','field'=>'name','ordering'=> 1, 'type'=>'edit_text','col_width' => '30%','arr_params'=>array('size'=> 40));
	$list_config[] = array('title'=>'Image','field'=>'image','type'=>'image','no_col'=>1,'arr_params'=>array('search'=>'/original/','replace'=>'/resized/'));
//	$list_config[] = array('title'=>'Giá','field'=>'price','ordering'=> 1, 'type'=>'text','col_width' => '10%','arr_params'=>array('function'=>'format_money'));
	$list_config[] = array('title'=>'Giá','type'=>'label');
	$list_config[] = array('title'=>'Giá gốc','field'=>'price_old','no_col'=>3, 'type'=>'edit_text','display_label'=>1,'arr_params'=>array('size'=>10));
	$list_config[] = array('title'=>'Giảm giá','field'=>'discount','no_col'=>3, 'type'=>'edit_text','display_label'=>1,'arr_params'=>array('size'=>10));
	$list_config[] = array('title'=>'Loại giảm giá','field'=>'discount_unit','no_col'=>3, 'type'=>'edit_selectbox','display_label'=>1,'arr_params'=>array('arry_select'=>array('percent'=>'Phần trăm','price'=>'Giá trị')));
//	$list_config[] = array('title'=>'Summary','field'=>'summary','type'=>'text','col_width' => '30%','arr_params'=>array('size'=>50,'rows'=>8));
	$list_config[] = array('title'=>'Category','field'=>'category_name','ordering'=> 1, 'type'=>'text','col_width' => '20%');
	$list_config[] = array('title'=>'Tổng view','field'=>'hits','ordering'=> 1, 'type'=>'text');
	$list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'edit_text','arr_params'=>array('size'=>3));
//	$list_config[] = array('title'=>'Home','field'=>'show_in_home','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'home'));
	$list_config[] = array('title'=>'Published','field'=>'published','ordering'=> 1, 'type'=>'published');
//	$list_config[] = array('title'=>'SP hot','field'=>'is_hot','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_hot'));
	$list_config[] = array('title'=>'SP mới','field'=>'is_new','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_new'));
	$list_config[] = array('title'=>'SP bán chạy','field'=>'is_sell','ordering'=> 1, 'type'=>'change_status','col_width' => '6%','arr_params'=>array('function'=>'is_sell'));
//	$list_config[] = array('title'=>'SP cũ','field'=>'is_old','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_old'));

	$list_config[] = array('title'=>'Edit','type'=>'edit');
	$list_config[] = array('title'=>'Created time','field'=>'created_time','ordering'=> 1, 'type'=>'datetime');
	$list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text');
	
	TemplateHelper::genarate_form_liting($this->module,$this -> view,$list,$fitler_config,$list_config,$sort_field,$sort_direct,$pagination);
?>
<style>
.filter_area select{
	width: 120px;
}
</style>

