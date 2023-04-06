<!--	TAGS		-->
<?php 
//if($category -> display_tags){
	if($data -> tags){
		$arr_tags = explode(',',$data -> tags);
		$total_tags = count($arr_tags);
		if($total_tags){
			//echo '<div class="news_tags row-item">';
			echo '<h4 class="tags_title fl-left tag1 tag2">'.FSText::_('Tags').': </h4>';
			//echo '<div class="content_tags">';

			for($i = 0; $i < $total_tags; $i ++){
				$item = trim($arr_tags[$i]);
				if($item){
					//if($i > 0)
						//echo '<font>, </font>';
					$link = FSRoute::_("index.php?module=search&view=search&keyword=".str_replace(' ','+',$item));
					echo '<h3 style="margin-right: 5px;" class="item-tag fl-left  tag2"><a style="color: #2685CA; font-size: 14px;" href="'.$link.'" title="'.$item .'">'.$item.',</a></h3>';
				}
			}
			//echo "<div class='clear'></div>";
			//echo '</div>';
			//echo '</div>';
			//echo "<div class='clear'></div>";
		}
	}
//}
?>
<!--	end TAGS		-->	