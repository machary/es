<?php
$featured_properties = new WP_Query(array(
	'post_type' => 'property',
	'tax_query' => array(
		array(
			'taxonomy' => 'property_type',
			'field' => 'slug',
			'terms' => 'featured'
		)
	),
	'posts_per_page' => 15
));
if($featured_properties->have_posts()):
?>
<div id="featured-slider">
<div class="flexslider">
  <ul class="slides">
  	<?php while($featured_properties->have_posts()): $featured_properties->the_post(); ?>
    <li>
	<?php if(get_post_meta(get_the_ID(), 'pyre_external_link', true)): ?>
		<a href="<?php echo get_post_meta(get_the_ID(), 'pyre_external_link', true); ?>" target="<?php echo get_post_meta(get_the_ID(), 'pyre_external_link_target', true); ?>">
	<?php else: ?>
	    <a href="<?php the_permalink(); ?>">
	<?php endif; ?>
	
			
			<?php if(of_get_option('slider_retina_disabled', 'yes') == 'yes'): ?>
			<?php the_post_thumbnail('featured-slider'); ?>
			<?php else: ?>
			<?php the_post_thumbnail('featured-slider-scaled'); ?>
			<?php endif; ?>
			
			
			<?php if(get_post_meta(get_the_ID(), 'pyre_remove_caption', true)): ?>
				<?php else: ?>
					<div class="flex-caption">
						<div class="featured-address-number"><?php echo get_post_meta(get_the_ID(), 'pyre_address', true); ?></div>
						<?php if(get_post_meta(get_the_ID(), 'pyre_city', true) && get_post_meta(get_the_ID(), 'pyre_state', true) && get_post_meta(get_the_ID(), 'pyre_zip', true)): ?>
						<div class="featured-address-city"><?php echo get_post_meta(get_the_ID(), 'pyre_city', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_state', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_zip', true); ?></div>
						<?php endif; ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Call For Price'): ?>
						<div class="featured-price"><?php _e('Call For Price','progressionstudios'); ?></div>
						<?php else: ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_price', true)): ?>
						<div class="featured-price"><?php echo of_get_option('currency_text_opt', '$'); ?><?php echo number_format(get_post_meta(get_the_ID(), 'pyre_price', true)); ?><?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'For Rent'): ?>/month<?php endif; ?></div>
						<?php endif; ?>
						<?php endif; ?>
					</div><!-- close .flex-caption -->
			<?php endif; ?>
			
		</a>
	</li>
	<?php endwhile; ?>
  </ul>
</div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.flexslider').flexslider({
		animation: "<?php echo of_get_option('animation', 'fade'); ?>",              //String: Select your animation type, "fade" or "slide"
		slideDirection: "<?php echo of_get_option('slide_direction', 'horizontal'); ?>",   //String: Select the sliding direction, "horizontal" or "vertical"
		slideshow: <?php echo of_get_option('autoplay', true); ?>,                //Boolean: Animate slider automatically
		slideshowSpeed: <?php echo of_get_option('transition', 7000); ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationDuration: 500,         //Integer: Set the speed of animations, in milliseconds
		directionNav: <?php echo of_get_option('nextprev', true); ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
		controlNav: <?php echo of_get_option('controllingnavigation', true); ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
		mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
		prevText: "Previous",           //String: Set the text for the "previous" directionNav item
		nextText: "Next",               //String: Set the text for the "next" directionNav item
		pausePlay: false,               //Boolean: Create pause/play dynamic element
		pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
		playText: 'Play',               //String: Set the text for the "play" pausePlay item
		randomize: false,               //Boolean: Randomize slide order
		slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
		useCSS: true,
		animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
		pauseOnHover: false            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering

    });
});
</script>
<?php endif; ?>
<?php wp_reset_query() ?>