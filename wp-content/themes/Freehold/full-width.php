<?php
// Template Name: Full Width
get_header(); ?>
	<div id="main">
		<div class="width-container">

				<div class="content-boxed">
					<?php while(have_posts()): the_post(); ?>
					<h2 class="title-bg"><?php the_title(); ?></h2>

						
						<?php the_content(); ?>
												
						<div class="clearfix"></div>

					<?php endwhile; ?>

				<div class="clearfix"></div>
				</div><!-- close .content-boxed -->
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>