<?php
	class ProductsControllersCart  extends FSControllers
	{
        var $module;
		var $view;
		function __construct()
		{
			$this->module  = 'products';
			$this->view  = 'cart';
			$array_status = array( 0 => 'Đang chờ',1 => 'Đã hoàn tất',
									2=> 'Đã hủy');
			$this -> arr_status = $array_status;
			parent::__construct();
		} 
        
         
		function buy(){
			$product_id = FSInput::get('id',0,'int'); // product_id
            $module = FSInput::get('module');
            
			$Itemid = FSInput::get('Itemid',0,'int'); // product_id
			FSFactory::include_class('errors');
			if(!$product_id)
				Errors::_('Sản phẩm chưa xác định');
			
			$model = $this -> model;	
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				
			if(!isset($_SESSION['cart'])) {
				$product_list = array();
				
				$prices = $model -> getPrice();
				if($prices == '-1'){
					Errors::_("Không tồn tại sản phẩm trong giỏ hàng",'error');
					setRedirect($link);
					return;
				}
				$product_list[] = array($product_id, 1 ,$prices[0],$prices[1]); // prdid,quality, price, discount
				
			} else {
				$product_list  = $_SESSION['cart'];
				
				$exist_prd  = 0;
				for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
							
					if($prd[0] == $product_id) {
						$product_list[$j][1] ++;
						$exist_prd ++;
						break;
					} 
				}
				// if not exist product
				if(!$exist_prd) {
					$prices = $model -> getPrice();
					$product_list[count($product_list)] = array($product_id,1,$prices[0],$prices[1]);
				}
			}
			
			$_SESSION['cart']  = $product_list  ;
			setRedirect($link);
		}
		
		/*
		 * Same BUY function
		 * Addition: add buy incentives accessory
		 */
		function buy_multi(){
			$product_id = FSInput::get('id',0,'int'); // product_id
            $module = FSInput::get('module');
            if($module != 'products')
                return false;
            
			$Itemid = FSInput::get('Itemid',0,'int'); // product_id
			FSFactory::include_class('errors');
			if(!$product_id)
				Errors::_('Sản phẩm chưa xác định');
			
            
			$model = $this -> model;	
            
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			$quantity = FSInput::get('quantity',1,'int');
            
            $quantity = $quantity? $quantity:1;	
			if(!isset($_SESSION['cart'])) {
			
				$product_list = array();
				
				$prices = $model -> getPrice();
				if($prices == '-1'){
					Errors::_("Không tồn tại sản phẩm trong giỏ hàng",'error');
					setRedirect($link);
					return;
				}
				$product_list[] = array($product_id, $quantity ,$prices[0],$prices[1],$prices[2],$prices[3], $module,$prices[4]); // prdid,quality, price, discount
				
			} else {
			
				$product_list  = $_SESSION['cart'];
                //echo '<pre>';
//                print_r($product_list[0]);
//				print_r($product_list[0][1]);die;
				$exist_prd  = 0;
				for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
						
					if($prd[0] == $product_id && $prd[6] == $module) {
					    //print_r(123);die;
						$product_list[$j][1] = $product_list[$j][1] + $quantity ;
						$exist_prd ++;
						break;
					} 
				}
                
				// if not exist product
                //print_r($exist_prd);die;
				if(!$exist_prd) {
					$prices = $model -> getPrice();
					$product_list[count($product_list)] = array($product_id,$quantity,$prices[0],$prices[1],$prices[2],$prices[3],$module,$prices[4]);
				}
			}
           
			$_SESSION['cart']  = $product_list  ;
			// add incenty assessory
			$incentives_accessory = $model -> get_incenty_accessory($product_id);
			$this -> buy_incenty_accessory($product_id,$incentives_accessory);
			  
			
			setRedirect($link);
		}
		
		function buy_incenty_accessory($product_id,$incentives_accessory){
			if(!count($incentives_accessory))
				return;
			$product_list  = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();	
			foreach($incentives_accessory as $item){
				$exist_prd  = 0;
				for ($j = 0; $j < count($product_list); $j ++) {
					$prd = $product_list[$j];
							
					if($prd[0] == $item -> product_incenty_id) {
						$product_list[$j][1] ++;
						$exist_prd ++;
						break;
					} 
				}
				// if not exist product
				if(!$exist_prd) {
					$product_list[count($product_list)] = array($item -> product_incenty_id,1,$item -> price_new,$item -> price_old);
				}
			}		
			$_SESSION['cart']  = $product_list  ;
			return;				
		}
		
		/*
		 * Display shopcart common
		 */
		function shopcart() {
			$note_in_cart = FsGlobal::getConfig('note_in_cart');
			include 'modules/'.$this->module.'/views/'.$this->view.'/shopcart.php';				
		}
		/*
		 * Remove shopcart in one estores
		 */
		function del_all() {
			$Itemid = FSInput::get('Itemid',0,'int');
			if(isset($_SESSION['cart'])) {
				unset($_SESSION['cart']);
			}
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		/*
		 * Remove product in one estores
		 */
		function del() {
			$eid = FSInput::get('eid',0,'int');
			$pid = FSInput::get('id',0,'int');
			$Itemid = FSInput::get('Itemid',0,'int');
			if($eid && $pid) {
				if(isset($_SESSION['cart'])) {
					$cart  = $_SESSION['cart'];
					
					$cart_new = array();
					
					// Repeat estores
					for ($j = 0; $j < count($cart); $j ++) {
						 $item = $cart[$j];
						
						// if exist estores
						if($item[0] == $eid) {

							$products_new = array();
							$count_products = 0;
							
							$product_list = $item[1];
							
							// Repeat products
							for($i = 0; $i < count($product_list); $i ++) {
							 	$prd = $product_list[$i];
							 	if($pid != $prd[0]) {
							 		$products_new[] = $prd;
							 		$count_products++;
							 	} 
							}
							if($count_products) 
								$cart_new[] = array('0' => $eid, $products_new);
						} else {	
							$cart_new[] = $item;
						}
					}
					$_SESSION['cart'] = $cart_new;
				}
				
			}
			$link = FSRoute::_('index.php?module=products&view=cart&task=shopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		
		/*
		 * Remove product in one estores
		 * but redirect eshopcart
		 */
		function edel() {
			$pid = FSInput::get('id',0,'int');
			$Itemid = FSInput::get('Itemid',0,'int');
			if($pid) {
				if(isset($_SESSION['cart'])) {
					$product_list  = $_SESSION['cart'];
					
					// count products of eid current:
					$count_products_current = 0;
					
					// Repeat estores
							$products_new = array();
							
							// Repeat products
							for($i = 0; $i < count($product_list); $i ++) {
							 	$prd = $product_list[$i];
							 	if($pid != $prd[0]) {
							 		$products_new[] = $prd;
							 	} 
							}
					$_SESSION['cart'] = $products_new;
					
				}
			}
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		
		
		/*
		 * Display detail shopcart in estores
		 * and display login form
		 */
		function eshopcart(){
			
			if(isset($_SESSION['username'])){
				$this -> eshopcart2();
				return;
			} 
			$model = $this -> model;
            	
			
			// get temporary data stored in fs_order:
			$session_order = $model -> getOrder();
			
			$member = $model->get_member_by_username(@$session_order->username);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/eshopcart.php';
		}
		
		/*
		 * Save database from eshopcart form
		 */
		function eshopcart_save(){
			$model = $this -> model;	
			$Itemid = FSInput::get('Itemid',0,'int');
			
			// get temporary data stored in fs_order:
			$session_order = $model -> eshopcart_save();
			if($session_order) {
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				setRedirect($link);
			} else {
				$msg = "B&#7841;n ch&#432;a th&#7875; chuy&#7875;n sang b&#432;&#7899;c ti&#7871;p theo do s&#7889; sim b&#7841;n nh&#7853;p ch&#432;a &#273;&#250;ng";
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart&Itemid='.$Itemid);
				setRedirect($link,$msg,'error');
			}
		}
		
		/*
		 * Save payment method
		 */
		
		
		/*
		 * Display detail shopcart in estores And cutomer form
		 * 
		 */
		function eshopcart2(){
			
			$model = $this -> model;
	
			// get temporary data stored in fs_order:
			$session_order = $model -> getOrder();
			$user = $model -> get_user();
			$discount = $model -> getDiscount();
			$Itemid = FSInput::get('Itemid',0,'int');
			
			// breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Giỏ hàng', 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);

			//$discount_code = isset($session_order->discount_code)?$session_order->discount_code:'';
			$array_breadcrumb[] = array(0=> array('name'=> 'Giỏ hàng', 'link'=>'','selected' => 0));
			include 'modules/'.$this->module.'/views/'.$this->view.'/eshopcart2.php';
		}
		
		/*
		 * Display policy, transportation of estores
		 */
	
		
		/*
		 * Confirm and order
		 */
		function order() {
			$model = $this -> model;
			$Itemid = FSInput::get('Itemid',0,'int');	
			// get temporary data stored in fs_order:
			$session_order = $model -> getOrder();

			// calculation:
			$total_price = 0;
			$quantity = 0;
			if(isset($_SESSION['cart'])) {
				$product_list = $_SESSION['cart'];
//				 prdid,quality, price, discount/
				$i = 0; 
				if($product_list) {
					foreach ($product_list as $prd) {
				  		$i++;
				  		$total_price +=  $prd[2]* $prd[1];
				  		$quantity +=  $prd[1];
					}
		  		}
			}
					
			$notice_when_order = FsGlobal::getConfig('notice_when_order');
			$array_breadcrumb[] = array(0=> array('name'=> 'Đơn hàng', 'link'=>'','selected' => 0));
			if(!$session_order->sender_name ) {
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				setRedirect($link);
			}
			// breadcrumbs
			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Thanh toán', 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			include 'modules/'.$this->module.'/views/'.$this->view.'/order.php';
		}
		/*
		 * function save info of sender and recipient
		 */
		function eshopcart2_save(){
			$model = $this -> model;	
			$Itemid = FSInput::get('Itemid',0,'int');
			// get temporary data stored in fs_order:
			$session_order = $model -> eshopcart2_save();

			$Itemid = FSInput::get('Itemid',0,'int');
			if($session_order) { 
				$link = FSRoute::_('index.php?module=products&view=cart&task=finish_order&id='.$session_order.'&Itemid='.$Itemid);
                $session_id = session_id();
                unset($session_id);
                unset($_SESSION['cart']);
                
                //$link = FSRoute::_('index.php?module=products&view=home&Itemid='.$Itemid);
                setRedirect($link,'Đơn hàng của bạn đã được gửi đi. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn!');
			} else {
				$link = FSRoute::_('index.php?module=products&view=cart&task=order&Itemid='.$Itemid);
//				$link = FSRoute::_('index.php?module=products&view=cart&task=order&eid='.$eid.'&Itemid='.$Itemid);
                setRedirect($link,FSText::_('Gửi đơn hàng không thành công,kiểm tra lại thông tin hoặc kết nối của bạn.'));
			}
			setRedirect($link);
			
		}
        
        function finish_order(){
            $model = $this -> model;	
            $Itemid = FSInput::get('Itemid');
            
            $id = FSInput::get('id',0,'int');
            
            $estore_code = 'DH';
	        $estore_code .= str_pad($id, 8 , "0", STR_PAD_LEFT);
            
            //$order  = $model -> getOrderById($id);
//			if(!$order)
//				return;
//			$data = $model -> get_order_items($order->id);
//			$str_ids = '';
//			if(count($data)){
//				$i = 0;
//				foreach( $data as $item){
//					if($i)
//						$str_ids .= ',';
//					$str_ids .= $item -> product_id;
//					$i ++;						
//				}
//			}
//			$arr_products = $model -> get_products_from_ids($str_ids);
            
            unset($_SESSION['cart']);
            
            $breadcrumbs = array();
            $breadcrumbs[] = array(0=>FSText::_('Đơn đặt hàng').' '.$estore_code, 1 => '');
            global $tmpl;	
            $tmpl -> assign('breadcrumbs', $breadcrumbs);
            
            include 'modules/'.$this->module.'/views/'.$this->view.'/finish_order.php';
		}
		/*
		 * Recalculate estores
		 * but redirect to eshopcart
		 */
		function ere_cal(){
			$Itemid = FSInput::get('Itemid');
			if(isset($_SESSION['cart'])) {
				$cart  = $_SESSION['cart'];
				$product_list = $cart;
				
				$products_new = array();
				$count_products = 0;
				
				// Repeat products
				for($i = 0; $i < count($product_list); $i ++) {
				 	$prd = $product_list[$i];
					$quantity = FSInput::get('quantity_'.$prd[0]);
					if($quantity) {
						$products_new[] = array($prd[0],$quantity,$prd[2],$prd[3],$prd[4],$prd[5]);
//						$count_products ++;
					}		
				}
//				if($count_products) 
//					$cart_new[] =  $products_new;
				$_SESSION['cart'] = $products_new;
				
				// if del all
				if(!$count_products) {
					$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
					setRedirect($link);
				}
			}
			
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		function ere_cal2(){
			$Itemid = FSInput::get('Itemid');
			if(isset($_SESSION['cart'])) {
				$product_list  = $_SESSION['cart'];
				
				$products_new = array();
				$count_products = 0;
				
				// Repeat products
				for($i = 0; $i < count($product_list); $i ++) {
				 	$prd = $product_list[$i];
					$quantity = FSInput::get('quantity_'.$prd[0]);
					if($quantity) {
						$products_new[] = array($prd[0],$quantity,$prd[2],$prd[3],$prd[4],$prd[5],$prd[6],$prd[7]);
//						$count_products ++;
					}		
				}
//				if($count_products) 
//					$cart_new[] =  $products_new;
				$_SESSION['cart'] = $products_new;
				
				// if del all
				if(!$count_products) {
					$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
					setRedirect($link);
				}
			}
			
			$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
			setRedirect($link);
		}
		
		/*
		 * get product name
		 */
		function getProductName($product_id) {
			$model = $this -> model;
			return $model -> getProductName($product_id) ;
		}
		
		function getProductById($product_id) {
			$model = $this -> model;
			return $model -> getProductById($product_id) ;
		}
		function getProductCategoryById($category_id) {
			$model = $this -> model;
			return $model -> getProductCategoryById($category_id) ;
		}
		
		/*
		 * For ajax
		 * Display fullname of sim_number
		 */
		function ajax_get_member() {
			$model = $this -> model;
			$member = $model -> ajax_get_member();
			if(!$member)
				echo json_encode(array('status'=>0,'text'=>'Khong xac dinh'));
			else
				echo json_encode(array('status'=>1,'text'=>$member->fname." ".$member -> mname ." ". $member->lname));
			exit;
		}
		
		/*
		 * SAve order.
		 */
		function order_save() {
			$model = $this -> model;	
			$Itemid = FSInput::get('Itemid');
			// get temporary data stored in fs_order:
			$order_id = $model -> order_save();
			if($order_id) {
				$payment_method = $model -> get_result('id = '.$order_id,'fs_order','payment_method');
				$send_mail  = $model -> mail_to_buyer($order_id);
				
				if($payment_method == 1){  // thanh toán nội địa
					$this -> onepay_interior($order_id);
				}else if($payment_method == 2){ // thanh toán quốc tế
					$this -> onepay_international($order_id);
				}else{
					$link = FSRoute::_('index.php?module=products&view=cart&task=finished&id='.$order_id.'&Itemid='.$Itemid);
					if(!$send_mail){
						$msg = FSText::_('Bạn không thể send mail');
						setRedirect($link,$msg,'alert');
						return;
					}
					setRedirect($link,'Đơn hàng của bạn đã được gửi đi. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất. Xin cảm ơn!');
				}
			} else {
				$msg = FSText::_("Bạn chưa thể chuyển sang bước tiếp theo do có sự cố trong thông tin giỏ hàng");
				$link = FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);
				setRedirect($link,$msg,'error');
			}
		}
	   
        function showStatus($status){
			$arr_status = $this -> arr_status;
			echo @$arr_status[$status];
		}
		
		function finished() {
			$model = $this -> model;	
			$order = $model -> getOrderById();

			$breadcrumbs = array();
			$breadcrumbs[] = array(0=>'Thanh toán', 1 => '');
			global $tmpl;	
			$tmpl -> assign('breadcrumbs', $breadcrumbs);
			
			if($order){
				$order_detail = $model -> get_orderdetail_by_orderId($order->id);
				
				$i = 0;
				$str_product_ids = '';
				foreach($order_detail as $item){
					if($i > 0)
							$str_product_ids .= ',';
					$str_product_ids .= $item -> product_id;	
					$i ++;
				}
				
				$products = $model -> get_products_from_orderdetail($str_product_ids);
				if(!$order_detail){
					echo FSText::_("Bạn hãy chọn và thanh toán sản phẩm");
					return;
				}
//				$payment_method_name = $model -> get_payment_method($order->payment_method) ;
//				$transfer_method_name = $model -> get_transfer_method($order->transfer_method) ;
				include 'modules/'.$this->module.'/views/'.$this->view.'/finished.php';
			} else {
				
				echo FSText::_("Bạn hãy chọn và thanh toán sản phẩm");
				return;
			}
		}
		
		function generate_step($step = 1){
			include 'modules/'.$this->module.'/views/'.$this->view.'/step.php';
		}
        
        function change() {
			$product_id = FSInput::get('product_id'); // product_id	
			$quantity = FSInput::get('quantity');;	
			$stock_map = FSInput::get('stock_map'); // product_id	
			$manu_id = FSInput::get('manu_id'); // product_id	

			$_SESSION['cart'][$manu_id][$product_id][$stock_map][1]  = $quantity  ;

			$arr_cart = $_SESSION['cart'];
			$total_count =0; 
			$group_count =0;
			$count_manu = 0;
			foreach ($arr_cart as  $manu =>  $cart_item) { 
				foreach ($cart_item as $key => $product_item) {
					if($key == 'count_manu')
	  					continue;

			  		foreach ($product_item as $item) {
			  			if($manu == $manu_id){
				  			$total_count += $item[1];
				  			$count_manu += $item[1]; 
				  		}
			  			
			  			if($key == $product_id){
			  				$group_count += $item[1];
			  				
			  			}
			  		}
			  	}
			  }
			$_SESSION['cart'][$manu_id][$product_id]['group_count'] = $group_count ;
			$_SESSION['cart'][$manu_id]['count_manu'] = $count_manu ;
			$arr_data=array();
			$arr_data['success']=true;	
			$arr_data['items_count'] = $quantity;		
			$arr_data['total_count'] = $total_count;
			$arr_data['group_count'] = $group_count;
			$arr_data['count_manu'] = $count_manu;
			echo json_encode($arr_data);
		}
	}
	
?>
