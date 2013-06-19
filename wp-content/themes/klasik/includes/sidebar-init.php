<?php
function klasik_sidebar_init() {

	register_sidebar( array(
		'name' 					=> __( 'Post Sidebar', 'klasik' ),
		'id' 						=> 'post-sidebar',
		'description' 		=> __( 'Located at the left/right side of archives, single and search.', 'klasik' ),
		'before_widget' 	=> '<ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 		=> '</li></ul>',
		'before_title' 		=> '<h2 class="widget-title">',
		'after_title' 			=> '</h2>',
	));	
	
}

function klasik_footer1_sidebar_init(){

	register_sidebar(array(
		'name'          => __('Footer1 Sidebar', 'klasik' ),
		'id'         	=> 'footer1',
		'description'   => __( 'Located at the footer column 1.', 'klasik' ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '<div class="clear"></div></li></ul><div class="clear"></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
}

function klasik_footer2_sidebar_init(){

	register_sidebar(array(
		'name'          => __('Footer2 Sidebar', 'klasik' ),
		'id'         	=> 'footer2',
		'description'   => __( 'Located at the footer column 2.', 'klasik' ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '<div class="clear"></div></li></ul><div class="clear"></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));	
	
}

function klasik_footer3_sidebar_init(){

	register_sidebar(array(
		'name'          => __('Footer3 Sidebar', 'klasik' ),
		'id'         	=> 'footer3',
		'description'   => __( 'Located at the footer column 3.', 'klasik' ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '<div class="clear"></div></li></ul><div class="clear"></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
}

function klasik_footer4_sidebar_init(){

	register_sidebar(array(
		'name'          => __('Footer4 Sidebar', 'klasik' ),
		'id'         	=> 'footer4',
		'description'   => __( 'Located at the footer column 4.', 'klasik' ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '<div class="clear"></div></li></ul><div class="clear"></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
}

function klasik_footer5_sidebar_init(){

	register_sidebar(array(
		'name'          => __('Footer5 Sidebar', 'klasik' ),
		'id'         	=> 'footer5',
		'description'   => __( 'Located at the footer column 5.', 'klasik' ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '<div class="clear"></div></li></ul><div class="clear"></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
}

function klasik_footer6_sidebar_init(){

	register_sidebar(array(
		'name'          => __('Footer6 Sidebar', 'klasik' ),
		'id'         	=> 'footer6',
		'description'   => __( 'Located at the footer column 6.', 'klasik' ),
		'before_widget' => '<div class="widget-bottom"><ul><li id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> '<div class="clear"></div></li></ul><div class="clear"></div></div>',
		'before_title' 	=> '<h2 class="widget-title">',
		'after_title' 	=> '</h2>',
	));
	
}
/** Register sidebars by running klasik_sidebar_init() on the widgets_init hook. */
add_action( 'widgets_init', 'klasik_sidebar_init' );
add_action( 'widgets_init', 'klasik_footer1_sidebar_init' );
add_action( 'widgets_init', 'klasik_footer2_sidebar_init' );
add_action( 'widgets_init', 'klasik_footer3_sidebar_init' );
add_action( 'widgets_init', 'klasik_footer4_sidebar_init' );