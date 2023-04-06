<?php

/**
 * author: AnhPT
 * date:   2018-11-30 07:16 AM
 * Class ProductsControllersProduct
 */
class ProductsControllersProduct extends FSControllers
{
    var $module;
    var $view;

    function __construct()
    {
        parent::__construct();
        $arr_layout = array(array('characteristic', 'Thông số kĩ thuật', 'thong-so-ki-thuat'), array('accessories', 'Phụ kiện', 'phu-kien'));
        $this->arr_layout = $arr_layout;
    }

    function display()
    {
        // call models
        $model = $this->model;
        $products_content = $model->get_product();
//        var_dump($products_content);die;
        $data = $products_content;
//        var_dump($data);
        if (!$data)
            setRedirect(URL_ROOT, FSText::_('Sản phẩm này không tồn tại'), 'error');

        // seo
        global $tmpl, $module_config;
        $tmpl->set_data_seo($data);

        $product_images = $model->getImages($data->id);
        // products in cat
//        $products_in_cat = $model->get_products_in_cat($data->category_id, $data->id);

// 		breadcrumbs
        $lis_cat_parent = $model->get_list_parent($data->category_id_wrapper);
        //$breadcrumbs [] = array (0 => 'Sản phẩm', 1 => FSRoute::_ ( 'index.php?module=products&view=home' ) );
        for ($i = 0; $i < count($lis_cat_parent); $i++) {
            $item = $lis_cat_parent [$i];
            $breadcrumbs [] = array(0 => $item->name, 1 => FSRoute::_('index.php?module=products&view=cat&ccode=' . $item->alias . '&cid=' . $item->id . '&Itemid=10'));

        }
//        $products_content = $model->getproducts_content();
        if ($products_content->products_relates && $products_content->products_relates != ',,' ) {
            $products_relates = $model->getproducts_relates($products_content->products_relates);
        }
        $str = $products_content->tags;
        $tag1 = explode(',', $str);
        // var_dump($tag1 );
        global $tmpl;
        $tmpl->assign('breadcrumbs', $breadcrumbs);
        $tmpl->assign('member_id', $data->user_id);
        $products_all = $model->getproducts_all();
        // $khuvuc = $model->getkhuvuc();
        $khuvuc_chimuc = $model->getkhuvuc_chimuc();
        $city = $model->getcity();
//        $lienhe = $model->getlienhe($products_content->id);
//         var_dump($lienhe);die;
        // call views
        include 'modules/' . $this->module . '/views/' . $this->view . '/default.php';
    }


    function show_layout($link_image_remote)
    {
        $layout = FSInput::get('layout', 'thong-so-ki-thuat');
        $arr_layout = $this->arr_layout;
        $Itemid = FSInput::get('Itemid');
        $id = FSInput::get('id');
        foreach ($arr_layout as $item) {
            //				$link  = FSRoute::_("index.php?module=products&view=product&id=$id&layout=$item[2]&Itemid=$Itemid");
            $link = FSRoute::addParameters('layout', $item [2]);
            if ($layout == $item [2]) {
                echo "<li class='prd_cat_current'> <span>&nbsp; </span> <a  href='" . $link . "' ><span>" . $item [1] . "</span></a>";
            } else {
                echo "<li class='prd_cat_menu'><span>&nbsp; </span><a  href='" . $link . "' ><span>" . $item [1] . "</span></a>";
            }
        }
        echo "<li class='prd_cat_menu'><span>&nbsp; </span><a  href='" . $link_image_remote . "' target='_blink' ><span>" . 'Ảnh' . "</span></a>";
    }

    function get_layout()
    {
        $arr_layout = $this->arr_layout;
        $layout = FSInput::get('layout', 'thong-so-ki-thuat');
        foreach ($arr_layout as $item) {
            if ($layout == $item [2]) {
                return $item [0];
            }
        }
        return $arr_layout [0] [0];
    }

    /*
         * Save rating
         */
    function rating()
    {
        $model = $this->model;
        if (!$model->save_rating()) {
            echo '0';
            return;
        } else {
            echo '1';
            return;
        }
    }

    function rating_design()
    {
        $model = $this->model;
        if (!$model->save_rating_design()) {
            echo '0';
            return;
        } else {
            echo '1';
            return;
        }
    }

    function rating_features()
    {
        $model = $this->model;
        if (!$model->save_rating_features()) {
            echo '0';
            return;
        } else {
            echo '1';
            return;
        }
    }

    function rating_performance()
    {
        $model = $this->model;
        if (!$model->save_rating_performance()) {
            echo '0';
            return;
        } else {
            echo '1';
            return;
        }
    }

