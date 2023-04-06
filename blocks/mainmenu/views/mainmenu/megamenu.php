<?php
global $tmpl;
//$tmpl -> addScript('script','blocks/mainmenu/assets/js');
$tmpl->addStylesheet('styles', 'blocks/mainmenu/assets/css');
$lang = FSInput::get('lang');
$Itemid = FSInput::get('Itemid');
?>
<?php $i = 0; ?>
<nav class="hidden-sm hidden-xs nav-main">
    <div class="menu_hed head_1">
        <ul class="nav nav_1">
            <?php foreach ($level_0 as $item): ?>
                <?php $link = $item->link ? FSRoute::_($item->link) : ''; ?>
                <?php $class = 'level_0'; ?>
                <?php $class .= $item->description ? ' long ' : ' sort' ?>
                <?php if ($arr_activated[$item->id]) $class .= ' active '; ?>
                <?php $target = ''; ?>
                <?php if ($item->target) $target .= $item->target; ?>
                <?php
                $childrens = isset($children[$item->id]) && count($children[$item->id]) ? 1 : 0; ?>
                <li class="<?php echo $class; ?> <?php echo $children ? 'menu_hover' : '' ?> nav-item nav-items ">
                    <a href="<?php echo $link; ?> " class="nav-link" target="<?php echo $target; ?>" >
                        <?php echo $item->name; ?>
                        <?php if ($childrens) { ?>
<!--                            <i class="fa fa-angle-down" data-toggle="dropdown"></i>-->
                        <?php } ?>
                    </a>

                    <!--	LEVEL 1			-->
                    <?php if ($childrens) { ?>
                    <ul class="dropdown-menu border-box">
                        <?php } ?>
                        <?php if ($childrens) { ?>
                            <?php $j = 0; ?>
                            <?php foreach ($children[$item->id] as $key => $child) { ?>
                                <?php $link = $child->link ? FSRoute::_($child->link) : ''; ?>
                                <li class="dropdown-submenu nav-item-lv2 <?php if ($arr_activated[$child->id]) $class .= ' active '; ?> ">
                                    <a href="<?php echo $link; ?>" class="nav-link"
                                       id="menu_item_<?php echo $child->id; ?>">
                                        <?php echo $child->name; ?>
                                    </a>

                                    <!--	LEVEL 3			-->
                                    <?php if (isset($children[$child->id]) && count($children[$child->id])){ ?>
                                    <i class="fa fa-angle-right" data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu border-box">
                                        <?php } ?>
                                        <?php if (isset($children[$child->id]) && count($children[$child->id])) { ?>
                                            <?php foreach ($children[$child->id] as $child3) { ?>
                                                <?php $link = FSRoute::_($child3->link); ?>
                                                <li class='nav-item-lv3 <?php if ($arr_activated[$child3->id]) $class .= ' activated '; ?> '>
                                                    <a class="nav-link" href="<?php echo $link; ?>"
                                                       title="<?php echo htmlspecialchars($child3->name); ?>">
                                                        <?php echo $child3->name; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if (isset($children[$child->id]) && count($children[$child->id])){ ?>
                                    </ul>
                                    <?php } ?>
                                    <!--	end LEVEL 3			-->

                                </li>
                                <?php $j++; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($childrens){ ?>
                    </ul>
                <?php } ?>
                </li>
                <?php $i++; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>