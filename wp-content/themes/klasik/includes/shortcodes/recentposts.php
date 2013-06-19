<?php
	/* Recent Posts */
	add_shortcode( 'theme_recentposts', 'klasik_recent_posts' );
	
	function klasik_recent_posts($atts, $content = null) {
		extract(shortcode_atts(array(
					"cat" => '',
					"class" => '',
					"order"	=>	'date',
					"cols" => '3',
					"showposts" => 12,
					"disablemore" => "no",
					"moretext" => __('Continue Reading', 'templatesquare'),
					"lengthchar" => 70
		), $atts));
		
		$cols = intval($cols);
		
		if(!is_numeric($cols) || $cols < 1 || $cols > 6){
			$cols = 4;
		}
		
		$showposts = (!is_numeric($showposts))? 12 : $showposts;
		$longdesc = (!is_numeric($lengthchar))? 70 : $lengthchar;
		$disablemore = ($disablemore=="yes")? true : false;

		$output = "";
		$output .='<div class="recentpost-container '.$class.'">';
			$output .='<div class="row">';
				global $wp_query;
				$original_query = $wp_query;
				$wp_query = null;
				
				$args = array(
					"post_type" => "post",
					"orderby" => $order,
					"showposts" => $showposts
				);

				if($cat!=""){
					$args['category_name'] =  $cat;
				}
				
				$wp_query = new WP_Query( $args );
				global $post;
				
				if ($wp_query->have_posts()) : 
					$x = 0;
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					
					$custom = get_post_custom($post->ID);

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

					$output .='<article class="'.$colclass.' columns '.$omega.'">';
						$output .='<div class="item-container">';
							
							$postformat = (get_post_format())? get_post_format() : 'default';
							
							$output .= call_user_func('recent_content_'.$postformat, $longdesc, $moretext, $disablemore);
							
							$output.='<div class="clear"></div>';
						$output .='</div>';
					$output .='</article>';

					endwhile;
				
				$wp_query = null;
				$wp_query = $original_query;
				wp_reset_postdata();
				
				endif;
					$output.='<div class="clear"></div>';
				$output .='</div>';
			$output.='<div class="clear"></div>';
		$output .='</div>';
			 
		return $output;
}

function recent_content_default($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	$output = "";
	
	$custom = get_post_custom($post->ID);
	$cf_thumb = (isset($custom["klasik_thumb"][0]))? $custom["klasik_thumb"][0] : ""; 
                   
	if($cf_thumb!=""){
		$thumb = '<img src='. $cf_thumb .' alt="" class="imgframe"/>';
	}elseif(has_post_thumbnail($post->ID) ){
		$thumb = get_the_post_thumbnail($post->ID, 'thumb-standard', array('class' => 'imgframe'));
	}else{
		$thumb ="";
	}
	
	if($thumb!=""){
		$output .= '<div class="postimg">';
			$output .= '<div class="thumbcontainer">';
				$output .= $thumb;
				$output .= '<div class="clear"></div>';
			$output .= '</div>';
		$output .= '</div>';
	}
	
	$output .='<div class="title">';
		$output .='<h3 class="posttitle">';
			$output .='<a href="'. get_permalink() .'" rel="bookmark" title="'.__('Permanent Link to','templatesquare').' '.the_title_attribute('echo=0').'">'.get_the_title().'</a>';
		$output .='</h3>';
		
	$output .='</div>';
	
	$output .='<div class="entry-utility">';
		$output .='<div class="date">'. get_the_time('F d, Y') .'</div>'; 
		$output .='<div class="user">'. __('by','klasik').' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></div> ';
		$output .='<div class="tag">'. __('in','klasik'). ' ' . klasik_get_category() .'</div> ';
		$output .='<div class="clear"></div>';
	$output .='</div>';
	
	$output .='<div class="post-text">';
	
		$output.='<p class="text">';
			$excerpt = get_the_excerpt();
			$output .= klasik_string_limit_char($excerpt, $longdesc);
		$output.='</p>';
		
		if(!$disablemore){
			$output.='<a href="'.get_permalink().'" class="more">'. $moretext .'</a>';
		}

		$output.='<div class="clear"></div>';
	$output .='</div>';

	return $output;
}

function recent_content_aside($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	$output = "";
	$output .= '<div class="aside">';
		$output .= get_the_content();
  	$output .= '</div><!-- .aside -->';
	return $output;
}

