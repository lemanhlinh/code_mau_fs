<?php 
    global $config,$tmpl;
    $tmpl -> addStylesheet('video','blocks/video/assets/css');
?>
<div class="video-gallery row-item" >
    <?php 
        $i = 0;
        foreach ($list as $item) {
        $link_video = $item->link_video;
        $link = FSRoute::_('index.php?module=libraries&view=video&task=detail&code='.$item->alias.'&id='.$item->id);
        
        if($item->image){
            $link_img = URL_ROOT.str_replace("original", "small", $item->image);
        }else if($link_video){
            parse_str( parse_url( $link_video, PHP_URL_QUERY ), $arr_youtube_key );
            $video_id = $arr_youtube_key['v'];
            $thumb_default = "http://img.youtube.com/vi/$video_id/0.jpg"; 
            $link_img = $thumb_default;
        }else{
            $link_img = URL_ROOT.'images/no-images.png';
        }   
    ?>
        <?php if($i== 0){ ?>
            <a class="col-img col-lage" title="<?php echo $item->name;?>" href="<?php echo $link; ?>" >
                <img class="img-responsive" src="<?php echo $link_img; ?>" alt="<?php echo $item->name;?>" />
            </a><!-- END: col-lage -->
        <?php }else{ ?>
            <div class="row-item col-img">
                <a class="col-small fl-left" title="<?php echo $item->name;?>" href="<?php echo $link; ?>" >
                    <img class="img-responsive" src="<?php echo $link_img; ?>" alt="<?php echo $item->name;?>" />
                </a>
                <h3 class="name">
                    <a title="<?php echo $item->name;?>" href="<?php echo $link; ?>" ><?php echo getWord(12,$item->name); ?></a>
                </h3>
            </div><!-- END: col-img -->
        <?php }?>
        
        <?php //if($i==count($list)-1){ echo "</div>"; } ?>
    <?php $i++; } ?>
</div>      
