<?php
/**
 * author: AnhPT
 * date:   2018-11-30 06:38 AM
 * Class ProductsControllersCat
 */
class ProductsControllersCat extends FSControllers
{
    var $module;
    var $view;

    function display()
    {
        // call models
        $model = $this->model;
        $cat = $model->get_category();
        if (!$cat) {
            setRedirect(URL_ROOT, FSText::_('Không tồn tại danh mục này'), 'error');
        }

        $tablename = $cat->tablename;
        $query_body = $model->set_query_body($cat);
        $list = $model->get_list($query_body, $cat->tablename);

        //$product_cmp= $model -> get_compare_product($cat->tablename);
        $total = $model->getTotal($query_body);
        $pagination = $model->getPagination($total);

        // breadcrumbs
        $lis_cat_parent = $model->get_list_parent($cat->list_parents, $cat->id);
        $breadcrumbs = array();
        //$breadcrumbs [] = array (0 => 'Sản phẩm', 1 => FSRoute::_ ('index.php?module=products&view=home' ) );
        for ($i = count($lis_cat_parent); $i > 0; $i--) {
            $item = $lis_cat_parent [$i - 1];
            $breadcrumbs [] = array(0 => $item->name, 1 => FSRoute::_('index.php?module=products&view=cat&ccode=' . $item->alias . '&cid=' . $item->id . '&Itemid=10'));
        }
        $breadcrumbs [] = array(0 => $cat->name, 1 => FSRoute::_('index.php?module=products&view=cat&ccode=' . $cat->alias . '&cid=' . $cat->id . '&Itemid=10'));

        global $tmpl, $module_config;
        $tmpl->assign('breadcrumbs', $breadcrumbs);
        $tmpl->assign('tablename', $tablename);
        // seo
        $tmpl->set_data_seo($cat);

        // call views
        include 'modules/' . $this->module . '/views/' . $this->view . '/default.php';
    }
}