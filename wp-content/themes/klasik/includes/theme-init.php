<?php

add_action( 'after_setup_theme', 'klasik_setup' );

function klasik_default_image(){
	$imgconf = array(
		'image-slider' => array( /* Slider */
			'width' => 1140,
			'height' => 503
		),
		'thumb-blog' => array( /* Blog Image */
			'width' => 730,
			'height' => 322
		),
		'thumb-standard' => array( /* Blog Image */
			'width' => 730,
			'height' => 322
		),
		'thumb-widget' => array( /* Recent Post Widget Image */
			'width' => 100,
			'height' => 100
		),
		'thumb-portfolio' => array( /* Portfolio */
			'width' => 555,
			'height' => 330
		)
	);
	return $imgconf;
}

if ( ! function_exists( 'klasik_setup' ) ):

function klasik_setup() {
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	$imageconfs = klasik_get_imgsize();
	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		
		if(count($imageconfs)>0){
			foreach($imageconfs as $imageconf => $confval){
				
				if(array_key_exists('width',$confval) && array_key_exists('height',$confval)){
					$width = $confval['width'];
					$height = $confval['height'];
					
					add_image_size( $imageconf, $width, $height, true );
				}
				
			}
		}
		
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'gallery', 'video', 'audio' ) );
	
	//Customize the Slider List in the wp-admin
	add_filter('manage_edit-slider_columns', 'klasik_slider_add_list_columns');
	add_action('manage_slider_posts_custom_column', 'klasik_slider_manage_column');
	add_action( 'restrict_manage_posts', 'klasik_slider_add_taxonomy_filter' );
	
	//Customize the Feature List in the wp-admin
	add_filter('manage_edit-feature_columns', 'klasik_feat_add_list_columns');
	add_action('manage_feature_posts_custom_column', 'klasik_feat_manage_column', 10, 2);
	add_action( 'restrict_manage_posts', 'klasik_feat_add_taxonomy_filter' );
	
	//Customize the Portfolio List in the wp-admin
	add_filter('manage_edit-portfolio_columns', 'klasik_pf_add_list_columns');
	add_action('manage_portfolio_posts_custom_column', 'klasik_pf_manage_column');
	add_action( 'restrict_manage_posts', 'klasik_pf_add_taxonomy_filter' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => __( 'Main Menu', 'klasik' )

	) );
	
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	
}
endif;

/*================Slider Post Type================*/
function klasik_post_type_slider() {
	register_post_type( 'slider',
                array( 
				'labels' => array(
						'name' => __('Slider', 'klasik'),
						'add_new_item' => __('Add New Slider Item', 'klasik'),
						'edit_item' => __('Edit Slider Item', 'klasik'),
						'new_item' => __('New Slider Item', 'klasik')
						), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'rewrite' => true,
				'hierarchical' => true,
				'menu_position' => 5,
				'exclude_from_search' =>true,
				'supports' => array(
				                     'title',
									 'custom-fields',
                                     'thumbnail')
					) 
				);
	
	register_taxonomy( 'slider-category', array( 'slider' ), array(
		'hierarchical' => true,
		'label' =>  __('Slider Categories', 'klasik'),
		'query_var' => true,
		'rewrite' => array( 'slug' => 'slider-category', 'with_front' => false ),
		'show_ui' => true,
	));
}
add_action('init', 'klasik_post_type_slider');

function klasik_slider_add_list_columns($slider_columns){
	
	$new_columns = array();
	$new_columns['cb'] = '<input type="checkbox" />';
	
	$new_columns['title'] = __('Slider Title', 'klasik');
	$new_columns['images'] = __('Images', 'klasik');
	$new_columns['author'] = __('Author', 'klasik');
	
	$new_columns['slider-category'] = __('Categories', 'klasik');
	
	$new_columns['date'] = __('Date', 'klasik');
	
	return $new_columns;
}

