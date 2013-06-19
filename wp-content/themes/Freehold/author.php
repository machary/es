<?php
get_header(); ?>
	<div id="main">
		<div class="width-container">

			<div id="container-sidebar">
				<div class="content-boxed">			
					
					<?php
					$agent_id = $author;
					$agent_info = get_userdata($agent_id);
					?>

					<h2 class="title-bg"><?php _e('Listings By','progressionstudios'); ?> <?php echo $agent_info->display_name; ?></h2>

					
					
					
					<div class="agent-post">
						<div class="agent-thumb">
							<?php echo get_avatar($agent_id, 150
							); ?>
						</div>
						<div class="agent-details">
							<h5><?php echo $agent_info->display_name; ?></h5>
							<?php if(get_the_author_meta('subtitle', $agent_id)): ?>
							<h6><?php echo get_the_author_meta('subtitle', $agent_id); ?></h6>
							<?php endif; ?>
							<ul class="fancy-list">
								<?php if(get_the_author_meta('office', $agent_id)): ?>
								<li><span><?php _e('Office','progressionstudios'); ?>:</span> <?php echo get_the_author_meta('office', $agent_id); ?></li>
								<?php endif; ?>
								<?php if(get_the_author_meta('mobile', $agent_id)): ?>
								<li><span><?php _e('Mobile','progressionstudios'); ?>:</span> <?php echo get_the_author_meta('mobile', $agent_id); ?></li>
								<?php endif; ?>
								<?php if(get_the_author_meta('fax', $agent_id)): ?>
								<li><span><?php _e('Fax','progressionstudios'); ?>:</span> <?php echo get_the_author_meta('fax', $agent_id); ?></li>
								<?php endif; ?>
							</ul>
						</div>
						<div class="agent-social">
							<div class="message-send"><a href="mailto:<?php echo $agent_info->user_email; ?>" class="button secondary-button"><?php _e('Send a Message','progressionstudios'); ?></a></div>
							<div class="social-icons">
									<?php if(get_the_author_meta('facebook', $agent_id)): ?>
									<a class="facebook" href="<?php echo get_the_author_meta('facebook', $agent_id); ?>" target="_blank">F</a>
									<?php endif; ?>
									<?php if(get_the_author_meta('twitter', $agent_id)): ?>
									<a class="twitter" href="<?php echo get_the_author_meta('twitter', $agent_id); ?>" target="_blank">t</a>
									<?php endif; ?>
									<?php if(get_the_author_meta('skype', $agent_id)): ?>
									<a class="skype" href="<?php echo get_the_author_meta('skype', $agent_id); ?>" target="_blank">s</a>
									<?php endif;?>
									<?php if(get_the_author_meta('linkedin', $agent_id)): ?>
									<a class="linkedin" href="<?php echo get_the_author_meta('linkedin', $agent_id); ?>" target="_blank">l</a>
									<?php endif; ?>
							</div><!-- close .social-icons -->
						</div>
						<div class="clearfix"></div>
						<?php if(get_the_author_meta('description', $agent_id)): ?>
						<div class="agent-bio">
							<p><?php echo get_the_author_meta('description', $agent_id); ?></p>
						</div>
						<?php endif; ?>
						<hr />
					</div>
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
						'paged' => $paged,
						'posts_per_page' => '-1',
						'meta_query' => array(
							array(
								'key' => 'pyre_agent',
								'value' => $agent_id,
								'type' => 'numeric',
								'compare' => '='
							)
						)
					));
					while($properties->have_posts()): $properties->the_post();
					?>
					
					<?php if(get_post_meta(get_the_ID(), 'pyre_no_agent', true)): ?>
					<?php else: ?>
					<?php get_template_part( 'property-listing' );           // Navigation bar (property-listing.php) ?>
					<?php endif; ?>
					<?php endwhile; ?>


					<div class="clearfix"></div>
				</div><!-- close .content-boxed -->

				
				
				<div class="clearfix"></div>
				<?php if($properties->max_num_pages): ?>
				<div class="page-count"><?php _e('Page','progressionstudios'); ?> <?php echo $paged; ?> <?php _e('of','progressionstudios'); ?> <?php echo $properties->max_num_pages; ?></div>
				<?php kriesi_pagination($properties->max_num_pages, $range = 2); ?>
				<?php endif; ?>
				<div class="clearfix"></div>
				
				
				
			</div><!-- close #container-sidebar -->
			<?php wp_reset_query() ?>

<?php include 'sidebar-agents.php'; ?>			
			
			
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>