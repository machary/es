<?php 
	/* Portfolio */
	add_shortcode( 'theme_portfolio', 'klasik_portfolio' );
	
	function klasik_portfolio($atts, $content = null) {
		extract(shortcode_atts(array(
					"cats" => '',
					"class" => '',
					"order"	=>	'date',
					"cols" => '3',
					"showposts" => 12,
					"disabletitle" => "no",
					"disabledesc" => "no",
					"lengthchar" => 120
		), $atts));
		
		$cols = intval($cols);
		
		if(!is_numeric($cols) || $cols < 1 || $cols > 6){
			$cols = 4;
		}
		
		$disabletitle = ($disabletitle=="yes")? true : false;
		$disabledesc = ($disabledesc=="yes")? true : false;
		$longdesc = (!is_numeric($lengthchar))? 120 : $lengthchar;
		$showposts = (!is_numeric($showposts))? 12 : $showposts;
        $categories = explode(",",$cats);

		global $wp_query;
		$output = "";
		$output .='<div class="klasik-portfolio '.$class.'">';
		
			$approvedcat = array();
			$sideoutput = "";
            if( count($categories)!=0 ){
                foreach ($categories as $key) {
                    $catname = get_term_by("slug",$key,"portfolio-category");
                    $approvedcat[] = $key;
                }
            }
			
			

				$approvedcatID = array();
				$isotopeclass = "";
				if( count($categories)>1 ){
					$sideoutput .='<div class="frame-filter">';
						$sideoutput .='<div class="filterlist">';
							$sideoutput .= '<ul id="filter" class="controlnav">';
								$sideoutput .= '<li class="segment-1 selected-1 current first"><a href="#" data-filter="*">'.__('All Categories','klasik').'</a></li>';
								foreach ($categories as $key) {
									$catname = get_term_by("slug",$key,"portfolio-category");
									$sideoutput .= '<li class="segment-1"><a href="#" data-filter=".'.$catname->slug.'">'.$catname->name.'</a></li>';
									$approvedcatID[] = $key;
								}
							$sideoutput .= '</ul>';
						$sideoutput .='</div>';
					$sideoutput .='</div>';
					$sideoutput .='<div class="clear"></div>';
					$isotopeclass = "isotope";
					$showposts = -1;
				}elseif( count($categories)==1 ){
					foreach ($categories as $key) {
						$catname = get_term_by("slug",$key,"portfolio-category");
						$approvedcatID[] = $key;
					}
				}else{
					$sideoutput .='<span style="color:red">Please Setting Portfolio in Appearance->Theme Options->Portfolio.</span>';
				}
				
				$output .= $sideoutput;
			
			$temp = $wp_query;
			$wp_query= null;
			$wp_query = new WP_Query();
			
			$args = array(
                'post_type' => 'portfolio',
                'showposts' => $showposts,
                'orderby' => 'date'
            );

			if( count($approvedcatID) ){
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio-category',
						'field' => 'slug',
						'terms' => $approvedcat
					)
				);
			}
			
			$wp_query->query($args);
			global $post;
			
			if ($wp_query->have_posts()) : 
				$x = 0;
				
				$output .= '<div class="row '.$isotopeclass.'">';
				while ($wp_query->have_posts()) : $wp_query->the_post(); 
				
				$custom = get_post_custom($post->ID);
				
				$x++;

				if($cols==1){
					$colclass = "twelve columns";
				}elseif($cols==2){
					$colclass = "one_half columns";
				}elseif($cols==3){
					$colclass = "one_third columns";
				}elseif($cols==4){	
					$colclass = "one_fourth columns";
				}elseif($cols==5){
					$colclass = "one_fifth columns";
				}elseif($cols==6){
					$colclass = "one_sixth columns";
				}
				
				if($x%$cols==0){
					$omega = "omega";
				}elseif($x%$cols==1){
					$omega = "alpha";
				}else{
					$omega = "";
				}

				$output .= klasik_portfolio_box($colclass.' '.$omega, $disabletitle, $disabledesc, $longdesc);

				endwhile;
				$output .= '</div>';
				$wp_query = null; $wp_query = $temp; wp_reset_query();
			
			endif;
			$output.='<div class="clear"></div>';
		$output .='</div>';
			 
		return do_shortcode($output);
}

