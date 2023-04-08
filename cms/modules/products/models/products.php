<?php

class ProductsModelsProducts extends FSModels
{
    var $limit;
    var $prefix;
    var $image_watermark;

    function __construct()
    {
        $limit = FSInput::get('limit', 20, 'int');
        $this->limit = $limit;
        $this->view = 'products';
        $this->type = 'products';
        $this->table_name = FSTable_ad::_('fs_products');
        $this->use_table_extend = 1;
        $this->table_category = FSTable_ad::_('fs_' . $this->type . '_categories');
        $this->table_manufactory = FSTable_ad::_('fs_manufactories');
        $this->table_application = FSTable_ad::_('fs_application');
        $this->table_product_contact = FSTable_ad::_('fs_product_contact');
        // $this->table_product_contact = FSTable_ad::_('fs_products_types');
        $this->table_types = FSTable_ad::_('fs_' . $this->type . '_types');
        //synchronize
        //			$this -> array_synchronize = array('fs_estores_products'=>array('id'=>'product_id','published'=>'record_published','alias'=>'product_alias','name'=>'product_name','category_name'=>'category_name','category_alias'=>'category_alias','category_alias_wrapper'=>'category_id_wrapper','category_id'=>'category_id','manufactory_country_id'=>'manufactory_country_id','manufactory_country_name'=>'manufactory_country_name','manufactory_country_flag'=>'manufactory_country_flag','manufactory_id'=>'manufactory_id','manufactory_alias'=>'manufactory_alias','manufactory_name'=>'manufactory_name'));
        // calculate filters:
        // $this->calculate_filters = 1;
        // config for save
        $cyear = date('Y');
        $cmonth = date('m');
        $cday = date('d');
        $this->img_folder = 'images/' . $this->type . '/' . $cyear . '/' . $cmonth . '/' . $cday;
        $this->check_alias = 1;
        $this->field_img = 'image';
        $this->field_reset_when_duplicate = array('comments_total');

        parent::__construct();

        $this->load_params();
    }

    function load_params()
    {
        $module_params = $this->get_params($this->module, 'product');

        if ($module_params) { // params from fs_config_modules
            $this->module_params = $module_params;
            $arr_img_paths = array();
            $arr_img_paths_other = array();

            FSFactory::include_class('parameters');
            $current_parameters = new Parameters ($module_params);
            // large size
            $image_large_size = $current_parameters->getParams('image_large_size');
            $image_large_method = $current_parameters->getParams('image_large_method');
            if (!$image_large_method)
                $image_large_method = 'resize_image'; // giữ nguyên dạng ảnh, thêm khoảng trắng
            $image_large_width = $this->get_dimension($image_large_size, 'width');
            $image_large_height = $this->get_dimension($image_large_size, 'height');
            if ($image_large_width || $image_large_height) {
                $arr_img_paths [] = array('large', $image_large_width, $image_large_height, $image_large_method);
                $arr_img_paths_other [] = array('large', $image_large_width, $image_large_height, $image_large_method);
            }

            // resized: ảnh đại diện trong trang danh sách
            $image_resized_size = $current_parameters->getParams('image_resized_size');
            $image_resized_method = $current_parameters->getParams('image_resized_method');
            if (!$image_resized_method)
                $image_resized_method = 'resize_image'; // giữ nguyên dạng ảnh, thêm khoảng trắng


            $image_resized_width = $this->get_dimension($image_resized_size, 'width');
            $image_resized_height = $this->get_dimension($image_resized_size, 'height');

            $arr_img_paths [] = array('resized', $image_resized_width, $image_resized_height, $image_resized_method);
            $arr_img_paths_other [] = array('resized', $image_resized_width, $image_resized_height, $image_resized_method);

            // small: ảnh nhỏ làm slideshow
            $image_small_size = $current_parameters->getParams('image_small_size');
            $image_small_method = $current_parameters->getParams('image_small_method');
            if (!$image_small_method)
                $image_small_method = 'resize_image'; // giữ nguyên dạng ảnh, thêm khoảng trắng
            $image_small_width = $this->get_dimension($image_small_size, 'width');
            $image_small_height = $this->get_dimension($image_small_size, 'height');
            if ($image_small_width || $image_small_height) {
                $arr_img_paths [] = array('small', $image_small_width, $image_small_height, $image_small_method);
                $arr_img_paths_other [] = array('small', $image_small_width, $image_small_height, $image_small_method);
            }
            $this->arr_img_paths = $arr_img_paths;
            $this->arr_img_paths_other = $arr_img_paths_other;

        } else {
            // default
            $this->arr_img_paths = array(array('resized', 204, 190, 'resize_image'));
            $this->arr_img_paths_other = array(array('large', 374, 380, 'resize_image'), array('small', 47, 35, 'resize_image'));
        }
    }

