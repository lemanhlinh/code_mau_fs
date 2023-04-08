<?php
//var_dump($data);
$title = @$data ? FSText:: _('Edit') : FSText:: _('Add');
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('save_add', FSText:: _('Save and new'), '', 'save_add.png');
$toolbar->addButton('apply', FSText:: _('Apply'), '', 'apply.png');
$toolbar->addButton('Save', FSText:: _('Save'), '', 'save.png');
$toolbar->addButton('back', FSText:: _('Cancel'), '', 'cancel.png');
$this->dt_col_start('col-xs-12 col-md-8 connectedSortable', 1); // khối 1
echo ' 	<div class="alert alert-danger" style="display:none" >
                            <span id="msg_error"></span>
                    </div>';

$this->dt_form_begin(1, 4, $title . ' ' . FSText::_('Sản phẩm'), 'fa-edit', 1, 'col-md-8', 1);
$category_id = isset($data->category_id) ? $data->category_id : $cid;

TemplateHelper::dt_edit_text(FSText:: _('Name'), 'name', @$data->name);
TemplateHelper::dt_edit_text(FSText:: _('Alias'), 'alias', @$data->alias, '', 40, 1, 0, FSText::_("Hệ thống tự động sinh "));
TemplateHelper::dt_edit_text(FSText:: _('Biệt danh'), 'code', @$data->code);
TemplateHelper::dt_edit_text(FSText:: _('Url ngôn ngữ khác'), 'other_languages1', @$data->other_languages1);
//TemplateHelper::dt_edit_text(FSText :: _('Mã sản phẩm'),'code',@$data -> code);
TemplateHelper::dt_edit_image(FSText:: _('Image'), 'image', str_replace('/original/', '/small/', URL_ROOT . @$data->image));
TemplateHelper::dt_edit_image(FSText:: _('Icon'), 'icon', str_replace('/original/', '/original/', URL_ROOT . @$data->icon));

TemplateHelper::dt_edit_selectbox(FSText::_('Lĩnh vực'), 'category_id', $category_id, 0, $categories, $field_value = 'id', $field_label = 'treename', $size = 1, 1);

TemplateHelper::dt_edit_selectbox(FSText::_('Hãng sản xuất'), 'manufactory', @$data->manufactory, 0, $manufactories, $field_value = 'id', $field_label = 'name', $size = 1, 0);
TemplateHelper::dt_edit_selectbox(FSText::_('Ứng dụng'), 'application', @$data->application, 0, $application, $field_value = 'id', $field_label = 'name', $size = 1, 1);
TemplateHelper::dt_edit_selectbox(FSText::_('Loại sản phẩm'), 'types', @$data->types, 0, $products_types, $field_value = 'id', $field_label = 'name', $size = 1, 0);
TemplateHelper::dt_edit_selectbox(FSText::_('Sản phẩm liên quan'), 'products_relates', @$data->products_relates, 0, $products_relates, $field_value = 'id', $field_label = 'name', $size = 1, 1);
TemplateHelper::dt_edit_selectbox(FSText::_('Loại email liên hệ'), 'email_contact', @$data->email_contact, 0, $email_contact, $field_value = 'id', $field_label = 'name', $size = 1, 0);
TemplateHelper::dt_edit_selectbox(FSText::_('Loại email download'), 'email_download', @$data->email_download, 0, $email_download, $field_value = 'id', $field_label = 'name', $size = 1, 0);
TemplateHelper::dt_edit_selectbox(FSText::_('Loại email đặt mua'), 'email_order', @$data->email_order, 0, $email_order, $field_value = 'id', $field_label = 'name', $size = 1, 0);
TemplateHelper::dt_edit_selectbox(FSText::_('Loại email tải báo giá'), 'email_catalogue', @$data->email_catalogue, 0, $email_catalogue, $field_value = 'id', $field_label = 'name', $size = 1, 0);
TemplateHelper::dt_edit_selectbox(FSText::_('Loại email tải khóa cứng'), 'email_driver', @$data->email_driver, 0, $email_driver, $field_value = 'id', $field_label = 'name', $size = 1, 0);
//if($use_manufactory){
//}
//TemplateHelper::dt_edit_text(FSText :: _('Bảo hành'),'guarantee',@$data -> guarantee);
//TemplateHelper::dt_edit_selectbox(FSText::_('Tỉnh/Thành phố'),'city_id',@$data -> city_id,0,$cities,$field_value = 'id', $field_label='name',$size = 1,0,1);
//TemplateHelper::dt_edit_selectbox(FSText::_('Quận/Huyện'),'district_id',@$data -> district_id,0,$district,$field_value = 'id', $field_label='name',$size = 1,0,1);

