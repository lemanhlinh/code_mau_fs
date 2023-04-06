<?php
/*
 * Huy write
 */

// controller

class NewsControllersHome extends FSControllers
{
    function display()
    {
        // call models
        $model = $this->model;

        global $tags_group;

        $query_body = $model->set_query_body();
        // var_dump($query_body);

        $list = $model->get_list($query_body);
        // var_dump($list)
        $list_hot = $model->get_hot();
        // var_dump($show_home);

        $list_cat = $model->get_listcat();// hứng kết quả trả về danh sách từ model
        foreach ($list_cat as $item) {
            $list_new[$item->id] = $model->get_listnew($item->id);
        }
        // var_dump($news1->id);
        $news2 = $model->get_tinnoibat();// hứng kết quả trả về từ model
        // var_dump($news2);
        // $news_hot = $model->get_tinnoibat1();// hứng kết quả trả về từ model
        // var_dump($news_hot);

        $total = $model->getTotal($query_body);
        $pagination = $model->getPagination($total);

        $breadcrumbs = array();
        $breadcrumbs[] = array(0 => FSText::_('Tin tức'), 1 => FSRoute::_('index.php?module=news&view=home&Itemid=2'));
        global $tmpl,$config;
        $tmpl->assign('breadcrumbs', $breadcrumbs);
        $tmpl -> assign('og_image', URL_ROOT.$config['banner_new']);

        $tmpl->set_seo_special();
        // echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
        // call views
        // echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
        include 'modules/' . $this->module . '/views/' . $this->view . '/default.php';
    }

}

?>