    /*
         * Trả lại kích thước chiều dài hoặc chiều rộng
         */
    function get_dimension($size, $dimension = 'width')
    {
        if (!$size)
            return 0;
        $array = explode('x', $size);
        if ($dimension == 'width') {
            return (intval(@$array [0]));
        } else {
            return (intval(@$array [1]));
        }
    }

    /*
         * Lấy parameter từ cấu hình vào.............................................................................
         */
    function get_params($module, $view, $task = '')
    {

        $where = '';
        $where .= 'module = "' . $module . '" AND view = "' . $view . '"';
        if ($task == 'display' || !$task) {
            $where .= ' AND ( task = "display" OR task = "" OR task IS NULL)';
        } else {
            $where .= ' AND task = "' . $task . '" ';
        }

        $fstable = FSFactory::getClass('fstable');
        global $db;
        $sql = " SELECT params  FROM " . $fstable->_('fs_config_modules') . "
				WHERE $where ";
        $db->query($sql);
        $rs = $db->getResult();
        return $rs;
    }

    function setQuery()
    {

        // ordering
        $ordering = "";
        $where = "  ";
        if (isset ($_SESSION [$this->prefix . 'sort_field'])) {
            $sort_field = $_SESSION [$this->prefix . 'sort_field'];
            $sort_direct = $_SESSION [$this->prefix . 'sort_direct'];
            $sort_direct = $sort_direct ? $sort_direct : 'asc';
            $ordering = '';
            if ($sort_field)
                $ordering .= " ORDER BY $sort_field $sort_direct, created_time DESC, id DESC ";
        }
        // from
        if (isset($_SESSION[$this->prefix . 'text0'])) {
            $date_from = $_SESSION[$this->prefix . 'text0'];
            if ($date_from) {
                $date_from = strtotime($date_from);
                $date_new = date('Y-m-d H:i:s', $date_from);
                $where .= ' AND a.edited_time >=  "' . $date_new . '" ';
            }
        }

        // to
        if (isset($_SESSION[$this->prefix . 'text1'])) {
            $date_to = $_SESSION[$this->prefix . 'text1'];
            if ($date_to) {
                $date_to = $date_to . ' 23:59:59';
                $date_to = strtotime($date_to);
                $date_new = date('Y-m-d H:i:s', $date_to);
                $where .= ' AND a.edited_time <=  "' . $date_new . '" ';
            }
        }
        if (isset ($_SESSION [$this->prefix . 'filter0'])) {
            $filter = $_SESSION [$this->prefix . 'filter0'];
            if ($filter) {
                $where .= ' AND a.category_id like   "%,' . $filter . ',%" ';
            }
        }
        // Lọc ảnh
//        if (isset ($_SESSION [$this->prefix . 'filter1'])) {
//            $filter = $_SESSION [$this->prefix . 'filter1'];
//            if ($filter) {
//                if ($filter == 1)
//                    $where .= ' AND a.show_in_home = 1';
//                else
//                    $where .= ' AND a.show_in_home = 0';
//            }
//        }
        // lọc loại sản phẩm
//        if (isset ($_SESSION [$this->prefix . 'filter2'])) {
//            $filter = $_SESSION [$this->prefix . 'filter2'];
//            if ($filter) {
//                if ($filter == 1)
//                    $where .= ' AND a.is_hot = 1';
//                else
//                    $where .= ' AND a.is_hot = 0';
//            }
//        }

        // Trang chủ
        if (isset ($_SESSION [$this->prefix . 'filter3'])) {
            $filter = $_SESSION [$this->prefix . 'filter3'];
            if ($filter) {
                if ($filter == 1)
                    $where .= ' AND a.is_sell = 1';
                else
                    $where .= ' AND a.is_sell = 0';
            }
        }
        // Trang chủ
        if (isset ($_SESSION [$this->prefix . 'filter4'])) {
            $filter = $_SESSION [$this->prefix . 'filter4'];
            if ($filter) {
                if ($filter == 1)
                    $where .= ' AND a.is_new = 1';
                else
                    $where .= ' AND a.is_new = 0';
            }
        }

        // lọc loại sản phẩm
        if (isset ($_SESSION [$this->prefix . 'filter1'])) {
            $filter = $_SESSION [$this->prefix . 'filter1'];
            if ($filter) {
                $where .= ' AND manufactory =   ' . $filter;
            }
        }

        if (!$ordering)
            $ordering .= " ORDER BY edited_time DESC , id DESC ";

        if (isset ($_SESSION [$this->prefix . 'keysearch'])) {
            if ($_SESSION [$this->prefix . 'keysearch']) {
                $keysearch = $_SESSION [$this->prefix . 'keysearch'];
                $where .= " AND ( a.name LIKE '%" . $keysearch . "%' OR a.alias LIKE '%" . $keysearch . "%' OR a.id = '" . $keysearch . "' OR a.code LIKE '%" . $keysearch . "%')";
            }
        }

        $query = " SELECT a.*
				  FROM 
				  	" . $this->table_name . " AS a
				  	WHERE 1=1 " . $where . $ordering . " ";
        return $query;
    }

