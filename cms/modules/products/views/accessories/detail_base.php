<table cellspacing="1" class="admintable">
<?php 

	TemplateHelper::dt_edit_text(FSText :: _('Name'),'name',@$data -> name);
	TemplateHelper::dt_edit_text(FSText :: _('Alias'),'alias',@$data -> alias,'',60,1,0,FSText::_("Can auto generate"));
	TemplateHelper::dt_edit_text(FSText :: _('Mã sản phẩm'),'code',@$data -> code);
	TemplateHelper::dt_edit_text(FSText :: _('Giá'),'price_old',@$data -> price_old,'',20,1,0);
	TemplateHelper::dt_edit_selectbox('Loại giảm giá','discount_unit',@$data -> discount_unit,0,array('percent'=>'Phần trăm','price'=>'Giá trị'),$field_value = '', $field_label='');
	TemplateHelper::dt_edit_text(FSText :: _('Giảm giá'),'discount',@$data -> discount,'',20,1,0);
	TemplateHelper::dt_edit_text(FSText :: _('Số lượng'),'quantity',@$data -> quantity,10,20,1,0);

	TemplateHelper::dt_sepa();
	if($data -> category_id)
	{
		$category_id = isset($data -> category_id)?$data -> category_id:$cid;
		TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',$category_id,0,$relate_categories,$field_value = 'id', $field_label='treename',$size = 1,0);
	}else{
		TemplateHelper::dt_edit_selectbox(FSText::_('Categories'),'category_id',@$data -> category_id,0,$categories,$field_value = 'id', $field_label='treename',$size = 10,0);
	}
	TemplateHelper::dt_edit_image(FSText :: _('Image'),'image',str_replace('/original/','/resized/',URL_ROOT.@$data->image));
	TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1);
	TemplateHelper::dt_edit_text(FSText :: _('Ordering'),'ordering',@$data -> ordering,@$maxOrdering,'20');
	TemplateHelper::dt_edit_text(FSText :: _('Summary'),'summary',@$data -> summary,'',60,3,0);
	TemplateHelper::dt_edit_text(FSText :: _('Mô tả'),'description',@$data -> description,'',650,450,1);
	TemplateHelper::dt_edit_text(FSText :: _('Tags'),'tags',@$data -> tags,'',100,2);
	TemplateHelper::dt_sepa();
	TemplateHelper::dt_edit_text(FSText :: _('SEO title'),'seo_title',@$data -> seo_title,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta keyword'),'seo_keyword',@$data -> seo_keyword,'',100,1);
	TemplateHelper::dt_edit_text(FSText :: _('SEO meta description'),'seo_description',@$data -> seo_description,'',100,9);
?>
</table>


