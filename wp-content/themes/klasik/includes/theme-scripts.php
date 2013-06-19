<?php
function klasik_script() {
	if (!is_admin()) {
		
		wp_enqueue_script('jquery');
		
		wp_register_script('jisotope', get_template_directory_uri().'/js/jquery.isotope.min.js', array('jquery'), '1.5.19', true);
		wp_enqueue_script('jisotope');
		
		wp_register_script('jprettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), '3.0', true);
		wp_enqueue_script('jprettyPhoto');
		
		wp_register_script('jhoverIntent', get_template_directory_uri().'/js/hoverIntent.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jhoverIntent');
		
		wp_register_script('jsuperfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), '1.4.8', true);
		wp_enqueue_script('jsuperfish');
		
		wp_register_script('jsupersubs', get_template_directory_uri().'/js/supersubs.js', array('jquery'), '0.2', true);
		wp_enqueue_script('jsupersubs');
		
		wp_register_script('flexslider-js', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '2.1', true);
		
		wp_register_script('nivoslider-js', get_template_directory_uri().'/js/jquery.nivo.slider.pack.js', array('jquery'), '3.1', true);
		
		$slidertype = klasik_get_slidertype();
		wp_enqueue_script( $slidertype . '-js');
		
		wp_register_script('jeasing', get_template_directory_uri().'/js/jquery.easing.1.3.js', array('jquery'), '1.3', true);
		wp_enqueue_script('jeasing');
	
		wp_register_script('tinynav', get_template_directory_uri().'/js/tinynav.min.js', array('jquery'), '1.0', true);
		wp_enqueue_script('tinynav');
		
		wp_register_script('jgeneral', get_template_directory_uri().'/js/general.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jgeneral');
		
		wp_register_script('jcustom', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jcustom');
		
	}
}
add_action('init', 'klasik_script');