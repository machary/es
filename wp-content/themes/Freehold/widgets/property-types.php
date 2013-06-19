<?php
add_action('widgets_init', 'pyre_homepage_prop_type_load_widgets');

function pyre_homepage_prop_type_load_widgets()
{
	register_widget('Pyre_Homepage_prop_type_Widget');
}

class pyre_homepage_prop_type_Widget extends WP_Widget {
	
	function pyre_homepage_prop_type_Widget()
	{
		$widget_ops = array('classname' => 'pyre_homepage_prop_type', 'description' => 'List of all Property Types');

		$control_ops = array('id_base' => 'pyre_homepage_prop_type-widget');

		$this->WP_Widget('pyre_homepage_prop_type-widget', 'Freehold: Property Types List', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);


		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>



		<?php
		//list terms in a given taxonomy (useful as a widget for twentyten)
		$taxonomy = 'property_type';
		$tax_terms = get_terms($taxonomy);

		$tax_terms = wp_list_filter($tax_terms, array('slug'=>'featured'),'NOT');
		$tax_terms = wp_list_filter($tax_terms, array('slug'=>'homepage'),'NOT');
		$tax_terms = wp_list_filter($tax_terms, array('slug'=>'widget'),'NOT');
		?>
		
		
		<ul>
		<?php
		foreach ($tax_terms as $tax_term) {
		echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s", "progressionstudios" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
		}
		?>

		</ul>



		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];

		
		return $instance;
	}

	function form($instance)
	{
		
		$defaults = array('title' => 'Property Types');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
	<?php }
}
?>