<?php
function klasik_styles() {
	if (!is_admin()) {
		
		wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600');
		wp_enqueue_style( 'googleFonts');
		
		wp_register_style('skeleton-css', get_template_directory_uri().'/css/skeleton.css', '', '', 'screen, all');
		wp_enqueue_style('skeleton-css');
		
		wp_register_style('prettyPhoto-css', get_template_directory_uri().'/css/prettyPhoto.css', '', '', 'screen, all');
		wp_enqueue_style('prettyPhoto-css');
		
		wp_register_style('flexslider-css', get_template_directory_uri().'/css/flexslider.css', '', '', 'screen, all');
		
		wp_register_style('nivoslider-css', get_template_directory_uri().'/css/nivo-slider.css', '', '', 'screen, all');
		
		$slidertype = klasik_get_slidertype();
		wp_enqueue_style( $slidertype . '-css');
		
		wp_register_style('general-css', get_template_directory_uri().'/css/general.css', '', '', 'screen, all');
		wp_enqueue_style('general-css');
		
		wp_register_style('main-css', get_bloginfo( 'stylesheet_url' ), '', '', 'all');
		wp_enqueue_style('main-css');
		
		wp_register_style('color-css', get_stylesheet_directory_uri().'/css/color.css', '', '', 'screen, all');
		wp_enqueue_style('color-css');
		
		wp_register_style('layout-css', get_stylesheet_directory_uri().'/css/layout.css', '', '', 'all');
		wp_enqueue_style('layout-css');
		
		wp_register_style('noscript-css', get_stylesheet_directory_uri().'/css/noscript.css', '', '', 'screen, all');
		wp_enqueue_style('noscript-css');	
		
	}
}
add_action('init', 'klasik_styles');