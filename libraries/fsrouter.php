<?php

class FSRoute
{

    var $url;

    function __construct($url)
    {

    }

    static function _($url)
    {
        return FSRoute::enURL($url);
    }

    /*
     * Trả lại tên mã hóa trên URL
     */

    static function get_name_encode($name, $lang)
    {
        $lang_url = array(
            'p' => 'pe',
            'cp' => 'cpe',
            'san-pham' => 'products',
            'tim-kiem' => 'search',
            'n' => 'ne',
            'cn' => 'cne',
            'tin-tuc' => 'news',
            's' => 'se',
            'thu-vien-anh' => 'photo-library',
            'c' => 'ce',
            'lien-he' => 'contact',
            'gioi-thieu' => 'about',
            'thanh-tich' => 'achievements',
            'linh-vuc-hoat-dong' => 'field-of-activity',
            'f' => 'fe',
            'cong-ty-thanh-vien' => 'subsidiaries',
        );

        if ($lang == 'vi')
            return $name;
        else
            return $lang_url[$name];
    }

    static function addParameters($params, $value, $module = '', $view = '')
    {
        // only filter
        if (!$module) {
            $module = FSInput::get('module');
            //$view = FSInput::get('view');
            if (!$view) {
                //$module = FSInput::get('module');
                $view = FSInput::get('view');
            }
        }


        if ($module == 'products' && $view == 'search') {
            $array_paras_need_get = array('ccode', 'filter', 'manu', 'order', 'style', 'Itemid', 'keyword', 'limit');
            $url = 'index.php?module=' . $module . '&view=' . $view;
            foreach ($array_paras_need_get as $item) {
                if ($item != $params) {
                    $value_of_param = FSInput::get($item);
                    if ($value_of_param) {
                        $url .= "&" . $item . "=" . $value_of_param;
                    }
                } else {
                    if ($value)
                        $url .= "&" . $item . "=" . $value;
                }
            }
            return FSRoute:: _($url);
        }

        if ($module == 'products') {
            $array_paras_need_get = array('ccode', 'filter', 'manu', 'order', 'style', 'Itemid', 'cid', 'limit', 'id');
            $url = 'index.php?module=' . $module . '&view=' . $view;
            foreach ($array_paras_need_get as $item) {
                if ($item != $params) {
                    $value_of_param = FSInput::get($item);
                    if ($value_of_param) {
                        $url .= "&" . $item . "=" . $value_of_param;
                    }
                } else {
                    if ($value)
                        $url .= "&" . $item . "=" . $value;
                }
            }

            return FSRoute:: _($url);
        }
        return FSRoute:: _($_SERVER['REQUEST_URI']);
    }

    function removeParameters($params)
    {
        // only filter
        $module = FSInput::get('module');
        $view = FSInput::get('view');
        $ccode = FSInput::get('ccode');
        $filter = FSInput::get('filter');
        $manu = FSInput::get('manu');
        $Itemid = FSInput::get('Itemid');

        $url = 'index.php?module=' . $module . '&view=' . $view;
        if ($ccode) {
            $url .= '&ccode=' . $ccode;
        }
        if ($filter) {
            $url .= '&filter=' . $filter;
        }
        $url .= '&Itemid=' . $Itemid;
        $url = trim(preg_replace('/&' . $params . '=[0-9a-zA-Z_-]+/i', '', $url));
    }

    /*
     * rewrite
     */

