<?php
add_action('widgets_init', 'location_load_widgets');

function location_load_widgets()
{
	register_widget('Location_Widget');
}

class Location_Widget extends WP_Widget {
	
	function Location_Widget()
	{
		$widget_ops = array('classname' => 'location', 'description' => 'Location & address.');

		$control_ops = array('id_base' => 'location-widget');

		$this->WP_Widget('location-widget', 'Freehold: Contact', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$address = $instance['address'];
		$phone = $instance['phone'];
		$int_phone = $instance['int_phone'];
		$email = $instance['email'];

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
		<div class="location-widget">
			<?php if($address): ?>
			<span>Location</span>: <?php echo $address; ?><br>
			<?php endif; ?>
			<?php if($phone): ?>
			<span>Phone</span>: <?php echo $phone; ?><br>
			<?php endif; ?>
			<?php if($int_phone): ?>
			<span>Mobile</span>: <?php echo $int_phone; ?><br>
			<?php endif; ?>
			<?php if($email): ?>
			<span>Email</span>: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
			<?php endif; ?>
		</div>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['int_phone'] = $new_instance['int_phone'];
		$instance['email'] = $new_instance['email'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Location', 'address' => '', 'phone' => '', 'int_phone' => '', 'email' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>">Address:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>">Phone:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $instance['phone']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('int_phone'); ?>">Mobile:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('int_phone'); ?>" name="<?php echo $this->get_field_name('int_phone'); ?>" value="<?php echo $instance['int_phone']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">Email Address:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
		</p>
		
	<?php
	}
}
?>