function klasik_slider_manage_column($column_name){
	global $post;
	$posttype = 'slider';
	$taxonom = 'slider-category';
	
	$id = $post->ID;
	$title = $post->post_title;
	switch($column_name){
		case 'images':
			$thumbnailid = get_post_thumbnail_id($id);
			$imagesrc = wp_get_attachment_image_src($thumbnailid, 'thumbnail');
			if($imagesrc){
				echo '<img src="'.$imagesrc[0].'" width="50" alt="'.$title.'" />';
			}else{
				_e('No Featured Image', 'klasik');
			}
			break;
		
		case 'slider-category':
			$postterms = get_the_terms($id, $taxonom);
			if($postterms){
				$termlists = array();
				foreach($postterms as $postterm){
					$termlists[] = '<a href="'.admin_url('edit.php?'.$taxonom.'='.$postterm->slug.'&post_type='.$posttype).'">'.$postterm->name.'</a>';
				}
				if(count($termlists)>0){
					$termtext = implode(", ",$termlists);
					echo $termtext;
				}
			}
			
			break;
	}
}

/* Filter Custom Post Type Categories */
function klasik_slider_add_taxonomy_filter() {
	global $typenow;
	$posttype = 'slider';
	$taxonomy = 'slider-category';
	if( $typenow==$posttype){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>".__('View All','klasik')." "."$tax_name</option>";
			foreach ($terms as $term) { 
				$selectedstr = '';
				if(isset($_GET[$tax_slug]) && $_GET[$tax_slug] == $term->slug){
					$selectedstr = ' selected="selected"';
				}
				echo '<option value='. $term->slug. $selectedstr . '>' . $term->name .' (' . $term->count .')</option>'; 
			}
			echo "</select>";
		}
	}
}


/*================Feature Post Type================*/
function klasik_post_type_feature() {
	register_post_type( 'feature',
				array( 
				'label' => __('Features', 'klasik'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => array( 'slug' => 'feature-view', 'with_front' => false ),
				'hierarchical' => true,
				'menu_position' => 5,
				'has_archive' => true,
				'supports' => array(
									 'title',
									 'thumbnail',
									 'excerpt',
									 'custom-fields',
									 'revisions')
					) 
				);
	register_taxonomy('feature-category', 'feature', array(
		'hierarchical' => true,
		'label' =>  __('Feature Categories', 'klasik'),
		'query_var' => true,
		'rewrite' => array( 'slug' => 'feature-category', 'with_front' => false ),
		'show_ui' => true,
		'singular_name' => 'Category'
		));
}

add_action('init', 'klasik_post_type_feature');

function klasik_feat_add_list_columns($feature_columns){
		
	$new_columns = array();
	$new_columns['cb'] = '<input type="checkbox" />';
	
	$new_columns['title'] = __('Feature Title', 'klasik');
	$new_columns['images'] = __('Images', 'klasik');
	$new_columns['author'] = __('Author', 'klasik');
	
	$new_columns['feature-category'] = __('Categories', 'klasik');
	
	$new_columns['date'] = __('Date', 'klasik');
	
	return $new_columns;
}

function klasik_feat_manage_column($column_name, $id){
	global $wpdb, $post;
	
	$posttype = 'feature';
	$taxonom = 'feature-category';
	
	$id = $post->ID;
	$title = $post->post_title;
	switch($column_name){
		case 'images':
			$thumbnailid = get_post_thumbnail_id($id);
			$imagesrc = wp_get_attachment_image_src($thumbnailid, 'thumbnail');
			if($imagesrc){
				echo '<img src="'.$imagesrc[0].'" width="50" alt="'.$title.'" />';
			}else{
				_e('No Featured Image', 'klasik');
			}
			break;
		
		case 'feature-category':
			$postterms = get_the_terms($id, $taxonom);
			if($postterms){
				$termlists = array();
				foreach($postterms as $postterm){
					$termlists[] = '<a href="'.admin_url('edit.php?'.$taxonom.'='.$postterm->slug.'&post_type='.$posttype).'">'.$postterm->name.'</a>';
				}
				if(count($termlists)>0){
					$termtext = implode(", ",$termlists);
					echo $termtext;
				}
			}
			
			break;
		
		default:
			break;
	}
}

/* Filter Custom Post Type Categories */
function klasik_feat_add_taxonomy_filter() {
	global $typenow;
	$posttype = 'feature';
	$taxonomy = 'feature-category';
	if( $typenow==$posttype){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>".__('View All','klasik')." "."$tax_name</option>";
			foreach ($terms as $term) { 
				$selectedstr = '';
				if(isset($_GET[$tax_slug]) && $_GET[$tax_slug] == $term->slug){
					$selectedstr = ' selected="selected"';
				}
				echo '<option value='. $term->slug. $selectedstr . '>' . $term->name .' (' . $term->count .')</option>'; 
			}
			echo "</select>";
		}
	}
}

