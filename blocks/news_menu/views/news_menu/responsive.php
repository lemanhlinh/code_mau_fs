<?php global $tmpl;
$tmpl -> addStylesheet('default','blocks/news_menu/assets/css');
$tmpl -> addScript('default','blocks/news_menu/assets/js');

// $tmpl -> addStylesheet('responsive','blocks/mainmenu/assets/css');
$tmpl -> addScript('responsive','blocks/mainmenu/assets/js');
$Itemid = FSInput::get('Itemid',3,'int');
$ccode = FSInput::get('ccode');
?>

	<!--	CONTENT -->
    <div id='css_menu2'>
 <nav class='cssmenu' id='css_menu'>
            <div class="buttonres"></div>
            <ul class="menu-news">
                <li class='active'>
                    <a href="<?php echo FSRoute::_('index.php?module=news&view=home'); ?>"><?php echo FSText::_('Trang chủ') ?></a>
                </li>
                                <?php 
                $Itemid  = 5; // config
                $num_child = array();
                $parant_close = 0;
                $i = 0;
                $count_children = 0;
                $summner_children = 0;
                $id = 0;
                if($need_check)
                    $id = FSInput::get('id',0,'int');
                    
                $total = count($list);
                    foreach ( $list as $item ) { 
                        $class = '';
                        if($need_check){
                            $class =  $item -> alias ==  $ccode ? 'open':'';
                        }
                        $link = FSRoute::_('index.php?module=news&view=cat&id='.$item->id.'&ccode='.$item->alias);
                        $class  .= ' level_'.$item -> level;
                        if($i == ($total -1))
                              $class .= ' last-item';
                              
                        $icon = '';
                        $icon .= $item->icon? "<i style='background: url(".URL_ROOT.str_replace('/original/','original/',$item->icon).") no-repeat center center;'>&nbsp;</i>":"";
                                
                        if($item -> level ){
                            $count_children ++;
                            if($count_children == $summner_children && $summner_children)
                                 $class .= ' last-item';
                        echo "<li class='$class child_".$item->parent_id."' >
                                    <a  href='".$link."'  > ".$item -> name."</a>  ";
                                                } else {
                            $count_children = 0;
                            $summner_children = $item -> children;
                                echo "<li class='has-sub item $class  ' id='pr_".$item -> id."' >";
                                echo " <a  href='".$link."' > ".$item -> name."</a>";
                        } 
                    ?>
                  <?php 
                    $num_child[$item->id] = $item->children ;
                    if($item->children  > 0){
                        if($item -> level)
                            echo "<ul id='c_".$item->id."' class=' sub-menu wrapper_children wrapper_children_level".$item -> level."' >";
                        else 
                            echo "<ul id='c_".$item->id."' class=' sub-menu wrapper_children_level".$item -> level."' >";
                    }
        
                    if(@$num_child[$item->parent_id] == 1) 
                    {
                        if($item->children > 0)
                        {
                            $parant_close ++;
                        }
                        else
                        {
                            $parant_close ++;
                            for($i = 0 ; $i < $parant_close; $i++)
                            {
                                echo "</ul>";
                            }
                            $parant_close = 0;
                            $num_child[$item->parent_id]--;
                        }
                        
                        if(( (@$num_child[$item->parent_id] == 0) && (@$item->parent_id >0 ) ) || !$item->children )
                        {
                          echo "</li>";
                        }
                        if(@$num_child[$item->parent_id] >= 1) 
                            $num_child[$item->parent_id]--;
                    }   
                        
                    
                    if(isset($num_child[$item->parent_id] ) && ($num_child[$item->parent_id] == 1) )
                        echo "</ul>";
                    if(isset($num_child[$item->parent_id]) && ($num_child[$item->parent_id] >= 1) )
                        $num_child[$item->parent_id]--;
                          
                }
                ?>
</ul>
</nav>
<div class="news_search">
    <span data-id="mmenu_search_news">&nbsp;</span>
    <?php include_once 'mdefault_search.php';?>
</div>
</div>
<!--	end CONTENT -->