    function get_datas($str_cat_id)
    {
        global $db;
        $query = $this->setQuery($str_cat_id);
        if (!$query)
            return array();
        $sql = $db->query_limit($query, $this->limit, $this->page);
        $result = $db->getObjectList();

        return $result;
    }


    /*
         * select in category
         */
    function get_categories_tree()
    {
        global $db;
        $where = '';
        if (isset ($_SESSION [$this->prefix . 'category_keysearch'])) {
            if ($_SESSION [$this->prefix . 'category_keysearch']) {
                $keysearch = $_SESSION [$this->prefix . 'category_keysearch'];
                $where .= " AND ( name LIKE '%" . $keysearch . "%' OR alias LIKE '%" . $keysearch . "%' OR id = '" . $keysearch . "')";
            }
        }
        $sql = " SELECT id, name, parent_id AS parent_id  ,level
				FROM " . $this->table_category . "
				WHERE 1=1 " . $where;
        $db->query($sql);
        $categories = $db->getObjectList();

        $tree = FSFactory::getClass('tree', 'tree/');
        $list = $tree->indentRows2($categories);
        return $list;
    }

    /**
     * modifier: AnhPT
     * modified date:   2018-11-25 03:03 PM
     * @param array $row
     * @param int $use_mysql_real_escape_string
     * @return bool|int|null|string
     */
    function save($row = array(), $use_mysql_real_escape_string = 0)
    {
        $name = FSInput::get('name');
        if (!$name) {
            Errors::_('Bạn phải nhập tên');
            return false;
        }

        $id = FSInput::get('id', 0, 'int');

//        $nick_name = FSInput::get('nick_name');
//        if (!$nick_name) {
//            Errors::_('You must entere nick_name');
//            return false;
//        }
////        var_dump($nick_name);die;
//        $row ['nick_name'] = $nick_name;

//        $id = FSInput::get('id', 0, 'int');

        // category and category_id_wrapper
//        $category_id = FSInput::get('category_id', 0, 'int');
//        if (!$category_id) {
//            Errors::_('You must select category');
//            return false;
//        }
//
//        $cat = $this->get_record_by_id($category_id, $this->table_category);
//        $row ['category_id_wrapper'] = $cat->list_parents;
//        $row ['category_root_alias'] = $cat->root_alias;
//        $row ['category_alias_wrapper'] = $cat->alias_wrapper;
//        $row ['category_name'] = $cat->name;
//        $row ['category_alias'] = $cat->alias;
//        $row ['category_published'] = $cat->published;
//        mẫu chọn nhiều danh mục
        $arr_category_id = FSInput::get('category_id', array(), 'array');
//        var_dump($arr_category_id);
        if (!$arr_category_id) {
            Errors::_('Bạn phải chọn lĩnh vực');
        }
        $str_category_id = implode(',', $arr_category_id);
        $row ['category_id'] = ',' . $str_category_id . ',';
//var_dump($row ['category_id']);
        $cat_alias = '';
        foreach ($arr_category_id as $key) {
            $cat = $this->get_record_by_id($key, $this->table_category);
//            var_dump($app);die;
            $cat_alias .= $cat->alias . ',';
        }
//        var_dump($app_alias);die;
        $row ['category_alias'] = ',' . $cat_alias;
//var_dump($row);die;
        $manufactory_id = FSInput::get('manufactory', 0, 'int');
//        if (!$manufactory_id) {
//            Errors::_('You must select manufactory');
//        }
//        $arr_manufactory_id = FSInput::get ( 'manufactory', 6, 'int' );
//        $str_manufactory_id = implode ( ',', $arr_manufactory_id );
//        var_dump($str_manufactory_id);die;
//        $row ['manufactory'] = $arr_manufactory_id;
//        $row ['manufactory_alias'] = $arr_manufactory_id;
//        else {
            $manu = $this->get_record_by_id($manufactory_id, $this->table_manufactory);
//         var_dump($manu);die;
            // $row ['category_id_wrapper'] = $cat->list_parents;
            // $row ['category_root_alias'] = $cat->root_alias;
            // $row ['category_alias_wrapper'] = $cat->alias_wrapper;
            $row ['manufactory_name'] = $manu->name;
            $row ['manufactory_alias'] = $manu->alias;
//            var_dump($row);
//         var_dump($row);die;
//        }
//

        $arr_application_id = FSInput::get('application', array(), 'array');
//        var_dump($arr_application_id);die;
        $str_application_id = implode(',', $arr_application_id);
//        var_dump($str_manufactory_id);die;
        $row ['application'] = $str_application_id;
        $app_alias = '';
        foreach ($arr_application_id as $key) {
            $app = $this->get_record_by_id($key, $this->table_application);
//            var_dump($app);die;
            $app_alias .= $app->alias . ',';
        }
//        var_dump($app_alias);die;
        $row ['application_alias'] = ',' . $app_alias;

        $products_types_id = FSInput::get('types', 0, 'int');
        if (!$products_types_id) {
            Errors::_('You must select products_types');
//            return false;
        } else {
            $types = $this->get_record_by_id($products_types_id, $this->table_types);
            // var_dump($types);die;
            $row ['types_name'] = $types->name;
            $row ['types_id'] = $types->id;
            $row ['types_alias'] = $types->alias;
        }
        //price
        $price_old = FSInput::get('price_old');
        $row ['price_old'] = $price_old;
        $row ['price'] = $price_old;

        // products_relates
        $arr_products_relates_id = FSInput::get('products_relates', array(), 'array');
        $str_products_relates_id = implode(',', $arr_products_relates_id);
        if ($id) {

            $prd_main = $this->get_record('id=' . $id, 'fs_products', 'products_relates, id, name');
            foreach ($arr_products_relates_id as $key) {
                $prd_rlt = $this->get_record_by_id($key, $this->table_name);
//                var_dump($prd_rlt->products_relates);
                if (!$prd_rlt->products_relates) {
                    $where = ' id = ' . $prd_rlt->id;
                    $table = $this->table_name;
                    $row1 = array();
                    $row1['products_relates'] = ',' . $id . ',';
                    $ddd = $this->_update($row1, $table, $where);
                } else {
                    if (strpos($prd_rlt->products_relates, ',' . $id . ',') === false) {
                        $where = ' id = ' . $prd_rlt->id;
                        $table = $this->table_name;
                        $row2 = array();
                        $row2['products_relates'] = $prd_rlt->products_relates . $id . ',';
                        $ddd = $this->_update($row2, $table, $where);
                    }
                }
            }

            $prd_main1 = trim($prd_main->products_relates, ',');
            $arr_prd_main = explode(',', $prd_main1);
            $prd_other = array();
            foreach ($arr_prd_main as $key) {
                if (strpos($str_products_relates_id, ',' . $key . ',') === false) {
                    $prd_other[] = $key;
                }

//                    if ($prd_other) {
                foreach ($prd_other as $k) {
                    $prd_other_id = $this->get_record_by_id($k, $this->table_name);
//                    var_dump($prd_other_id);
                    if ($prd_other_id) {
                        $prd_other_id1 = $prd_other_id->products_relates;
                        $str_prd_other_id1 = trim($prd_other_id1, ',');
                        $arr_prd_other_id1 = explode(',', $str_prd_other_id1);
                        $new_relates = array();
                        foreach ($arr_prd_other_id1 as $v) {
                            if ($v != $id) {
                                $new_relates[] = $v;
                            }
                        }
                        if ($new_relates) {
                            $str_new_relates = implode(',', $new_relates);
                            $row3 = array();
                            $row3['products_relates'] = ',' . $str_new_relates . ',';
                        } else {
                            $str_new_relates = '';
                            $row3 = array();
                            $row3['products_relates'] = $str_new_relates;
                        }
                        $where = ' id = ' . $prd_other_id->id;
                        $table = $this->table_name;
                        $ddd = $this->_update($row3, $table, $where);
                    }
                }
            }
        }
        if ($str_products_relates_id) {
            $row ['products_relates'] = ',' . $str_products_relates_id . ',';
//                var_dump($row ['products_relates']);die;
        } else {
            $row ['products_relates'] = '';

        }


        $username = $_SESSION['ad_username'];
        if (!$id) {
            $row['user_full_name'] = $username;
        } else {
            $row['user_full_name'] = $username;
        }

        $image_name_icon = $_FILES["icon"]["name"];
        if ($image_name_icon) {
            $image_icon = $this->upload_image('icon', '_' . time(), 5000000, $this->arr_img_paths_icon);
            if ($image_icon) {
                $row['icon'] = $image_icon;
            }
        }

        $cyear = date('Y');
        $path = PATH_BASE . 'images' . DS . 'upload_file' . DS . $cyear . DS;
        require_once(PATH_BASE . 'libraries' . DS . 'upload.php');
        $upload = new  Upload();
        $upload->create_folder($path);


        $file_price = $_FILES["file_price"]["name"];
//        var_dump($file_price);die;
        if ($file_price) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_price_name = $fsFile->upload_file("file_price", $path_original, 50000000, '_' . time());
            if (!$file_price_name)
                return false;
            $row['file_price'] = 'images/upload_file/' . $cyear . '/' . $file_price_name;
        }
        $file_driver = $_FILES["file_driver"]["name"];
        if ($file_driver) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_driver_name = $fsFile->upload_file("file_driver", $path_original, 50000000, '_' . time());
            if (!$file_driver_name)
                return false;
            $row['file_driver'] = 'images/upload_file/' . $cyear . '/' . $file_driver_name;
        }

        $file_download1 = $_FILES["file_download1"]["name"];
        if ($file_download1) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_download1_name = $fsFile->upload_file("file_download1", $path_original, 50000000, '_' . time());
            if (!$file_download1_name)
                return false;
            $row['file_download1'] = 'images/upload_file/' . $cyear . '/' . $file_download1_name;
        }


        $file_download2 = $_FILES["file_download2"]["name"];
        if ($file_download2) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_download2_name = $fsFile->upload_file("file_download2", $path_original, 50000000, '_' . time());
            if (!$file_download2_name)
                return false;
            $row['file_download2'] = 'images/upload_file/' . $cyear . '/' . $file_download2_name;
        }


        $file_download3 = $_FILES["file_download3"]["name"];
        if ($file_download3) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_download3_name = $fsFile->upload_file("file_download3", $path_original, 50000000, '_' . time());
            if (!$file_download3_name)
                return false;
            $row['file_download3'] = 'images/upload_file/' . $cyear . '/' . $file_download3_name;
        }


        $file_download4 = $_FILES["file_download4"]["name"];
        if ($file_download4) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_download4_name = $fsFile->upload_file("file_download4", $path_original, 50000000, '_' . time());
            if (!$file_download4_name)
                return false;
            $row['file_download4'] = 'images/upload_file/' . $cyear . '/' . $file_download4_name;
        }


        $file_download5 = $_FILES["file_download5"]["name"];
        if ($file_download5) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_download5_name = $fsFile->upload_file("file_download5", $path_original, 50000000, '_' . time());
            if (!$file_download5_name)
                return false;
            $row['file_download5'] = 'images/upload_file/' . $cyear . '/' . $file_download5_name;
        }


        $file_download6 = $_FILES["file_download6"]["name"];
        if ($file_download6) {
            $path_original = $path;
            // remove old if exists record and img
            if ($id) {
                $img_paths = array();
                $img_paths[] = $path_original;
                // special not remove when update
//					$this -> remove_file($id,$img_paths,'file_upload');
            }
            $fsFile = FSFactory::getClass('FsFiles');
            // upload
            $file_download6_name = $fsFile->upload_file("file_download6", $path_original, 50000000, '_' . time());
            if (!$file_download6_name)
                return false;
            $row['file_download6'] = 'images/upload_file/' . $cyear . '/' . $file_download6_name;
        }
