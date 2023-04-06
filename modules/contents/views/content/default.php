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
    <?php echo html_entity_decode($data->content) ?>

</section>





