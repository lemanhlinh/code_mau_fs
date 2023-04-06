<?php 
$html ='';
	foreach($list as $item){
	
		$link = FSRoute::_('index.php?module=products&view=product&code='.$item->alias.'&id='.$item -> id.'&ccode='.$item->category_alias.'&Itemid=5');
			$html .='<li class="product" >';
				$html .='<section class="_box">';
					$html .='<figure>';
						$html .='<figcaption class="media-caption">';
					        $html .='<div class="media-caption__body">'.$item -> summary.'</div>';
					      $html .='</figcaption>';
				    	$html .='<a href="'.$link.'">';
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
		            	$html .='<span class="_like" >'.$item -> like.'</span>';
		          
		            	$html .='<a href="'. $link.'" class="_comments pull-right" >'.$item -> comments_published.'</a>';
		            $html .='</div>';
		            $html .='<div class="_owner clearfix fsn">';
		            	$html .='<a class="full_name pull-left" href="'.FSRoute::_('index.php?module=members&view=member&task=edit&id='.$item -> user_id.'&username='.$item -> username).'">';
		            		$html .='<img  src="'.URL_ROOT.$item -> user_image.'" width="27" height="27"  onerror="javascript:this.src=\''.URL_ROOT.'images/no-avatar.jpg'.'\';" />';
		            		$html .='<font>'.$item -> user_full_name.'</font>';
		            	$html .='</a>';
		            	if($item -> user_city){
		            		$html .='<span class="user_city pull-right">'.$item -> user_city.'</span>';
		            	 }
		            $html .='</div>';
				$html .='</section>';
	 		        
			$html .='</li>';
	}
	
?>