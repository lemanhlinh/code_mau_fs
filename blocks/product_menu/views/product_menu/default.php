<?php global $tmpl;
//$tmpl->addStylesheet('styles', 'blocks/product_menu/assets/css');
$Itemid = FSInput::get('Itemid', 1, 'int');
$ccode = FSInput::get('ccode');
?>

<div class="aside-item collection-category">
    <div class="title_module margin-bottom-10"><h2><span>Danh mục</span></h2></div>
    <div class="aside-content aside-cate-link-cls">
        <nav class="cate_padding nav-category navbar-toggleable-md">
            <ul class="nav-ul nav navbar-pills">
                <?php
                $Itemid = 5; // config
                $num_child = array();
                $parant_close = 0;
                $i = 0;
                $count_children = 0;
                $summner_children = 0;
                $id = 0;
                if ($need_check)
                    $id = FSInput::get('id', 0, 'int');

                $total = count($list);
                foreach ($list as $item) {
                    $class = '';
                    if ($need_check) {
                        $class = $item->alias == $ccode ? 'open' : '';
                    }
                    $link = FSRoute::_('index.php?module=products&view=cat&cid=' . $item->id . '&ccode=' . $item->alias);
                    $class .= ' level_' . $item->level;
                    if ($i == ($total - 1))
                        $class .= ' last-item';

                    $icon = '';
                    $icon .= $item->icon ? "<i style='background: url(" . URL_ROOT . str_replace('/original/', '/original/', $item->icon) . ") no-repeat center center;'>&nbsp;</i>" : "";

                    if ($item->level) {
                        $count_children++;
                        if ($count_children == $summner_children && $summner_children)
                            $class .= ' last-item';

                        echo " <li class=\"nav-item  lv2\"> 
                                <a class=\"nav-link\" href='" . $link . "'  > " . $item->name . "</a> 
                              </li> ";
                    } else {
                        $count_children = 0;
                        $summner_children = $item->children;
                        echo "<li class=\"nav-item  lv1 active\"> ";
                        echo "<a class=\"nav-link\" href='" . $link . "' > " . $item->name . "</a>";
                    }
                    ?>
                    <?php
                    $num_child[$item->id] = $item->children;
                    if ($item->children > 0) {
                        if ($item->level)
                            echo "<i class=\"fa fa-angle-down\"></i><ul class=\"dropdown-menu\">";
                        else
                            echo "<i class=\"fa fa-angle-down\"></i><ul class=\"dropdown-menu\">";
                    }

                    if (@$num_child[$item->parent_id] == 1) {
                        if ($item->children > 0) {
                            $parant_close++;
                        } else {
                            $parant_close++;
                            for ($i = 0; $i < $parant_close; $i++) {
                                echo "</ul>";
                            }
                            $parant_close = 0;
                            $num_child[$item->parent_id]--;
                        }

                        if (((@$num_child[$item->parent_id] == 0) && (@$item->parent_id > 0)) || !$item->children) {
                            echo "</li>";
                        }
                        if (@$num_child[$item->parent_id] >= 1)
                            $num_child[$item->parent_id]--;
                    }


                    if (isset($num_child[$item->parent_id]) && ($num_child[$item->parent_id] == 1))
                        echo "</ul>";
                    if (isset($num_child[$item->parent_id]) && ($num_child[$item->parent_id] >= 1))
                        $num_child[$item->parent_id]--;
                }
                ?>
        </nav>
    </div>
</div>
