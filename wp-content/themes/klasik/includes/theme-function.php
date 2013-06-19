<?php

/*********For Localization**************/
load_theme_textdomain( 'klasik', get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);
/*********End For Localization**************/


// The excerpt based on character
if(!function_exists("klasik_string_limit_char")){
	function klasik_string_limit_char($excerpt, $substr=0, $strmore = ""){
		$string = strip_tags(str_replace('...', '...', $excerpt));
		if ($substr>0) {
			$string = substr($string, 0, $substr);
		}
		if(strlen($excerpt)>=$substr){
			$string .= $strmore;
		}
		return $string;
	}
}
// The excerpt based on words
if(!function_exists("klasik_string_limit_words")){
	function klasik_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  
	  return implode(' ', $words);
	}
}

if(!function_exists("klasik_get_category")){
	function klasik_get_category(){
		global $post;
		$categories = get_the_category();
		$separator = ', ';
		$catoutput = '';
		if($categories){
			foreach($categories as $category) {
				$catoutput .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'klasik' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}
		}
		
		return trim($catoutput, $separator);
	}
}

if( !function_exists('klasik_is_pagepost')){
	function klasik_is_pagepost(){
		global $post;
		
		if( is_404() || is_archive() || is_attachment() || is_search() ){
			$custom = false;
		}else{
			$custom = true;
		}
		
		return $custom;
	}
}

if( !function_exists('klasik_get_customdata')){
	function klasik_get_customdata(){
		global $post;
		
		if( klasik_is_pagepost() ){
			$custom = get_post_custom(get_the_ID());
		}else{
			$custom = array();
		}
		
		return $custom;
	}
}

if( !function_exists('klasik_get_imgsize')){
	function klasik_get_imgsize(){
	
		global $imgconf;
		$defaultimg = klasik_default_image();
		$imageconfs = (isset($imgconf) && is_array($imgconf))? $imgconf : array();
		
		$imageconfs = array_merge($defaultimg, $imageconfs);
		
		return $imageconfs;
	}
}

if( !function_exists('klasik_get_customstyle')){
	function klasik_get_customstyle(){
	
		global $customstyles;
		$defaultimg = klasik_default_styles();
		$imageconfs = (isset($customstyles) && is_array($customstyles))? $customstyles : array();
		
		$imageconfs = array_merge($defaultimg, $imageconfs);
		
		return $imageconfs;
	}
}

if( !function_exists('klasik_get_configval')){
	function klasik_get_configval($confstr,$defval=""){
	
		if(defined($confstr)){
			$return = constant($confstr);
		}else{
			$return = $defval;
		}
		
		return $return;
		
	}
}

if( !function_exists('klasik_get_slidertype')){
	function klasik_get_disablesingleimage(){
	
		if(defined('KLASIK_DISABLESINGLEIMAGE')){
			$return = KLASIK_DISABLESINGLEIMAGE;
		}else{
			$return = false;
		}
		
		return $return;
	}
}

if( !function_exists('klasik_get_slidertype')){
	function klasik_get_slidertype(){
	
		if(defined('KLASIK_SLIDERTYPE')){
			$slidertype = KLASIK_SLIDERTYPE;
		}else{
			$slidertype = 'flexslider';
		}
		
		return $slidertype;
	}
}

if( !function_exists('klasik_get_sliderinterval')){
	function klasik_get_sliderinterval(){
	
		if(defined('KLASIK_SLIDERTIMEOUT')){
			$slidertimeout = KLASIK_SLIDERTIMEOUT;
		}else{
			$slidertimeout = 6000;
		}
		
		return $slidertimeout;
	}
}

if( !function_exists('klasik_get_slidernav')){
	function klasik_get_slidernav(){
	
		if(defined('KLASIK_SLIDERNAV')){
			$slidernav = KLASIK_SLIDERNAV;
		}else{
			$slidernav = 'true';
		}
		
		return $slidernav;
	}
}

if( !function_exists('klasik_get_slidercontrol')){
	function klasik_get_slidercontrol(){
	
		if(defined('KLASIK_SLIDERCONTROL')){
			$slidercontrol = KLASIK_SLIDERCONTROL;
		}else{
			$slidercontrol = 'false';
		}
		
		return $slidercontrol;
	}
}

if( !function_exists('klasik_get_pfslug')){
	function klasik_get_pfslug(){
	
		if(defined('KLASIK_PFSLUG')){
			$pfslug = KLASIK_PFSLUG;
		}else{
			$pfslug = 'portfolio-item';
		}
		
		return $pfslug;
	}
}

if( !function_exists('klasik_get_pfcatslug')){
	function klasik_get_pfcatslug(){
	
		if(defined('KLASIK_PFCATSLUG')){
			$pfcatslug = KLASIK_PFCATSLUG;
		}else{
			$pfcatslug = 'portfolio-category';
		}
		
		return $pfcatslug;
	}
}

if( !function_exists('klasik_get_pfcol')){
	function klasik_get_pfcol(){
	
		if(defined('KLASIK_PFCOL')){
			$pfcol = KLASIK_PFCOL;
		}else{
			$pfcol = 4;
		}
		
		return $pfcol;
	}
}

/* Remove inline styles printed when the gallery shortcode is used.*/
function klasik_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'klasik_remove_gallery_css' );

/*Template for comments and pingbacks. */
if ( ! function_exists( 'klasik_comment' ) ) :
function klasik_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="con-comment">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 53); ?>
		</div><!-- .comment-author .vcard -->


		<div class="comment-body">
			<?php  printf( __( '%s ', 'klasik' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>&nbsp;
            <span class="time">
               <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s %2$s', 'klasik' ), get_comment_date(),  get_comment_time() ); ?>
                <?php edit_comment_link( __( '/&nbsp;Edit', 'klasik' ), ' ' );?> <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ,'reply_text' => '/&nbsp;Reply') ) ); ?>
            </span>
			<div class="commenttext">
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'klasik' ); ?></em>
			<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'klasik' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'klasik'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/*Prints HTML with meta information for the current post (category, tags and permalink).*/
if ( ! function_exists( 'klasik_posted_in' ) ) :
function klasik_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'Categories: %1$s <br/> Tags: %2$s', 'klasik' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'Categories: %1$s', 'klasik' );
	} else {
		$posted_in = __( '', 'klasik' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/* for top menu */
function nav_page_fallback() {
if(is_front_page()){$class="current_page_item";}else{$class="";}
print '<ul id="topnav" class="sf-menu"><li class="'.$class.'"><a href=" '.home_url( '/') .' " title=" '.__('Click for Home','klasik').' ">'.__('Home','klasik').'</a></li>';
    wp_list_pages( 'title_li=&sort_column=menu_order' );
print '</ul>';
}

/* for shortcode widget  */
add_filter('widget_text', 'do_shortcode');
?>