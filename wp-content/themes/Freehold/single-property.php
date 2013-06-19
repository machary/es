<?php
get_header(); ?>
	<div id="main">
		<div class="width-container">
			<?php if(of_get_option('property_single_sidebar', 'no') == 'no'): ?><div id="container-sidebar"><?php endif; ?>
					<?php
					while(have_posts()): the_post();
					?>
					<div class="content-boxed">
					<h2 class="title-bg">
						<?php the_title(); ?>
						
						<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Call For Price'): ?>
						<span><?php _e('Call For Price','progressionstudios'); ?></span>
						<?php else: ?>
						<?php if(get_post_meta(get_the_ID(), 'pyre_price', true)): ?>
						<span><?php echo of_get_option('currency_text_opt', '$'); ?><?php echo number_format(get_post_meta(get_the_ID(), 'pyre_price', true)); ?><?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'For Rent'): ?><?php _e('/month','progressionstudios'); ?><?php endif; ?></span>
						<?php endif; ?>
						<?php endif; ?>
					</h2>
					
					
					
					
					<?php
					$args = array(
					    'post_type' => 'attachment',
					    'numberposts' => '-1',
					    'post_status' => null,
					    'post_parent' => get_the_ID(),
						'orderby' => 'menu_order',
						'order' => 'ASC',
					);
					$attachments = get_posts($args);
					if($attachments):
					?>
					<div class="property-listing-single">
						
						
						
						
						
						<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Open House'): ?><div class="notification-listing <?php echo get_post_meta(get_the_ID(), 'pyre_status', true); ?>"><?php _e('Open House','progressionstudios'); ?></div><?php endif; ?>

						<div id="property-single-slider">
						<div id="slider" class="flexslider">
				          <ul class="slides">
					
								<?php if(get_post_meta($post->ID, 'pyre_video_embed_code', true)): ?>
							    		<li>
										<?php
										$video = get_post_meta($post->ID, 'pyre_video_embed_code', true);
										$pattern = "/height=\"[0-9]*\"/";
										$video = preg_replace($pattern, "height='281'", $video);
										$pattern = "/width=\"[0-9]*\"/";
										$video = preg_replace($pattern, "width='500'", $video);
										?>
										<div class="portfolio-product-single">
											<?php echo $video; ?>
										</div>
										</li>
								<?php endif; ?>
					
					
					
				          	<?php foreach($attachments as $attachment): ?>
							<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
							<?php $attachment_image2 = wp_get_attachment_image_src($attachment->ID, 'property-main'); ?>
				
							<?php if(get_post_meta($post->ID, 'pyre_video_embed_code2', true)): ?>
						    		<li><?php
									$video = get_post_meta($post->ID, 'pyre_video_embed_code2', true);
									$pattern = "/height=\"[0-9]*\"/";
									$video = preg_replace($pattern, "height='281'", $video);
									$pattern = "/width=\"[0-9]*\"/";
									$video = preg_replace($pattern, "width='500'", $video);
									?>
									<div class="portfolio-product-single">
										<?php echo $video; ?>
									</div></li>
							<?php else: ?>
							<li>
				  	    	    <a href="<?php echo $attachment_image[0]; ?>" rel="prettyPhoto[gallery]">
									<img src="<?php echo $attachment_image2[0]; ?>" />
								</a>
				  	    	</li>
					<?php endif; ?>
				
				
				  	    	<?php endforeach; ?>
				
							
				          </ul>
				        </div>
						
						<?php if(get_post_meta($post->ID, 'pyre_video_embed_code2', true)): ?>
							<?php else: ?>
						<?php if(count($attachments) > 1): ?>
						<div id="carousel" class="flexslider">
				          <ul class="slides">
					
									<?php if(get_post_meta($post->ID, 'pyre_video_embed_code', true)): ?>
								    		<li><img src="<?php echo of_get_option('fall_back_video_image', get_template_directory_uri() . '/images/fall-back-video.png'); ?>" style="width:145px;" /></li>
									<?php endif; ?>
									
				          	<?php foreach($attachments as $attachment): ?>
							<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, 'property-thumb'); ?>
				            <li>
									<img src="<?php echo $attachment_image[0]; ?>" style="width:145px;" />
				  	    	</li>
				  	    	<?php endforeach; ?>
				          </ul>
				        </div>
				    	<?php endif; ?>
				<?php endif; ?>
						</div>
						<div class="clearfix"></div>
						<script type="text/javascript">
						jQuery(document).ready(function($) {
						    $(window).load(function(){
						      $('#carousel').flexslider({
						        animation: "slide",
						        controlNav: false,
						        animationLoop: false,
						        slideshow: false,
						        itemWidth: 145,
						        itemMargin: 15,
						        asNavFor: '#slider'
						      });

						      $('#slider').flexslider({
						        animation: "<?php echo of_get_option('animation_real_estate', 'fade'); ?>",
						        controlNav: false,
						        animationLoop: false,
						        slideshow: <?php echo of_get_option('autoplay_real_estate', false); ?>,
						slideshowSpeed: <?php echo of_get_option('transition_real_estate', 7000); ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
						        sync: "#carousel",
						        start: function(slider){
						          $('body').removeClass('loading');
						        }
						      });
						    });
						});
						</script>
						
						
					</div>
					<?php endif; ?>
					
					
					<div class="slider-spacer"></div>

					<?php the_content(); ?>

					<div class="clearfix"></div>

					<div class="share-section-listing">
						<span class="share-text"><?php _e('Share this','progressionstudios'); ?>:</span>
						<script type="text/javascript">var switchTo5x=true;</script>
						<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
						<script type="text/javascript">stLight.options({publisher: "b779a7d6-8947-431e-8a89-abe575e1b4b0"}); </script>
						<span class='st_facebook' displayText='Facebook'></span>
						<span class='st_twitter' displayText='Tweet'></span>
						<span class='st_pinterest' displayText='Pinterest'></span>
						<span class='st_email' displayText='Email'></span>
						<span class="st_print"><a href="javascript:window.print()">Print</a></span>
						<div class="clearfix"></div>
					</div>

					<div class="clearfix"></div>
				</div><!-- close .content-boxed -->
				
				
				
