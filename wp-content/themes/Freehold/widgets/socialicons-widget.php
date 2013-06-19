<?php
add_action('widgets_init', 'socialicons_load_widgets');

function socialicons_load_widgets()
{
	register_widget('Socialicons_Widget');
}

class Socialicons_Widget extends WP_Widget {
	
	function Socialicons_Widget()
	{
		$widget_ops = array('classname' => 'socialicons', 'description' => '');

		$control_ops = array('id_base' => 'socialicons-widget');

		$this->WP_Widget('socialicons-widget', 'Freehold: Social Icons', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
		<div class="social-icons-widget">
		<?php if(of_get_option('rss_link')): ?>
		<a class="social-rss" href="<?php echo of_get_option('rss_link'); ?>" target="_blank">r</a>
		<?php endif; ?>
		<?php if(of_get_option('facebook_link')): ?>
		<a class="social-facebook" href="<?php echo of_get_option('facebook_link'); ?>" target="_blank">f</a>
		<?php endif; ?>
		<?php if(of_get_option('twitter_link')): ?>
		<a class="social-twitter" href="<?php echo of_get_option('twitter_link'); ?>" target="_blank">l</a>
		<?php endif; ?>
		<?php if(of_get_option('skype_link')): ?>
		<a class="social-skype" href="<?php echo of_get_option('skype_link'); ?>" target="_blank">h</a>
		<?php endif; ?>
		<?php if(of_get_option('vimeo_link')): ?>
		<a class="social-vimeo" href="<?php echo of_get_option('vimeo_link'); ?>" target="_blank">v</a>
		<?php endif; ?>
		<?php if(of_get_option('linkedin_link')): ?>
		<a class="social-linkedin" href="<?php echo of_get_option('linkedin_link'); ?>" target="_blank">i</a>
		<?php endif; ?>
		<?php if(of_get_option('dribbble_link')): ?>
		<a class="social-dribbble" href="<?php echo of_get_option('dribbble_link'); ?>" target="_blank">d</a>
		<?php endif; ?>
		<?php if(of_get_option('forrst_link')): ?>
		<a class="social-forrst" href="<?php echo of_get_option('forrst_link'); ?>" target="_blank">forrst</a>
		<?php endif; ?>
		<?php if(of_get_option('flickr_link')): ?>
		<a class="social-flickr" href="<?php echo of_get_option('flickr_link'); ?>" target="_blank">n</a>
		<?php endif; ?>
		<?php if(of_get_option('google_link')): ?>
		<a class="social-google" href="<?php echo of_get_option('google_link'); ?>" target="_blank">g</a>
		<?php endif; ?>
		
		<?php if(of_get_option('youtube_link')): ?>
		<a href="<?php echo of_get_option('youtube_link'); ?>" target="_blank" class="social-youtube">youtube</a>
		<?php endif; ?>
		
		<div class="clearfix"></div>
		</div>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Social Icons');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php
	}
}
?>