function recent_content_audio($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	$output = "";
	
	$output .= '<div class="entry-audio">';
		$pregaud = preg_match_all('/(\<audio.*\<\/audio\>)/is', get_the_content(), $audios);
		$audio = $audios[1][0];
		$media = "";
		
		if(!empty($audio)){
			$media = $audio;
		}
		
		if(!empty($media)){
			$output .= '<div class="mediacontainer">'.$media.'</div>';
		}
		
		$output .='<div class="title">';
			$output .='<h3 class="posttitle">';
				$output .='<a href="'. get_permalink() .'" rel="bookmark" title="'.__('Permanent Link to','templatesquare').' '.the_title_attribute('echo=0').'">'.get_the_title().'</a>';
			$output .='</h3>';
			
		$output .='</div>';
		
		$output .='<div class="entry-utility">';
			$output .='<div class="date">'. get_the_time('F d, Y') .'</div>'; 
			$output .='<div class="user">'. __('by','klasik').' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></div> ';
			$output .='<div class="tag">'. __('in','klasik'). ' ' . klasik_get_category() .'</div> ';
			$output .='<div class="clear"></div>';
		$output .='</div>';
		
		$output .='<div class="post-text">';
		
			$output.='<p class="text">';
				$excerpt = get_the_excerpt();
				$output .= klasik_string_limit_char($excerpt, $longdesc);
			$output.='</p>';
			
			if(!$disablemore){
				$output.='<a href="'.get_permalink().'" class="more">'. $moretext .'</a>';
			}
			
			$output.='<div class="clear"></div>';
		$output .='</div>';
	
	$output .='</div>';
	return $output;
}

function recent_content_gallery($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	$output = "";
	
	$output .= '<div class="entry-gallery">';
		$custom = get_post_custom($post->ID);
		$cf_thumb = (isset($custom["klasik_thumb"][0]))? $custom["klasik_thumb"][0] : "";
		$cf_lightbox = (isset($custom["klasik_lightbox"][0]))? $custom["klasik_lightbox"][0] : "";
		$cf_externallink = (isset($custom["klasik_link"][0]))? $custom["klasik_link"][0] : "";
	
		//get post-thumbnail attachment
		$attachments = get_children( array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'orderby' => 'menu_order',
		'post_mime_type' => 'image')
		);
		
		$cf_thumb2 = "";
		$lislides = "";
		foreach ( $attachments as $att_id => $attachment ) {
			$getimage = wp_get_attachment_image_src($att_id, 'thumb-blog', true);
			$theimage = $getimage[0];
			$cf_thumb2 = '<img src="'.$theimage.'" alt="'. get_the_title() .'" />';
		}
		
		//thumb image
		if($cf_thumb!=""){
			$cf_thumb = "<img src='" . $cf_thumb . "' alt='". get_the_title() ."'  />";
		}elseif(has_post_thumbnail($post->ID)){
			$cf_thumb = get_the_post_thumbnail($post->ID, 'thumb-blog');
		}else{
			$cf_thumb = $cf_thumb2;
		}
		
		if($cf_thumb!=""){
			$output .= '<div class="postimg">';
				$output .= '<div class="thumbcontainer">';
					$output .= $cf_thumb;
					$output .= '<div class="clear"></div>';
				$output .= '</div>';
			$output .= '</div>';
		}
		
		$output .='<div class="title">';
			$output .='<h3 class="posttitle">';
				$output .='<a href="'. get_permalink() .'" rel="bookmark" title="'.__('Permanent Link to','templatesquare').' '.the_title_attribute('echo=0').'">'.get_the_title().'</a>';
			$output .='</h3>';
			
		$output .='</div>';
		
		$output .='<div class="entry-utility">';
			$output .='<div class="date">'. get_the_time('F d, Y') .'</div>'; 
			$output .='<div class="user">'. __('by','klasik').' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></div> ';
			$output .='<div class="tag">'. __('in','klasik'). ' ' . klasik_get_category() .'</div> ';
			$output .='<div class="clear"></div>';
		$output .='</div>';
		
		$output .='<div class="post-text">';
		
			$output.='<p class="text">';
				$excerpt = get_the_excerpt();
				$output .= klasik_string_limit_char($excerpt, $longdesc);
			$output.='</p>';
			
			if(!$disablemore){
				$output.='<a href="'.get_permalink().'" class="more">'. $moretext .'</a>';
			}
			
			$output.='<div class="clear"></div>';
		$output .='</div>';
	
	$output .='</div>';

	return $output;
}

