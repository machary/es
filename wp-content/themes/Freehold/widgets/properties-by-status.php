<?php
add_action('widgets_init', 'pyre_properties_status_widgets');

function pyre_properties_status_widgets()
{
	register_widget('Pyre_Properties_Status_Widget');
}

class Pyre_Properties_Status_Widget extends WP_Widget {
	
	function Pyre_Properties_Status_Widget()
	{
		$widget_ops = array('classname' => 'properties_status-widget', 'description' => 'Properties by Status');

		$control_ops = array('id_base' => 'properties_status-widget');

		$this->WP_Widget('properties_status-widget', 'Freehold: Properties by Status', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$title = $instance['title'];
		$posts = $instance['posts'];
		$status = $instance['status'];
		
		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		}
		?>
		


		<?php
		$args = array(
			'post_type' => 'property',
			'posts_per_page' => $posts,
		);
		$args['meta_query'][] = array(
			'key' => 'pyre_status',
			'value' => $status,
		);
		$loop = new WP_Query( $args );
		 ?>
		 <ul class="widget-listings">
		<?php while ( $loop->have_posts() ) : $loop->the_post();
		 ?>
					<li>
						<a href="<?php the_permalink(); ?>">
						<div class="property-thumbnail">
							<?php the_post_thumbnail('widget-thumb'); ?>
						</div>
						<div class="property-meta">
							<div class="listings-address-widget"><?php echo get_post_meta(get_the_ID(), 'pyre_address', true); ?></div>
							<?php if(get_post_meta(get_the_ID(), 'pyre_city', true) && get_post_meta(get_the_ID(), 'pyre_state', true) && get_post_meta(get_the_ID(), 'pyre_zip', true)): ?>
							<div class="listings-street-widget"><?php echo get_post_meta(get_the_ID(), 'pyre_city', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_state', true); ?>, <?php echo get_post_meta(get_the_ID(), 'pyre_zip', true); ?></div>
							<?php endif; ?>
							<?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'Call For Price'): ?>
							<div class="listings-price-widget"><?php _e('Call For Price','progressionstudios'); ?></div>
							<?php else: ?>
							<?php if(get_post_meta(get_the_ID(), 'pyre_price', true)): ?>
							<div class="listings-price-widget"><?php echo of_get_option('currency_text_opt', '$'); ?><?php echo number_format(get_post_meta(get_the_ID(), 'pyre_price', true)); ?><?php if(get_post_meta(get_the_ID(), 'pyre_status', true) == 'For Rent'): ?><?php _e('/month','progressionstudios'); ?><?php endif; ?></div>
							<?php endif; ?>
							<?php endif; ?>
						</div>
						<div class="clearfix"></div>
						</a>
					</li>
		<?php endwhile; ?>
		</ul>
		
		<div class="clearfix"></div>
		
		
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['posts'] = $new_instance['posts'];
		$instance['status'] = $new_instance['status'];

		return $instance;
	}

	function form($instance)
	{
		
		$defaults = array('title' => 'Properties by status', 'posts' => 4, 'status' => 'For Rent');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('status'); ?>">Status:</label> 
			<select id="<?php echo $this->get_field_id('status'); ?>" name="<?php echo $this->get_field_name('status'); ?>" class="widefat categories" style="width:100%;">
				<option value='For Rent' <?php if ('For Rent' == $instance['status']) echo 'selected="selected"'; ?>>For Rent</option>
				<option value='For Sale' <?php if ('For Sale' == $instance['status']) echo 'selected="selected"'; ?>>For Sale</option>
				<option value='Open House' <?php if ('Open House' == $instance['status']) echo 'selected="selected"'; ?>>Open House</option>
				<option value='Call For Price' <?php if ('Call For Price' == $instance['status']) echo 'selected="selected"'; ?>>Call For Price</option>
			</select>
		</p>
	<?php }
}
?>