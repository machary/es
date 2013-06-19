<?php
// Include widgets
include_once('widgets/widgets.php');

// Post Thumbnails
add_theme_support('post-thumbnails');
add_image_size('featured-slider', 898, 315, true);
add_image_size('featured-slider-scaled', 1796, 650, true);
add_image_size('blog-image', 900, 436, true);
add_image_size('portfolio-thumb', 438, 246, true);
add_image_size('portfolio-single', 880, 494, true);
add_image_size('property-listing', 575, 325, true);
add_image_size('property-main', 880, 440, true);
add_image_size('property-thumb', 290, 120, true);
add_image_size('widget-thumb', 200, 109, true);


/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once dirname( __FILE__ ) . '/admin/options-framework.php';
}


// Translation Ready
load_theme_textdomain( 'progressionstudios', get_template_directory() . '/lang' );

//Custom menus
register_nav_menu('main_nav','Main Navigation');

// Shortcodes
include_once('shortcodes.php');

// Include boostrap file for the pyre theme framework
include_once('framework/bootstrap.php'); // also adds the meta-boxes in editor

// Register Widgetized Areas
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div class="content-boxed %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title-bg">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => 'Sidebar Real Estate Search',
		'before_widget' => '<div class="content-boxed %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title-bg">',
		'after_title' => '</h2>',
	));

	
	register_sidebar(array(
		'name' => 'Sidebar Property Listing',
		'before_widget' => '<div class="content-boxed %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title-bg">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'name' => 'Sidebar Agents',
		'before_widget' => '<div class="content-boxed %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="title-bg">',
		'after_title' => '</h2>',
	));

	register_sidebar(array(
		'name' => 'Footer Widget 1',
		'before_widget' => '<div class="grid4column">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => 'Footer Widget 2',
		'before_widget' => '<div class="grid4column">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => 'Footer Widget 3',
		'before_widget' => '<div class="grid4column">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => 'Footer Widget 4',
		'before_widget' => '<div class="grid4column lastcolumn">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}

add_theme_support( 'automatic-feed-links' );
add_editor_style('');
if ( ! isset( $content_width ) ) $content_width = 900;

// Register custom post types
add_action('init', 'pyre_init');
function pyre_init() {
	register_post_type(
		'portfolio',
		array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio-type'),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail','comments'),
			'can_export' => true,
		)
	);

	register_post_type(
		'property',
		array(
			'labels' => array(
				'name' => 'Properties',
				'singular_name' => 'Property'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'property'),
			'supports' => array('title', 'editor', 'thumbnail'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_type', 'portfolio', array('hierarchical' => true, 'label' => 'Types', 'query_var' => true, 'rewrite' => true));
	register_taxonomy('property_type', 'property', array('hierarchical' => true, 'label' => 'Property Type', 'query_var' => true, 'rewrite' => true));
}





if ( ! function_exists( 'progressionstudios_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function progressionstudios_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'progressionstudios' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'progressionstudios' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'progressionstudios' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'progressionstudios' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'progressionstudios' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'progressionstudios' ); ?></em>
					<br />
				<?php endif; ?>

			</div>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'progressionstudios' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()



// More Link on Posts
function has_more($post=NULL)
{
	if(!isset($post)) {
		global $post;
	}
	
	if(strpos($post->post_content, '<!--more-->') !== false) {
		return true;
	}
	
	return false;
}


/* 
 * Turns off the default options panel from Twenty Eleven
 */
 
add_action('after_setup_theme','remove_twentyeleven_options', 100);

function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}

// Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span></a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><span class='arrows'>&lsaquo;</span></a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a href='#' class='selected'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span class='arrows'>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}

function freehold_ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago";
}


/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'style' ) );
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=PT+Sans:700|Open+Sans:600', array( 'style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', false );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', false );
	wp_enqueue_script( 'gomap', get_template_directory_uri() . '/js/jquery.gomap-1.3.2.min.js', array( 'jquery' ), '20120206', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );




function freehold_all_authors() {
	global $wpdb;
	$order = 'user_nicename';
	$user_ids = $wpdb->get_col("SELECT ID FROM $wpdb->users ORDER BY $order");

	foreach($user_ids as $user_id) :
		$user = get_userdata($user_id);
		if(get_the_author_meta('is_agent', $user_id) == 'yes') {
			$all_authors[$user_id] = $user->display_name;
		}
	endforeach;
	return $all_authors;
}

