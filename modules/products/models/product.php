<?php

class ProductsModelsProduct extends FSModels
{
    function __construct()
    {
        $limit = 6;
        $page = FSInput::get('page');
        $this->limit = $limit;
        $this->page = $page;
        $this->type = 'products';
        $fs_table = FSFactory::getClass('fstable');
        $this->table_name = $fs_table->getTable('fs_products');
        $this->table_contact = $fs_table->getTable('fs_product_contact');
        $this->table_product_type = $fs_table->getTable('fs_products_types');
        $this->table_cate = $fs_table->getTable('fs_products_categories');
        $this->table_comment = $fs_table->getTable('fs_products_comments');
        $this->table_order = $fs_table->getTable('fs_order');
        $this->table_order_items = $fs_table->getTable('fs_order_items');
        $this->table_email = $fs_table->getTable('fs_email');
        $this->table_manu = $fs_table->getTable('fs_manufactories');
        $this->table_app = $fs_table->getTable('fs_application');
        $this->table_busi = $fs_table->getTable('fs_business');
        $this->table_khuvuc = $fs_table->getTable('fs_khuvuc');
        $this->table_city = $fs_table->getTable('fs_cities');
        //$this->table_name = 'fs_products';
        $module = FSInput::get('module', 'home');
        $view = FSInput::get('view', $module);

        $this->module = $module;
        $this->view = $view;

        $cyear = date('Y');
        $cmonth = date('m');
        $cday = date('d');
        $this->img_folder = 'images/' . $this->type . '/' . $cyear . '/' . $cmonth . '/' . $cday;
        $this->field_img = 'image';
        $this->load_params();
    }

    function load_params()
    {
        $module_params = $this->get_params($this->module, $this->view);

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

        //			FSFactory::include_class('parameters');
        //			$config_name = 'products_';
        //			$data_params = $this -> get_records('');
        //			if($data -> task)
        //				$config_name  = '_'.$data -> task;
        //			$config = isset($config_module[$config_name])?$config_module[$config_name]:array()  ;
        //
        //			$current_parameters = new Parameters($data->params);
        //			$params = isset($config['params'])?$config['params']: null;
    }

    /*
         * get Article
         */
    function get_product()
    {
        $id = FSInput::get('id');
        $code = FSInput::get('code');
        if (!$code && !$id)
            return;
        $fs_table = FSFactory::getClass('fstable');

        $select = '*';
        $where = " 1 = 1 ";
        if (!$id)
            $where .= ' AND alias = "' . $code . '"';
        else
            $where .= ' AND id = ' . $id;
        $result = $this->get_record($where, $fs_table->getTable('fs_products', 1), $select);
        return $result;
    }

    /*
         * get Category current
         */
    function getCategoryByCode()
    {
        $fs_table = FSFactory::getClass('fstable');
        $ccode = FSInput::get('ccode');
        if (!$ccode)
            return;
        $query = " SELECT id,name, alias,vat
						FROM " . $fs_table->getTable('fs_products_categories') . " 
						WHERE alias = '$ccode' ";
        global $db;
        $sql = $db->query($query);
        $result = $db->getObject();
        return $result;
    }

    function getCategoryById($id)
    {
        if (!$id)
            return;
        $fs_table = FSFactory::getClass('fstable');
        $query = " SELECT id,name,icon,alias,tags_group,tablename, root_id,list_parents,vat
						FROM " . $fs_table->getTable('fs_products_categories') . " 
						WHERE id = $id ";
        global $db;
        $sql = $db->query($query);
        $result = $db->getObject();
        return $result;
    }

    function get_products_in_cat($category_id, $record_id)
    {
        if (!$category_id || !$record_id)
            return;
        $limit = 4;
        $fs_table = FSFactory::getClass('fstable');
        $query = ' SELECT id,name,alias,price,image ,price_old ,discount
						FROM ' . $fs_table->getTable('fs_products') . '
						WHERE category_id = ' . $category_id . '
							AND published = 1 
							AND id <> ' . $record_id . '
							 ORDER BY id DESC LIMIT ' . $limit;
        //print_r($query);                     
        global $db;
        $sql = $db->query($query);
        $result = $db->getObjectListByKey('id');
        return $result;
    }