    static function enURL($url)
    {
        if (!$url)
            $url = $_SERVER['REQUEST_URI'];

        if (!IS_REWRITE)
            return URL_ROOT . $url;
        if (strpos($url, 'http://') !== false || strpos($url, 'https://') !== false)
            return $url;

        $url_reduced = substr($url, 10); // width : index.php
        $array_buffer = explode('&', $url_reduced, 10);
        $array_params = array();
        for ($i = 0; $i < count($array_buffer); $i++) {
            $item = $array_buffer[$i];
            $pos_sepa = strpos($item, '=');
            $array_params[substr($item, 0, $pos_sepa)] = substr($item, $pos_sepa + 1);
        }

        $module = isset($array_params['module']) ? $array_params['module'] : '';
        $view = isset($array_params['view']) ? $array_params['view'] : $module;
        $task = isset($array_params['task']) ? $array_params['task'] : 'display';
        $Itemid = isset($array_params['Itemid']) ? $array_params['Itemid'] : 0;
        //$location  = isset($array_params['location'])?$array_params['location']: CITY;

        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';
        $url_first = URL_ROOT;
        $url1 = '';
        switch ($module) {
            case 'products':
                switch ($view) {
                    case 'product':
                        $code = isset($array_params['code']) ? $array_params['code'] : '';
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        $id = isset($array_params['id']) ? $array_params['id'] : '';
                        return $url_first .FSRoute::get_name_encode('san-pham', $lang).'/' .$code . '-' . FSRoute::get_name_encode('p', $lang) . $id . '.html';

                    case 'cat':
                        foreach ($array_params as $key => $value) {
                            if ($key == 'module' || $key == 'view' || $key == 'Itemid' || $key == 'ccode' || $key == 'cid' || $key == 'filter')
                                continue;
                            $url1 .= '&' . $key . '=' . $value;
                        }
                        $cid = isset($array_params['cid']) ? $array_params['cid'] : '';
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        $filter = isset($array_params['filter']) ? $array_params['filter'] : '';
                        if ($filter)
                            return $url_first . $ccode . '-' . FSRoute::get_name_encode('cp', $lang) . $cid . '/' . $filter . '-filter.html' . $url1;
                        else
                            // return $url_first.$ccode.'-pc'.$cid.'.html'.$url1;
                            return $url_first . $ccode . '-' . FSRoute::get_name_encode('cp', $lang) . $cid . '.html' . $url1;
                    case 'home':
                        foreach ($array_params as $key => $value) {
                            if ($key == 'module' || $key == 'view' || $key == 'Itemid' || $key == 'ccode' || $key == 'id' || $key == 'filter' || $key == 'cid')
                                continue;
                            $url1 .= '&' . $key . '=' . $value;
                        }
                        //return $url_first.'san-pham.html';
                        return $url_first . FSRoute::get_name_encode('san-pham', $lang) . '.html' . $url1;
//                    case 'search':
//
//                        $keyword = isset($array_params['keyword']) ? $array_params['keyword'] : '';
//                        $url = $url_first . FSRoute::get_name_encode('tim-kiem', $lang);
//                        if ($keyword) {
//                            $url .= '/' . $keyword . '.html';
//                        }
//                        return $url;

                    case 'cart':
                        switch ($task) {
                            case 'eshopcart2':
                                //return $url_first.'gio-hang.html';
                                return $url_first . FSRoute::get_name_encode('gio-hang', $lang) . '.html' . $url1;
                            case 'order':
                                return $url_first . 'don-hang.html';
                            case 'finish_order':
                                $id = isset($array_params['id']) ? $array_params['id'] : 0;
                                //return $url_first.'ket-thuc-don-hang-'.$id.'.html';
                                return $url_first . FSRoute::get_name_encode('ket-thuc-don-hang', $lang) . '-' . $id . '.html' . $url1;
                            case 'finish':
                                $id = isset($array_params['id']) ? $array_params['id'] : 0;
                                return $url_first . 'hoan-tat-don-hang-' . $id . '.html';
                            default:
                                return $url_first . $url;
                        }
                    default:
                        return $url_first . $url;
                }
                break;
            case 'contest':
                switch ($view) {
                    case 'home':
                        switch ($task) {
                            case 'result':
                                return $url_first . 'ket-qua-thi-va-kiem-tra.html';
                            default:
                                return $url_first . 'thi-va-kiem-tra.html';
                        }
                    default:
                        return $url_first . $url;
                }
                break;
            case 'field':
                switch ($view) {
                    case 'field':
                        $code = isset($array_params['code']) ? $array_params['code'] : '';
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        $id = isset($array_params['id']) ? $array_params['id'] : '';
                        return $url_first . $code . '-' . FSRoute::get_name_encode('f', $lang) . $id . '.html';

                    case 'home':
                        //return $url_first.'tin-tuc.html';
                        return $url_first . FSRoute::get_name_encode('linh-vuc-hoat-dong', $lang) . '.html';

                }
                break;
            case 'subsidiaries':
                switch ($view) {
                    case 'subsidiaries':
                        $code = isset($array_params['code']) ? $array_params['code'] : '';
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        $id = isset($array_params['id']) ? $array_params['id'] : '';
                        return $url_first . $code . '-' . FSRoute::get_name_encode('s', $lang) . $id . '.html';

                    case 'home':
                        //return $url_first.'tin-tuc.html';
                        return $url_first . FSRoute::get_name_encode('cong-ty-thanh-vien', $lang) . '.html';

                }
                break;
            case 'news':
                switch ($view) {
                    case 'news':
                        $code = isset($array_params['code']) ? $array_params['code'] : '';
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        $id = isset($array_params['id']) ? $array_params['id'] : '';
                        return $url_first . $code . '-' . FSRoute::get_name_encode('n', $lang) . $id . '.html';
                    case 'cat':
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        $id = isset($array_params['id']) ? $array_params['id'] : '';
                        //return $url_first.$ccode.'-c'.$id.'.html';
                        return $url_first . $ccode . '-' . FSRoute::get_name_encode('cn', $lang) . $id . '.html';
                    case 'home':
                        //return $url_first.'tin-tuc.html';
                        return $url_first . FSRoute::get_name_encode('tin-tuc', $lang) . '.html';
                    case 'search':

                        $keyword = isset($array_params['keyword']) ? $array_params['keyword'] : '';
                        $url = URL_ROOT . 'tim-kiem-tin-tuc';
                        if ($keyword) {
                            $url .= '/' . $keyword . '.html';
                        }
                        return $url;
                    default:
                        return $url_first . $url;
                }
                break;
//            case 'services':
//                switch ($view) {
//                    case 'service':
//                        $code = isset($array_params['code']) ? $array_params['code'] : '';
//                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
//                        $id = isset($array_params['id']) ? $array_params['id'] : '';
//                        return $url_first . $code . '-' . FSRoute::get_name_encode('s', $lang) . $id . '.html';
//
//                    default:
//                        return $url_first . $url;
//                }
//                break;
            case 'images':
                switch ($view) {
                    case 'img':
                        return $url_first . FSRoute::get_name_encode('thu-vien-anh', $lang) . '.html';

                    default:
                        return $url_first . $url;
                }
                break;
            case 'contents':
                switch ($view) {
                    case 'home':
                        return $url_first . FSRoute::get_name_encode('gioi-thieu', $lang) . '.html';
                    case 'cat':
                        $id = isset($array_params['id']) ? $array_params['id'] : '';
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        return $url_first . $ccode . '-cc' . $id . '.html';
                    case 'content':
                        $code = isset($array_params['code']) ? $array_params['code'] : '';
                        $ccode = isset($array_params['ccode']) ? $array_params['ccode'] : '';
                        $id = isset($array_params['id']) ? $array_params['id'] : '';
                        //return $url_first.FSRoute::get_name_encode('ct',$lang).'-'.$code.'.html';
                        return $url_first . $code . '-' . FSRoute::get_name_encode('c', $lang) . $id . '.html';
                }
                break;
                case 'achievements':
                switch ($view) {
                    case 'home':
                        return $url_first . FSRoute::get_name_encode('thanh-tich', $lang) . '.html';
                }
                break;
            case 'contact':
                return $url_first . FSRoute::get_name_encode('lien-he', $lang) . '.html';
            case 'search':
                switch ($view) {
                    case 'search':
                        $keyword = isset($array_params['keyword']) ? $array_params['keyword'] : '';
                        $url = URL_ROOT . FSRoute::get_name_encode('tim-kiem', $lang);
                        if ($keyword) {
                            $url .= '/' . $keyword . '.html';
                        }
                        return $url;
                }
                break;
            case 'notfound':
                switch ($view) {
                    case 'notfound':
                        return $url_first . '404-page.html';
                    default:
                        return $url_first . $url;
                }
                break;

            case 'cache':
                return $url_first . 'delete-cache.html';

            case 'sitemap':
                return $url_first . 'site-map.html';

            default:
                return URL_ROOT . $url;
        }
    }