function klasik_portfolio_box($class="", $disabletitle=false, $disabledesc=false, $longdesc=120){
	global $post;
	$custom = get_post_custom($post->ID);
            
	$cf_thumb 			= isset($custom["thumb"][0])? $custom["thumb"][0] : "" ;
	$cf_lightbox	 	= isset($custom["klasik_lightboxurl"][0])? $custom["klasik_lightboxurl"][0] : "" ;
	$cf_customdesc 		= isset($custom["klasik_customdesc"][0])? $custom["klasik_customdesc"][0] : "" ;
	$cf_disablelightbox	= isset($custom["klasik_disable_lightbox"][0])? $custom["klasik_disable_lightbox"][0] : "" ;
	$cf_externallink	= isset($custom["klasik_extlink"][0])? $custom["klasik_extlink"][0] : "" ;
	
	if($cf_customdesc!=""){
		$titledesc = $cf_customdesc;
	}else{
		$titledesc = get_the_title($post->ID);
	}
	
	
	//get post-thumbnail attachment
	$attachments = get_children( array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'orderby' => 'menu_order',
		'post_mime_type' => 'image')
	);
	
	 foreach ( $attachments as $att_id => $attachment ) {
		$getimage = wp_get_attachment_image_src($att_id, 'thumb-portfolio', true);
		$portfolioimage = $getimage[0];
		$cf_thumb2 ='<img src="'.$portfolioimage.'" class="frame" width="555" height="330" alt="" />';
		$thethumblb = $portfolioimage;
	 }
	 
	
	//thumb image
	if($cf_thumb!=""){
		$cf_thumb = "<img src='" . $cf_thumb . "' alt=''  />";
	}elseif(has_post_thumbnail($post->ID)){
		$cf_thumb = get_the_post_thumbnail($post->ID, 'thumb-portfolio');
		$thumb_id = get_post_thumbnail_id($post->ID);
		$args = array(
			'post_type' => 'attachment',
			'post_status' => null,
			'include' => $thumb_id
		);
		
		$thumbnail_image = get_posts($args);
		if ($thumbnail_image && isset($thumbnail_image[0])) {
			$cf_customdesc = $thumbnail_image[0]->post_content;
		}
	}else{
		$cf_thumb = $cf_thumb2;
	}
	
	$ids = get_the_ID();
	
	if($disabletitle==true){$addclass= "no-pftitle";}else{$addclass="";}

	$catinfos = get_the_terms($post->ID,'portfolio-category');
	$key = "";
	if($catinfos){
		foreach($catinfos as $catinfo){
			$key .= " ".$catinfo->slug;
		}
		$key = trim($key);
	}	
	$output="";				
	$output .= '<div data-id="id-'. $post->ID .'" class="item '.$class.' '.$key.'">';
			
		$output.='<div class="klasik-pf-img">';

		$output .= '<div class="shadowBottom">';
		if($cf_externallink!=""){
		
			$output .='<a class="pflink" href="'.$cf_externallink.'" title="'.$titledesc.'">';
				$output .= '<span class="rollover"></span>';
				$output .= $cf_thumb;
			$output .='</a>';

		}elseif($cf_lightbox!="" && $cf_disablelightbox==""){

			$output .='<a class="pfzoom" href="'.$cf_lightbox.'" data-rel=prettyPhoto[mixed] title="'.$cf_customdesc.'">';
				$output .= '<span class="rollover"></span>';
				$output .= $cf_thumb;
			$output .='</a>';

		}else{

			$output .='<a class="pfdetail" href="'.get_permalink().'" title="'.$titledesc.'">';
				$output .= '<span class="rollover"></span>';
				$output .= $cf_thumb;
			$output .='</a>';

		}
			$output .= '<div class="clear"></div>';
		$output .= '</div>';
		
		$output.='</div>';
		
		if(!$disabletitle || !$disabledesc){
			$output.='<div class="klasik-pf-text">';
				if(!$disabletitle){
					$output .='<h4><a class="pftitle" href="'.get_permalink().'" title="'.get_the_title().'">';
						$output .='<span>'.get_the_title().'</span>';
					$output .='</a></h4>';
				}
				$output .= '<div class="titleseparator"></div>';
				if(!$disabledesc){
					$excerpt = get_the_excerpt();
					$output .='<div class="textcontainer">'.klasik_string_limit_char($excerpt,$longdesc).'</div>';
					$output .='<div class="more-container"><a href="'.get_permalink().'" class="more-link">'.__('Read More','klasik').'</a></div>';
				}
	
			$output.='</div>';
		}

		$output .='<div class="clear"></div>';
	$output .='</div>';
	return $output;
}