function freehold_customize_register($wp_customize)
{
	$wp_customize->add_section( 'freehold_color_scheme' , array(
	    'title'      => __('Color Scheme','freehold'),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting('header_top', array(
	    'default'     => '#697884',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_top', array(
		'label'        => __( 'Header Top Background', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'header_top',
	)));
	

	$wp_customize->add_setting('header_color', array(
	    'default'     => '#6FBFEC',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_color', array(
		'label'        => __( 'Header Main Background', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'header_color',
	)));
	
	
	$wp_customize->add_setting('navigation_color', array(
	    'default'     => '#697884',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_color', array(
		'label'        => __( 'Navigation Background', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'navigation_color',
	)));
	

	$wp_customize->add_setting('button_color', array(
	    'default'     => '#ff8c68',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_color', array(
		'label'        => __( 'Button Background', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'button_color',
	)));
	
	
	$wp_customize->add_setting('footer_color', array(
	    'default'     => '#252425',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_color', array(
		'label'        => __( 'Footer Background', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'footer_color',
	)));
	
	
	
	$wp_customize->add_setting('link_color', array(
	    'default'     => '#f86132',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label'        => __( 'Link and Highlight Color', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'link_color',
	)));
	
	
	
	
	$wp_customize->add_setting('headings_color', array(
	    'default'     => '#737373',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headings_color', array(
		'label'        => __( 'H1 and H2 Color', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'headings_color',
	)));
	
	
	
	
	$wp_customize->add_setting('property_link', array(
	    'default'     => '#5f6f7d',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'property_link', array(
		'label'        => __( 'Dark Blue H3 and Link', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'property_link',
	)));
	
	

	$wp_customize->add_setting('heading5_color', array(
	    'default'     => '#888888',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'heading5_color', array(
		'label'        => __( 'H5 and H6 Color', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'heading5_color',
	)));
	
	
	
	$wp_customize->add_setting('body_color', array(
	    'default'     => '#444444',
	    'type'           => 'option',
	    'transport'   => 'refresh',
	));
	
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_color', array(
		'label'        => __( 'Body Default Color', 'freehold' ),
		'section'    => 'freehold_color_scheme',
		'settings'   => 'body_color',
	)));
	
	
	
}
add_action('customize_register', 'freehold_customize_register');


function freehold_customize_css()
{
    ?>
 
<style type="text/css">
.header-top, #child-pages li a {background-color:<?php echo get_option('header_top'); ?>; }
.social-icons a {	color:<?php echo get_option('header_top'); ?> ;}


header, a.secondary-button, .notification-listing { background-color:<?php echo get_option('header_color'); ?>; }
.sf-menu li.current-menu-item a, .sf-menu li.current-menu-item a:visited,
.sf-menu a:hover, .sf-menu li a:hover, .sf-menu a:hover, .sf-menu a:visited:hover, .sf-menu li.sfHover a, .sf-menu li.sfHover a:visited,
.sf-menu ul, .sf-menu ul ul, .sf-menu ul ul ul {background-color:<?php echo get_option('navigation_color'); ?>;}
.sf-menu ul:after {border-bottom-color:<?php echo get_option('navigation_color'); ?> !important;}
footer {background:<?php echo get_option('footer_color'); ?>;}
input.submit, input.submit-advanced, .button {background-color:<?php echo get_option('button_color'); ?>;}


body h3, .property-information-address a, .property-information-address, .property-information-address a, a .listings-address-widget, .listings-address-widget {color:<?php echo get_option('property_link'); ?>;}
body a, body h4, .property-information-price, .property-information-price a, h2.title-bg span, a .listings-price-widget, #sidebar .listings-price-widget {color: <?php echo get_option('link_color'); ?>;}
body h5, body h6 {color: <?php echo get_option('heading5_color'); ?>;}

body {color: <?php echo get_option('body_color'); ?>;}
h1, h2, h3, h4, h5, h6 {color:<?php echo get_option('headings_color'); ?>; }

</style>
    <?php
}
add_action('wp_head', 'freehold_customize_css');