    function get_products_related($products_related, $record_id)
    {
        if (!$products_related || !$record_id)
            return;
        $limit = 3;
        $rest_products_related_ = substr($products_related, 1, -1);  // retourne "abcde"

        $fs_table = FSFactory::getClass('fstable');
        $query = " SELECT id,name,summary,image,price,price_old,discount,types, alias, category_id,category_alias,manufactory_image,manufactory_name
						  FROM " . $fs_table->getTable('fs_products') . "
						  WHERE ID IN ( $rest_products_related_ )
						  	AND id <>  $record_id
						  	AND published = 1
						     ORDER BY  ordering DESC , id DESC
						     LIMIT $limit
						 ";
        global $db;
        $sql = $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }


    function getImages($record_id)
    {
        if (!$record_id)
            return;
        $limit = 10;
        $fs_table = FSFactory::getClass('fstable');
        $query = ' SELECT id,image, record_id,title
						  FROM ' . $fs_table->getTable('fs_products_images') . '
						  WHERE record_id =  ' . $record_id . '
						     LIMIT ' . $limit;
        global $db;
        $sql = $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    /*
         * Lấy dữ liệu từ các bảng mở rộng
         */
    function get_all_data_foreign($extend_fields)
    {
        if (!count($extend_fields))
            return array();
        $data_foreign = array();
        foreach ($extend_fields as $field) {
            if ($field->field_type == 'foreign_one' || $field->field_type == 'foreign_multi') {
                $table_name = $field->foreign_tablename;
                $id = $field->foreign_id;
                $data_foreign [$field->field_name] = $this->get_records('id = ' . $id, $table_name);
            }
        }
        return $data_foreign;
    }

    /*
         * Lấy dữ liệu từ các bảng mở rộng
         */
    function get_data_foreign($table_name, $value, $type = 'foreign_one')
    {
        if (!$value)
            return;
        $where = '';
        if ($type == 'foreign_one') {
            $where = ' id = ' . intval($value) . ' ';
            return $this->get_result($where, $table_name, 'name');
        } else {
            $where = ' id IN (0' . $value . '0) ';
            $rs = $this->get_records($where, $table_name, 'name');
            $html = '<ul class="foreign_multi">';
            for ($i = 0; $i < count($rs); $i++) {
                $html .= '<li>' . $rs[$i]->name . '</li>';
            }
            $html .= '</ul>';
            return $html;
        }

    }

    /*
         * Lấy toạn bộ dữ liệu từ các bảng mở rộng
         */
    function get_all_foreign_data()
    {
        return $this->get_records('published = 1', 'fs_extends_items', '*', '', '', 'id');
    }


    function get_comments($record_id)
    {
        global $db;
        if (!$record_id)
            return;

        $query = ' SELECT *
						FROM ' . $this->table_comment . '
						WHERE record_id = ' . $record_id . '
							AND published = 1
						ORDER BY  created_time  DESC
						';
        $db->query($query);
        $result = $db->getObjectList();

        $tree = FSFactory::getClass('tree', 'tree/');
        $list = $tree->indentRows2($result);
        return $list;
    }


    function recalculate_comment($record_id, $time)
    {
        $sql = ' UPDATE  ' . $this->table_name . '
						SET comments_total = comments_total + 1,
						    comments_unread = comments_unread + 1,
						    comments_last_time = "' . $time . '" 
						    WHERE id = ' . $record_id . '
						';
        //print_r($sql);die;                
        global $db;
        $db->query($sql);
        $rows = $db->affected_rows();
    }

    function get_products_by_ids($str_products_together)
    {
        if (!$str_products_together)
            return;
        $query = " SELECT name,id , image, alias,category_alias,summary
						FROM fs_products
						WHERE id IN (" . $str_products_together . ") 
						AND published = 1";
        global $db;
        $sql = $db->query($query);
        $result = $db->getObjectListByKey('id');
        return $result;
    }

    /*
         * Lấy danh sách category
         */
    function get_list_parent($list_parents)
    {
        if (!$list_parents)
            return;
        $fs_table = FSFactory::getClass('fstable');
        $query = 'SELECT name,id,alias,parent_id FROM ' . $fs_table->getTable('fs_products_categories') . ' WHERE id IN (0' . $list_parents . '0) 
					ORDER BY parent_id ASC';
        global $db;
        $db->query($query);
        $list = $db->getObjectList();
        return $list;
    }

    /*
         * get alias of parent_root
         */
    function get_ext_fields($tablename)
    {
        // get rootid
        if (!$tablename)
            return;

        global $db;
        // query get alias
        // tam thơi xóa điều kiệns AND is_compare = 1
        $query = " SELECT *
						FROM fs_products_tables 
						WHERE table_name = '$tablename'
						ANd  is_filter <> 1 
						ORDER BY ordering  
						 ";
        $db->query($query);
        $rs = $db->getObjectList();
        return $rs;
    }

    function get_news_relate_tags($tag, $tablename)
    {
        if (!$tag)
            return;
        $arr_tags = explode(',', $tag);
        $where = ' WHERE published = 1';
        $total_tags = count($arr_tags);
        if ($total_tags) {
            $where .= ' AND (';
            $j = 0;
            for ($i = 0; $i < $total_tags; $i++) {
                $item = trim($arr_tags [$i]);
                if ($item) {
                    if ($j > 0)
                        $where .= ' OR ';
                    $where .= " tags like '%" . $item . "%'";
                    $j++;
                }
            }
            $where .= ' )';
        }

        global $db;
        $limit = 5;
        $fs_table = FSFactory::getClass('fstable');

        $query = " SELECT id,title,alias ,category_id ,image , category_alias ,summary,created_time
						FROM " . $fs_table->getTable($tablename) . " 
						" . $where . "
						ORDER BY id DESC,ordering DESC
						LIMIT 0,$limit
						";
        $db->query($query);
        $result = $db->getObjectList();

        return $result;
    }

    function get_types()
    {
        return $list = $this->get_records('published = 1', $this->table_product_type, 'id,name,image', 'ordering ASC');
    }

    function update_hits($record_id)
    {
        if (USE_MEMCACHE) {
            $fsmemcache = FSFactory::getClass('fsmemcache');
            $mem_key = 'array_hits';

            $data_in_memcache = $fsmemcache->get($mem_key);
            if (!isset($data_in_memcache))
                $data_in_memcache = array();
            if (isset($data_in_memcache[$record_id])) {
                $data_in_memcache[$record_id]++;
            } else {
                $data_in_memcache[$record_id] = 1;
            }
            $fsmemcache->set($mem_key, $data_in_memcache, 10000);

        } else {
            if (!$record_id)
                return;

            // count
            global $db, $econfig;
            $sql = " UPDATE $this->table_name
					SET hits = hits + 1 
					WHERE  id = '$record_id' 
				 ";
            $db->query($sql);
            $rows = $db->affected_rows();
            return $rows;
        }
    }

    function get_price_product()
    {
        $fs_table = FSFactory::getClass('fstable');
        $price_id = FSInput::get('price_id');
        if (!$price_id)
            return;
        $query = " SELECT *
						FROM " . $fs_table->getTable('fs_products_price') . " 
						WHERE id = $price_id";
        global $db;
        $sql = $db->query($query);
        $result = $db->getObject();
        return $result;
    }

    /*
     * get temporary data stored in fs_order
     * 1
     */
    function getOrder()
    {
        $session_id = session_id();
        $query = ' SELECT *
						FROM ' . $this->table_order_items . '
						WHERE  session_id = "' . $session_id . '" 
						AND is_temporary = 1 ';
        global $db;
        $db->query($query);
        return $rs = $db->getObject();

    }

    function get_user()
    {
        if (!isset($_SESSION['username']))
            return false;
        $username = $_SESSION['username'];
        if (!$username)
            return;
        $query = " SELECT full_name,sex,address as address,email, mobilephone,mobilephone
						FROM fs_members 
						WHERE  username = '$username' ";
        global $db;
        $db->query($query);
        return $rs = $db->getObject();
    }

    /*
     * if currency = 'VND' return
     * else transform.
     */
    function getPrice()
    {
        $record_id = FSInput::get('id');
        if (!$record_id)
            return -1;
        $query = " SELECT price,  discount
						FROM $this->table_name
						WHERE id = $record_id
						 ";
        global $db;
        $db->query($query);
        $rs = $db->getObject();

        return array($rs->price, $rs->discount);
    }

    function eshopcart2_simple_save()
    {

        //$username = isset($_SESSION['username'])?$_SESSION['username'] : '';
        //$user_id = $this ->get_user_id();
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $user_id = '';

        $sender_email = FSInput::get('sender_email');

        if (!$sender_email)
            return;


        $product_list = $_SESSION['cart'];

        $quantity = FSInput::get('quantity');
        $price = FSInput::get('price');
        $warranty = FSInput::get('warranty');
//			$total_before_discount = $quantity*$price; 

        if ($warranty == 1) {
            $total_before_discount = $price * $quantity;
        } else if ($warranty == 2) {
            $total_before_discount = ($price + 300000) * $quantity;
        } else {
            $total_before_discount = ($price + 600000) * $quantity;
        }
        $total_after_discount = $total_before_discount;
        $products_count = $quantity;
        $prd_id_str = FSInput::get('id');

        $session_id = session_id();

        $sender_name = FSInput::get('sender_name');
        $sender_telephone = FSInput::get('sender_telephone');
        $sender_address = FSInput::get('sender_address');
        $time = date("Y-m-d H:i:s");
        if (!$sender_name || !$sender_email)
            return false;

        $fsstring = FSFactory::getClass('FSString');
        $random_string = $fsstring->generateRandomString(8);
        $code_order = $random_string;

        $sql = " INSERT INTO 
					fs_order (`username`,`user_id`,products_id,is_temporary,session_id,sender_name,
								sender_address,sender_email,sender_telephone,
								created_time,edited_time,total_before_discount,total_after_discount,products_count,is_activated,code_order)
					VALUES ('$username','$user_id','$prd_id_str','0','$session_id','$sender_name',
								'$sender_address','$sender_email','$sender_telephone',
								'$time','$time','$total_before_discount','$total_after_discount','$products_count','0','$code_order');
					";
        global $db;
        $db->query($sql);
        $id = $db->insert();

        // update
        $this->save_order_items($id);

        return $id;
    }

    function get_user_id()
    {
        $username = $_SESSION['username'];
        if (!$username)
            return;
        $query = " SELECT id
						FROM fs_members 
						WHERE  username = '$username' ";
        global $db;
        $db->query($query);
        return $rs = $db->getResult();
    }

    /*
     * Save data into fs_order_items
     */
    function save_order_items($order_id)
    {
        if (!$order_id)
            return false;

        global $db;

        // remove before update or inser
        $sql = " DELETE FROM fs_order_items
					WHERE order_id = '$order_id'";

        $db->query($sql);
        $rows = $db->affected_rows();

        $quantity = FSInput::get('quantity');
        $price = FSInput::get('price');
        $price_old = FSInput::get('price_old');
        $products_count = $quantity;
        $prd_id = FSInput::get('id');
        $warranty = FSInput::get('warranty');

        if ($warranty == 1) {
            $total_money = $price * $quantity;
        } else if ($warranty == 2) {
            $total_money = ($price + 300000) * $quantity;
        } else {
            $total_money = ($price + 600000) * $quantity;
        }
//			$total_money = $quantity*$price;

        // insert data
        $sql = " INSERT INTO fs_order_items (order_id,record_id,price,count,discount,total,warranty)
					VALUES ('$order_id','$prd_id','$price','$quantity','$price_old','$total_money','$warranty')  ";

        $db->query($sql);
        $rows = $db->affected_rows();
        return true;


    }
    //function get_users_by_ids($str_user_ids){
//			if (! $str_user_ids)
//				return;
//			$limit = 10;
//			$fs_table = FSFactory::getClass ( 'fstable' );
//			$query = ' SELECT *
//							  FROM ' . $fs_table->getTable ( 'fs_members' ) . '
//							  WHERE id IN (0'.$str_user_ids.',0)
//							   ORDER BY ordering 
//							 ';
//			global $db;
//			$sql = $db->query ( $query );
//			$result = $db->getObjectListByKey('id');
//			return $result;
//		}

    function get_condition($condition_id)
    {
        return $this->get_record_by_id($condition_id, 'fs_buy_conditions');
    }

    function get_status($condition_id)
    {
        return $this->get_record_by_id($condition_id, 'fs_buy_status');
    }

    function getproducts_content()// không sử dụng limit để show danh sách
    {
        $id = FSInput::get('id', 0, 'varchar');
        if ($id) {
            $where = " AND id = " . $id . " ";
        } else {
            $code = FSInput::get('code');
            if (!$code)
                die('Not exist this url');
            $where = " AND alias = '$code' ";
        }
        $query = "SELECT * FROM $this->table_name WHERE published = 1" . $where;
        global $db;
        $db->query($query);
        $result = $db->getObject();
        return $result;
    }

    function getproducts_all()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_name WHERE published = 1";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;


    }