TemplateHelper::dt_edit_text(FSText:: _('Summary'), 'summary', @$data->summary, '', 100, 6);
TemplateHelper::dt_edit_text(FSText:: _('Tổng quan'), 'description', @$data->description, '', 650, 450, 1, '', '', 'col-sm-2', 'col-sm-12');
TemplateHelper::dt_edit_text(FSText:: _('Chi tiết tính năng'), 'feature_details', @$data->feature_details, '', 650, 450, 1, '', '', 'col-sm-2', 'col-sm-12');
TemplateHelper::dt_edit_text(FSText:: _('Video'), 'video', @$data->video, '', 650, 450, 1, '', '', 'col-sm-2', 'col-sm-12');
TemplateHelper::dt_edit_text(FSText:: _('Tawk_to'), 'tawk_to', @$data->tawk_to, '', 650, 450, 1, '', '', 'col-sm-2', 'col-sm-12');
$this->dt_form_end_col(); // END: col-1
//$this -> dt_form_begin(1,2,FSText::_('Summary'),'fa-info',1,'col-md-8 fl-right');
//TemplateHelper::dt_edit_text(FSText :: _(''),'summary',@$data -> summary,'',100,5,0,'','','col-sm-2','col-sm-12');
//TemplateHelper::dt_edit_text(FSText :: _('Thông tin chi tiết'),'description',@$data -> description,'',650,450,1,'','','col-sm-2','col-sm-12');
//$this->dt_form_end_col(); // END: col-4

$this->dt_form_begin(1, 2, FSText::_('Ảnh slide'), 'fa-image', 1, 'col-md-4 fl-right');
TemplateHelper::dt_edit_image2(FSText:: _('Image'), 'image', str_replace('/original/', '/small/', URL_ROOT . @$data->image), '', '', '', 1);
$this->dt_form_end_col(); // END: col-3
$this->dt_form_begin(1, 2, FSText::_('Tags'), 'fa-tags', 1, 'col-md-4 fl-right');
TemplateHelper::dt_edit_text(FSText:: _(''), 'tags', @$data->tags, '', 100, 4, 0, '', '', 'col-sm-2', 'col-sm-12');
//TemplateHelper::dt_edit_text(FSText :: _('Thông tin chi tiết'),'description',@$data -> description,'',650,450,1,'','','col-sm-2','col-sm-12');
$this->dt_form_end_col();
$this->dt_form_begin();
TemplateHelper::dt_edit_text(FSText:: _('File báo giá'), 'file_catalogue', @$data->file_catalogue);
TemplateHelper::dt_edit_file(FSText:: _('File báo giá'), 'file_price', @$data->file_price);
TemplateHelper::dt_edit_text(FSText:: _('Link báo giá'), 'link_catalogue', @$data->link_catalogue);
$this->dt_form_end_col();
$this->dt_form_begin();

TemplateHelper::dt_edit_text(FSText:: _('File khóa cứng'), 'file_driver_name', @$data->file_driver_name);
TemplateHelper::dt_edit_file(FSText:: _('File khóa cứng'), 'file_driver', @$data->file_driver);
TemplateHelper::dt_edit_text(FSText:: _('Link khóa cứng'), 'link_driver', @$data->link_driver);
$this->dt_form_end_col();

