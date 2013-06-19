<?php
// Template Name: Agents
get_header(); ?>
	<div id="main">
		<div class="width-container">

			<div id="container-sidebar">
				<div class="content-boxed">
					
					<?php while(have_posts()): the_post(); ?>
					<h2 class="title-bg"><?php the_title(); ?></h2>
					<div <?php post_class(); ?>>
						
						<?php the_content(); ?>
												
						<div class="clearfix"></div>
						
					</div><!-- close .type-post -->
					
					
					<?php the_tags('<div class="share-section">
						<div class="tags">Tags: </div>', ', ', '<div class="clearfix"></div>
					</div>'); ?>
					<?php endwhile; ?>

				<div class="clearfix"></div>

					<?php
					$agents = freehold_all_authors();
					foreach($agents as $agent_id => $agent):
					?>
					<?php
					$agent_info = get_userdata($agent_id);
					?>
					<div class="agent-post <?php echo $agent_info->display_name; ?>">
						<div class="agent-thumb">
							<a href="<?php echo get_author_posts_url($agent_id); ?>"><?php echo get_avatar($agent_id, 150
							); ?></a>
						</div>
						<div class="agent-details">
							<h5><a href="<?php echo get_author_posts_url($agent_id); ?>"><?php echo $agent_info->display_name; ?></a></h5>
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
						<hr />
					</div>

					<?php endforeach; ?>
				</div><!-- close .content-boxed -->
				
				
				<div class="clearfix"></div>
				
				
				
			</div><!-- close #container-sidebar -->



			<?php include 'sidebar-agents.php'; ?>	
			
			
			
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>