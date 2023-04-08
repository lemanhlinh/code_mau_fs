
<!-- HEAD -->
	<?php 
	
	$title = ''; 
	global $toolbar;
	$toolbar->setTitle($title);
	$toolbar->addButton('save_add',FSText :: _('Save and new'),'','save_add.png'); 
	$toolbar->addButton('apply',FSText::_('Apply'),'','apply.png'); 
	$toolbar->addButton('save',FSText::_('Save'),'','save.png'); 
	$toolbar->addButton('cancel',FSText::_('Cancel'),'','cancel.png'); 
    $this->dt_col_start('col-xs-12 col-md-12 connectedSortable', 1);  	
    $this -> dt_form_begin(1,4,$title.' '.FSText::_('Nhân viên'));
	TemplateHelper::dt_edit_text(FSText :: _('Tên nhân viên'),'name',@$data -> name);
//	TemplateHelper::dt_edit_selectbox(FSText::_('Khu vực'),'khuvuc',@$data -> khuvuc,0,$khuvuc,$field_value = 'id', $field_label='name',$size = 1,0);
    TemplateHelper::dt_edit_selectbox(FSText::_('Liên hệ'), 'lienhe', @$data->lienhe, 0, $lienhe, $field_value = 'id', $field_label = 'name', $size = 1, 1);
    TemplateHelper::dt_edit_selectbox(FSText::_('Liên hệ kinh doanh'), 'lienhe_kd', @$data->lienhe_kd, 0, $lienhe_kd, $field_value = 'id', $field_label = 'name', $size = 1, 1);
    TemplateHelper::dt_edit_selectbox(FSText::_('Liên hệ hỗ trợ kỹ thuật'), 'lienhe_kt', @$data->lienhe_kt, 0, $lienhe_kt, $field_value = 'id', $field_label = 'name', $size = 1, 1);
    TemplateHelper::dt_edit_selectbox(FSText::_('Liên hệ kinh doanh Miền Bắc'), 'lienhe_kdmb', @$data->lienhe_kdmb, 0, $lienhe_kdmb, $field_value = 'id', $field_label = 'name', $size = 1, 1);
    TemplateHelper::dt_edit_selectbox(FSText::_('Liên hệ kinh doanh Miền Nam'), 'lienhe_kdmn', @$data->lienhe_kdmn, 0, $lienhe_kdmn, $field_value = 'id', $field_label = 'name', $size = 1, 1);
	TemplateHelper::dt_edit_text(FSText :: _('Số điện thoại'),'phone',@$data -> phone);
	TemplateHelper::dt_edit_text(FSText :: _('Skype'),'Skype',@$data -> Skype);
	TemplateHelper::dt_edit_text(FSText :: _('Zalo'),'Zalo',@$data -> Zalo);
	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
//    TemplateHelper::dt_edit_selectbox(FSText::_('Sản phẩm'), 'products', @$data->products, 0, $products, $field_value = 'id', $field_label = 'name', $size = 1, 1);
	// TemplateHelper::dt_edit_text(FSText :: _('Mã'),'code',@$data -> code);
	//TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',URL_ROOT.@$data->image);

	// TemplateHelper::dt_edit_selectbox(FSText::_('Sử dụng cho các bảng'),'tablenames',@$data -> tablenames,0,$tables,'table_name','table_name',$size = 10,1,0,'Giữ phím Ctrl để chọn nhiều item');

	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
	
	// TemplateHelper::dt_edit_text(FSText :: _('Summary'),'summary',@$data -> summary,'',100,9);
	//TemplateHelper::dt_edit_text(FSText :: _('Content'),'content',@$data -> content,'',650,450,1);
	
	$this -> dt_form_end(@$data, 1, 0);
    $this->dt_form_end_col();
	?>
<!-- END HEAD-->