/*================Portfolio Post Type================*/
function klasik_post_type_portfolio() {
	$pfslug = klasik_get_pfslug();
	$pfcatslug = klasik_get_pfcatslug();
	register_post_type( 'portfolio',
                array( 
				'labels' => array(
						'name' => __('Portfolio', 'klasik'),
						'add_new_item' => __('Add New Portfolio Item', 'klasik'),
						'edit_item' => __('Edit Portfolio Item', 'klasik'),
						'new_item' => __('New Portfolio Item', 'klasik')
						), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => array( 'slug' => $pfslug, 'with_front' => false ),
				'hierarchical' => true,
				'menu_position' => 5,
				'has_archive' => true,
				'supports' => array(
						 'title',
						 'editor',
						 'custom-fields',
						 'thumbnail',
						 'revisions',
						 'excerpt')
					) 
				);
				
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), array(
		'hierarchical' => true,
		'label' =>  __('Portfolio Categories', 'klasik'),
		'query_var' => true,
		'rewrite' => array( 'slug' => $pfcatslug, 'with_front' => false ),
		'show_ui' => true,
	));
}

add_action('init', 'klasik_post_type_portfolio');

/*================ Make a Portfolio Post Type =================*/
function klasik_pf_add_list_columns($portfolio_columns){
	
	$new_columns = array();
	$new_columns['cb'] = '<input type="checkbox" />';
	
	$new_columns['title'] = __('Portfolio Title', 'klasik');
	$new_columns['images'] = __('Images', 'klasik');
	$new_columns['author'] = __('Author', 'klasik');
	
	$new_columns['portfolio-category'] = __('Categories', 'klasik');
	
	$new_columns['date'] = __('Date', 'klasik');
	
	return $new_columns;
}

function klasik_pf_manage_column($column_name){
	global $post;
	$posttype = 'portfolio';
	$taxonom = 'portfolio-category';
	
	$id = $post->ID;
	$title = $post->post_title;
	switch($column_name){
		case 'images':
			$thumbnailid = get_post_thumbnail_id($id);
			$imagesrc = wp_get_attachment_image_src($thumbnailid, 'thumbnail');
			if($imagesrc){
				echo '<img src="'.$imagesrc[0].'" width="50" alt="'.$title.'" />';
			}else{
				_e('No Featured Image', 'klasik');
			}
			break;
		
		case 'portfolio-category':
			$postterms = get_the_terms($id, $taxonom);
			if($postterms){
				$termlists = array();
				foreach($postterms as $postterm){
					$termlists[] = '<a href="'.admin_url('edit.php?'.$taxonom.'='.$postterm->slug.'&post_type='.$posttype).'">'.$postterm->name.'</a>';
				}
				if(count($termlists)>0){
					$termtext = implode(", ",$termlists);
					echo $termtext;
				}
			}
			
			break;
	}
}

/* Filter Custom Post Type Categories */
function klasik_pf_add_taxonomy_filter() {
	global $typenow;
	$posttype = 'portfolio';
	$taxonomy = 'portfolio-category';
	if( $typenow==$posttype){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>".__('View All','klasik')." "."$tax_name</option>";
			foreach ($terms as $term) { 
				$selectedstr = '';
				if(isset($_GET[$tax_slug]) && $_GET[$tax_slug] == $term->slug){
					$selectedstr = ' selected="selected"';
				}
				echo '<option value='. $term->slug. $selectedstr . '>' . $term->name .' (' . $term->count .')</option>'; 
			}
			echo "</select>";
		}
	}
}



if ( ! function_exists( 'klasik_theme_support' ) ):

function klasik_theme_support() {
	$args = "";
	 add_theme_support( 'custom-header', $args );
	 add_theme_support( 'custom-background', $args );
}
endif;