<?php if(get_post_meta(get_the_ID(), 'pyre_no_agent', true)): ?>
				

			
<?php else: ?>
			
				
				<?php if(get_post_meta(get_the_ID(), 'pyre_agent', true)): ?>
				<br>
			
				<div class="content-boxed">
					<h2 class="title-bg"><?php _e('Agent Information','progressionstudios'); ?></h2>
					
					
					<?php
					$agent_id = get_post_meta(get_the_ID(), 'pyre_agent', true);
					$agent_info = get_userdata($agent_id);
					?>
					<div class="agent-post">
						<div class="agent-thumb">
							<a href="<?php echo get_author_posts_url($agent_id); ?>"><?php echo get_avatar($agent_id, 125
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
					</div>





				<div class="clearfix"></div>
				</div><!-- close .content-boxed -->
				<?php endif; ?>
				
					<?php endif; ?>
				
				
					<?php endwhile; ?>


			
			
		
				
				
				<div class="clearfix"></div>
				<?php if($wp_query->max_num_pages): ?>
				<div class="page-count">Page <?php echo $paged; ?> of <?php echo $wp_query->max_num_pages; ?></div>
				<?php kriesi_pagination($properties->max_num_pages, $range = 2); ?>
				<?php endif; ?>
				<div class="clearfix"></div>
				
				
				
<?php if(of_get_option('property_single_sidebar', 'no') == 'no'): ?></div><!-- close #container-sidebar --><?php endif; ?>
			
		<?php if(of_get_option('property_single_sidebar', 'no') == 'no'): ?>	<?php include 'sidebar-listing.php'; ?>	<?php endif; ?>
			
			
			
		<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #main -->
<?php get_footer(); ?>