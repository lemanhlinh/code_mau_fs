<link type="text/css" rel="stylesheet" media="all" href="../libraries/jquery/jquery.ui/jquery-ui.css"/>
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>
<?php
$title = @$data ? FSText:: _('Edit') : FSText:: _('Add');
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('save_add', FSText:: _('Save and new'), '', '', 1);
$toolbar->addButton('apply', FSText:: _('Apply'), '', '', 1);
$toolbar->addButton('save', FSText:: _('Save'), '', '', 1);
$toolbar->addButton('back', FSText:: _('Cancel'), '', '');

$this->dt_col_start('col-xs-12 col-md-8 connectedSortable', 1);
echo ' 	<div class="alert alert-danger alert-dismissible" style="display:none" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <span id="msg_error"></span>
                </div>';
//$this -> dt_form_begin(1,4,$title.' '.FSText::_('News'));
$this->dt_form_begin(1, 4, $title . ' ' . FSText::_('News'), 'fa-edit', 1, 'col-md-8', 1);
TemplateHelper::dt_edit_text(FSText:: _('Tiêu đề tin'), 'title', @$data->title);
TemplateHelper::dt_edit_text(FSText:: _('Alias'), 'alias', @$data->alias, '', 60, 1, 0, FSText::_("Can auto generate"));

TemplateHelper::dt_edit_selectbox(FSText::_('Categories'), 'category_id', @$data->category_id, 0, $categories, $field_value = 'id', $field_label = 'treename', $size = 10, 0, 1);
TemplateHelper::dt_edit_text(FSText:: _('Ordering'), 'ordering', @$data->ordering, @$maxOrdering);
TemplateHelper::dt_edit_image(FSText:: _('Hình ảnh'), 'image', str_replace('/original/', '/small/', URL_ROOT . @$data->image));
$this->dt_form_end_col();
//$this->dt_form_begin();
//TemplateHelper::dt_edit_file(FSText:: _('File upload'), 'file_upload', @$data->file_upload);
//
//$this->dt_form_end_col();

$this->dt_form_begin(1, 2, FSText::_('Tags'), 'fa-tags', 1, 'col-md-4 fl-right');
TemplateHelper::dt_edit_text(FSText:: _(''), 'tags', @$data->tags, '', 100, 4, 0, '', '', 'col-sm-2', 'col-sm-12');

//TemplateHelper::dt_edit_text(FSText :: _('Link video'),'video',@$data -> video,'',100,1,0,'','','col-sm-3','col-sm-9');

$this->dt_form_end_col(); // END: col-1

$this->dt_form_begin(1, 4, FSText::_('Content'), 'fa-info', 1, 'col-md-8');
TemplateHelper::dt_edit_text(FSText:: _(''), 'content', @$data->content, '', 650, 450, 1, '', '', 'col-sm-2', 'col-sm-12');
$this->dt_form_end_col(); // END: col-4

$this->dt_col_end();
$this->dt_col_start('col-xs-12 col-md-4 connectedSortable');
$this->dt_form_begin(1, 2, FSText::_('Quản trị'), 'fa-user', 1, 'col-md-4 fl-right');
TemplateHelper::dt_text(FSText:: _('Người tạo'), @$data->author);
//TemplateHelper::dt_text(FSText :: _('Thời gian'),date('H:i:s d/m/Y',strtotime(@$data -> start_time)));
TemplateHelper::dt_text(FSText:: _('Người sửa cuối'), @$data->author_last);
//TemplateHelper::dt_text(FSText :: _('Thời gian sửa'),date('H:i:s d/m/Y',strtotime(@$data -> end_time)));
$this->dt_form_end_col(); // END: col-4

$this->dt_form_begin(1, 2, FSText::_('Kích hoạt'), 'fa-unlock', 1, 'col-md-4 fl-right');
TemplateHelper::dt_checkbox(FSText::_('Published'), 'published', @$data->published, 1, '', '', '', 'col-sm-4', 'col-sm-8');
TemplateHelper::dt_checkbox(FSText::_('Tin nổi bật'), 'is_hot', @$data->is_hot, 0, '', '', '', 'col-sm-4', 'col-sm-8');
TemplateHelper::dt_checkbox(FSText::_('Hiển thị trang chủ'), 'show_in_homepage', @$data->show_in_homepage, 0, '', '', '', 'col-sm-4', 'col-sm-8');

TemplateHelper::datetimepicke(FSText:: _('Published time'), 'created_time', @$data->created_time ? @$data->created_time : date('Y-m-d H:i:s'), '', 20, FSText:: _('Bạn vui lòng chọn thời gian hiển thị'), 'col-md-3', 'col-md-4');
$this->dt_form_end_col(); // END: col-2

$this->dt_form_begin(1, 2, FSText::_('Summary'), 'fa-info', 1, 'col-md-4');
TemplateHelper::dt_edit_text(FSText:: _(''), 'summary', @$data->summary, '', 100, 5, 0, '', '', 'col-sm-2', 'col-sm-12');
//TemplateHelper::dt_edit_text(FSText :: _('Thông tin chi tiết'),'description',@$data -> description,'',650,450,1,'','','col-sm-2','col-sm-12');
$this->dt_form_end_col(); // END: col-4

$this->dt_form_begin(1, 2, FSText::_('Cấu hình seo'), '', 1, 'col-md-4');
TemplateHelper::dt_edit_text(FSText:: _('SEO title'), 'seo_title', @$data->seo_title, '', 100, 1, 0, '', '', 'col-md-12', 'col-md-12');
TemplateHelper::dt_edit_text(FSText:: _('SEO meta keyword'), 'seo_keyword', @$data->seo_keyword, '', 100, 1, 0, '', '', 'col-md-12', 'col-md-12');
TemplateHelper::dt_edit_text(FSText:: _('SEO meta description'), 'seo_description', @$data->seo_description, '', 100, 7, 0, '', '', 'col-md-12', 'col-md-12');
$this->dt_form_end_col(); // END: col-4

$this->dt_col_end(); // show the dong </div>
//$this -> dt_form_end(@$data,1,0,2,'Cấu hình seo');
$this->dt_form_end(@$data, 1, 0, 2, 'Cấu hình seo', '', 1, 'col-sm-4');
?>
<script type="text/javascript">
    $('.form-horizontal').keypress(function (e) {
        if (e.which == 13) {
            formValidator();
            return false;
        }
    });

    function formValidator() {
        $('.alert-danger').show();

        if (!notEmpty('title', 'Bạn phải nhập tiêu đề'))
            return false;

        // if (!lengthMaxword('title', 10, 'Mỗi từ tối đa có 10 ký tự'))
        //     return false;

        // if (!notEmpty('image', 'bạn phải nhập hình ảnh'))
        //     return false;

        if (!notEmpty('category_id', 'Bạn phải chọn danh mục'))
            return false;

        // if (!notEmpty('summary', 'Bạn phải nhập nội dung mô tả'))
        //     return false;

        // if (CKEDITOR.instances.content.getData() == '') {
        //     invalid("content", 'Bạn phải nhập nội dung chi tiết');
        //     return false;
        // }

        $('.alert-danger').hide();
        return true;
    }
</script>
<?php //include 'detail_seo.php'; ?>