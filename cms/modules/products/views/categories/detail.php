<!-- HEAD -->
<?php

$title = @$data ? FSText::_('Edit') : FSText::_('Add');
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('save_add', FSText:: _('Save and new'), '', 'save_add.png');
$toolbar->addButton('apply', FSText::_('Apply'), '', 'apply.png');
$toolbar->addButton('save', FSText::_('Save'), '', 'save.png');
$toolbar->addButton('cancel', FSText::_('Cancel'), '', 'cancel.png');

$this->dt_col_start('col-xs-12 col-md-8 connectedSortable', 1); // khối 1
echo ' 	<div class="alert alert-danger" style="display:none" >
                            <span id="msg_error"></span>
                    </div>';

// block
$this->dt_form_begin(1, 4, $title . ' ' . FSText::_('Lĩnh vực'), 'fa-edit', 1, 'col-md-12', 1);
TemplateHelper::dt_edit_text(FSText:: _('Name'), 'name', @$data->name);
TemplateHelper::dt_edit_text(FSText:: _('code'), 'code', @$data->code);
TemplateHelper::dt_edit_text(FSText:: _('link'), 'link', @$data->link);
TemplateHelper::dt_edit_text(FSText:: _('Alias'), 'alias', @$data->alias, '', 60, 1, 0, FSText::_("Can auto generate"));
TemplateHelper::dt_edit_selectbox(FSText::_('Parent'), 'parent_id', @$data->parent_id, '', $categories, $field_value = 'id', $field_label = 'treename', $size = 1, 0, 1);
// TemplateHelper::dt_checkbox(FSText::_('Kế thừa từ bảng cha'),'inheritance_perent_table',@$data -> inheritance_perent_table,0);
// TemplateHelper::dt_edit_selectbox(FSText::_('Tên bảng'), 'tablename', @$data->tablename, 'fs_products', $tables, $field_value = 'table_name', $field_label = 'table_name', $size = 1, 0, 1);
//TemplateHelper::dt_edit_image(FSText:: _('Image'), 'image', str_replace('/original/', '/resized/', URL_ROOT . @$data->image));
// block 2

$this->dt_form_end_col(); // END: col-1
// END block

$this->dt_form_begin(1, 2, FSText::_('Summary'), 'fa-star', 1, 'col-md-12');
TemplateHelper::dt_edit_text(FSText :: _(''),'summary',@$data -> summary,'',100,5,0);
$this->dt_form_end_col(); // END: col-1

$this->dt_col_end(); // show the dong </div>

$this->dt_col_start('col-xs-12 col-md-4 connectedSortable'); // khối 2

// block 1
$this->dt_form_begin(1, 2, FSText::_('Kích hoạt'), 'fa-unlock', 1, 'col-md-12');
TemplateHelper::dt_checkbox(FSText::_('Published'), 'published', @$data->published, 1);
TemplateHelper::dt_edit_text(FSText:: _('Ordering'), 'ordering', @$data->ordering, @$maxOrdering, '20');
$this->dt_form_end_col(); // END: col-1//

$this -> dt_form_begin(1,2,FSText::_('Cấu hình seo'),'',1,'col-md-4 fl-right');
TemplateHelper::dt_edit_text(FSText :: _('SEO title'),'seo_title',@$data -> seo_title,'',100,1,0,'','','col-md-12','col-md-12');
TemplateHelper::dt_edit_text(FSText :: _('SEO meta keyword'),'seo_keyword',@$data -> seo_keyword,'',100,1,0,'','','col-md-12','col-md-12');
TemplateHelper::dt_edit_text(FSText :: _('SEO meta description'),'seo_description',@$data -> seo_description,'',100,9,0,'','','col-md-12','col-md-12');
$this->dt_form_end_col(); // END: col-4

$this->dt_col_end(); // Thẻ đóng khối </div>

//	$this -> dt_form_end(@$data,1,1);
$this->dt_form_end(@$data, 1, 0, 2, 'Cấu hình seo', '', 1, 'col-sm-4');
?>
