<?php
get_header(); ?>
	<?php
	$purl = get_post_type_archive_link('property');
	?>

	<script type="text/javascript">
	jQuery(document).ready(function($) {
		function insertParam(key, value)
		{
		    key = escape(key); value = escape(value);

		    var kvp = document.location.search.substr(1).split('&');

		    var i=kvp.length; var x; while(i--) 
		    {
		        x = kvp[i].split('=');

		        if (x[0]==key)
		        {
		                x[1] = value;
		                kvp[i] = x.join('=');
		                break;
		        }
		    }

		    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

		    //this will reload the page, it's likely better to store this until finished
		    document.location.search = kvp.join('&'); 
		}
		function removeParameter(url, parameter)
		{
		  var urlparts= url.split('?');

		  if (urlparts.length>=2)
		  {
		      var urlBase=urlparts.shift(); //get first part, and remove from array
		      var queryString=urlparts.join("?"); //join it back up

		      var prefix = encodeURIComponent(parameter)+'=';
		      var pars = queryString.split(/[&;]/g);
		      for (var i= pars.length; i-->0;)               //reverse iteration as may be destructive
		          if (pars[i].lastIndexOf(prefix, 0)!==-1)   //idiom for string.startsWith
		              pars.splice(i, 1);
		      url = urlBase+'?'+pars.join('&');
		  }
		  return url;
		}
		$('select[name=sorting]').change(function() {
			var current_option = $(this).find('option:selected').val();
			if(current_option == 'recent') {
				window.location = removeParameter(window.location.href, 'price');
			} else if(current_option == 'high') {
				insertParam('price', 'high')
			} else if(current_option == 'low') {
				insertParam('price', 'low')
			}
		});
	});
	</script>
	<div id="main">
		<div class="width-container">

			<div id="container-sidebar">
				<div class="content-boxed">
					<h2 class="title-bg"><?php echo of_get_option('search_results_text', 'Search Results'); ?></h2>

					<div id="sortable-search">
						<select name="sorting"> 
							<option value="recent"><?php _e('Most Recent','progressionstudios'); ?></option>
							<option value="high" <?php if(isset($_GET['price']) && $_GET['price'] == 'high'): ?>selected="selected"<?php endif; ?>><?php _e('Price (high to low)','progressionstudios'); ?></option> 
							<option value="low" <?php if(isset($_GET['price']) && $_GET['price'] == 'low'): ?>selected="selected"<?php endif; ?>><?php _e('Price (low to high)','progressionstudios'); ?></option> 
						</select>
					</div>
					
					

					<?php
					if ( get_query_var('paged') ) {
					    $paged = get_query_var('paged');
					} else if ( get_query_var('page') ) {
					    $paged = get_query_var('page');
					} else {
					    $paged = 1;
					}
					$args = array(
						'post_type' => 'property',
						'paged' => $paged
					);
					if(isset($_GET['price'])) {
					if($_GET['price'] == 'high') {
						$args['meta_key'] = 'pyre_price';
						$args['orderby'] = 'meta_value_num';
						$args['order'] = 'DESC';
					}
					}
					if(isset($_GET['price'])) {
					if($_GET['price'] == 'low') {
						$args['meta_key'] = 'pyre_price';
						$args['orderby'] = 'meta_value_num';
						$args['order'] = 'ASC';
					}
					}
					if(isset($_GET['status'])) {
					if($_GET['status']) {
						$args['meta_query'][] = array(
							'key' => 'pyre_status',
							'value' => $_GET['status'],
						);
					}
					}
					if(isset($_GET['price-min'])) {
					if($_GET['price-min'] >= 1) {
						$args['meta_query'][] = array(
							'key' => 'pyre_price',
							'value' => $_GET['price-min'],
							'compare' => '>=',
							'type' => 'numeric'
						);
					}
					}
					if(isset($_GET['price-max'])) {
					if($_GET['price-max'] >= 1) {
						$args['meta_query'][] = array(
							'key' => 'pyre_price',
							'value' => $_GET['price-max'],
							'compare' => '<=',
							'type' => 'numeric'
						);
					}
					}
					if(isset($_GET['city'])) {
					if($_GET['city']) {
						$args['meta_query'][] = array(
							'key' => 'pyre_city',
							'value' => $_GET['city'],
						);
					}
					}
					if(isset($_GET['state'])) {
					if($_GET['state']) {
						$args['meta_query'][] = array(
							'key' => 'pyre_state',
							'value' => $_GET['state'],
						);
					}
					}
					if(isset($_GET['zip'])) {
					if($_GET['zip']) {
						$args['meta_query'][] = array(
							'key' => 'pyre_zip',
							'value' => $_GET['zip'],
						);
					}
					if($_GET['beds'] >= 1) {
						$args['meta_query'][] = array(
							'key' => 'pyre_bedrooms',
							'value' => $_GET['beds'],
							'compare' => '>=',
							'type' => 'numeric'
						);
					}
					}
					if(isset($_GET['baths'])) {
					if($_GET['baths'] >= 1) {
						$args['meta_query'][] = array(
							'key' => 'pyre_bathrooms',
							'value' => $_GET['baths'],
							'compare' => '>=',
							'type' => 'numeric'
						);
					}
					}
					if(isset($_GET['sqft'])) {
					if($_GET['sqft'] >= 1) {
						$args['meta_query'][] = array(
							'key' => 'pyre_size',
							'value' => $_GET['sqft'],
							'compare' => '>=',
							'type' => 'numeric'
						);
					}
					}
					if(isset($_GET['ptype'])) {
					if($_GET['ptype']) {
						$args['tax_query'][] = array(
							'taxonomy' => 'property_type',
							'field' => 'slug',
							'terms' => $_GET['ptype']
						);
					}
					}
					if(isset($_GET['search_keyword'])) {
					if($_GET['search_keyword']) {
						$args['meta_query'] = array();
						$args['meta_query'][] = array(
							'key' => 'pyre_full_address',
							'value' => $_GET['search_keyword'],
							'compare' => 'LIKE',
							'type' => 'CHAR'
						);
					}
					}
					query_posts($args);
					if(have_posts()):
					?>
					
					
					
					<?php if(of_get_option('map_search', 'no') == 'no'): ?>
					<div id="map-container">
						<div id="map-listing"></div>
					</div>
					<script type="text/javascript"> 
					jQuery(document).ready(function($) {
					    $("#map-listing").goMap({ 
					        markers: [
					        <?php while(have_posts()): the_post(); ?>
					        {  
					            address: '<?php echo get_post_meta($post->ID, "pyre_full_address", true); ?>', 
					            title: '<?php echo get_post_meta($post->ID, "pyre_full_address", true); ?>' ,
								icon: '<?php echo of_get_option("map_icon", get_template_directory_uri() . "/images/home.png"); ?>',
								html: {content: '<a href="<?php the_permalink(); ?>" class="alignright map-image-thumb"><?php the_post_thumbnail("widget-thumb"); ?></a><div class="property-information-address"><a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, "pyre_address", true); ?></a></div><div class="property-information-location"><a href="<?php the_permalink(); ?>"><?php echo get_post_meta(get_the_ID(), "pyre_city", true); ?>, <?php echo get_post_meta(get_the_ID(), "pyre_state", true); ?>, <?php echo get_post_meta(get_the_ID(), "pyre_zip", true); ?></a></div><div class="property-information-price"><a href="<?php the_permalink(); ?>"><?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == "Call For Price"): ?>Call For Price<?php else: ?><?php echo of_get_option('currency_text_opt', '$'); ?><?php echo number_format(get_post_meta(get_the_ID(), "pyre_price", true)); ?><?php if(get_post_meta(get_the_ID(), "pyre_status", true) == "For Rent"): ?>/month<?php endif; ?><?php endif; ?></a></div><a href="<?php the_permalink(); ?>" class="view-listing-map"><?php echo of_get_option("view_listing_button", "View Listing"); ?></a>'}
								
							},
							<?php endwhile; ?>
							],
							disableDoubleClickZoom: true,
							<?php if(of_get_option('map_zoom', '12')): ?>zoom: <?php echo of_get_option('map_zoom', '12'); ?>,<?php endif; ?>
							address: '', //have this be the first items address so that one is centered
							maptype: 'ROADMAP' 
					    }); 

					});
					</script>
					<?php endif; ?>
					
					
					

					<?php
					while(have_posts()): the_post();
					?>
					
					
					<?php get_template_part( 'property-listing' );           // Navigation bar (property-listing.php) ?>
					
					<?php endwhile; ?>

					<?php else: ?>
					<h3><?php echo of_get_option('search_results_none_title', 'No properties were found which match your search criteria.'); ?></h3>
					<p><?php echo of_get_option('search_results_none_content', 'Try broadening your search to find more results.'); ?></p>
					<?php endif; ?>


					<div class="clearfix"></div>
				</div><!-- close .content-boxed -->

				
				
				<div class="clearfix"></div>
				<?php if($wp_query->max_num_pages): ?>
				<div class="page-count"><?php _e('Page','progressionstudios'); ?> <?php echo $paged; ?> <?php _e('of','progressionstudios'); ?> <?php echo $wp_query->max_num_pages; ?></div>
				<?php kriesi_pagination($wp_query->max_num_pages, $range = 2); ?>
				<?php endif; ?>
				<div class="clearfix"></div>
				
				
				
				
			</div><!-- close #container-sidebar -->
			<?php wp_reset_query() ?>

			<?php include 'sidebar-real-estate.php'; ?>	
			
			
			
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>