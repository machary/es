<?php
// Template Name: Homepage w/ Listings
get_header(); ?>
	<div id="main">
		<div class="width-container">
			
<?php include 'slider.php'; ?>	


<?php if(of_get_option('homepage_full_width', 'no') == 'no'): ?><div id="container-sidebar"><?php endif; ?>


				<div class="content-boxed">
					
					<?php while(have_posts()): the_post(); ?>
					<h2 class="title-bg"><?php the_title(); ?></h2>

					<?php endwhile; ?>
					
					
					
					<?php if(of_get_option('homepage_all_type', 'no') == 'no'): ?>
						<?php
						if ( get_query_var('paged') ) {
						    $paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
						    $paged = get_query_var('page');
						} else {
						    $paged = 1;
						}
						$properties = new WP_Query(array(
							'post_type' => 'property',
							'tax_query' => array(
								array(
									'taxonomy' => 'property_type',
									'field' => 'slug',
									'terms' => 'featured',
									'operator' => 'NOT IN'
								)
							),
							'paged' => $paged
						));
						while($properties->have_posts()): $properties->the_post();
						?>
					
					<?php get_template_part( 'property-listing' );           // Navigation bar (property-listing.php) ?>	
					
					<?php endwhile; ?>
					
					<?php else: ?>
						
						<?php
						if ( get_query_var('paged') ) {
						    $paged = get_query_var('paged');
						} else if ( get_query_var('page') ) {
						    $paged = get_query_var('page');
						} else {
						    $paged = 1;
						}
						$properties = new WP_Query(array(
							'post_type' => 'property',
							'tax_query' => array(
								array(
									'taxonomy' => 'property_type',
									'field' => 'slug',
									'terms' => 'homepage'
								)
							),
							'paged' => $paged
						));
						while($properties->have_posts()): $properties->the_post();
						?>
						
						<?php get_template_part( 'property-listing' );           // Navigation bar (property-listing.php) ?>	
						<?php endwhile; ?>
						
					<?php endif; ?>
					
					
					


					<div class="clearfix"></div>
				</div><!-- close .content-boxed -->

				
				
				<div class="clearfix"></div>
				<?php if($properties->max_num_pages): ?>
				<div class="page-count"><?php _e('Page','progressionstudios'); ?> <?php echo $paged; ?> <?php _e('of','progressionstudios'); ?> <?php echo $properties->max_num_pages; ?></div>
				<?php kriesi_pagination($properties->max_num_pages, $range = 2); ?>
				<?php endif; ?>
				<div class="clearfix"></div>
				
				
				<?php if(of_get_option('homepage_full_width', 'no') == 'no'): ?></div><!-- close #container-sidebar --><?php endif; ?>
			<?php wp_reset_query() ?>

			<?php if(of_get_option('homepage_full_width', 'no') == 'no'): ?><?php get_sidebar(); ?><?php endif; ?>
			
			
			
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>