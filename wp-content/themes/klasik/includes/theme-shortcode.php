<?php
/**
 * Theme Short-code Functions
 */
 $shortcode_path = get_template_directory() . '/includes/shortcodes/';
 
/****************Standards Shortcodes***********************/ 

require_once($shortcode_path. "features.php" );
require_once($shortcode_path. "portfolio.php" );
require_once($shortcode_path. "recentposts.php" );
require_once($shortcode_path. "shortcode-saya.php");

function klasik_run_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
	
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'klasik_run_shortcode', 7 );
?>