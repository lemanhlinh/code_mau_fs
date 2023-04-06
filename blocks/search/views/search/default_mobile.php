<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/1/2018
 * Time: 11:10 AM
 */
    global $tmpl;
    $tmpl -> addScript("search","blocks/search/assets/js");
    $text_default = FSText::_('Tìm kiếm');

    $keyword = $text_default;
    $module = FSInput::get('module');
    if($module == 'search'){
        $key = FSInput::get('keyword');
        if($key){
            $keyword = $key;
        }
    }
?>
<div class="header_search_ col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-lg hidden-md">
    <div class="search_full">
        <form class="form_search" method="get"  name="search_form_mobile" id="search_form_mobile" onsubmit="javascript: submit_form_search2();return false;">
            <input type="search" name="query" value="" placeholder="<?= $text_default ?>" id="input_search" class="input_search" autocomplete="off">
            <input type='hidden'  name="module" value="search"/>
            <input type='hidden'  name="module" id='link_search_mobile' value="<?php echo FSRoute::_('index.php?module=search&view=search'); ?>" />
            <input type='hidden'  name="view" value="search"/>
            <input type='hidden'  name="Itemid" value="20"/>
            <span class="input-group-btn">
                <button class="btn icon-fallback-text">
                    <i class="icon-magnifier icons"></i>
                </button>
            </span>
        </form>
    </div>
</div>