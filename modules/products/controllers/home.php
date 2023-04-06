<?php

/**
 * author: AnhPT
 * date:   2018-11-30 05:07 AM
 * Class ProductsControllersHome
 */
class ProductsControllersHome extends FSControllers
{

    function display()
    {
        // call models
        $model = $this->model;

        $query_body = $model->set_query_body();

        $list = $model->get_list($query_body);

        // var_dump($list);

        $total = $model->getTotal();
        $bcr_lv = $model->getproducts_lv();

//        var_dump($total);
        $pagination = $model->getPagination($total);
//        var_dump($pagination);die;
        // breadcrumbs
        $breadcrumbs = array();
        $breadcrumbs [] = array(0 => FSText::_('Tất cả sản phẩm'), 1 => '');

        global $tmpl, $module_config;
        $tmpl->assign('breadcrumbs', $breadcrumbs);
        // seo
        $tmpl->set_seo_special();
        $products_hot = $model->getproducts_hot();
        $products_all = $model->getproducts_all();
//        var_dump($products_all);die;
        $products_az = $model->getproducts_az();
        $products_categories = $model->getproducts_categories();
        $products_categories_orther = $model->getproducts_categories_orther();
        $result_cat = array_merge($products_categories, $products_categories_orther);
//        var_dump($result_cat);
        $products_manufactories = $model->getproducts_manufactories();
        $products_application = $model->getproducts_application();
        $products_application_orther = $model->getproducts_application_orther();
        $result_app = array_merge($products_application, $products_application_orther);

        $products_types = $model->getproducts_types();
        $products_types_orther = $model->getproducts_types_orther();
        $result_types = array_merge($products_types, $products_types_orther);

        $city = $model->getcity();
        // $products_content = $model->getproducts_content();
        // var_dump($products_content);die;
        // call views
        include 'modules/' . $this->module . '/views/' . $this->view . '/default.php';
    }
}
?>