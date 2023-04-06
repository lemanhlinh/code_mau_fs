<?php
global $tmpl, $config;
//$tmpl->addScript('form1');
$tmpl->addStylesheet('gioithieu', 'modules/contents/assets/css');
//$tmpl->addScript('content', 'modules/contents/assets/js');
//    $tmpl -> addStylesheet('product','modules/products/assets/css');

$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
//var_dump($url);

$return = base64_encode($url);
$lang = FSInput::get('lang');

//var_dump($return);
// echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
?>
<section>
    <!--    --><?php //echo html_entity_decode($data->content) ?>
    <div class="box_dev" style="position: relative; padding-top: 40px; padding-bottom: 115px">
        <img alt="" class="img-responsive" src="/upload_images/images/2021/06/24/Group%20331.png"
             style="position: absolute;right: 0;top: 0;"/>
        <div class="container">
            <img alt="" class="img-responsive" src="/upload_images/images/2021/06/26/Group750.png"
                 style="margin: auto"/>
            <h1 style="text-align: center">Thành tích</h1>
            <p style="text-align: center; margin-bottom: 50px">At vero eos et accusamus et iusto odio dignissimos
                ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti<br>
                quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in
                culpa...(demo)</p>
        </div>
    </div>
</section>





