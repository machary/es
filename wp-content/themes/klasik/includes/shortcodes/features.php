<?php
	/* Featured Pages */
	add_shortcode( 'theme_features', 'klasik_features' );
	
	function klasik_features($atts, $content = null) {
		extract(shortcode_atts(array(
					"ids" => '',
					"cat" => '',
					"class" => '',
					"order"	=>	'date',
					"cols" => '3',
					"disablemore" => "no",
					"moretext" => 'Read More'
		), $atts));
		
		if($ids!=""){
			$ids = explode(",",$ids);
		}else{
			$ids = array();
		}
		$cols = intval($cols);
		
		if(!is_numeric($cols) || $cols < 1 || $cols > 6){
			$cols = 4;
		}

		global $wp_query;
		$output = "";
		$output .='<div class="featured-container '.$class.'">';
			$output .='<div class="row">';
				
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				
				$args = array(
					"post_type" => "feature",
					"orderby" => $order,
					"showposts" => -1
				);

				if( count($ids) ){
					$args["post__in"] = $ids;
				}elseif($cat!=""){
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'feature-category',
							'field' => 'slug',
							'terms' => $cat
						)
					);
				}
				$wp_query->query($args);
				global $post;
				
				if ($wp_query->have_posts()) : 
					$x = 0;
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					
					$custom = get_post_custom($post->ID);
					
					$cf_pageicon = "";
					if(has_post_thumbnail($post->ID)){
						$thumbid = get_post_thumbnail_id($post->ID);
						$imagesrc = wp_get_attachment_image_src($thumbid,'full');
						if($imagesrc!=false){
							$cf_pageicon = $imagesrc[0];
						}
					}
					
					$cf_pageicon = (isset($custom["klasik_pageicon"][0]))? $custom["klasik_pageicon"][0] : $cf_pageicon;
					$cf_link = (isset($custom["klasik_link"][0]))? $custom["klasik_link"][0] : "";
					
					$x++;

					if($cols==1){
						$colclass = "twelve columns";
					}elseif($cols==2){
						$colclass = "one_half";
					}elseif($cols==3){
						$colclass = "one_third";
					}elseif($cols==4){	
						$colclass = "one_fourth";
					}elseif($cols==5){
						$colclass = "one_fifth";
					}elseif($cols==6){
						$colclass = "one_sixth";
					}
					
						if($x%$cols==0){
							$omega = "omega";
						}elseif($x%$cols==1){
							$omega = "alpha";
						}else{
							$omega = "";
						}

					$output .='<div class="'.$colclass.' columns '.$omega.'">';
						$output .='<div class="item-container">';
							$output .='<div class="title">';
								if($cf_pageicon){
									$output .='<div class="img-container"><img src="'.$cf_pageicon.'" alt="" /></div> ';
								}
								
								$output .='<h3>';
									
									if($cf_link==""){
										$output .= get_the_title();
									}else{
										$output .='<a href="'.$cf_link.'" rel="bookmark" title="'.__('Permanent Link to','templatesquare').' '.the_title_attribute('echo=0').'">'.get_the_title().'</a>';
									}
									
								$output .='</h3>';
								
							$output .='</div>';
							
							$output .='<div class="feature-text">';
							
								$output.='<p class="text">';
									$excerpt = get_the_excerpt();
									$output.= $excerpt;
								$output.='</p>';
								if($cf_link!="" && $disablemore!="yes"){
									$output.='<a href="'.$cf_link.'" class="more">'. $moretext .'</a>';
								}
								$output.='<div class="clear"></div>';
							$output .='</div>';
							
							$output.='<div class="clear"></div>';
						$output .='</div>';
					$output .='</div>';

					endwhile;
			
				$wp_query = null; $wp_query = $temp; wp_reset_query();
				
				endif;
				$output.='<div class="clear"></div>';
			$output .='</div>';
			$output .='<div class="clear"></div>';
		$output .='</div>';
			 
		return do_shortcode($output);
}