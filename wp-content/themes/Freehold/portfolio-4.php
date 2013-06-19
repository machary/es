<?php
// Template Name: Portfolio Four Column
get_header(); ?>

	<div id="main">
		<div class="width-container">

				<div class="content-boxed">
					<h2 class="title-bg"><?php the_title(); ?></h2>

					<?php
					if($post->post_parent) {
						$children = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&depth=1&echo=0');
					}
					else {
						$children = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&depth=1&echo=0');
					}
					if ($children) { ?>

						<ul id="child-pages">
							<?php if($post->post_parent): ?>
							<li><a href='<?php echo get_permalink($post->post_parent); ?>'><?php echo get_the_title($post->post_parent); ?></a></li>
							<?php else: ?>
							<li class="current_page_item"><a href='<?php echo get_permalink($post->ID); ?>'><?php echo get_the_title($post->ID); ?></a></li>
							<?php endif; ?>
							<?php echo $children; ?>
						</ul>
						<div class="clearfix"></div>

					<?php } else { ?>
					<?php } ?>
					
			
			<?php while(have_posts()): the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>

			<div class="portfolio-items-page">

			<?php
			$portfolio_type = get_post_meta($post->ID, 'pyre_portfolio_type', true);
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'posts_per_page' => '20',
				'show_posts' => '2',
				'post_type' => 'portfolio',
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_type',
						'field' => 'id',
						'terms' => $portfolio_type
					)
				),
				'paged' => $paged
			);
			$portfolio = new WP_Query($args);
			$portfolio_count = $portfolio->post_count;
			$count = 1;
			$count_2 = 1;
			while($portfolio->have_posts()): $portfolio->the_post();
				if($count >= 5) { $count = 1; }
			?>
			<div class="portfolio-item">
			<div class="grid4column<?php if($count == 4): echo ' lastcolumn'; endif; ?> <?php echo strtolower($tax); ?> all">
				<div class="item-container">
					<?php if(has_post_thumbnail()): ?>
					<div class="item-container-image item-container-spacer portfolio-image">
						
						<?php if(get_post_meta($post->ID, 'pyre_portfolio_external_link', true)): ?>
						<a href="<?php echo get_post_meta($post->ID, 'pyre_portfolio_external_link', true); ?>">
						<?php else: ?>
						<?php if(get_post_meta($post->ID, 'pyre_video_link', true)): ?>
						<a href="<?php echo get_post_meta($post->ID, 'pyre_video_link', true); ?>" rel="prettyPhoto[gallery]">
						<?php else: ?>
							<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
							
						<a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]">
						<?php endif; ?>
						<?php endif; ?>
						<?php the_post_thumbnail('portfolio-thumb'); ?>
						</a>
					</div>
					<?php else: ?>
					<?php if(get_post_meta($post->ID, 'pyre_video_embed_code', true)): ?>
				    	<?php
						$video = get_post_meta($post->ID, 'pyre_video_embed_code', true);
						$pattern = "/height=\"[0-9]*\"/";
						$video = preg_replace($pattern, "height='281'", $video);
						$pattern = "/width=\"[0-9]*\"/";
						$video = preg_replace($pattern, "width='500'", $video);
						?>
						<div class="portfolio-video">
							<?php echo $video; ?>
						</div>
					<?php endif; ?>
					<?php endif; ?>
					<div class="item-container-content">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo get_the_excerpt(); ?></p>
					</div><!-- close .item-container-content -->
				</div><!-- close .item-container -->
				<hr>
			</div>
			</div>
			<?php if($count == 4): ?><div class="clearfix"></div><?php endif; ?>
			<?php $count ++; $count_2++; endwhile; ?>

			</div>

<div class="clearfix"></div>
			<?php kriesi_pagination($portfolio->max_num_pages, $range = 2); ?>
			
			<div class="clearfix"></div>

				<div class="clearfix"></div>
				</div><!-- close .content-boxed -->
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>