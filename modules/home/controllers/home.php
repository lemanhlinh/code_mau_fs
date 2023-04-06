<?php
/*
 * Huy write
 */
	// controller
	class HomeControllersHome extends FSControllers
	{
		var $module;
		var $view;
		function display()
		{
            $fstable = FSFactory::getClass('fstable');
			// call models
			$model = $this -> model;

			$banner =  $model->get_records('published = 1 and category_id = 1',$fstable->_('fs_banners'));
			$slideshow =  $model->get_records('published = 1 and category_id = 1',$fstable->_('fs_slideshow'));
			$banner_thanhtuu =  $model->get_records('published = 1 and category_id = 2',$fstable->_('fs_banners'));
			$list_field =  $model->get_records('published = 1',$fstable->_('fs_field'));
			$news =  $model->get_records('published = 1 and show_in_homepage = 1 order by created_time desc, ordering desc Limit 6',$fstable->_('fs_news'),'image,id,alias,category_id,category_alias,category_name,created_time,title');
			$bout =  $model->get_record('published = 1 and id = 1',$fstable->_('fs_contents'));
//var_dump($news);
			// call views			
			include 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
		}
        function save()
        {
            $model = $this->model;
            $name = FSInput::get('name');
            $email = FSInput::get('email');
            $phone = FSInput::get('phone');
            $note = FSInput::get('message');
            $where = ' published = 1';
            $table = 'fs_contact_enjicad';
            $row = array();
            $row['fullname']= $name;
            $row['email']= $email;
            $row['telephone']= $phone;
            $row['message']= $note;
            var_dump($row);die;
//
            $id = $model->_update($row, $table, $where);;
//            $link = FSRoute::_("index.php?module=products&view=product&code=" . $alias . "&id=" . $id_product);
//            if ($id) {
//                $email = FSInput::get('email');
//                $msg = FSText::_(" Cảm ơn bạn đã liên lạc với chúng tôi. Thông tin của sản phẩm đã được gửi về mail: $email ");
//                $this->sendmail();
//                setRedirect($link, $msg);
//            } else {
//
//                $msg = FSText::_(" Chưa thêm vào liên hệ. ");
//
//                setRedirect($link, $msg);
//            }
        }

	}
?>