    function getkhuvuc($id, $id_sp)// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_busi WHERE published = 1 and khuvuc = " . $id . " and products like '%" . $id_sp . "%'";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function getlienhe( $id_sp)// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_busi WHERE published = 1  and lienhe like '%," . $id_sp . ",%' order by RAND()";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getlienhe_kdmb( $id_sp)// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_busi WHERE published = 1  and lienhe_kdmb like '%," . $id_sp . ",%' order by RAND()";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getlienhe_kd( $id_sp)// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_busi WHERE published = 1  and lienhe_kd like '%," . $id_sp . ",%' order by RAND()";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getlienhe_kt( $id_sp)// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_busi WHERE published = 1  and lienhe_kt like '%," . $id_sp . ",%' order by RAND()";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getlienhe_kdmn( $id_sp)// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_busi WHERE published = 1  and lienhe_kdmn like '%," . $id_sp . ",%' order by RAND()";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function getkhuvuc_chimuc()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_khuvuc WHERE published = 1";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function getcity()// không sử dụng limit để show danh sách
    {
        $query = "SELECT * FROM $this->table_city WHERE published = 1";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }

    function save_hits()
    {
        $version = FSInput::get('version');
        $type = FSInput::get('type');
//        var_dump($type);
        $products_id = FSInput::get('id');
        $product_alll = $this->get_record('published = 1 and id =' . $products_id, $this->table_name);
//var_dump($product_detail);
        if ($products_id) {
            $where = " AND id = '$products_id' ";
        }
        if ($version == $product_alll->file_name1) {
            $set = 'hit1 = hit1+1';
        }
        else if($version == $product_alll->file_name2){
            $set = 'hit2 = hit2+1';
        }
        else if($version == $product_alll->file_name3){
            $set = 'hit3 = hit3+1';
        }
        else if($version == $product_alll->file_name4){
            $set = 'hit4 = hit4+1';
        }
        else if($version == $product_alll->file_name5){
            $set = 'hit5 = hit5+1';
        }
        else {
            $set = 'hit6 = hit6+1';
        }
        $query = "UPDATE ".$this->table_name."
                    SET " . $set . "
	                WHERE published = 1" . $where;
        global $db;
        $db->query($query);
        $id = $db->insert();
        return $id;
    }

