	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('cat','modules/'.$this -> module.'/assets/css');
	// $tmpl -> addScript('cat','modules/'.$this -> module.'/assets/js');
	?>
<div class='product-cat'>
	<div class='product-cat-head'>
			<h1><?php echo $cat -> name; ?></h1>
			<div class='project_filter'>
					Sắp xếp:
					<?php $i = 0;?>
	        		<?php foreach($array_menu as $item){?>
	        			<?php if($i){?>
	        				<span class='sepa'>|</span>
	        			<?php }?>
	        			<?php if($item[0] == 'moi-nhat'){?>
        				<a class='item <?php echo $sort == $item[0]?'selected':''?>' href="<?php echo FSRoute::_('index.php?module=products&view=cat&ccode='.$cat->alias.'&id='.$cat->id);?>" ><?php echo $item[1]; ?></a>
        				<?php }else{?>
        				<a class='item <?php echo $sort == $item[0]?'selected':''?>' href="<?php echo FSRoute::addParameters('sort', $item[0]);?>" ><?php echo $item[1]; ?></a>
        				<?php }?>
        				<?php $i++;?>
	        		<?php }?>
	        </div>
	        <div class='limit'>
					Số file/trang:
					<?php $array_limit = array('15','20','25','30','35','40'); ?>
					<?php $limit = FSInput::get('limit',15,'int');?>
					<select name="limit" onchange="window.location=this.value">
	        		<?php foreach($array_limit as $item){?>
	        			<?php $url = FSRoute::addParameters('limit', $item); ?>
	        			<?php if($item == $limit){?>
	        				<option value="<?php echo $url; ?>" selected="selected" ><?php echo $item; ?></option>
        				<?php }else{?>
        					<option value="<?php echo $url; ?>" ><?php echo $item; ?></option>
        				<?php }?>
	        		<?php }?>
	        		</select>
	        </div>
	        <div class='clear'></div>
        </div>
	<?php include_once 'default_list.php';?>
</div>