//
//        var_dump($row);
//        die;

        $id = parent::save($row, 1);
        if (!$id) {
            Errors::setError('Not save');
            return false;
        }
        $arr_products_relates_id = FSInput::get('products_relates', array(), 'array');
//        var_dump($arr_products_relates_id);
//        $str_products_relates_id = implode(',', $arr_products_relates_id);
        foreach ($arr_products_relates_id as $key) {
            $prd_rlt = $this->get_record_by_id($key, $this->table_name);
            if (!$prd_rlt->products_relates) {
                $where = ' id = ' . $prd_rlt->id;
                $table = $this->table_name;
                $row1 = array();
                $row1['products_relates'] = ',' . $id . ',';
//                var_dump($row1);die;
                $ddd = $this->_update($row1, $table, $where);
            } else {
                if (strpos($prd_rlt->products_relates, ',' . $id . ',') === false) {
                    $where = ' id = ' . $prd_rlt->id;
                    $table = $this->table_name;
                    $row2 = array();
                    $row2['products_relates'] = $prd_rlt->products_relates . $id . ',';

                    $ddd = $this->_update($row2, $table, $where);
                }
            }
        }
        return $id;

    }

    /*
         * Save all record for list form
         */
    function save_all()
    {
        $total = FSInput::get('total', 0, 'int');
        if (!$total)
            return true;
        $field_change = FSInput::get('field_change');
        if (!$field_change)
            return false;

        // 	calculate filters:
        $arr_table_name_changed = array();

        $field_change_arr = explode(',', $field_change);
        $total_field_change = count($field_change_arr);
        $record_change_success = 0;
        for ($i = 0; $i < $total; $i++) {
            $str_update = '';
            $update = 0;
            $row = array();
            foreach ($field_change_arr as $field_item) {
                $field_value_original = FSInput::get($field_item . '_' . $i . '_original');
                $field_value_new = FSInput::get($field_item . '_' . $i);
                if (is_array($field_value_new)) {
                    $field_value_new = count($field_value_new) ? ',' . implode(',', $field_value_new) . ',' : '';
                }

                if ($field_value_original != $field_value_new) {
                    $update = 1;
                    //	        	          $row[$field_item] = htmlspecialchars_decode($field_value_new);
                    $row [$field_item] = htmlspecialchars_decode($field_value_new);
                    //	        	          $str_update[] = "`".$field_item."` = '".$field_value_new."'";
                }
            }
            if ($update) {
                // update price when change discount
                $discount = FSInput::get('discount_' . $i);
                $discount_unit = FSInput::get('discount_unit_' . $i);
                $price = FSInput::get('price_' . $i);
                $price = $this->standart_money($price, 0);
                $price_old = FSInput::get('price_old_' . $i);
                $price_old = $this->standart_money($price_old, 0);
                $row ['price'] = $price;
                $row ['price_old'] = $price_old;
                if ($discount_unit == 'percent') {
                    if ($discount > 100 || $discount < 0) {
                    } else {
                        $row ['price'] = $price_old * (100 - $discount) / 100;
                    }
                } else {
                    if ($discount > $price_old || $discount < 0) {
                    } else {
                        $row ['price'] = $price_old - $discount;
                    }
                }
                // user
                $user_group = $_SESSION['ad_group'];
                $user_id = $_SESSION['ad_userid'];
                $username = $_SESSION['ad_username'];
                $fullname = $_SESSION['ad_fullname'];

                // $row2['editor_id'] = $user_id;
                // $row2['editor_name'] = $username;


                $id = FSInput::get('id_' . $i, 0, 'int');
                $rs = $this->_update($row, $this->table_name, '  id = ' . $id, 0);
                $this->_update($row2, $this->table_name, '  id = ' . $id, 0);
                if ($this->use_table_extend) {
                    $record = $this->get_record('id = ' . $id, $this->table_name);
                    $table_extend = $record->tablename;
                    // calculate filters:
                    $arr_table_name_changed [] = $table_extend;
                    global $db;
                    if ($table_extend && $table_extend != 'fs_products' && $db->checkExistTable($table_extend)) {
                        $rs = $this->_update($row, $table_extend, '  record_id = ' . $id);
                    }
                }

                //synchronize
                $array_synchronize = $this->array_synchronize;
                if (count($array_synchronize)) {
                    foreach ($array_synchronize as $table_name => $fields) {
                        $i = 0;
                        $syn = 0;
                        $row5 = array();
                        $where = ' WHERE ';
                        foreach ($fields as $cur_field => $syn_field) {
                            if (!$i) {
                                $where .= $syn_field . ' = ' . $id;
                            } else {
                                if (isset ($row [$cur_field])) {
                                    $row5 [$syn_field] = $row [$cur_field];
                                    $syn = 1;
                                }
                            }
                            $i++;
                        }
                        if ($syn)
                            $rs = $this->_update($row5, $table_name, $where, 0);
                    }
                }

                if (!$rs) {
                    continue;
                }
//					return false;
                $record_change_success++;
            }
        }

        // calculate filters:
        if ($this->calculate_filters) {
            $this->caculate_filter($arr_table_name_changed);
        }
        return $record_change_success;
    }


    function getPaginations($str_cat_id)
    {
        $total = $this->getTotal($str_cat_id);
        $pagination = new Pagination($this->limit, $total, $this->page);
        return $pagination;
    }

    /*
     * show total of models
     */
    function getTotal($str_cat_id)
    {
        global $db;
        $query = $this->setQuery($str_cat_id);
        $sql = $db->query($query);
        $total = $db->getTotal();
        return $total;
    }

    function standart_money($money, $method)
    {
        $money = str_replace(',', '', trim($money));
        $money = str_replace(' ', '', $money);
        $money = str_replace('.', '', $money);
//		$money = intval($money);
        $money = (double)($money);
        if (!$method)
            return $money;
        if ($method == 1) {
            $money = $money * 1000;
            return $money;
        }
        if ($method == 2) {
            $money = $money * 1000000;
            return $money;
        }
    }

    /*
    * value: == 1 :hot
    * value  == 0 :unhot
    * published record
    */
    function home($value)
    {
        $ids = FSInput::get('id', array(), 'array');

        if (count($ids)) {
            global $db;
            $str_ids = implode(',', $ids);
            $sql = " UPDATE " . $this->table_name . "
							SET show_in_home = $value
						WHERE id IN ( $str_ids ) ";
            $db->query($sql);
            $rows = $db->affected_rows();
            return $rows;
        }
        // 	update sitemap
        if ($this->call_update_sitemap) {
            $this->call_update_sitemap();
        }

        return 0;
    }
}

?>