    function save()
    {
        $type = FSInput::get('type');
        $products_id = FSInput::get('id');
//        echo $products_id; die;
        // echo "1";die;
        // $i = FSInput::get('i');
        $email = FSInput::get('email');
        $fullname = FSInput::get('name');
        $address = FSInput::get('address');
        $telephone = FSInput::get('phone');
        $city = FSInput::get('city');
        $message = FSInput::get('message');
        $company = FSInput::get('company');
        $type = FSInput::get('type');
        $products_id = FSInput::get('id');
        $products_alias = FSInput::get('alias');
        $products_name = FSInput::get('products_name');
        $version = FSInput::get('version');
        // $quantity = FSInput::get('quantity');
        //$website = FSInput::get('website');
        //$subject = FSInput::get('contact_subject');


        $param = 'Name='.$fullname.'&Company='.$company.'&Address='.$address.'&City='.$city.'&Email='.$email.'&Mobile='.$telephone.'&Comment='.$message.'&Software='. $products_name;
//        var_dump($param);die;
        $param = str_replace(" ","%20",$param);
//echo $param;die;
        $url = 'https://dskh.cic.com.vn/addcustomer.php?'.$param;

//         var_dump($url);die;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);

        // $city = FSInput::get('city');
        // $districts = FSInput::get('districts');
        // $type = FSInput::get('type',0,'int');

        // $total_ = FSInput::get('_total_price',0,'int');
        // $quantity = FSInput::get('_quantity',0,'int');

//        $content = $data_html . htmlspecialchars_decode(FSInput::get('message'));
        $time = date("Y-m-d H:i:s");
        $published = 1;

        $sql = " INSERT INTO 
						" . $this->table_contact . " (email,fullname,address,telephone,edited_time,created_time,message, company, country,type, products_id, products_alias, products_name, version, published)
						VALUES ('$email','$fullname','$address','$telephone','$time','$time','$message','$company','$city','$type','$products_id','$products_alias', '$products_name','$version','$published')";
        global $db;
        $db->query($sql);
        $id = $db->insert();
        return $id;

    }

