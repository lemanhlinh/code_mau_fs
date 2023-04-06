<?php  	
    global $tmpl,$config;
    $img = $data->image? URL_ROOT.str_replace('/original/', '/large/', $data->image):'';
    $link = FSRoute::_('index.php?module=products&view=product&code='.$data -> alias.'&ccode='.$data->category_alias.'&id='.$data->id);
    $schema = '
                <script type="application/ld+json">
                {
                  "@context": "http://schema.org",
                  "@type": "Article",
                  "mainEntityOfPage":{
                    "@type":"WebPage",
                    "@id":"'.$link.'"
                  },
                  "headline": "'.$data->name.'",
                  "image": {
                    "@type": "ImageObject",
                    "url": "'.$img.'",
                    "height": 700,
                    "width": 700
                  },
                  "datePublished": "'.date('d/m/Y',strtotime($data->created_time)).'",
                  "dateModified": "'.date('d/m/Y',strtotime($data->edited_time)).'",
                  "author": {
                    "@type": "Person",
                    "name": "'.$config['site_name'].'"
                  },
                   "publisher": {
                    "@type": "Organization",
                    "name": "'.URL_ROOT.$config['site_name'].'",
                    "logo": {
                      "@type": "ImageObject",
                      "url": "'.URL_ROOT.$config['logo'].'",
                      "width": 600,
                      "height": 60
                    }
                  },
                  "description": "'.$data -> summary.'"
                }</script>';
                
    $stype_css_amp = '
                    body {
                            font-family: "Roboto", sans-serif;
                            line-height: 18px;
                            color: #333333;
                      }
                      .amp-products {
                            color: #353535;
                            font-weight: 400;
                            overflow-wrap: break-word;
                            word-wrap: break-word;
                      }
                      .amp-products amp-img {
                            padding: 20px;
                            background-color: #f3f3f3;
                            border: 1px solid #cccccc;
                        }
                      .amp-description {
                            font-size: 20px;
                            text-align: left;
                            line-height: 30px;
                        }
                        header {
                            background-color: #ffffff;
                            position: relative;
                            border-bottom: 1px solid #dddddd;
                            padding: 10px 0px;
                        }
                        footer {
                            padding: 25px 0px;
                            background-color: #282828;
                            color: #ffffff;
                            font-size: 18px;
                            line-height: 24px;
                        }
                        .amp-container{
                            max-width: 840px;
                            margin: 0px auto;
                        }
                        
                    ';
    $tmpl -> load_amp(1,1,$stype_css_amp,$schema,$link,'',1);
?>
<div class="amp-products">
        <h1 class="amp-name">
           <?php echo $data->name; ?>
        </h1><!-- END: .name-products -->
        
        <a href="<?php echo $link; ?>" title="<?php echo $data->name; ?>">
            <amp-img class="fl-left" src="<?php echo $img; ?>" alt="<?php echo $data->name; ?>" height="400" width="436"></amp-img>
        </a>
        
            
        <div class="amp-summary">
            <?php echo $data->summary; ?>
        </div><!-- END: .name-products -->

        <div class="amp-description">
            <?php 
                $description = html_entity_decode($data->description);
                $description = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $description);
                $description = preg_replace("/<img[^>]+\>/i", "", $description);
                echo $description;
            ?>
        </div>
</div><!-- END: amp-products -->

