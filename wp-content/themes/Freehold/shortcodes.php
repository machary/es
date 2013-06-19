<?php
	
//////////////////////////////////////////////////////////////////
// Button shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('button', 'shortcode_button');
	function shortcode_button($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'arrow' => '',
				'link' => '#',
				'target' => '',
			), $atts);
		
			return '<span><a href="' . $atts['link'] . '" target="' . $atts['target'] . '" class="button ' . $atts['arrow'] . '">' .do_shortcode($content). '</a></span>';
	}



	//////////////////////////////////////////////////////////////////
	// bgarea shortcode
	//////////////////////////////////////////////////////////////////
	add_shortcode('bgarea', 'shortcode_bgarea');
		function shortcode_bgarea($atts, $content = null) {


				return '<span><div class="item-container">' .do_shortcode($content). '</div></span>';
		}
		
	//////////////////////////////////////////////////////////////////
	// Background shortcode
	//////////////////////////////////////////////////////////////////
	add_shortcode('background', 'shortcode_background');
		function shortcode_background($atts, $content = null) {
			$atts = shortcode_atts(
				array(
					'heading' => ''
				), $atts);

				return '<span></div><!-- close .container -->
				<div class="clearfix"></div>
				<div class="content-highlight">
					<div class="container"><h3>' . $atts['heading'] . '</h3>' .do_shortcode($content). '</div>
				</div><!-- close .content-highlight -->
				<div class="container"></span>';
		}

	
//////////////////////////////////////////////////////////////////
// Check list shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('checklist', 'shortcode_checklist');
	function shortcode_checklist( $atts, $content = null ) {
	
	$content = str_replace('<ul>', '<ul class="checkmark">', do_shortcode($content));
	$content = str_replace('<li>', '<li>', do_shortcode($content));
	
	return $content;
	
}



	//////////////////////////////////////////////////////////////////
	// Divider shortcode
	//////////////////////////////////////////////////////////////////

	add_shortcode('divider', 'shortcode_divider');
		function shortcode_divider($atts, $html = null) {
			$html .= '<div class="clearfix"></div><hr>';

			return $html;
		}

//////////////////////////////////////////////////////////////////
// Arrow list shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('arrowlist', 'shortcode_badlist');
	function shortcode_badlist( $atts, $content = null ) {
	
	$content = str_replace('<ul>', '<ul class="arrow">', do_shortcode($content));
	$content = str_replace('<li>', '<li>', do_shortcode($content));
	
	return $content;
	
}
	