//file1
$this->dt_form_begin();

TemplateHelper::dt_edit_text(FSText:: _('Ghi chú file 1'), 'file_name1', @$data->file_name1);
TemplateHelper::dt_edit_file(FSText:: _('File 1'), 'file_download1', @$data->file_download1);
TemplateHelper::dt_edit_text(FSText:: _('Link file 1'), 'link_download1', @$data->link_download1);
$this->dt_form_end_col();

//file2
$this->dt_form_begin();

TemplateHelper::dt_edit_text(FSText:: _('Ghi chú file 2'), 'file_name2', @$data->file_name2);
TemplateHelper::dt_edit_file(FSText:: _('File 2'), 'file_download2', @$data->file_download2);
TemplateHelper::dt_edit_text(FSText:: _('Link file 2'), 'link_download2', @$data->link_download2);
$this->dt_form_end_col();

//file3
$this->dt_form_begin();
TemplateHelper::dt_edit_text(FSText:: _('Ghi chú file 3'), 'file_name3', @$data->file_name3);
TemplateHelper::dt_edit_file(FSText:: _('File 3'), 'file_download3', @$data->file_download3);
TemplateHelper::dt_edit_text(FSText:: _('Link file 3'), 'link_download3', @$data->link_download3);
$this->dt_form_end_col();

//file4
$this->dt_form_begin();

TemplateHelper::dt_edit_text(FSText:: _('Ghi chú file 4'), 'file_name4', @$data->file_name4);
TemplateHelper::dt_edit_file(FSText:: _('File 4'), 'file_download4', @$data->file_download4);
TemplateHelper::dt_edit_text(FSText:: _('Link file 4'), 'link_download4', @$data->link_download4);
$this->dt_form_end_col();

//file5
$this->dt_form_begin();

TemplateHelper::dt_edit_text(FSText:: _('Ghi chú file 5'), 'file_name5', @$data->file_name5);
TemplateHelper::dt_edit_file(FSText:: _('File 5'), 'file_download5', @$data->file_download5);
TemplateHelper::dt_edit_text(FSText:: _('Link file 5'), 'link_download5', @$data->link_download5);
$this->dt_form_end_col();

//file6
$this->dt_form_begin();

TemplateHelper::dt_edit_text(FSText:: _('Ghi chú file 6'), 'file_name6', @$data->file_name6);
TemplateHelper::dt_edit_file(FSText:: _('File 6'), 'file_download6', @$data->file_download6);
TemplateHelper::dt_edit_text(FSText:: _('Link file 6'), 'link_download6', @$data->link_download6);
//$this->dt_form_end_col();


//TemplateHelper::dt_edit_file(FSText:: _('File đầy đủ'), 'file_full', @$data->file_full);

//TemplateHelper::dt_edit_file(FSText:: _('File dùng thử'), 'file_demo', @$data->file_demo);
$this->dt_form_end_col(); // END: col-4

//$this -> dt_form_begin(1,4,FSText::_('Sản phẩm liên quan'),'fa fa-briefcase',1,'col-md-8');
//        include 'detail_related.php';
//    $this->dt_form_end_col(); // END: col-4

$this->dt_col_end(); // show the dong </div>

$this->dt_col_start('col-xs-12 col-md-4 connectedSortable'); // khối 2

$this->dt_form_begin(1, 2, FSText::_('Giá'), 'fa-dollar', 1, 'col-md-4');
TemplateHelper::dt_edit_text(FSText:: _('Giá'), 'price_old', @$data->price_old, '', 60, 1, 0, '', '', 'col-sm-4', 'col-sm-8');
// TemplateHelper::dt_edit_selectbox('Loại giảm giá','discount_unit',@$data -> discount_unit,0,array('percent'=>'Phần trăm','price'=>'Giá trị'),$field_value = '', $field_label='','','','','','','','col-sm-4','col-sm-8');
// TemplateHelper::dt_edit_text(FSText :: _('Giảm giá'),'discount',@$data -> discount,'',60,1,0,'','','col-sm-4','col-sm-8');
$this->dt_form_end_col(); // END: col-2

