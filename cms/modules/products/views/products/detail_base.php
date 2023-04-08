<?php 
	$category_id = isset($data -> category_id)?$data -> category_id:$cid;

	TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',40,1,0,FSText::_("You must enter alias "));

	// TemplateHelper::dt_edit_text(FSText :: _('Mã'),'code',@$data -> code);
	TemplateHelper::dt_edit_text(FSText :: _('Giá'),'price_old',@$data -> price_old,'',60,1,0);
	TemplateHelper::dt_edit_selectbox('Loại giảm giá','discount_unit',@$data -> discount_unit,0,array('percent'=>'Phần trăm','price'=>'Giá trị'),$field_value = '', $field_label='');
	TemplateHelper::dt_edit_text(FSText :: _('Giảm giá'),'discount',@$data -> discount,'',60,1,0);
	
	TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',str_replace('/original/','/resized/',URL_ROOT.@$data->image));

	TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',$category_id,0,$relate_categories,$field_value = 'id', $field_label='treename',$size = 1,0);
	//if($use_manufactory){
//		TemplateHelper::dt_edit_selectbox(FSText::_('Thương hiệu'),'manufactory',@$data -> manufactory,0,$manufactories,$field_value = 'id', $field_label='name',$size = 1,0);
//	}
    
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
    TemplateHelper::dt_checkbox(FSText::_('Sản phảm mới'),'is_new',@$data -> is_new,0);
    TemplateHelper::dt_checkbox(FSText::_('Sản bán chạy'),'is_sell',@$data -> is_sell,0);
    //TemplateHelper::dt_edit_text(FSText :: _('Mã sản phẩm'),'code',@$data -> code);
    //TemplateHelper::dt_edit_text(FSText :: _('Bảo hành'),'guarantee',@$data -> guarantee);
    TemplateHelper::dt_edit_text(FSText :: _('Link video'),'link_video',@$data -> link_video);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering);
    //TemplateHelper::dt_edit_text(FSText :: _('Số lượng sản phẩm'),'quantity',@$data -> quantity);
	TemplateHelper::dt_edit_text(FSText :: _('Summary'),'summary',@$data -> summary,'',100,9);
    TemplateHelper::dt_edit_text(FSText :: _('Thông tin chi tiết'),'description',@$data -> description,'',650,450,1,'','','col-sm-2','col-sm-10');
//	TemplateHelper::dt_edit_text(FSText :: _('Driver'),'driver',@$data -> driver,'',650,450,1);
//	TemplateHelper::dt_edit_text(FSText :: _('Nhúng video'),'video',@$data -> video);
	//TemplateHelper::dt_edit_text(FSText :: _('Tags'),'tags',@$data -> tags,'',100,4);
?>
