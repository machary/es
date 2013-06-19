<div class="property-listing">
	
	<div class="property-listing-thumb">
		
		
		<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Open House'): ?><div class="notification-listing <?php echo get_post_meta(get_the_ID(), 'pyre_status', true); ?>"><?php _e('Open House','progressionstudios'); ?></div><?php endif; ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('property-listing'); ?></a>
		
	</div>
	
	<div class="property-information">
		<div class="property-information-address"><a href="<?php the_permalink(); ?>"><?php echo get_post_meta(get_the_ID(), 'pyre_address', true); ?></a></div>
		<?php if(get_post_meta(get_the_ID(), 'pyre_city', true) && get_post_meta(get_the_ID(), 'pyre_state', true) && get_post_meta(get_the_ID(), 'pyre_zip', true)): ?>
		<div class="property-information-location"><a href="<?php the_permalink(); ?>"><?php echo get_post_meta(get_the_ID(), 'pyre_city', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_state', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_zip', true); ?></a></div>
		<?php endif; ?>
		
		<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Call For Price'): ?>
		<div class="property-information-price"><a href="<?php the_permalink(); ?>"><?php _e('Call For Price','progressionstudios'); ?></a></div>
		<?php else: ?>
		<?php if(get_post_meta(get_the_ID(), 'pyre_price', true)): ?>
		<div class="property-information-price"><a href="<?php the_permalink(); ?>"><?php echo of_get_option('currency_text_opt', '$'); ?><?php echo number_format(get_post_meta(get_the_ID(), 'pyre_price', true)); ?><?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'For Rent'): ?><?php _e('/month','progressionstudios'); ?><?php endif; ?></a></div>
		<?php endif; ?>
		
		<?php endif; ?>
		
		<?php if(get_post_meta(get_the_ID(), 'pyre_size', true) || get_post_meta(get_the_ID(), 'pyre_bedrooms', true) || get_post_meta(get_the_ID(), 'pyre_bathrooms', true)): ?>
		<div class="property-highlight">
			<?php if(get_post_meta(get_the_ID(), 'pyre_size', true)): ?><div class="sq-highlight"><?php echo get_post_meta(get_the_ID(), 'pyre_size', true); ?> <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></div><?php endif; ?>
			<?php if(get_post_meta(get_the_ID(), 'pyre_bedrooms', true)): ?><div class="bed-higlight"><?php echo get_post_meta(get_the_ID(), 'pyre_bedrooms', true); ?> <?php echo of_get_option('beds_text', 'Beds'); ?></div><?php endif; ?>
			<?php if(get_post_meta(get_the_ID(), 'pyre_bathrooms', true)): ?><div class="bath-higlight"><?php echo get_post_meta(get_the_ID(), 'pyre_bathrooms', true); ?> <?php echo of_get_option('baths_text', 'Baths'); ?></div><?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="property-highlight">
			<?php if(get_post_meta(get_the_ID(), 'pyre_garage', true)): ?><div class="garage-higlight"><?php echo get_post_meta(get_the_ID(), 'pyre_garage', true); ?> <?php _e('Car Garage','progressionstudios'); ?></div><?php endif; ?>
			<div class="time-higlight"><?php _e('Listed','progressionstudios'); ?> <?php echo freehold_ago(get_post_time('U', true)); ?></div>
		</div>
		<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Open House'): ?>
		<div class="property-highlight">
			<div class="open-house"><span><?php _e('Open House','progressionstudios'); ?></span>: <?php echo get_post_meta(get_the_ID(), 'pyre_open', true); ?></div>
		</div>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div><!-- close property-information-->
	
	<div class="clearfix"></div>
	
	<div class="property-listing-base">
		<div class="grid2column">
			<?php
			$purl = get_post_type_archive_link('property');
			?>
			<div class="property-status"><?php echo of_get_option('property_status_text', 'Property Status'); ?>: <a href="<?php echo site_url(); ?>?post_type=property&amp;status=<?php echo get_post_meta(get_the_ID(), 'pyre_status', true); ?>"><?php echo get_post_meta(get_the_ID(), 'pyre_status', true); ?></a></div>
		</div>
		<div class="grid2column lastcolumn">
			<?php if(of_get_option('view_listing_button', 'View Listing')): ?>
			<a href="<?php the_permalink(); ?>" class="button secondary-button"><?php echo of_get_option('view_listing_button', 'View Listing'); ?></a>
			<?php endif; ?>
		</div>
		<div class="clearfix"></div>
		<hr>
	</div><!-- close .property-listing-base -->
</div>