// $this -> dt_form_begin(1,2,FSText::_('Kích hoạt'),'fa-unlock',1,'col-md-4 fl-right');
// TemplateHelper::dt_checkbox(FSText::_('Published'),'published',@$data -> published,1,'','','','col-sm-4','col-sm-8');
//TemplateHelper::dt_checkbox(FSText::_('Tình trạng'),'is_status',@$data -> is_status,1,array(1 => FSText :: _('Còn hàng'), 0 => FSText :: _('Hết hàng' )),'','','col-sm-4','col-sm-8');
TemplateHelper::dt_checkbox(FSText::_('Sản phẩm tiêu biểu'), 'is_hot', @$data->is_hot, 0, '', '', '', 'col-sm-4', 'col-sm-8');
TemplateHelper::dt_checkbox(FSText::_('Link teamview'), 'teamview', @$data->teamview, 0, '', '', '', 'col-sm-4', 'col-sm-8');
// TemplateHelper::dt_checkbox(FSText::_('Sản phẩm khuyến mại'),'is_sale',@$data -> is_sale,0,'','','','col-sm-4','col-sm-8');
// TemplateHelper::dt_checkbox(FSText::_('Sản phẩm mới'),'is_new',@$data -> is_new,0,'','','','col-sm-4','col-sm-6');
// TemplateHelper::dt_checkbox(FSText::_('Sản phẩm bán chạy'),'is_sell',@$data -> is_sell,0,'','','','col-sm-4','col-sm-6');
// TemplateHelper::dt_checkbox(FSText::_('Còn hàng'),'is_status',@$data -> is_status,1,'','','','col-sm-4','col-sm-6');
TemplateHelper::dt_edit_text(FSText:: _('Ordering'), 'ordering', @$data->ordering, @$maxOrdering, '', '', 0, '', '', 'col-sm-4', 'col-sm-8');
TemplateHelper::dt_edit_text(FSText:: _('Landing page'), 'landing_page', @$data->landing_page);
//TemplateHelper::dt_edit_text(FSText:: _('Tawk.to'), 'landing_page', @$data->landing_page);
$this->dt_form_end_col(); // END: col-2

 $this -> dt_form_begin(1,2,FSText::_('Cấu hình seo'),'',1,'col-md-4 fl-right');
 TemplateHelper::dt_edit_text(FSText :: _('SEO title'),'seo_title',@$data -> seo_title,'',100,1,0,'','','col-md-12','col-md-12');
 TemplateHelper::dt_edit_text(FSText :: _('SEO meta keyword'),'seo_keyword',@$data -> seo_keyword,'',100,1,0,'','','col-md-12','col-md-12');
 TemplateHelper::dt_edit_text(FSText :: _('SEO meta description'),'seo_description',@$data -> seo_description,'',100,9,0,'','','col-md-12','col-md-12');
 $this->dt_form_end_col(); // END: col-4

$this->dt_col_end(); // Thẻ đóng khối </div>
$this->dt_form_end(@$data, 1, 0, 2, 'Cấu hình seo', '', 1, 'col-sm-4');
?>

<!--<script  type="text/javascript" language="javascript">
$(function(){
	$("select#city_id").change(function(){
		$.ajax({url: "index.php?module=products&view=products&task=ajax_get_product_district&raw=1",
			 data: {cid: $(this).val()},
			  dataType: "text",
			  success: function(text) {
			    j = eval("(" + text + ")");
			    var options = '';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id + '">' + j[i].name + '</option>';
				}
				$("#district_id").html(options);
				$('#district_id option:first').attr('selected', 'selected');
                $("#district_id").trigger("chosen:updated");
			  }
		});
	});
});
</script>-->