    /*
     * get real url from virtual url
     */

    function deURL($url)
    {
        if (!IS_REWRITE)
            return $url;
        return $url;
        if (strpos($url, URL_ROOT_REDUCE) !== false) {
            $url = substr($url, strlen(URL_ROOT_REDUCE));
        }
        if ($url == 'news.html')
            return 'index.php?module=news&view=home&Itemid=1';
        if (strpos($url, 'news-page') !== false) {
            $f = strpos($url, 'news-page') + 9;
            $l = strpos($url, '.html');
            $page = intval(substr($url, $f, ($l - $f)));
            return "index.php?module=news&view=home&page=$page&Itemid=1";
        }
        $array_url = explode('/', $url);
        $module = isset($array_url[0]) ? $array_url[0] : '';
        switch ($module) {
            case 'news':
                // if cat
                if (preg_match('#news/([^/]*)-c([0-9]*)-it([0-9]*)(-page([0-9]*))?.html#s', $url, $arr)) {
                    return "index.php?module=news&view=cat&id=" . @$arr[2] . "&Itemid=" . @$arr[3] . '&page=' . @$arr[5];
                }
                // if article
                if (preg_match('#news/detail/([^/]*)-i([0-9]*)-it([0-9]*).html#s', $url, $arr)) {
                    return "index.php?module=news&view=news&id=" . @$arr[2] . "&Itemid=" . @$arr[3];
                }
            case 'companies':
                $str_continue = ($module = isset($array_url[1])) ? $array_url[1] : '';
                if ($str_continue == 'register.html')
                    return "index.php?module=companies&view=company&task=register&Itemid=5";
                if (preg_match('#category-id([0-9]*)-city([0-9]*)-it([0-9]*)(-page([0-9]*))?.html#s', $str_continue, $arr)) {
                    if (isset($arr[5]))
                        return "index.php?module=companies&view=category&id=" . @$arr[1] . "&city=" . @$arr[2] . "&Itemid=" . @$arr[3] . "&page=" . @$arr[5];
                    else
                        return "index.php?module=companies&view=category&id=" . @$arr[1] . "&city=" . @$arr[2] . "&Itemid=" . @$arr[3];
                }
            default:
                return $url;
        }
    }