    function vote_result()
    {
        $model = $this->model;
        if (!$model->save_vote_result()) {
            return;
        } else {
            $data = $model->get_product();
            $html = '';
            $html .= '<dl id="vote_grph">';
            $html .= '<dt>Thiết kế</dt>';
            $pdesign = $data->rating_design_sum ? ceil($data->rating_design_sum / $data->rating_count_vote) : 0;
            $pfeatures = $data->rating_features_sum ? ceil($data->rating_features_sum / $data->rating_count_vote) : 0;
            $pperformance = $data->rating_performance_sum ? ceil($data->rating_performance_sum / $data->rating_count_vote) : 0;
            $html .= '<dd id="vote_grph_design">';
            $html .= '<span class="img">';
            $html .= '<img width="' . ($pdesign * 10) . '%" src="' . URL_ROOT . '/modules/products/assets/images/spacer.gif">';
            $html .= '</span>';
            $html .= '<span class="number">' . $pdesign . '</span>';
            $html .= '</dd>';
            $html .= '<dt>Tính năng</dt>';
            $html .= '<dd id="vote_grph_features">';
            $html .= '<span class="img">';
            $html .= '<img width="' . ($pfeatures * 10) . '%" src="' . URL_ROOT . '/modules/products/assets/images/spacer.gif">';
            $html .= '</span>';
            $html .= '<span class="number">' . $pfeatures . '</span>';
            $html .= '</dd>';
            $html .= '<dt>Hiệu suất</dt>';
            $html .= '<dd id="vote_grph_performance">';
            $html .= '<span class="img">';
            $html .= '<img width="' . ($pperformance * 10) . '%" src="' . URL_ROOT . '/modules/products/assets/images/spacer.gif">';
            $html .= '</span>';
            $html .= '<span class="number">' . $pperformance . '</span>';
            $html .= '</dd>';
            $html .= '</dl>';
            $html .= '<form id="frmVote" name="frmVote" method="post">';
            $html .= '<div id="vote_rate">';
            $html .= '<select id="pDesign" name="pDesign" title="Design">';
            $html .= '<option value="">----</option>';
            for ($i = 1; $i <= 10; $i++) {
                $html .= '<option>' . $i . '</option>';
            }
            $html .= '</select>';
            $html .= '<select id="pFeatures" name="pFeatures" title="Features">';
            $html .= '<option value="">----</option>';
            for ($i = 1; $i <= 10; $i++) {
                $html .= '<option>' . $i . '</option>';
            }
            $html .= '</select>';
            $html .= '<select id="pPerformance" name="pPerformance" title="Performance">';
            $html .= '<option value="">----</option>';
            for ($i = 1; $i <= 10; $i++) {
                $html .= '<option>' . $i . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
            $html .= '<div id="vote_submit">';
            $html .= '<span class="number">' . $data->rating_count_vote . ' lần</span>';
            $html .= '<span class="submit">';
            $html .= '<input id="button_vote" type="button" value="Đánh giá">';
            $html .= '<input type="hidden" name="record_id" id="record_id" value="' . $data->id . '">';
            $html .= '</span>';
            $html .= '<br class="clear">';
            $html .= '</div>';
            $html .= '</form>';
            $html .= '<script>$( "#button_vote" ).click(function() {  alert( "Bạn đã đánh giá thiết bị này rồi !" );});</script>';

            echo $html;
            return;
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

    function ajax_compare()
    {
        $limit = 3;
        $id = FSInput::get('id', 0, 'int');
        $table_name = 'fs_products_' . FSInput::get('table_name');
        if (!$id || !$table_name) {
            echo '';
            return;
        }
        if (isset($_SESSION[$table_name])) {
            $compare = $_SESSION[$table_name];
        } else {
            $compare[0] = $id;
            $_SESSION[$table_name] = $compare;
            echo '';
            return;
        }
        // kiểm tra trùng lặp
        $is_duplicate = 0;
        foreach ($compare as $pos => $record_id) {
            if ($id == $record_id) {
                $is_duplicate = 1;
            }
        }
        // nếu ko trùng lặp
        if (!$is_duplicate) {
            $stt = 1;
            if ((count($compare) + 1) >= $limit) {
                $compare[0] = $id;
            } else {
                for ($i = 0; $i < $limit; $i++) {
                    if (empty($compare[$i])) {
                        $compare[$i] = $id;
                        $positon = $i;
                        break;
                    } else {
                        $stt = $stt + 1;
                    }
                }
            }
            $_SESSION[$table_name] = $compare;
        }
        if (count($compare) <= 1) {
            echo '';
            return;
        }
        $str_list_id = '';
        foreach ($compare as $pos => $record_id) {
            if ($str_list_id)
                $str_list_id .= '_';
            $str_list_id .= $record_id;
        }

        echo '/so-sanh-san-pham.html&list=' . $str_list_id;
        return;
    }

    // update hits
    function update_hits()
    {
        $model = new ProductsModelsProduct();
        $product_id = FSInput::get('id');
        $model->update_hits($product_id);
    }

    function get_data_foreign($table_name, $value, $type)
    {
        $model = $this->model;
        return $model->get_data_foreign($table_name, $value, $type);
    }

    function fetch_price_product()
    {
        $model = $this->model;
        $price = FSInput::get('price');
        $data = $model->get_price_product();
        $html = "";
        $html .= "<span>" . format_money($price + $data->price, 'đ') . "</span>";
        echo $html;
        return;
    }

    function fetch_location_product_by_color()
    {
        $model = $this->model;
        $color_id = FSInput::get('color_id');
        $rid = FSInput::get('rid');
        $data = $model->get_price_product();
        $html = '';
        $html .= '<span class="pull-left">Giá bán tại: </span>';
        $html .= '<div class="select-box1 pull-left">';
        $html .= '<select name="quantity" onchange="load_quantity_product_by_color(this.value,' . $rid . ',' . $color_id . ')">';
        $html .= '<option value="sl_hn" selected="selected" >Hà Nội</option>';
        $html .= '<option value="sl_hcm">Tp.Hồ Chí Minh</option>';
        $html .= '<option value="sl_dn">Đà Nẵng</option>';
        $html .= '</select>';
        $html .= '</div>';
        echo $html;
        return;
    }

    function fetch_total_color_quantity_product()
    {
        $model = $this->model;
        $location = FSInput::get('location');
        $rid = FSInput::get('rid');
        $price_by_color = $model->get_price_by_colors($rid);
        $quantity = 0;
        foreach ($price_by_color as $item) {
            $quantity += $item->$location;
        }
        $total = $quantity;
        if ($total == 0) {
            echo '<div class="sold_out">Hết hàng</div>';
        } else {
            echo '<div class="in_stock">Còn hàng</div>';
        }

        return;
    }

    function fetch_quantity_product_by_color()
    {
        $model = $this->model;
        $location = FSInput::get('location');
        $location = ($location) ? $location : 'sl_hn';
        $rid = FSInput::get('rid');
        $color_id = FSInput::get('color_id');
        $price_by_color = $model->get_price_by_colors($rid);
        $quantity = 0;
        foreach ($price_by_color as $item) {
            if ($item->color_id == $color_id)
                $quantity += $item->$location;
        }
        $total = $quantity;
        if ($total == 0) {
            echo 'Hết hàng';
        } elseif ($total > 0 && $total <= 3) {
            echo 'Còn ít hàng';
        } else {
            echo 'Còn hàng';
        }

        return;

    }

    function ajax_check_notification()
    {
        $model = $this->model;
        $product_id = FSInput::get('id');

    }

    function save()
    {
//         echo "1";die;
        $model = $this->model;
        $return = FSInput::get('return');
         if ($this->check_captcha()==false) {
//              $link = FSRoute::_("index.php?module=product&Itemid=14");
             $msg = FSText::_("Bạn đã nhập sai mã capcha. ");
             setRedirect($return,$msg);
         }
        $id_product = FSInput::get('id');

        $alias = FSInput::get('alias');
        $id = $model->save();
//                var_dump($id);die;

        $link = FSRoute::_("index.php?module=products&view=product&code=" . $alias . "&id=" . $id_product);
        if ($id) {
            $email = FSInput::get('email');

            $msg = FSText::_(" Cảm ơn bạn đã liên lạc với chúng tôi. Thông tin của sản phẩm đã được gửi về mail: $email ");
            $this->sendmail();
            $this->dem();
            setRedirect($link, $msg);
        } else {

            $msg = FSText::_(" Chưa thêm vào liên hệ. ");

            setRedirect($link, $msg);
        }
    }

    function dem()
    {
        $model = $this->model;
        $model->save_hits();
    }
//        sendmaill old
//        function sendmailall(){
//            $model = $this->model;
//            // send Mail()
//            $mailer = FSFactory::getClass('Email','mail');
//            $global = new FsGlobal();
//
//            // Recipient
//
//            $to = $global-> getConfig('admin_email');
//            // var_dump($site_name);die;
//
//            global $config;
//
//            $email = FSInput::get('email');
//            $fullname = FSInput::get('name');
//            $type = FSInput::get('type');
//            $products_id = FSInput::get('id');
//            $mailer -> isHTML(true);
//            $mailer -> setSender(array($to,'cic.com.vn'));
//            $mailer -> AddAddress($email,$fullname);
//            $version = FSInput::get('version');
//
//            // $mailer -> AddBCC('dungpd@finalstyle.com','pham duc dung');
//            $mailer -> setSubject('CIC | '.$type);
//            $product_detail= $model->get_record('published = 1 and id =' .$products_id ,'fs_products');
////            var_dump($product_detail);die;
//            // body
//            if($type == 'Download sản phẩm'){
//                $link1 = 'Download Link: <a href="'.$product_detail->file_full.'">Download bản đầy đủ</a><br />
//                 Download Link: <a href="'.$product_detail->file_demo.'">Download bản dùng thử</a><br />';
////
//            }
//            else if($type == 'Tải báo giá'){
////                $link1 = $products_all->file_price;
//                $link1 = 'Download Link: <a href="'.$product_detail->file_price.'">Tải báo giá</a><br />';
//
//            }
//            else if($type == 'Download bản full'){
////                $link1 = $products_all->file_full;
//                $link1 = 'Download Link: <a href="'.$product_detail->file_full.'">Download bản đầy đủ</a><br />';
//            }
//            else if($type == 'Download bản demo'){
////                $link1 = $products_all->file_demo;
//                $link1 = 'Download Link: <a href="'.$product_detail->file_demo.'">Download bản dùng thử</a><br />';
//            }
//            else{
////                $link1 = $products_all->file_driver;
//                $link1 = 'Download Link: <a href="'.$product_detail->file_diver.'">Tải driver</a><br />';
//            }
////            var_dump($link1);die;
//            $name1 = $product_detail->name;
////            var_dump($name1);
//
//
//
//            $body = '
//
//				<table id="m_234297997826117954m_-7036324376900437633templateBody" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 727px; height: 706px;">
//					<tr style="border-bottom: 1px solid #291f2c; padding-bottom: 10px">
//						<td style="padding-bottom: 10px" valign="top">
//						&nbsp;</td>
//						<td style="padding-bottom: 10px" valign="top">
//						<img alt="" src="'.URL_ROOT.'images/config/a2_1565174137.png" /></td>
//					</tr>
//					<tr>
//						<td style="padding-top: 10px; padding-bottom: 10px; height: 688px;">
//						&nbsp;</td>
//						<td style="padding-top: 10px; padding-bottom: 10px; height: 688px;" class="auto-style5">
//						<span class="auto-style1">Kính gửi bạn</span><span style="background-color: rgb(255,255,255)">
//						'.$fullname.'</span><br />
//						<br />
//						<span class="" title="">
//						<span class="tlid-translation translation">Công ty Cổ phần Công nghệ và
//						Tư vấn CIC cảm ơn bạn đã yêu cầu '.$type.' của '.$name1.'.</span><span class="tlid-translation translation" lang="vi"><br />
//						<br />
//						</span></span><span lang="vi">
//						<span class="tlid-translation translation"><span title="">
//						Chúng tôi mời bạn lựa chọn các phiên bản theo những đường dẫn dưới đây:</span></span></span><br />
//						<br />
//						    '.$link1.'
//                        <br/>
//
//						Nếu bạn có bất kỳ câu hỏi nào về '.$name1.' hoặc có yêu cầu được cấp giấy
//						phép bản quyền sử dụng phần mềm, xin vui lòng liên hệ với chúng tôi theo
//						thông tin sau:<br />
//						<br />
//						<table style="width: 100%">
//							<tr>
//								<td valign="top">
//						<span class="" title=""><span class="tlid-translation translation">
//								<a href="https://www.cic.com.vn">
//								<img alt="" class="auto-style4" height="72" src="http://enjicad.vn/img/Logo-CIC.png" width="186" style="float: left" /></a></span></span></td>
//								<td>
//						<span class="" title=""><span class="tlid-translation translation">
//						<span class="" title="" valign="top">
//						    <span class="tlid-translation translation"  valign="top">
//								<p><b>Công ty Cổ phần Công nghệ và Tư vấn CIC</b><br>
//                                    Địa chỉ: 37 Lê Đại Hành - Hai Bà Trưng - Hà Nội<br>
//                                    Phone: 024 3974 6798<br>
//                                    Hotline: 088 646 2020<br>
//                                    Website:   <a target="_blank" href="http://www.cic.com.vn">http://www.cic.com.vn</a><br>
//                                    Email: <a href="cic.dcs@cic.com.vn">cic.dcs@cic.com.vn</a>
//                                </p>
//								<br />
//								<p><b>Chi nhánh Thành phố Hồ Chí Minh</b><br>
//                                    Địa chỉ: 36 Nguyễn Huy Lượng - P. 14 - Q. Bình Thạnh - TP. HCM<br>
//                                    Phone: 028 6289 9022<br>
//                                    Hotline: 088 645 2020<br>
//                                    Website: <a target="_blank" href="http://www.cic.com.vn">http://www.cic.com.vn</a><br>
//                                    Email: <a href="cichcm@cic.com.vn">cichcm@cic.com.vn</a>
//                                </p>
//						</span></span>
//								</td>
//							</tr>
//						</table>
//						<br />
//						</span><span class="tlid-translation translation" lang="vi">Cảm ơn bạn đã quan
//						tâm đến Sản phẩm </span><span class="tlid-translation translation">
//						'.$name1.'!</span></span><br />
//						<br />
//						Công ty Cổ phần Công nghệ và Tư vấn CIC</td>
//					</tr>
//					<tr>
//						<td style="border-top: 1px solid #291f2c; padding-top: 5px; text-align: center" valign="top">
//						&nbsp;</td>
//						<td style="border-top: 1px solid #291f2c; padding-top: 5px; text-align: center" valign="top">
//						<img alt="" height="60" src="http://enjicad.vn/img/Footer_moi.jpg" width="729" /></td>
//					</tr>
//				</table>
//
//				';
//print_r($body);die;

//            $mailer -> setBody($body);
//            câu lệnh gửi mail cho khách hàng
//            if(!$mailer ->Send()){
    // $msg = 'Gửi thông tin thành công. Vui lòng check Email để tải bản dùng thử.';
    // setRedirect($link,$msg);
//                return true;
//            }
//        }


    function sendmail()
    {
//        echo 1; die;
        $fs_table = FSFactory::getClass('fstable');
        $model = $this->model;
        // send Mail()
        $mailer = FSFactory::getClass('Email', 'mail');
        $global = new FsGlobal();

        // Recipient
//        $ip = $_SERVER['REMOTE_ADDR'];
        $to = $global->getConfig('admin_email');
//         var_dump($to);die;

        global $config;

        $email = FSInput::get('email');
        $fullname = FSInput::get('name');
        $type = FSInput::get('type');
		//var_dump($type);
        $products_id = FSInput::get('id');
//        var_dump($products_id);die;
        $mailer->isHTML(true);
        $mailer->setSender(array($to, 'cic.com.vn'));
        $mailer->AddAddress($email, $fullname);
        $version = $_POST['version'];
//var_dump($version);

        $mailer->AddBCC($to, 'CIC');
//        $mailer->setSubject('CIC | ' . @$type. '(IP: '.$ip .')');
        $mailer->setSubject('CIC | ' . @$type);
		//var_dump($2);
        $product_detail = $model->get_record('published = 1 and id =' . $products_id, $fs_table->_('fs_products'));


        $name1 = $product_detail->name;
//        print_r($product_detail);die;

        // body
        if ($type == 'Download sản phẩm') {
            $file = $product_detail->email_download;
            $emaill = $model->getemail($file);
//            print_r($emaill);die;

            $body = str_replace(['{name}', '{name1}'], [$fullname, $name1], $emaill->content);
            $body = str_replace('/upload_images/', URL_ROOT . 'upload_images/', $body);
//            var_dump($product_detail->file_name1);die;
            if ($version == $product_detail->file_name1) {
//                if ($product_detail->file_download1 && $product_detail->link_download1) {
//                    $body = str_replace('{link1}', 'Download link:<a href="index.php?module=products&view=product&raw=1&task=download&file_download='. $product_detail->file_download1 . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link1}', 'Download link:<a href="' . $product_detail->link_download1 . '">' . $version . '</a>', $body);
//                }else
                if ($product_detail->file_download1) {
                    $body = str_replace('{link1}', 'Download link:<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download1 . '">' . $version . '</a>', $body);
                } elseif ($product_detail->link_download1) {
                    $body = str_replace('{link1}', 'Download link:<a href="' . $product_detail->link_download1 . '">' . $version . '</a>', $body);
//                    print_r($body);die;
                }
            } else if ($version == $product_detail->file_name2) {
//                if ($product_detail->file_download2 && $product_detail->link_download2) {
//                    $body = str_replace('{link1}', 'Download link 1:<a href="index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download2 . '&name_download=' . $version . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link2}', 'Download link 2:<a href="' . $product_detail->link_download2 . '">' . $version . '</a>', $body);
//                }
//                else
                if ($product_detail->file_download2) {
                    $body = str_replace('{link1}', 'Download link:<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download2 . '&name_download=' . $version . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link2}', '', $body);
                } elseif ($product_detail->link_download2) {
                    $body = str_replace('{link1}', 'Download link:<a href="' . $product_detail->link_download2 . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link2}', '', $body);
                }
            } else if ($version == $product_detail->file_name3) {
//                if ($product_detail->file_download3 && $product_detail->link_download3) {
//                    $body = str_replace('{link1}', 'Download link 1:<a href="index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download3 . '&name_download=' . $version . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link2}', 'Download link 2:<a href="' . $product_detail->link_download3 . '">' . $version . '</a>', $body);
//                }
//                else
//                echo 1;die;
                if ($product_detail->file_download3) {
//                var_dump($product_detail->file_download3);die;

                    $body = str_replace('{link1}', 'Download link:<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download3 . '&name_download=' . $version . '">' . $version . '</a>', $body);
                } elseif ($product_detail->link_download3) {
                    $body = str_replace('{link1}', 'Download link: <a href="' . $product_detail->link_download3 . '">' . $version . '</a>', $body);
                }
            } else if ($version == $product_detail->file_name4) {
//                if ($product_detail->file_download4 && $product_detail->link_download4) {
//                    $body = str_replace('{link1}', 'Download link 1:<a href="index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download4 . '&name_download=' . $version . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link2}', 'Download link 2:<a href="' . $product_detail->link_download4 . '">' . $version . '</a>', $body);
//                } else
                if ($product_detail->file_download4) {
                    $body = str_replace('{link1}', 'Download link:<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download4 . '&name_download=' . $version . '">' . $version . '</a>', $body);
                } elseif ($product_detail->link_download4) {
                    $body = str_replace('{link1}', 'Download link: <a href="' . $product_detail->link_download4 . '">' . $version . '</a>', $body);
                }
            } else if ($version == $product_detail->file_name5) {
//                if ($product_detail->file_download5 && $product_detail->link_download5) {
//                    $body = str_replace('{link1}', 'Download link 1:<a href="index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download5 . '&name_download=' . $version . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link2}', 'Download link 2:<a href="' . $product_detail->link_download5 . '">' . $version . '</a>', $body);
//                } else
                if ($product_detail->file_download5) {
                    $body = str_replace('{link1}', 'Download link:<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download5 . '&name_download=' . $version . '">' . $version . '</a>', $body);

                } elseif ($product_detail->link_download5) {
                    $body = str_replace('{link1}', 'Download link: <a href="' . $product_detail->link_download5 . '">' . $version . '</a>', $body);
                }
            } else if ($version == $product_detail->file_name6) {
//                if ($product_detail->file_download6 && $product_detail->link_download6) {
//                    $body = str_replace('{link1}', 'Download link 1:<a href="index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download6 . '&name_download=' . $version . '">' . $version . '</a>', $body);
//                    $body = str_replace('{link2}', 'Download link 2:<a href="' . $product_detail->link_download6 . '">' . $version . '</a>', $body);
//                } else
                if ($product_detail->file_download6) {
                    $body = str_replace('{link1}', 'Download link 1:<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_download6 . '&name_download=' . $version . '">' . $version . '</a>', $body);
                } elseif ($product_detail->link_download6) {
                    $body = str_replace('{link1}', 'Download link: <a href="' . $product_detail->link_download6 . '">' . $version . '</a>', $body);
                }
            } else {
                $body = str_replace('{link1}', ' ', $body);
//                $body = str_replace('{link2}', ' ', $body);
            }
//            print_r($body);die;
        } else if ($type == 'Tải báo giá') {
            $file = $product_detail->email_catalogue;
            $emaill = $model->getemail($file);
            $body = str_replace(['{name}', '{name1}'], [$fullname, $name1], $emaill->content);
            $body = str_replace('/upload_images/', URL_ROOT . 'upload_images/', $body);

//            if ($product_detail->file_price && $product_detail->link_catalogue) {
//                $body = str_replace('{link1}', 'Download link 1:<a href="index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_price . '&name_download=' . $type . '">' . $type . '</a>', $body);
//                $body = str_replace('{link2}', 'Download link 2:<a href="' . $product_detail->link_catalogue . '">' . $type . '</a>', $body);
//            } else
            if ($product_detail->file_price) {
                $body = str_replace('{link1}', 'Download link :<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_price . '&name_download=' . $type . '">' . $type . '</a>', $body);
            } elseif ($product_detail->link_catalogue) {
                $body = str_replace('{link1}', 'Download link :<a href="' . $product_detail->link_catalogue . '">' . $type . '</a>', $body);
            }
//            print_r($body);die;
        } else if ($type == 'liên hệ sản phẩm') {
            $file = $product_detail->email_contact;
            $emaill = $model->getemail($file);
            $body = str_replace(['{name}', '{name1}'], [$fullname, $name1], $emaill->content);
            $body = str_replace('{link1}', ' ', $body);
            $body = str_replace('/upload_images/', URL_ROOT . 'upload_images/', $body);
//            print_r($body);die;
        } else if ($type == 'Đăng ký mua') {
            $file = $product_detail->email_order;
//            $file = $product_detail->email_contact;
            $emaill = $model->getemail($file);
            $body = str_replace(['{name}', '{name1}'], [$fullname, $name1], $emaill->content);
            $body = str_replace('{link1}', ' ', $body);
            $body = str_replace('/upload_images/', URL_ROOT . 'upload_images/', $body);


        } else {
            $file = $product_detail->email_driver;
            $emaill = $model->getemail($file);
            $body = str_replace(['{name}', '{name1}'], [$fullname, $name1], $emaill->content);
            $body = str_replace('/upload_images/', URL_ROOT . 'upload_images/', $body);
//            if ($product_detail->file_driver && $product_detail->link_driver) {
//                $body = str_replace('{link1}', 'Download link 1:<a href="index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_driver . '&name_download=' . $type . '">' . $type . '</a>', $body);
//                $body = str_replace('{link2}', 'Download link 2:<a href="' . $product_detail->link_driver . '">' . $type . '</a>', $body);
//            } else
            if ($product_detail->file_driver) {
                $body = str_replace('{link1}', 'Download link:<a href="'.URL_ROOT.'index.php?module=products&view=product&raw=1&task=download&file_download=' . $product_detail->file_driver . '&name_download=' . $type . '">' . $type . '</a>', $body);
            } elseif ($product_detail->link_driver) {
                $body = str_replace('{link1}', 'Download link:<a href="' . $product_detail->link_driver . '">' . $type . '</a>', $body);
            }
//            print_r($body);die;
        }


       //print_r($body);
      //die;

        $mailer->setBody($body);
//            câu lệnh gửi mail cho khách hàng
        if (!$mailer->Send()) {
//            // $msg = 'Gửi thông tin thành công. Vui lòng check Email để tải bản dùng thử.';
//            // setRedirect($link,$msg);
            return true;
        }
    }

    function save_home()
    {
//             echo "1";die;
        $model = $this->model;
        // if ($this->check_captcha()==false) {
        //      $link = FSRoute::_("index.php?module=product&Itemid=14");
        //     $msg = FSText::_("Bạn đã nhập sai mã capcha. ");
        //     setRedirect($link,$msg);
        // }
        $id_home = FSInput::get('id');
        $alias = FSInput::get('alias');
        $id = $model->save();
        $link = URL_ROOT . "index.php?module=products&view=home&code=" . $alias . "&id=" . $id_home;
        if ($id) {


            $msg = FSText::_(" Cảm ơn bạn đã liên lạc với chúng tôi. ");

            setRedirect($link, $msg);
        } else {

            $msg = FSText::_(" Chưa thêm vào liên hệ. ");

            setRedirect($link, $msg);
        }
    }

    function download()
    {

//        $id = FSInput::get('id');
//        if (!$id)
//            return;
//        $model = $this->model;
//        //print_r($id);
//        $record = $model->get_download($id);
        $record = $_GET['file_download'];
        $name = ltrim($record, 'images/upload_file/2019/');
//                var_dump($name);die;

        $record_name = $_GET['name_download'];

//        var_dump($record_name);die;
        $link = FSRoute::_('');
        if (!$record) {
            setRedirect($link, 'Không có file upload');
            return;
        }

        $path_file = URL_ROOT . $record;

//        var_dump($path_file);die;
        $fsstring = FSFactory::getClass('FSString');

        $name_file = strtolower(substr($record, (strripos($record, '/') + 1), strlen($record)));

//        $file_export_name = @$name_file ? $fsstring->stringStandart(@$name_file) : 'Catalog' . $record->id;

//        lay duoi file
//        $file_ext = $this->getExt(($record->upload));
        //print_r($file_ext);die;
//        $file_export_name = $file_export_name . '.' . $file_ext;
        $file_export_name = strtolower($record_name);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=" . $name);
        header("Content-Transfer-Encoding: binary");
//			header("Content-Length: ".filesize($path_file));
        ob_clean();
        flush();
        readfile($path_file);

//        $up = $model->addDown($id);
        exit();
    }

    function buy()
    {
        $product_id = FSInput::get('id', 0, 'int'); // product_id
        $warranty = FSInput::get('warranty'); // product_id
        FSFactory::include_class('errors');
        if (!$product_id)
            Errors::_('Sản phẩm chưa xác định');
        $model = $this->model;

        if (!isset($_SESSION['cart'])) {
            $product_list = array();

            $prices = $model->getPrice();
            if ($prices == '-1') {
                Errors::_("Không tồn tại sản phẩm trong giỏ hàng", 'error');
                return;
            }
            $product_list[] = array($product_id, 1, $prices[0], $prices[1], $warranty); // prdid,quality, price, discount

        } else {
            $product_list = $_SESSION['cart'];

            $exist_prd = 0;
            for ($j = 0; $j < count($product_list); $j++) {
                $prd = $product_list[$j];

                if ($prd[0] == $product_id) {
                    $product_list[$j][1]++;
                    $product_list[$j][4] = $warranty;
                    $exist_prd++;
                    break;
                }
            }
            // if not exist product
            if (!$exist_prd) {
                $prices = $model->getPrice();
                $product_list[count($product_list)] = array($product_id, 1, $prices[0], $prices[1], $warranty);
            }
        }

        $_SESSION['cart'] = $product_list;


        $html = '';
        $html .= ' <div class="modal-dialog">';
        $html .= ' <div class="modal-content">';
        $html .= '<div class="modal-header">';
        $html .= '<h4 class="modal-title"><span>Thêm vào giỏ hàng</span></h4>';
        $html .= ' </div>';
        $html .= '<div class="modal-body">';
        if (!isset($_SESSION['cart'])) {
            $html .= ' <div class="check-square mt10"><strong>Sản phẩm đã thêm vào giỏ hàng</strong></div>';
        } else {
            $html .= ' <div class="check-square mt10"><strong>Sản phẩm chưa thêm vào giỏ hàng</strong></div>';
        }
        $html .= '  </div>';
        $html .= ' <div class="modal-footer">';
        $html .= ' <button type="button" class="btn btn-default" data-dismiss="modal">Xem tiếp sản phẩm</button>';
        $html .= ' <a  href="' . FSRoute::_("index.php?module=products&view=cart&task=eshopcart2") . '" class="btn btn-default">Giỏ hàng của bạn</a>';
        $html .= ' </div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= ' </div>';
        echo $html;
        return;
    }

    function load_price_by_dcare()
    {
        $value = FSInput::get('value');
        $model = $this->model;
        $data = $model->get_product();
        if (!$data)
            return;
        if ($data->is_hotdeal) {
            if ($data->date_end > date('Y-m-d H:i:s') && $data->date_start < date('Y-m-d H:i:s'))
                $price = $data->price;
            else
                $price = $data->price_old;
        } else {
            $price = $data->price;
        }
        $html = '';
        if ($value == 1) {
            $html .= '<span>' . format_money($price, 'đ') . '</span>';
        } else if ($value == 2) {
            $html .= '<span>' . format_money(($price + 300000), 'đ') . '</span>';
        } else {
            $html .= '<span>' . format_money(($price + 600000), 'đ') . '</span>';
        }
        $html .= ' <span></span>';
        echo $html;
        return;
    }

    /*
     * function save info of sender and recipient
     */
    function eshopcart2_simple_save()
    {
        $model = $this->model;
        $Itemid = FSInput::get('Itemid', 0, 'int');
        // get temporary data stored in fs_order:
        $order_id = $model->eshopcart2_simple_save();
        $Itemid = FSInput::get('Itemid', 0, 'int');
        if ($order_id) {
//				$send_mail  = $model -> mail_to_buyer_simple($order_id);
            $link = FSRoute::_('index.php?module=products&view=cart&task=finished&id=' . $order_id . '&Itemid=' . $Itemid);
            setRedirect($link, 'Đơn hàng của bạn đã được gửi đi. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn!');
        } else {
            $link = FSRoute::_('index.php?module=products&view=cart&task=order&Itemid=' . $Itemid);
            setRedirect($link);
        }
    }

    function map()
    {
        $model = $this->model;
        $id = FSInput::get('id', 0, 'int');

        $fs_table = FSFactory::getClass('fstable');

        //$address = $model->get_record(' published = 1 AND show_contact = 1 ',$fs_table -> getTable('fs_address'),'id,latitude,longitude');

        $datas = $model->get_record_by_id($id, $fs_table->getTable('fs_address'), 'name');

        $data = array(
            'error' => true,
            'message' => '',
            'html' => ''
        );
        //<p><strong>Địa chỉ: </strong>'.$list -> address. '</p>
        $data['html'] .= '  
                                <h3>' . $datas->name . '</h3>
                            ';

        $data['error'] = false;
        echo json_encode($data);
    }
}