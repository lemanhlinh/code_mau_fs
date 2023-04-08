<?php 
    global $config;
    include_once '../libraries/tree/tree.php';
    $list = Tree::indentRows($list);
    $root_total = 0;
    $root_last = 0;
    $url = $_SERVER['REQUEST_URI'];

    foreach ($list as $item){
    	if(!@$item->parent_id){
    		$root_total ++ ;
    		$root_last = $item->id;
    	}
    }

    $array_panel = array(
            1 => 'bg-gray-light',
            2 => 'bg-black',
            3 => 'bg-red',
            4 => 'bg-yellow',
            5 => 'bg-aqua',
            6 => 'bg-blue',
            7 => 'bg-light-blue',
            8 => 'bg-green',
            9 => 'bg-navy',
            10 => 'bg-teal',
            11 => 'bg-olive',
            12 => 'bg-lime',
            13 => 'bg-orange',
            14 => 'bg-fuchsia',
            15 => 'bg-purple',
            16 => 'bg-maroon',
            17 => 'bg-gray-active',
            18 => 'bg-black-active',
            19 => 'bg-red-active',
            20 => 'bg-yellow-active',
            21 => 'bg-aqua-active',
            22 => 'bg-blue-active',
            23 => 'bg-light-blue-active',
            24 => 'bg-green-active',
            25 => 'bg-navy-active',
            26 => 'bg-teal-active',
            27 => 'bg-olive-active',
            28 => 'bg-lime-active',
            29 => 'bg-orange-active',
            30 => 'bg-fuchsia-active',
            31 => 'bg-purple-active',
            32 => 'bg-maroon-active',
    );
                
?>

<div class="user-panel">
    <div class="pull-left image">
          <img src="<?php echo URL_ROOT.'images/favicon.jpg'; ?>" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
      <p><?php echo !empty($_SESSION['ad_username'])? $_SESSION['ad_username']:'user' ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>

<!--<form action="#" method="get" class="sidebar-form">-->
<!--    <div class="input-group">-->
<!--      <input type="text" name="q" class="form-control" id="myInput" placeholder="Search..." />-->
<!--      <span class="input-group-btn">-->
<!--        <button id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>-->
<!--      </span>-->
<!--    </div>-->
<!--</form>-->

<ul class="sidebar-menu tree" data-widget="tree" id="sidebar-menu">
    
    <?php 
	$num_child = array();
	$parant_close = 0;
        
	foreach ($list as $item){
		$class = '';
        $collapse = '';
        $icon = '';
        $lable = '';
        $is_link = 0;
        if($item->icon){
            $icon = '<i class="'.$item->icon.'"></i> ';
        }
        
        if($item->count){
            $where = $item->where?  $item->where:'';
            $count = $this->get_count($where,$item->count);
            $lable = '<span class="pull-right-container"><span class="label pull-right '.$array_panel[$item->code_color].'">'.$count.'</span></span>';
        }                
        
		if($item->link){
		    $is_link = 1;
			$link = trim($item->link);
			if(strpos($url,$link) !== false)
				$class .= ' active ';
		}else{
			$link = "javascript:void(0)";
            $collapse =  '<span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>';
		}
        
        $has_child = '';
        if($item->children > 0)
            $has_child = ' has-child';
            
		if(!$item->parent_id){
        ?>
            <li class=" <?php echo $class;?> <?php echo $is_link? '':'treeview'; ?>">
                <a href="<?php echo $link; ?>" >
                    <?php echo $icon; ?>
                    <span><?php echo FSText::_(trim($item->name)); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    <?php echo $lable; ?> 
                </a>
            
        <?php }else{ ?>
            <li class="<?php echo $class;?> <?php echo $is_link? '':'treeview'; ?>" >
                <a href="<?php echo $link; ?>"  >
                    <?php //echo $icon; ?>
                    <span><?php echo FSText::_(trim($item->name)); ?></span>
                    <?php echo $collapse; ?>
                    <?php echo $lable; ?>                    
                </a>   
        <?php } ?>
        
	    <?php 
		$num_child[$item->id] = $item->children ;
		if($item->children  > 0)
			echo "<ul class='treeview-menu'  >";
		if(@$num_child[$item->parent_id] == 1){
			if($item->children > 0){
				$parant_close ++;
			}else{
				$parant_close ++;
				for($i = 0 ; $i < $parant_close; $i++){
					echo "</ul>";
				}
				$parant_close = 0;
				$num_child[$item->parent_id]--;
			}
			if(@$num_child[$item->parent_id] >= 1) 
				$num_child[$item->parent_id]--;
		}	
		if(isset($num_child[$item->parent_id] ) && ($num_child[$item->parent_id] == 1) )
			echo "</ul>";
		if(isset($num_child[$item->parent_id]) && ($num_child[$item->parent_id] >= 1) )
			$num_child[$item->parent_id]--;
        echo '</li>';
	}
	?>
</ul>