    function get_home_link()
    {
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vi';
        if ($lang == 'vi') {
            return URL_ROOT;
        } else {
            return URL_ROOT . 'en';
        }
    }

    /*
     * Dịch ngang
     */

    static function change_link_by_lang($lang, $link = '')
    {
        $module = FSRoute::get_param('module', $link);
        $view = FSRoute::get_param('view', $link);
        if (!$view)
            $view = $module;
        if (!$module || ($module == 'home' && $view == 'home')) {
            if ($lang == 'en') {
//				return URL_ROOT;
            } else {
                return URL_ROOT . 'vi';
            }
        }
        switch ($module) {

            case 'contents':
                switch ($view) {
                    case 'content':
                        $code = FSRoute::get_param('code', $link);
                        $record = FSRoute::trans_record_by_field($code, 'alias', 'fs_contents', $lang, 'id,alias,category_alias');
                        if (!$record)
                            return;
                        $url = URL_ROOT . FSRoute::get_name_encode('ct', $lang) . '-' . $record->alias;
                        return $url . '.html';
                        return $url;
                }
                break;
            default:
                $url = URL_ROOT . 'ce-information';
                return $url . '.html';
        }
    }

    /*
     * Hàm trả lại tham số: có thể từ biến $_REQUEST hay từ phân tích URL truyền vào
     */

    static function get_param($param_name, $link = '')
    {
        if (!$link)
            return FSInput::get($param_name);
        $url = str_replace('&amp;', '&', $link);
        $url_reduced = substr($url, 10); // width : index.php
        $array_buffer = explode('&', $url_reduced, 10);
        $array_params = array();
        for ($i = 0; $i < count($array_buffer); $i++) {
            $item = $array_buffer[$i];
            $pos_sepa = strpos($item, '=');
            $array_params[substr($item, 0, $pos_sepa)] = substr($item, $pos_sepa + 1);
        }
        return @$array_params[$param_name];
    }

    function get_record_by_id($id, $table_name, $lang, $select)
    {
        if (!$id)
            return;
        if (!$table_name)
            return;
        $fs_table = FSFactory::getClass('fstable');
        $table_name = $fs_table->getTable($table_name);

        $query = " SELECT " . $select . "
					  FROM " . $table_name . "
					  WHERE id = $id ";

        global $db;
        $sql = $db->query($query);
        $result = $db->getObject();
        return $result;
    }

    /*
     * Lấy bản ghi dịch ngôn ngữ
     */

    static function trans_record_by_field($value, $field = 'alias', $table_name, $lang, $select = '*')
    {
        if (!$value)
            return;
        if (!$table_name)
            return;
        $fs_table = FSFactory::getClass('fstable');
        $table_name_old = $fs_table->getTable($table_name);

        $query = " SELECT id
					  FROM " . $table_name_old . "
					  WHERE " . $field . " = '" . $value . "' ";

        global $db;
        $sql = $db->query($query);
        $id = $db->getResult();
        if (!$id)
            return;
        $query = " SELECT " . $select . "
					  FROM " . $fs_table->translate_table($table_name) . "
					  WHERE id = '" . $id . "' ";
        global $db;
        $sql = $db->query($query);
        $rs = $db->getObject();
        return $rs;
    }

    /*
     * Dịch từ field -> field ( tìm lại id rồi dịch ngược)
     */

    function translate_field($value, $table_name, $field = 'alias')
    {

        if (!$value)
            return;
        if (!$table_name)
            return;
        $fs_table = FSFactory::getClass('fstable');
        $table_name_old = $fs_table->getTable($table_name);

        $query = " SELECT id
					  FROM " . $table_name_old . "
					  WHERE $field = '" . $value . "' ";
        global $db;
        $sql = $db->query($query);
        $id = $db->getResult();
        if (!$id)
            return;
        $query = " SELECT " . $field . "
					  FROM " . $fs_table->translate_table($table_name) . "
					  WHERE id = '" . $id . "' ";
        global $db;
        $sql = $db->query($query);
        $rs = $db->getResult();
        return $rs;
    }

}