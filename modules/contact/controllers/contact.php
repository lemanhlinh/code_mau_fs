<?php
	/*
	 * Huy write
	 */
	// controller
class ContactControllersContact extends FSControllers {
	
		function display(){
		$model = $this->model;
			
			$submitbt = FSInput::get('submitbt');
			$msg = '';
			$address=$model->get_address_list();
            
			$array_breadcrumb[] = array(0=> array('name'=> FSText::_('Contact'), 'link'=>'','selected' => 0));
			// breadcrumbs
			$breadcrumbs = array ();
			$breadcrumbs [] = array (0 => FSText::_( 'Liên hệ' ), 1 => '' );
			global $tmpl;
			$tmpl->assign ( 'breadcrumbs', $breadcrumbs );
			$tmpl -> set_seo_special();
			// call views
			include 'modules/'.$this->module.'/views/'.$this->view.'/'.'default.php';
		}
		
		/* 
		 * save contact
		 */
		function save(){
			// echo "1";die;
			$model = $this->model;
            $id = $model->save();
			         $link = FSRoute::_("index.php?module=contact&Itemid=14");
			if($id)
			{
				$msg = FSText::_(" Cám ơn bạn đã liên lạc với chúng tôi. ");
                $this->send_mail();
				setRedirect($link,$msg);

			}
			else{
  
				$msg = FSText::_(" Chưa thêm vào liên hệ. ");

				setRedirect($link,$msg);
			}
		}
		
	// function sendmail
    function send_mail($sender_name='',$sender_email='',$data_html = '')
    {
        include 'libraries/errors.php';
        // send Mail()
        $model = $this->model;
        $global = new FsGlobal();
        $mailer = FSFactory::getClass('Email', 'mail');

        // sender
        $sender_title = FSInput::get('contact_title');

        // Recipient
//						echo 1;die;
        $to = $global-> getConfig('admin_email');
//				var_dump($to);die;

        $site_name = $global-> getConfig('site_name');
//				var_dump($site_name);die;

        global $config;
        $subject = ' -  Contact from customer';

        $contact_fullname = FSInput::get('contact_name');
        $contact_company = FSInput::get('contact_company');
        $contact_telephone = FSInput::get('contact_phone');
        $contact_email = FSInput::get('contact_email');
        $title = FSInput::get('contact_tieude');
//                $message = FSInput::get('contact_message');

//				$fax = FSInput::get('contact_fax');
        $content = htmlspecialchars_decode(FSInput::get('contact_message'));
//				var_dump($content);die;

        $mailer -> isHTML(true);
        $mailer -> setSender(array($sender_email,$sender_name));
        $mailer -> AddAddress($to,'admin');

        //$mailer -> AddCC('tuananh@finalstyle.com','Phạm tuấn Anh');
//        $mailer -> setSubject(''.html_entity_decode($site_name).' '.$subject);
        $mailer -> setSubject('Liên hệ từ '.$contact_fullname.' trên Plaschem.vn ');
        // body

        $body = '';
        $body .= '<p align="left">'.FSText::_('Bạn nhận được liên hệ được gửi từ website Plaschem.vn với nội dung như sau').':</p>';
        $body .= '<p align="left"><strong>'.FSText::_('Full name').': </strong> '.$contact_fullname.'</p>';
        $body .= '<p align="left"><strong>'.FSText::_('Email').': </strong> '.$contact_email.'</p>';
//				$body .= '<p align="left"><strong>Điện thoại : </strong> '.$fax.'</p>';
        $body .= '<p align="left"><strong>'.FSText::_('Phone').': </strong> '.$contact_telephone.'</p>';
        //$body .= '<p align="left"><strong>Title : </strong> '.$contact_title.'</p>';
        $body .= '<p align="left"><strong>'.FSText::_('Công ty').': </strong> '.$contact_company.'</p>';
        $body .= '<p align="left"><strong>'.FSText::_('Tiêu đề').': </strong> '.$title.'</p>';
        $body .= '<p align="left"><strong>'.FSText::_('Nội dung').': </strong> '.$content.'</p>';
//                print_r($body);die;
//                if($data_html){
//                    $data_html .= $quantity? FSText::_('Số lượng').' '.$quantity:'';
//                    $body .= '<div align="left"><strong>'.FSText::_('Tôi muốn đặt hàng sản phẩm').': </strong> '.$data_html.'</div>';
//				}
//				$body .= '<p align="left"><strong>Started work time: </strong> '.$date_work .' '.$hour_work.':'.$minute_work.'</p>';
//				$body .= $message;
        $mailer -> setBody($body);
        if(!$mailer ->Send())
//            return false;
            return true;
    }


    /*
     * function check Captcha
     */
		function check_captcha(){
			$captcha = FSInput::get('txtCaptcha');
			
			if ( $captcha == $_SESSION["security_code"]){
				return true;
			} else {
			}
			return false;
		}
	//	function map(){
//			$model = new ContactModelsContact();
//			$google_map = $model -> get_address_current();
//			$str_des = '';
//			$str_des .= '<center>';
//            $str_des .= '    	<h3>'.@$google_map -> name. '</h3>';
//            $str_des .= '    	<p><strong>Add: </strong>'.@$google_map -> address. '</p>';
//            $str_des .= '    	<p><strong>Telephone: </strong>'.@$google_map -> phone. '</p>';
//            $str_des .= '    	</center>';
//            include 'modules/'.$this->module.'/views/'.$this->view.'/'.'map.php';
//		}
        function map(){
            $model = new ContactModelsContact();
            $list = $model -> get_address_current();   
            $data = array(
                'error' => true,
                'message' => '',
                'html' => ''
            );
            //<p><strong>Địa chỉ: </strong>'.$list -> address. '</p>          
            $data['html'] .= '  
                                <h3>'.$list -> name. '</h3>
                            ';
            
            $data['error'] = false;
            echo json_encode($data);
        }
	}
	
?>