function recent_content_image($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	$output = "";
	
	$output .='<div class="entry-image">';
	
		$custom = get_post_custom($post->ID);
		$cf_thumb = (isset($custom["klasik_thumb"][0]))? $custom["klasik_thumb"][0] : "";
		$cf_lightbox = (isset($custom["klasik_lightbox"][0]))? $custom["klasik_lightbox"][0] : "";
		$cf_externallink = (isset($custom["klasik_link"][0]))? $custom["klasik_link"][0] : "";
	
		//get post-thumbnail attachment
		$attachments = get_children( array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'orderby' => 'menu_order',
		'post_mime_type' => 'image')
		);
		
		foreach ( $attachments as $att_id => $attachment ) {
			$getimage = wp_get_attachment_image_src($att_id, 'thumb-blog', true);
			$theimage = $getimage[0];
			$cf_thumb2 ='<img src="'.$theimage.'" alt="" />';
		}
		 
		
		//thumb image
		if($cf_thumb!=""){
			$cf_thumb = "<img src='" . $cf_thumb . "' alt='". get_the_title() ."'  />";
		}elseif(has_post_thumbnail($post->ID)){
			$cf_thumb = get_the_post_thumbnail($post->ID, 'thumb-blog');
		}else{
			$cf_thumb = $cf_thumb2;
		}
		
		if(!$disablemore){
			$output .= '<a href="'.get_permalink($post->ID).'">'.$cf_thumb.'</a>';
		}else{
			$output .= $cf_thumb;
		}
		
	$output .= '</div>';
	return $output;
}

function recent_content_link($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	$output = "";
	
	$output .= '<div class="entry-links">';
	$content = preg_match_all( '/href\s*=\s*[\"\']([^\"\']+)/', get_the_content(), $links );
	$link = $links[1][0];

	$output .= '<h2 class="posttitle"><a href="'. $link .'">'. get_the_title() .'</a></h2>';
		$output .= '<div>'. $link .'</div>';
	$output .= '</div>';

	return $output;
}

function recent_content_quote($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	
	$thumb = "";
	
	$output = "";
	$output .= '<div class="entry-quote">';
		$output .= '<blockquote>';
			$output .= get_the_excerpt();
			$output .= '<div class="quotearrow"></div>';
		$output .= '</blockquote>';
		$output .= '<div class="clear"></div>';
		$output .= '<div class="quoteinfo">';
			$withimg = "";
			
			$output .= '<span class="info '. $withimg .'">'. get_the_title() .'</span>';
			$output .= '<div class="clear"></div>';
		$output .= '</div>';
	$output .= '</div>';

	return $output;
}

function recent_content_video($longdesc = 120, $moretext='', $disablemore = false){
	global $post;
	$output = "";
	$output .= '<div class="entry-video">';
	
		$custom = get_post_custom($post->ID);
		$pregvid = preg_match_all('/(\<video.*\<\/video\>)/is', get_the_content(), $videos);
		$pregobj = preg_match_all('/(\<object.*\<\/object\>)/is', get_the_content(), $objects);
		$pregemb = preg_match_all('/(\<embed.*\<\/embed\>)/is', get_the_content(), $embeds);
		$pregifr = preg_match_all('/(\<iframe.*\<\/iframe\>)/is', get_the_content(), $iframes);
		$video = isset($videos[1][0])? $videos[1][0] : "";
		$object = isset($objects[1][0])? $objects[1][0] : "";
		$embed = isset($embeds[1][0])? $embeds[1][0] : "";
		$iframe = isset($iframes[1][0])? $iframes[1][0]: "";
		$media = "";
		
		if(!empty($video)){
			$media = $video;
		}elseif(!empty($object)){
			$media = $object;
		}elseif(!empty($embed)){
			$media = $embed;
		}elseif(!empty($iframe)){
			$media = $iframe;
		}
		
		if(!empty($media)){
			$output .= '<div class="mediacontainer">'.$media.'</div>';
		}
		
		$output .='<div class="title">';
			$output .='<h3 class="posttitle">';
				$output .='<a href="'. get_permalink() .'" rel="bookmark" title="'.__('Permanent Link to','templatesquare').' '.the_title_attribute('echo=0').'">'.get_the_title().'</a>';
			$output .='</h3>';
			
		$output .='</div>';
		
		$output .='<div class="entry-utility">';
			$output .='<div class="date">'. get_the_time('F d, Y') .'</div>'; 
			$output .='<div class="user">'. __('by','klasik').' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'">'. get_the_author() .'</a></div> ';
			$output .='<div class="tag">'. __('in','klasik'). ' ' . klasik_get_category() .'</div> ';
			$output .='<div class="clear"></div>';
		$output .='</div>';
		
		$output .='<div class="post-text">';
		
			$output.='<p class="text">';
				$excerpt = get_the_excerpt();
				$output .= klasik_string_limit_char($excerpt, $longdesc);
			$output.='</p>';
			
			if(!$disablemore){
				$output.='<a href="'.get_permalink().'" class="more">'. $moretext .'</a>';
			}
			
			$output.='<div class="clear"></div>';
		$output .='</div>';
	
	$output .='</div>';

	return $output;
}