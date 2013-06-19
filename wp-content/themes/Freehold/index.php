<?php get_header(); ?>
	<div id="main">
		<div class="width-container">
			
			<?php if(of_get_option('fw_blog', 'no') == 'no'): ?><div id="container-sidebar"><?php endif; ?>
	
				<div class="content-boxed">
					<h2 class="title-bg"><?php echo of_get_option('blog_tagline', 'Our Blog'); ?></h2>
					
					
					<?php while(have_posts()): the_post(); ?>
					<div <?php post_class(); ?>>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="post-data"><?php _e('Posted on','progressionstudios'); ?> <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('F j, Y'); ?></a> <?php _e('by','progressionstudios'); ?> <span><?php the_author(); ?></span> <?php _e('in','progressionstudios'); ?> <?php the_category(', '); ?></div>
						
						
						<?php if(get_post_meta($post->ID, 'pyre_video_embed_link', true)): ?>
							<?php
							$video = get_post_meta($post->ID, 'pyre_video_embed_link', true);
							$pattern = "/height=\"[0-9]*\"/";
							$video = preg_replace($pattern, "height='281'", $video);
							$pattern = "/width=\"[0-9]*\"/";
							$video = preg_replace($pattern, "width='500'", $video);
							?>
							<div class="video-border">
							<?php echo $video; ?>
							</div>
							<?php else: ?>
						
						<?php if(has_post_thumbnail()): ?>
						<div class="featured-image">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-image'); ?></a>
						</div>
						<?php endif; ?>
						
							<?php endif; ?>
						
						<?php the_excerpt(); ?>
						
						<p><a href="<?php the_permalink(); ?>"><?php echo of_get_option('blog_button_more', 'Continue reading &rarr;'); ?></a></p>
						
						<div class="clearfix"></div>
						
					</div><!-- close .type-post -->
					
					
					<?php the_tags('<div class="share-section">
						<div class="tags">Tags:</div> ', ', ', '<div class="clearfix"></div>
					</div>'); ?>
					<?php endwhile; ?>

				<div class="clearfix"></div>
				</div><!-- close .content-boxed -->

				
				
				<div class="clearfix"></div>
				<?php 
					//get the current page number in $paged
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
					$totalPages = $wp_query->max_num_pages;
					if($totalPages>1):
				?>
				<div class="page-count"><?php _e('Page','progressionstudios'); ?> <?php echo $paged; ?> <?php _e('of','progressionstudios'); ?> <?php echo $wp_query->max_num_pages; ?></div>
				<?php kriesi_pagination($pages = '', $range = 2); ?>
				<?php endif; ?>
				<div class="clearfix"></div>
				
				
				<?php if(of_get_option('fw_blog', 'no') == 'no'): ?></div><!-- close #container-sidebar --><?php endif; ?>
			

			<?php if(of_get_option('fw_blog', 'no') == 'no'): ?><?php get_sidebar(); ?><?php endif; ?>
			
			
			
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>