<?php 
// print javascript in the <head />
if(!function_exists("klasik_print_javascript")){
	function klasik_print_javascript(){
	

?>
<!-- Hook Flexslider -->
<?php 
	$slidertype 	= klasik_get_slidertype();
	$sliderInterval = klasik_get_sliderinterval();
	$sliderNav		= klasik_get_slidernav();
	$sliderControl	= klasik_get_slidercontrol();
	
	//$sliderEnablePrevNext = klasik_get_option( 'klasik_slider_enable_prevnext');
?>
<script type="text/javascript">
function runisotope(){
	var $container = jQuery('.isotope');
		$container.isotope({
			itemSelector : '.item'
		});

	// filter items when filter link is clicked
	jQuery('#filter li').click(function(){
	jQuery('#filter li').removeClass('current');
		jQuery(this).addClass('current');
			var selector = jQuery(this).find('a').attr('data-filter');
			$container.isotope({ filter: selector });
		return false;
	}); 
};

jQuery(window).load(function() {
		
	<?php if($slidertype=='nivoslider'){ ?>
	
		jQuery('#slidernivo').nivoSlider({
			directionNav : <?php echo $sliderNav; ?>,
			controlNav :  <?php echo $sliderControl; ?>,
			effect: 'random',
			slices: 15,
			boxCols: 8,
			boxRows: 4,
			animSpeed: 500,
			pauseTime: <?php echo $sliderInterval; ?>,
		});
		
	<?php }elseif($slidertype=='flexslider'){ ?>
	
		jQuery('.flexslider').flexslider({
			animation: "fade",
			touch:true,
			animationDuration: <?php echo $sliderInterval; ?>,
			directionNav: <?php echo $sliderNav; ?>,
			controlNav: <?php echo $sliderControl; ?>
		});
		
	<?php } ?>
	
	runisotope();
});
</script>

<?php 
	}// end klasik_print_javascript()
	add_action("wp_footer","klasik_print_javascript",19);
}

	
// get website title
if(!function_exists("klasik_footer_text")){
	function klasik_footer_text(){
	
		$foot= stripslashes(klasik_get_option( 'klasik_footer'));
		if($foot==""){
		
			_e('Copyright', 'klasik'); echo ' &copy;';
			global $wpdb;
			$post_datetimes = $wpdb->get_results("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970");
			if ($post_datetimes) {
				$firstpost_year = $post_datetimes[0]->firstyear;
				$lastpost_year = $post_datetimes[0]->lastyear;
	
				$copyright = $firstpost_year;
				if($firstpost_year != $lastpost_year) {
					$copyright .= '-'. $lastpost_year;
				}
				$copyright .= ' ';
	
				echo $copyright;
				echo '<a href="'.home_url( '/').'">'.get_bloginfo('name') .'.</a>';
			}
			?><?php _e(' Designed by', 'klasik'); ?>	<a href="<?php echo esc_url( __( 'http://www.klasikthemes.com', 'klasik' ) ); ?>" title="">
			<?php _e('Klasik Themes','')?></a>.
            
            
        <?php 
		}else{
        	echo $foot;
        }
		
	}// end klasik_footer_text()
}