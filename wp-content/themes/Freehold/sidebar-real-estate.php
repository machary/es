<div id="sidebar">
<?php if(!isset($_GET['post_type'])){ $_GET['post_type'] = 'nothing'; } ?>
<?php if(is_archive() && ('property' == get_post_type() || $_GET['post_type'] == 'property')): ?>
<?php
$purl = get_post_type_archive_link('property');
?>
<div class="content-boxed">
	<h2 class="title-bg"><?php echo of_get_option('advanced_search_text', 'Advanced Search'); ?></h2>
	
	<?php
	if(!isset($_GET['search_keyword'])) {
		$_GET['search_keyword'] = '';
	}
	if(!isset($_GET['status'])) {
		$_GET['status'] = '';
	}
	if(!isset($_GET['price-min'])) {
		$_GET['price-min'] = '';
	}
	if(!isset($_GET['price-max'])) {
		$_GET['price-max'] = '';
	}
	if(!isset($_GET['city'])) {
		$_GET['city'] = '';
	}
	if(!isset($_GET['state'])) {
		$_GET['state'] = '';
	}
	if(!isset($_GET['zip'])) {
		$_GET['zip'] = '';
	}
	if(!isset($_GET['beds'])) {
		$_GET['beds'] = '';
	}
	if(!isset($_GET['baths'])) {
		$_GET['baths'] = '';
	}
	if(!isset($_GET['ptype'])) {
		$_GET['ptype'] = '';
	}
	if(!isset($_GET['sqft'])) {
		$_GET['sqft'] = '';
	}
	?>
	<div class="advanced-search-form">
	<form method="get" class="advanced-searchform" action="<?php echo $purl; ?>">
		<input type="hidden" name="post_type" value="property" />
		<div><input type="text" class="field" name="search_keyword" id="keyword" placeholder="<?php echo of_get_option('search_keyword_sidebar', 'Enter an address...'); ?>" value="<?php echo $_GET['search_keyword']; ?>" /></div>
		
		<div>
			<select name="status"> 
				<option value="" selected="selected"><?php echo of_get_option('property_status_text', 'Property Status'); ?></option> 
				<option value="For Rent" <?php if($_GET['status'] == 'For Rent'): ?>selected="selected"<?php endif; ?>><?php _e('For Rent','progressionstudios'); ?></option> 
				<option value="For Sale" <?php if($_GET['status'] == 'For Sale'): ?>selected="selected"<?php endif; ?>><?php _e('For Sale','progressionstudios'); ?></option> 
				<option value="Open House" <?php if($_GET['status'] == 'Open House'): ?>selected="selected"<?php endif; ?>><?php _e('Open House','progressionstudios'); ?></option> 
				<!--option value="Reduced" <?php if($_GET['status'] == 'Reduced'): ?>selected="selected"<?php endif; ?>>Recently Reduced</option--> 
				<!--option value="Call For Price" <?php if($_GET['status'] == 'Call For Price'): ?>selected="selected"<?php endif; ?>>Call For Price</option--> 
			</select>
			
		</div>
		
		<div class="advanced-two-column">
			<label for="locations" class="assistive-text"><?php _e('Price Min','progressionstudios'); ?>:</label>
			<input type="text" class="field" name="price-min" id="price-min" placeholder="<?php _e('Min Price','progressionstudios'); ?>" value="<?php echo $_GET['price-min']; ?>" />
		</div>	
		<div class="advanced-two-column last-two-column">
			<label for="locations" class="assistive-text"><?php _e('Price Max','progressionstudios'); ?>:</label>
			<input type="text" class="field" name="price-max" id="price-max" placeholder="<?php _e('Max Price','progressionstudios'); ?>" value="<?php echo $_GET['price-max']; ?>" />
		</div>
		<div class="clearfix"></div>
		
		<?php
		$query_for_search = new WP_Query(array(
			'post_type' => 'property',
			'posts_per_page' => -1,
		));
		while($query_for_search->have_posts()): $query_for_search->the_post();
			if(get_post_meta(get_the_ID(), 'pyre_city', true)):
			$city[] = get_post_meta(get_the_ID(), 'pyre_city', true);
			endif;

			if(get_post_meta(get_the_ID(), 'pyre_state', true)):
			$state[] = get_post_meta(get_the_ID(), 'pyre_state', true);
			endif;

			if(get_post_meta(get_the_ID(), 'pyre_zip', true)):
			$zip[] = get_post_meta(get_the_ID(), 'pyre_zip', true);
			endif;

			if(isset($city)) {
			if($city) {
				$city = array_unique($city);
			}
			}

			if(isset($state)) {
			if($state) {
				$state = array_unique($state);
			}
			}

			if(isset($zip)) {
			if($zip) {
				$zip = array_unique($zip);
			}
			}
			
		endwhile;
		?>
		<?php if($city): ?>
		<div>
			<select name="city"> 
				<option value="" selected="selected"><?php echo of_get_option('city_text', 'Choose City'); ?></option> 
				<?php foreach($city as $c): ?>
				<option value="<?php echo $c; ?>" <?php if($_GET['city'] == $c): ?>selected="selected"<?php endif; ?>><?php echo $c; ?></option>
				<?php endforeach; ?> 
			</select>
		</div>
		<?php endif; ?>
		
		<?php if($state): ?>
		<div class="advanced-two-column drop-down-fix">
			<label for="locations" class="assistive-text"><?php echo of_get_option('state_text', 'State'); ?>:</label>
			<select name="state">
				<option value="" selected="selected"><?php echo of_get_option('state_text', 'State'); ?></option>
				<?php foreach($state as $s): ?> 
				<option value="<?php echo $s; ?>" <?php if($_GET['state'] == $s): ?>selected="selected"<?php endif; ?>><?php echo $s; ?></option>
				<?php endforeach; ?> 
			</select>
		</div>
		<?php endif; ?>
		<?php if($zip): ?>
		<div class="advanced-two-column last-two-column">
			<label for="locations" class="assistive-text"><?php echo of_get_option('zip_text', 'Zip code'); ?>:</label>
			<select name="zip"> 
				<option value="" selected="selected"><?php echo of_get_option('zip_text', 'Zip code'); ?></option> 
				<?php foreach($zip as $z): ?> 
				<option value="<?php echo $z; ?>" <?php if($_GET['zip'] == $z): ?>selected="selected"<?php endif; ?>><?php echo $z; ?></option>
				<?php endforeach; ?> 
			</select>
		</div>
		<?php endif; ?>
		
		<div class="clearfix"></div>
		
		<div class="advanced-two-column drop-down-fix">
			<label for="locations" class="assistive-text"><?php echo of_get_option('beds_text', 'Beds'); ?>:</label>
			<select name="beds"> 
				<option value="" selected="selected"><?php echo of_get_option('beds_text', 'Beds'); ?></option> 
				<option value="1" <?php if($_GET['beds'] == '1'): ?>selected="selected"<?php endif; ?>>1+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
				<option value="2" <?php if($_GET['beds'] == '2'): ?>selected="selected"<?php endif; ?>>2+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
				<option value="3" <?php if($_GET['beds'] == '3'): ?>selected="selected"<?php endif; ?>>3+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
				<option value="4" <?php if($_GET['beds'] == '4'): ?>selected="selected"<?php endif; ?>>4+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
				<option value="5" <?php if($_GET['beds'] == '5'): ?>selected="selected"<?php endif; ?>>5+ <?php echo of_get_option('beds_text_short', 'bd'); ?></option> 
			</select>
		</div>	
		<div class="advanced-two-column last-two-column">
			<label for="locations" class="assistive-text"><?php echo of_get_option('baths_text', 'Baths'); ?>:</label>
			<select name="baths"> 
				<option value="" selected="selected"><?php echo of_get_option('baths_text', 'Baths'); ?></option> 
				<option value="1" <?php if($_GET['baths'] == '1'): ?>selected="selected"<?php endif; ?>>1+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
				<option value="2" <?php if($_GET['baths'] == '2'): ?>selected="selected"<?php endif; ?>>2+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
				<option value="3" <?php if($_GET['baths'] == '3'): ?>selected="selected"<?php endif; ?>>3+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
				<option value="4" <?php if($_GET['baths'] == '4'): ?>selected="selected"<?php endif; ?>>4+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
				<option value="5" <?php if($_GET['baths'] == '5'): ?>selected="selected"<?php endif; ?>>5+ <?php echo of_get_option('baths_text_short', 'ba'); ?></option> 
			</select>
		</div>
		<div class="clearfix"></div>
		
		<?php
		$ptype = get_terms('property_type');
		if($ptype):
		?>
		<div class="drop-down-spacing">
			<select name="ptype"> 
				<option value="" selected="selected"><?php echo of_get_option('property_type_text', 'Property Type'); ?></option>
				<?php foreach($ptype as $pt): ?>
				<?php if($pt->name != 'Featured'): ?>
				<?php if($pt->name != 'featured'): ?>
				<?php if($pt->name != 'Homepage'): ?>
				<?php if($pt->name != 'homepage'): ?>
				<?php if($pt->name != 'Widget'): ?>
				<?php if($pt->name != 'widget'): ?>
				<option value="<?php echo $pt->slug; ?>" <?php if($_GET['ptype'] == $pt->slug || get_query_var($taxonomy) == $pt->slug): ?>selected="selected"<?php endif; ?>><?php echo $pt->name; ?></option>
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
				<?php endforeach; ?>
			</select>
		</div>
		<?php endif; ?>
		
		<div>
			<select name="sqft"> 
				<option value="" selected="selected"><?php echo of_get_option('square_feet_text', 'Square Feet'); ?></option> 
				<option value="250" <?php if($_GET['sqft'] == '250'): ?>selected="selected"<?php endif; ?>>250+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="500" <?php if($_GET['sqft'] == '500'): ?>selected="selected"<?php endif; ?>>500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="1000" <?php if($_GET['sqft'] == '1000'): ?>selected="selected"<?php endif; ?>>1000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="1250" <?php if($_GET['sqft'] == '1250'): ?>selected="selected"<?php endif; ?>>1250+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="1500" <?php if($_GET['sqft'] == '1500'): ?>selected="selected"<?php endif; ?>>1500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="2000" <?php if($_GET['sqft'] == '2000'): ?>selected="selected"<?php endif; ?>>2000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="2500" <?php if($_GET['sqft'] == '2500'): ?>selected="selected"<?php endif; ?>>2500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="3000" <?php if($_GET['sqft'] == '3000'): ?>selected="selected"<?php endif; ?>>3000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="3500" <?php if($_GET['sqft'] == '3500'): ?>selected="selected"<?php endif; ?>>3500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="4000" <?php if($_GET['sqft'] == '4000'): ?>selected="selected"<?php endif; ?>>4000+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
				<option value="4500" <?php if($_GET['sqft'] == '4500'): ?>selected="selected"<?php endif; ?>>4500+ <?php echo of_get_option('square_feet_text_small', 'sqft'); ?></option> 
			</select>
		</div>
		
		<div><input type="submit" class="submit-advanced" name="submit" value="<?php _e('Search','progressionstudios'); ?>" /></div>
	</form>
	</div>
