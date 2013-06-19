<?php
// Template Name: Homepage w/ Content
get_header(); ?>
	<div id="main">
		<div class="width-container">
			
<?php include 'slider.php'; ?>	


<?php if(of_get_option('homepage_full_width', 'no') == 'no'): ?><div id="container-sidebar"><?php endif; ?>
				<div class="content-boxed">
					
					<?php while(have_posts()): the_post(); ?>
					<h2 class="title-bg"><?php the_title(); ?></h2>

						
						<?php the_content(); ?>
												
						<div class="clearfix"></div>

					<?php endwhile; ?>
					
				

					<div class="clearfix"></div>
				</div><!-- close .content-boxed -->

				
				
				<div class="clearfix"></div>
				
				<div class="clearfix"></div>
				
				
				
					<?php if(of_get_option('homepage_full_width', 'no') == 'no'): ?></div><!-- close #container-sidebar --><?php endif; ?>
				<?php wp_reset_query() ?>

				<?php if(of_get_option('homepage_full_width', 'no') == 'no'): ?><?php get_sidebar(); ?><?php endif; ?>

		
			
			
			
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>