    function save_home()
    {
        // echo "1";die;
        // $i = FSInput::get('i');
        $email = FSInput::get('email');
        $fullname = FSInput::get('name');
        $address = FSInput::get('address');
        $telephone = FSInput::get('phone');
        $city = FSInput::get('city');
        $message = FSInput::get('message');
        $company = FSInput::get('company');
        $type = FSInput::get('type');
        $products_id = FSInput::get('id');
        $products_alias = FSInput::get('alias');
        $products_name = FSInput::get('products_name');
        $version = FSInput::get('version');

        // $quantity = FSInput::get('quantity');
        //$website = FSInput::get('website');
        //$subject = FSInput::get('contact_subject');


        // $city = FSInput::get('city');
        // $districts = FSInput::get('districts');
        // $type = FSInput::get('type',0,'int');

        // $total_ = FSInput::get('_total_price',0,'int');
        // $quantity = FSInput::get('_quantity',0,'int');

        $content = $data_html . htmlspecialchars_decode(FSInput::get('message'));
        $time = date("Y-m-d H:i:s");
        $published = 1;

        $sql = " INSERT INTO 
						" . $this->table_contact . " (email,fullname,address,telephone,edited_time,created_time,message, company, country,type, products_id, products_alias, products_name, version)
						VALUES ('$email','$fullname','$address','$telephone','$time','$time','$message','$company','$city','$type','$products_id','$products_alias','$products_name','$version')";
        global $db;
        $db->query($sql);
        $id = $db->insert();
        return $id;

    }

    function getproducts_relates($id)
    {
        $query = "SELECT * FROM ".$this->table_name." WHERE published = 1 and id in (0".$id."0)";
        global $db;
        $db->query($query);
        $result = $db->getObjectList();
        return $result;
    }
    function getemail($id)
    {
        $query = "SELECT * FROM ".$this->table_email." WHERE published = 1 and id =".$id;
        global $db;
        $db->query($query);
        $result = $db->getObject();
        return $result;
    }
    /*
      * update lai record_id
      */

    function get_download($id)
    {
        if (!$id)
            return;

        $query = ' SELECT *
    					  FROM  ' . $this->table_name . '
    					  WHERE id = ' . $id;
        global $db;
        $db->query($query);
        $result = $db->getObject();
        return $result;
    }
}

?>