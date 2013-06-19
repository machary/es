			<div id="sidebar">
			<?php if(is_single() && 'property' == get_post_type()): ?>
			<div class="content-boxed">
				<h2 class="title-bg"><?php echo of_get_option('location_info_text', 'Location &amp; Information'); ?></h2>
				
				<?php if(of_get_option('map_search_sidebar', 'no') == 'no'): ?>
				
				<div id="sidebar-map">
					
					<div id="map-listing-single"></div>
					<script type="text/javascript"> 
					jQuery(document).ready(function($) {
					    $("#map-listing-single").goMap({ 
					        markers: [{  
					            address: "<?php echo get_post_meta($post->ID, 'pyre_full_address', true); ?>", 
					            title: '<?php echo get_post_meta($post->ID, 'pyre_full_address', true); ?>' ,
								icon: '<?php echo of_get_option("map_icon", get_template_directory_uri() . "/images/home.png"); ?>'
					        }],
							disableDoubleClickZoom: true,
							<?php if(of_get_option('map_zoom_sidebar', '15')): ?>zoom: <?php echo of_get_option('map_zoom_sidebar', '15'); ?>,<?php endif; ?>
							maptype: 'ROADMAP'
					    }); 

					});
					</script>
					
					
					</div>
					<div id="more-map">
						<a href="https://maps.google.com/maps?q=<?php echo urlencode(get_post_meta($post->ID, 'pyre_full_address', true)); ?>&amp;output=embed?iframe=true&width=90%&height=90%" rel="prettyPhoto[iframes]">Larger Map &uarr;</a><!-- just plug in the address and leave other options alone -->
					</div>
					<div class="clearfix"></div>
					<?php endif; ?>
					
					<div class="property-meta-single">
						<div class="listings-address-widget"><?php echo get_post_meta(get_the_ID(), 'pyre_address', true); ?></div>
						<?php if(get_post_meta(get_the_ID(), 'pyre_city', true) && get_post_meta(get_the_ID(), 'pyre_state', true) && get_post_meta(get_the_ID(), 'pyre_zip', true)): ?>
						<div class="listings-street-widget"><?php echo get_post_meta(get_the_ID(), 'pyre_city', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_state', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_zip', true); ?></div>
						<?php endif; ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Call For Price'): ?>
						<div class="listings-price-widget"><?php _e('Call For Price','progressionstudios'); ?></div>
						<?php else: ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_price', true)): ?>
						<div class="listings-price-widget"><?php echo of_get_option('currency_text_opt', '$'); ?><?php echo number_format(get_post_meta(get_the_ID(), 'pyre_price', true)); ?><?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'For Rent'): ?>/month<?php endif; ?></div>
						<?php endif; ?>
						<?php endif; ?>
					</div>
					
					<ul id="house-details-sidebar">
						<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Open House'): ?>
						<li><?php _e('Open House','progressionstudios'); ?>: <span><?php echo get_post_meta(get_the_ID(), 'pyre_open', true); ?></span></li>
						<?php endif; ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_bedrooms', true)): ?>
						<li><?php echo of_get_option('bedrooms_text', 'Bedrooms'); ?>:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_bedrooms', true); ?></span></li>
						<?php endif; ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_bathrooms', true)): ?>
						<li><?php echo of_get_option('bathrooms_text', 'Bathrooms'); ?>:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_bathrooms', true); ?></span></li>
						<?php endif; ?>
						
						
						<?php
						$terms = get_the_terms( $post->ID, 'property_type' );
						$terms = wp_list_filter($terms, array('slug'=>'featured'),'NOT');
						$terms = wp_list_filter($terms, array('slug'=>'homepage'),'NOT');
						$terms = wp_list_filter($terms, array('slug'=>'widget'),'NOT');

						if ( $terms && ! is_wp_error( $terms ) ) : 
							$property_links = array();
							foreach ( $terms as $term ) {
								$property_links[] = $term->name;
							}
							$on_property = join( ", ", $property_links );
						?>
						<li><?php echo of_get_option('property_type_text', 'Property Type'); ?>: <span><?php echo $on_property; ?></span></li>

						<?php endif; ?>
						
						
						<?php if(get_post_meta(get_the_ID(), 'pyre_size', true)): ?>
						<li><?php _e('Size','progressionstudios'); ?>:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_size', true); ?> <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></span></li>
						<?php endif; ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_lot', true)): ?>
						<li><?php _e('Lot','progressionstudios'); ?>:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_lot', true); ?> <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></span></li>
						<?php endif; ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_built', true)): ?>
						<li><?php _e('Year built','progressionstudios'); ?>:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_built', true); ?></span></li>
						<?php endif; ?>
						<li><?php _e('Added','progressionstudios'); ?>: <span><?php echo freehold_ago(get_post_time('U', true)); ?></span></li>
						<?php if(get_post_meta(get_the_ID(), 'pyre_zip', true)): ?>
						<li><?php echo of_get_option('zip_text', 'Zip code'); ?>:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_zip', true); ?></span></li>
						<?php endif; ?>
					</ul>	
			</div><!-- close .content-boxed -->
			<?php endif; ?>

			<?php
			if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Property Listing')): 
			endif;
			?>	
				
			</div><!-- close #sidebar -->