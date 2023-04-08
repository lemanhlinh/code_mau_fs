<link type="text/css" rel="stylesheet" media="all" href="templates/default/css/jquery-ui.css"/>
<script type="text/javascript" src="../libraries/jquery/jquery.ui/jquery-ui.js"></script>
<?php
global $toolbar;
$toolbar->setTitle(FSText:: _('Products'));
$toolbar->addButton('duplicate', FSText:: _('Duplicate'), FSText:: _('You must select at least one record'), 'duplicate.png');
$toolbar->addButton('save_all', FSText:: _('Save'), '', 'save.png');
$toolbar->addButton('add', FSText:: _('Add'), '', 'add.png');
$toolbar->addButton('edit', FSText:: _('Edit'), FSText:: _('You must select at least one record'), 'edit.png');
$toolbar->addButton('remove', FSText:: _('Remove'), FSText:: _('You must select at least one record'), 'remove.png');
$toolbar->addButton('published', FSText:: _('Published'), FSText:: _('You must select at least one record'), 'published.png');
$toolbar->addButton('unpublished', FSText:: _('Unpublished'), FSText:: _('You must select at least one record'), 'unpublished.png');
// $toolbar->addButton('update',FSText :: _('Update'),FSText :: _('You must select at least one record'),'update.png');
//$toolbar->addButton('export',FSText :: _('Export'),'','Excel-icon.png');

//	FILTER
$filter_config = array();
$fitler_config['search'] = 1;
//số bộ lọc
$fitler_config['filter_count'] = 2;
// $fitler_config['text_count'] = 2;

$filter_categories = array();
$filter_categories['title'] = FSText::_('Lĩnh vực');
$filter_categories['list'] = @$categories;
$filter_categories['field'] = 'treename';


//SP tiêu biểu
$filter_new = array();


$fitler_config['filter'][] = $filter_categories;

//filter manufactory


$filter_manufactory = array();
$filter_manufactory['title'] = FSText::_('Hãng sản xuất');
$filter_manufactory['list'] = @$manufactories;
$filter_manufactory['field'] = 'name';

$fitler_config['filter'][] = $filter_manufactory;
//	CONFIG
$list_config = array();
$list_config[] = array('title' => 'Tên', 'field' => 'name', 'ordering' => 1, 'type' => 'text_link', 'col_width' => '40%', 'link' => 'index.php?module=products&view=product&ccode=ccode&code=code&id=id&Itemid=10');
$list_config[] = array('title' => 'Ngôn ngữ khác', 'field' => 'other_languages1', 'ordering' => 1, 'type' => 'text_link1');

// $list_config[] = array('title'=>'Image','field'=>'image','type'=>'image','arr_params'=>array('width'=> 60,'search'=>'/original/','replace'=>'/resized/'));
//$list_config[] = array('title'=>'Giá','type'=>'label');
//$list_config[] = array('title'=>'Giá gốc','field'=>'price_old','no_col'=>3, 'type'=>'edit_text','display_label'=>1,'arr_params'=>array('size'=>10));
//$list_config[] = array('title'=>'Giảm giá','field'=>'discount','no_col'=>3, 'type'=>'edit_text','display_label'=>1,'arr_params'=>array('size'=>10));
//$list_config[] = array('title'=>'Loại giảm giá','field'=>'discount_unit','no_col'=>3, 'type'=>'edit_selectbox','display_label'=>1,'arr_params'=>array('arry_select'=>array('percent'=>'Phần trăm','price'=>'Giá trị')));
//	$list_config[] = array('title'=>'Category','field'=>'category_name','ordering'=> 1, 'type'=>'text','col_width' => '15%');
// $list_config[] = array('title'=>'SP mới','field'=>'is_new','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_new'));
// $list_config[] = array('title'=>'Tình trạng còn hàng','field'=>'is_status','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_status'));
// $list_config[] = array('title'=>'SP bán chạy','field'=>'is_sell','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_sell'));
//$list_config[] = array('title'=>'SP khuyến mại','field'=>'is_sale','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_sale'));
//$list_config[] = array('title'=>'SP tiêu biểu','field'=>'is_hot','ordering'=> 1, 'type'=>'change_status','arr_params'=>array('function'=>'is_hot'));
$list_config[] = array('title' => 'Ordering', 'field' => 'ordering', 'ordering' => 1, 'type' => 'edit_text', 'arr_params' => array('size' => 3));
$list_config[] = array('title' => 'Published', 'field' => 'published', 'ordering' => 1, 'type' => 'published');

$list_config[] = array('title' => 'Edit', 'type' => 'edit');
$list_config[] = array('title' => 'Edited time', 'field' => 'edited_time', 'ordering' => 1, 'type' => 'datetime');
$list_config[] = array('title' => 'Id', 'field' => 'id', 'ordering' => 1, 'type' => 'text');

TemplateHelper::genarate_form_liting($this->module, $this->view, $list, $fitler_config, $list_config, $sort_field, $sort_direct, $pagination);
?>
<script>
    $(function () {
        $("#text0").datepicker({clickInput: true, dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
        $("#text1").datepicker({clickInput: true, dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true});
    });
</script>
<style>
    table.dataTable.nowrap th, table.dataTable.nowrap td {
        white-space: unset !important;
    }
</style>