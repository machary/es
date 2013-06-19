<?php
get_header(); ?>
	<?php
	$purl = get_post_type_archive_link('property');
	?>

	<div id="main">
		<div class="width-container">

			<div id="container-sidebar">
				<div class="content-boxed">
					
					<?php if (is_tax('property_type')) {
						$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
						$tax_term_breadcrumb_taxonomy_slug = $term->taxonomy;
						echo '<h2 class="title-bg">Property Type: ' . $term->name . '</h2>';
					}
					?>

				
					<?php
					if ( get_query_var('paged') ) {
					    $paged = get_query_var('paged');
					} else if ( get_query_var('page') ) {
					    $paged = get_query_var('page');
					} else {
					    $paged = 1;
					}
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