</div><!-- close .content-boxed -->
<?php endif; ?>

<?php if(is_single() && 'property' == get_post_type()): ?>
<div class="content-boxed">
	<h2 class="title-bg"><?php echo of_get_option('location_info_text', 'Location &amp; Information'); ?></h2>
	<div id="sidebar-map">
		
		<div id="map-listing-single"></div>
		
		<script type="text/javascript"> 
		jQuery(document).ready(function($) {
		    $("#map-listing-single").goMap({ 
		        markers: [{  
		            address: "<?php echo get_post_meta($post->ID, 'pyre_full_address', true); ?>", 
		            title: '<?php echo get_post_meta($post->ID, 'pyre_full_address', true); ?>' ,
					icon: '<?php echo get_template_directory_uri(); ?>/images/home.png'
		        }],
				disableDoubleClickZoom: true,
				zoom: 12,
				maptype: 'ROADMAP'
		    }); 

		});
		</script>
		
		
		</div>
		<div id="more-map">
			<a href="https://maps.google.com/maps?q=<?php echo urlencode(get_post_meta($post->ID, 'pyre_full_address', true)); ?>&amp;output=embed?iframe=true&width=90%&height=90%" rel="prettyPhoto[iframes]"><?php _e('Larger Map','progressionstudios'); ?> &uarr;</a><!-- just plug in the address and leave other options alone -->
		</div>
		<div class="clearfix"></div>
		
		<div class="property-meta-single">
			<div class="listings-address-widget"><?php echo get_post_meta($post->ID, 'pyre_full_address', true); ?></div>
			<?php if(get_post_meta(get_the_ID(), 'pyre_city', true) && get_post_meta(get_the_ID(), 'pyre_state', true) && get_post_meta(get_the_ID(), 'pyre_zip', true)): ?>
			<div class="listings-street-widget"><?php echo get_post_meta(get_the_ID(), 'pyre_city', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_state', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_zip', true); ?></div>
			<?php endif; ?>
			<?php if(get_post_meta(get_the_ID(), 'pyre_price', true)): ?>
			<div class="listings-price-widget"><?php echo of_get_option('currency_text_opt', '$'); ?><?php echo number_format(get_post_meta(get_the_ID(), 'pyre_price', true)); ?><?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'For Rent'): ?><?php _e('/month','progressionstudios'); ?><?php endif; ?></div>
			<?php endif; ?>
			<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Call For Price'): ?>
			<div class="listings-price-widget"><?php _e('Call For Price','progressionstudios'); ?></div>
			<?php endif; ?>
		</div>
		
		<ul id="house-details-sidebar">
			<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Open House'): ?>
			<li><?php _e('Open House','progressionstudios'); ?>: <span><?php echo get_post_meta(get_the_ID(), 'pyre_open', true); ?></span></li>
			<?php endif; ?>
			<?php if(get_post_meta(get_the_ID(), 'pyre_bedrooms', true)): ?>
			<li>Bedrooms:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_bedrooms', true); ?></span></li>
			<?php endif; ?>
			<?php if(get_post_meta(get_the_ID(), 'pyre_bathrooms', true)): ?>
			<li>Bathrooms:	<span><?php echo get_post_meta(get_the_ID(), 'pyre_bathrooms', true); ?></span></li>
			<?php endif; ?>
			<?php
			$get_terms_array = get_the_terms(get_the_ID(), 'property_type');
			if($get_terms_array):
				foreach($get_terms_array as $get_terms_a) {
					if($get_terms_a->name != 'Featured') {
						$get_terms[] = "<a href='".get_term_link($get_terms_a->slug, 'property_type')."'>".$get_terms_a->name."</a>";
					}
				}
				$get_terms_string = implode(', ', $get_terms);
			?>
			<li><?php echo of_get_option('property_type_text', 'Property Type'); ?>: <span><?php echo $get_terms_string; ?><span></li>
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
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Real Estate Search')): 
endif;
?>
	
</div><!-- close #sidebar -->