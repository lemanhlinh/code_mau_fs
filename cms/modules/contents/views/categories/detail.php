<?php
$title = @$data ? FSText::_('Edit') : FSText::_('Add');
global $toolbar;
$toolbar->setTitle($title);
$toolbar->addButton('save_add', FSText:: _('Save and new'), '', '', 1);
$toolbar->addButton('apply', FSText::_('Apply'), '', 'apply.png', 1);
$toolbar->addButton('save', FSText::_('Save'), '', 'save.png', 1);
$toolbar->addButton('cancel', FSText::_('Cancel'), '', 'cancel.png');

$this->dt_col_start('col-xs-12 col-md-12 connectedSortable', 1);
echo ' 	<div class="alert alert-danger" style="display:none" >
                        <span id="msg_error"></span>
                </div>';
//$this -> dt_form_begin();
$this->dt_form_begin(1, 4, $title . ' ' . FSText::_('Danh mục'), 'fa-edit', 1, 'col-md-12', 1);
TemplateHelper::dt_edit_text(FSText:: _('Tên Danh mục'), 'name', @$data->name);
TemplateHelper::dt_edit_text(FSText:: _('Alias'), 'alias', @$data->alias, '', 60, 1, 0, FSText::_("Can auto generate"));
TemplateHelper::dt_edit_selectbox(FSText::_('Parent'), 'parent_id', @$data->parent_id, 0, $categories, $field_value = 'id', $field_label = 'treename', $size = 1, 0, 1);
TemplateHelper::dt_checkbox(FSText::_('Published'), 'published', @$data->published, 1);
TemplateHelper::dt_edit_text(FSText:: _('Ordering'), 'ordering', @$data->ordering, @$maxOrdering, '20');
//	TemplateHelper::dt_edit_image(FSText :: _('Icon'),'icon',@$data -> icon);
$this->dt_form_end_col(); // END: col-2

$this->dt_col_end(); // show the dong </div>
$this->dt_form_end(@$data, 1, 0, 2, '', '', 1);
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

        if (!notEmpty('name', 'Bạn phải nhập tên danh mục'))
            return false;

        if (!lengthMaxword('name', 10, 'Mỗi từ tối đa có 10 ký tự'))
            return false;

        $('.alert-danger').hide();
        return true;
    }
</script>