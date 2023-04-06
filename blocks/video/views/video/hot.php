<?php
    global $tmpl;
    $tmpl -> addStylesheet('lightgallery.min','modules/products/assets/css');
    $tmpl -> addScript('lightgallery-all.min','modules/products/assets/js');
    $tmpl -> addScript('script','blocks/video/assets/js'); 
    $tmpl -> addStylesheet('video','blocks/video/assets/css');
    $i = 0;$html = '';$class = '';
?>
<div class="video-gallery row-item" >
        <?php 
            foreach ($list as $item) {
            $link_video = $item->link_video;
            $class = $i==0? '':'hide';
            if($item->image && $item->video){
                $link_img = URL_ROOT.str_replace("original", "small", $item->image);
                $html .= '<div style="display:none;" id="video'.$item->id.'">
                            <video class="lg-video-object lg-html5" controls preload="none">
                                <source src="'.URL_ROOT.$item->video.'" type="video/mp4">
                            </video>
                        </div>';
                $video = '<a class="col-lage '.$class.'" data-poster="'.$link_img.'" data-sub-html="'.$item->name.'" data-html="#video'.$item->id.'" >
                              <img class="img-responsive" src="'.$link_img.'" />
                          </a>';        
            }else if($link_video){
                parse_str( parse_url( $link_video, PHP_URL_QUERY ), $arr_youtube_key );
                $video_id = $arr_youtube_key['v'];
                $thumb_default = "http://img.youtube.com/vi/$video_id/0.jpg"; 
                $link_img = $thumb_default;
                $video = '<a rel="nofollow" class="col-img col-lage '.$class.'" title="'.$item->name.'" href="'.$link_video.'" data-sub-html="'.$item->name.'">
                            <img class="img-responsive" src="'.$link_img.'" alt="'.$item->name.'" />
                        </a>';
            }
            
            //echo $video;  
        ?>
            <?php echo $video; ?>
            <?php //if($i==count($list)-1){ echo "</div>"; } ?>
        <?php $i++; } ?>
</div>
<?php echo $html; ?>



