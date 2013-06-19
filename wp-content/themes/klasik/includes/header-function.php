<?php 
// get website title
if(!function_exists("klasik_document_title")){
	function klasik_document_title(){
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'klasik' ), max( $paged, $page ) );
	}// end ts_get_title()
}

// head action hook
if(!function_exists("klasik_head")){
	function klasik_head(){
		do_action("klasik_head");
	}
	add_action('wp_head', 'klasik_head', 20);
}

if(!function_exists("klasik_print_headtag")){
	
	function klasik_print_headtag(){
		$favicon = klasik_get_option( 'klasik_favicon');
		if($favicon =="" ){
		?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />
		<?php }else{?>
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
		<?php
        }
	}
	add_action("klasik_head","klasik_print_headtag",7);
}


// print the logo html
if(!function_exists("klasik_logo")){
	function klasik_logo(){ 
	
		$logotype = klasik_get_option( 'klasik_logo_type');
		$logoimage = klasik_get_option( 'klasik_logo_image'); 
		$sitename =  klasik_get_option( 'klasik_site_name');
		$tagline = klasik_get_option( 'klasik_tagline');
		if($logoimage == ""){ $logoimage = get_stylesheet_directory_uri() . "/images/logo.png"; }
?>
		<?php if($logotype == 'textlogo'){ ?>
			
			<?php if($sitename=="" && $tagline==""){?>
                <h1><a href="<?php echo home_url( '/'); ?>" title="<?php _e('Click for Home','klasik'); ?>"><?php bloginfo('name'); ?></a></h1><span class="desc"><?php bloginfo('description'); ?></span>
            <?php }else{ ?>
                <h1><a href="<?php echo home_url( '/'); ?>" title="<?php _e('Click for Home','klasik'); ?>"><?php echo $sitename; ?></a></h1><span class="desc"><?php echo $tagline; ?></span>
            <?php }?>
        
        <?php } else { ?>
        	
            <div id="logoimg">
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'klasik' ) ); ?>" >
                <img src="<?php echo $logoimage;?>" alt="" />
            </a>
            </div>
            
		<?php } ?>
<?php 
	}
}
?>