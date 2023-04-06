<?php 
$html ='';
	foreach($list as $item){
		if(strpos($item -> user_image, 'http:') !== false || strpos($item -> user_image, 'https:') !== false){
			$avatar = $item -> user_image;
		}else{
			$avatar = URL_ROOT.$item -> user_image;
		}
		$link = FSRoute::_('index.php?module=products&view=product&code='.$item->alias.'&id='.$item -> id.'&ccode='.$item->category_alias.'&Itemid=5');
			$html .='<div class="item" >';
				$html .='<section class="_box">';
					$html .='<figure>';
						$html .='<figcaption class="media-caption">';
					        $html .='<div class="media-caption__body">'.$item -> summary.'</div>';
					      $html .='</figcaption>';
				    	$html .='<a href="'.$link.'">';
				    		if($item ->video){
				    			$html .='<span class="item-box__icon i i--camera"></span>';
				    		}
				       		$html .='<img class="img-responsive" src="'.URL_ROOT.str_replace('/original/', '/resized/', $item->image).'" alt="'.htmlspecialchars ($item -> name).'"  />';
				   		$html .='</a>';
				   	$html .='</figure>';	
					$html .='<div class="_price clearfix fss">';
		               $html .=' <span class="_current fhm pull-left ">'.format_money($item -> price).'</span>';
		               	if(strpos($item -> prices_type, ',2,')!== false){ 
		                	if(isset($_SESSION['user_id'])){
								$html .='<a class="exchange"  href="javascript:jqac.arrowchat.sendMessage(\''.$item->user_id.'\',\'Tôi muốn trao đổi về '.$link .'\'); jqac.arrowchat.chatWith(\''.$item->user_id.'\');" title="Trao đổi sản phẩm"></a>';
							}else{
								$html .='<a class="exchange"  href="javascript: alert(\'Bạn phải đăng nhập để trao đổi sản phẩm\');call_popup_login() "></a>';
							 }
	            	 	}
		            	if($item -> price_old){
	            			$html .='<span class="_old fsn pull-right">'.format_money($item -> price_old).'</span>';
	            	 	}
		           	$html .='</div>';
					$html .='<h2 class="_name fss fwn" ><a href="'.$link.'" title = "'.$item -> name .'" >'.$item -> name.'</a> </h2>';	
					$html .='<div class="_other clearfix text-center fsn mbm">';
		            	if($item -> size_name){ 
		            		$html .='<span class="size pull-left ">'.$item -> size_name.'</span>';	
		            	}
		            	// $html .='<span class="_like" >'.$item -> like.'</span>';

		             	if(in_array($item -> id, $arr_products_follows)){
            				$html .='<span class="_like like_ok like_product_'.$item -> id.'" onclick="javascript: like_product('.$item -> id.')" >'.$item -> like.'</span>';
		            	}else{
		            		$html .='<span class="_like like_no like_product_'.$item -> id.'"  onclick="javascript: like_product('.$item -> id.')" >'.$item -> like.'</span>';
		            	 }
		         
		            	$html .='<a href="'. $link.'" class="_comments pull-right" >'.$item -> comments_published.'</a>';
		            $html .='</div>';
		            $html .='<div class="_owner clearfix fsn">';
		            	$html .='<a class="full_name pull-left" href="">';
		            		$html .='<img  src="'.$avatar.'" width="27" height="27"  onerror="javascript:this.src=\''.URL_ROOT.'images/no-avatar.jpg'.'\';" />';
		            		$html .='<font>'.$item -> user_full_name.'</font>';
		            	$html .='</a>';
		            	if($item -> user_city){
		            		$html .='<span class="user_city pull-right">'.$item -> user_city.'</span>';
		            	 }
		            $html .='</div>';
				$html .='</section>';
	 		        
			$html .='</div>';
	}
	
?>