//////////////////////////////////////////////////////////////////
// Column one_half shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_half', 'shortcode_one_half');
	function shortcode_one_half($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid2column lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid2column">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_third', 'shortcode_one_third');
	function shortcode_one_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid3column lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid3column">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column two_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('two_third', 'shortcode_two_third');
	function shortcode_two_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid3columnbig lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid3columnbig">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_fourth', 'shortcode_one_fourth');
	function shortcode_one_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid4column lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid4column">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column three_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('three_fourth', 'shortcode_three_fourth');
	function shortcode_three_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid4columnbig lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid4columnbig">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Slider shortcode
//////////////////////////////////////////////////////////////////
	add_shortcode('slider', 'shortcode_slider');
		function shortcode_slider($atts, $content = null) {
			$html .= '<div class="flex-slider-border"><div class="flexslider">';
			$html .= '<ul class="slides">';
			$html .= do_shortcode($content);
			$html .= '</ul>';
			$html .= '</div></div><script type="text/javascript">
			jQuery(document).ready(function($) {
			    $(".flexslider").flexslider({
					animation: "fade",              //String: Select your animation type, "fade" or "slide"
					slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
					slideshow: true,                //Boolean: Animate slider automatically
					slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: 500,         //Integer: Set the speed of animations, in milliseconds
					directionNav: false,             //Boolean: Create navigation for previous/next navigation? (true/false)
					controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
					keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
					mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
					prevText: "Previous",           //String: Set the text for the "previous" directionNav item
					nextText: "Next",               //String: Set the text for the "next" directionNav item
					pausePlay: false,               //Boolean: Create pause/play dynamic element
					pauseText: "Pause",             //String: Set the text for the "pause" pausePlay item
					playText: "Play",               //String: Set the text for the "play" pausePlay item
					randomize: false,               //Boolean: Randomize slide order
					slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
					useCSS: true,
					animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
					pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
					pauseOnHover: false            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
			    });
			});
			</script>';
			return $html;
		}

	add_shortcode('slide', 'shortcode_slide');
		function shortcode_slide($atts, $content = null) {
			$html .= '<li><div class="slider-reuse">';
			$html .= '<img src="'.$atts['img'].'" alt="'.$atts['caption'].'" title="'.$atts['caption'].'" />';
			if($atts['caption']):
			$html .= '<p class="flex-caption">'.$atts['caption'].'</p>';
			endif;
			$html .= '</div></li>';

			return $html;
		}


	add_shortcode('slide2', 'shortcode_slider2');
		function shortcode_slider2($atts, $content = null) {
			$html .= '<ul id="slider">';
			$html .= '<li>';
			$html .= do_shortcode($content);
			$html .= '</li>';
			$html .= '</ul>';
			$html .= "
				<script type='text/javascript'>
			jQuery(document).ready(function($) {
				$('#slider').anythingSlider({
					delay               : 3000,      // How long between slideshow transitions in AutoPlay mode (in milliseconds)
					animationTime       : 400,       // How long the slideshow transition takes (in milliseconds)
					buildArrows         : false,      // If true, builds the forwards and backwards buttons
					buildNavigation     : true,      // If true, buildsa list of anchor links to link to each panel
					autoPlay            : false,      // This turns off the entire slideshow FUNCTIONALY, not just if it starts running or not
					hashTags            : false,      // Should links change the hashtag in the URL?
					resizeContents      : false,
					addWmodeToObject    : 'transparent',
					startStopped        : false,     // If autoPlay is on, this can force it to start stopped
					pauseOnHover        : true,      // If true & the slideshow is active, the slideshow will pause on hover
					resumeOnVideoEnd    : true      // If true & the slideshow is active & a youtube video is playing, it will pause the autoplay until the video has completed
				});
			});
			</script>
			";
			return $html;
		}

	add_shortcode('slide2', 'shortcode_slide2');
		function shortcode_slide2($atts, $content = null) {
			$html .= '<img src="'.$atts['img'].'" alt="'.$atts['caption'].'" title="'.$atts['caption'].'" />';

			return $html;
		}	



//////////////////////////////////////////////////////////////////
// Add Tabs shortcode
//////////////////////////////////////////////////////////////////	
	
add_shortcode( 'tabgroup', 'jqtools_tab_group' );
function jqtools_tab_group( $atts, $content ){
	$GLOBALS['tab_count'] = 0;

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
		$counter=1;
		$panes[] = '<ul class="tabs-content">';
		foreach( $GLOBALS['tabs'] as $tab ){
			if($counter == 1) {
				$tabs[] = '<li><a class="active" href="#tab'.$counter.'">'.$tab['title'].'</a></li>';
			} else {
				$tabs[] = '<li><a class="" href="#tab'.$counter.'">'.$tab['title'].'</a></li>';
			}

			if($counter == 1) {
				$panes[] = '<li id="tab'.$counter.'" class="active">'.$tab['content'].'</li>';
			} else {
				$panes[] = '<li id="tab'.$counter.'">'.$tab['content'].'</li>';
			}
			$counter++;
		}
		$panes[] = '</ul>';
		$return = "".'<!-- the tabs --><div class="tabss"><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" -->'.implode( "\n", $panes ).''."\n</div>";
	}
	return $return;
}

add_shortcode( 'tab', 'jqtools_tab' );
function jqtools_tab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d'
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

	$GLOBALS['tab_count']++;
}
	
//////////////////////////////////////////////////////////////////
// Add buttons to tinyMCE
//////////////////////////////////////////////////////////////////
add_action('init', 'add_button');


function add_button() {
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages')){
         return;
        }
        if ( get_user_option('rich_editing') == 'true' ) {
            global $typenow;
            if (empty($typenow) && !empty($_GET['post'])) {
                $post = get_post($_GET['post']);
                $typenow = $post->post_type;
            }
            if ("portfolio" == $typenow || "property" == $typenow || "post" == $typenow || "page" == $typenow){
               	add_filter('mce_external_plugins', 'add_plugin');  

			     add_filter('mce_buttons_3', 'register_button');
            }
       }
    }


function register_button($buttons) {  
   array_push($buttons, "button", "checklist", "arrowlist", "one_half", "one_third", "two_third", "one_fourth", "three_fourth", "slider", "tabs", "divider", "additional_features");  
   return $buttons;  
}  

function add_plugin($plugin_array) {  
   $plugin_array['button'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['checklist'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['arrowlist'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['one_half'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['one_third'] = get_template_directory_uri().'//tinymce/customcodes.js';
   $plugin_array['two_third'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['one_fourth'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['three_fourth'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['slider'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['divider'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['background'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['bgarea'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['additional_features'] = get_template_directory_uri().'/tinymce/customcodes.js';
   
   return $plugin_array;  
}  