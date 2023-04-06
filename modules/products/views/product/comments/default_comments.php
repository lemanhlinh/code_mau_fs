<?php $return = base64_encode($_SERVER['REQUEST_URI']); 

	$limit_display = 3;
	$num_child = array();
	$wrap_close = 0;
	$avatar = '';
	if(isset($_SESSION['avatar'])){
		if(strpos($_SESSION['avatar'], 'http:') !== false || strpos($_SESSION['avatar'], 'https:') !== false){
			$avatar = $_SESSION['avatar'];
		}else{
			$avatar = URL_ROOT.$_SESSION['avatar'];
		}
	}
 ?>
	<div class="_head mbl phl _2pi3 fss clearfix">
			<sapn class='pull-left' ><?php echo $total_comment;?> Bình luận</sapn>
			<sapn class='pull-right'>Tất cả bình luận &#187;</sapn>
	</div>			
	<?php if($comments){?>
		<ul class="_contents">	
			<?php foreach ($comments as $item){?>
				<li class='_item clearfix mbl _2pin' >
					<img width="32" src="<?php echo  $avatar?>" onerror="javascript:this.src='<?php echo URL_ROOT?>images/no-avatar.jpg';" />
					<div class='pull-left'>
						<span class='name fss'><?php echo $item -> email; ?></span>
						<div class='_content fsn'>
							<?php echo $item -> comment; ?>
						</div>
					</div>
					<div class='pull-right'>
						<span class='_date fss'><?php echo time_elapsed_string(strtotime($item -> created_time));?></span>
						
					</div>
					<!--	end CONTENT OF COMMENTS		-->
				</li>
			<?php } ?>
		</ul>
	<?php } ?>
	
	
<!-- FORM COMMENT	-->
<form action="#" method="post" name="comment">
	<p class="_control clearfix">
		<img width="32" src="<?php echo  $avatar?>" onerror="javascript:this.src='<?php echo URL_ROOT?>images/no-avatar.jpg';" />
		<textarea  name="comment" id='_txtcomment' placeholder="Viết bình luận..."></textarea>
	</p>
	<p class="clearfix">
		<a class="fss _2pi3 _2pia commentbt" href="javascript: void(0)"   <?php echo (@$_SESSION['user_id'])?'id="commentbt"':'onclick="myFunction()"' ?> ><?php echo (@$_SESSION['user_id'])?'Bình luận':'Đăng ký và để lại bình luận' ?></a>
	</p>
	<input type="hidden" value="products" name='module' />
	<input type="hidden" value="product" name='view' />
	<input type="hidden" value="save_comment" name='task' />
	<input type="hidden" value="<?php echo $data->id; ?>" name='record_id' id='record_id'  />
	<input type="hidden" value="<?php echo $return;?>" name='return'  />
</form>
