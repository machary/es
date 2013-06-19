<!-- SLIDER -->
<?php 
$slidertype = klasik_get_slidertype();

$custom = get_post_custom(get_the_ID());
$cf_slidercat = (isset($custom["klasik_slider_cat"][0]))? $custom["klasik_slider_cat"][0] : '';
$cf_sliderarr = (isset($custom["klasik_slider_arrange"][0]))? $custom["klasik_slider_arrange"][0] : '';
$cf_disabletext = (isset($custom["klasik_slider_disable_text"][0]))? $custom["klasik_slider_disable_text"][0] : '';

?>
<div id="outerslider">
    <div class="container">
    	<div class="row">
        
            <div id="slidercontainer" class="twelve columns">
              <section id="slider">
                <?php if($cf_slidercat){ ?>
                        <?php
                        $querycat = get_term_by("slug",$cf_slidercat,'slider-category');
                        
                        if($querycat){
                            $qrycatstr = '&slider-category='.$querycat->slug;
                        }
                        $nivocaption = "";
						$output="";
                        query_posts('post_type=slider'.$qrycatstr.'&post_status=publish&showposts=-1&order=' . $cf_sliderarr);
                        while ( have_posts() ) : the_post();
                        
                            $custom = get_post_custom($post->ID);
                            $cf_slideurl = (isset($custom["klasik_link"][0]))?$custom["klasik_link"][0] : "";
							$cf_thumb = (isset($custom["klasik_thumb"][0]))?$custom["klasik_thumb"][0] : "";
                            
                            $thecontent = get_the_content($post->ID);
                            $arrthumb = array();
							
							if($slidertype=="nivoslider"){
							
								if($cf_disabletext==""){
									
									/* Caption for Nivo Slider */
									$nivocaption .='<div id="'.get_the_ID().'" class="nivo-html-caption">';
										if($cf_slideurl!=''){
											$nivocaption .='<a href="'.$cf_slideurl.'">'.get_the_title().'</a>';
										}else{
											$nivocaption .= get_the_title();
										}
									$nivocaption .='</div>';
									
									/*Caption for Flexslider */
									$flexcap ='<div class="flex-caption">';
										if($cf_slideurl!=""){
											$flexcap .='<div><a href="'.$cf_slideurl.'" target="_blank">' . get_the_title() . '</a></div>';
										}else{
											$flexcap .='<div>' . get_the_title() . '</div>';
										}
									$flexcap .='</div>';
									
									if($cf_thumb!=""){
										$thetitle = 'title="#'.get_the_ID().'"';
										$urlthumb = $cf_thumb;
										$arrthumb = array('data-thumb' => $urlthumb);
									}else{
										$thetitle = '';
										$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-slider' ); $urlthumb = $thumb['0'];
										$arrthumb = array('data-thumb' => $urlthumb, 'title' => '#'.get_the_ID() );
									}
								}
                            
								if($cf_slideurl!=""){
									$output .= '<a href="'.$cf_slideurl.'" target="_blank">';
								}
	
								//slider images
								if(has_post_thumbnail( get_the_ID()) || $cf_thumb!=""){
									if($cf_thumb!=""){
										$output .= '<img src="'.$cf_thumb.'" data-thumb="'.$cf_thumb.'" width="1140" height="503" alt="'.get_the_title().'" '.$thetitle.' />';
									}else{
										$output .= get_the_post_thumbnail($post->ID, 'image-slider', $arrthumb);
									}
								}
									
								if($cf_slideurl!=""){
									$output .= '</a>';
								}
							
							}elseif($slidertype=="flexslider"){
								
								$output .= '<li>';
								
								if($cf_slideurl!=""){
									$output .= '<a href="'.$cf_slideurl.'" target="_blank">';
								}
	
								//slider images
								if(has_post_thumbnail( get_the_ID()) || $cf_thumb!=""){
									if($cf_thumb!=""){
										$output .= '<img src="'.$cf_thumb.'" data-thumb="'.$cf_thumb.'" width="1140" height="503" alt="'.get_the_title().'" '.$thetitle.' />';
									}else{
										$output .= get_the_post_thumbnail($post->ID, 'image-slider', $arrthumb);
									}
								}
									
								if($cf_slideurl!=""){
									$output .= '</a>';
								}
								
								if($cf_disabletext==""){

									/*Caption for Flexslider */
									$output .='<div class="flex-caption">';
										if($cf_slideurl!=""){
											$output .='<div><a href="'.$cf_slideurl.'" target="_blank">' . get_the_title() . '</a></div>';
										}else{
											$output .='<div>' . get_the_title() . '</div>';
										}
									$output .='</div>';

								}
								
								$output .= '</li>';
								
							}
							
                        endwhile;
                        wp_reset_query();
                        ?>
                    
                    <?php if($slidertype=="nivoslider"){ ?>
                    
                        <div id="slidernivo" class="nivoSlider">
                            <?php echo $output; ?>
                        </div>
                    	<?php echo $nivocaption;?>
                        
                    <?php }elseif($slidertype=="flexslider"){ ?>
                    
                        <div id="slideritems" class="flexslider">
                            <ul class="slides">
                            <?php echo $output; ?>
                            </ul>
                        </div>
                        
                    <?php } ?>
                    
                <?php }//end if($sliderCat) ?>
              </section>
        	</div>
            
    	</div>
    </div>
</div>
<!-- END SLIDER -->