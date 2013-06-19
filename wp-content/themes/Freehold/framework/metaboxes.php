<?php

class PyreThemeFrameworkMetaboxes {
	
	public function __construct()
	{
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('save_post', array($this, 'save_meta_boxes'));
	}
	
	public function add_meta_boxes()
	{
		$this->add_meta_box('post_options', 'Post Options', 'post');
		$this->add_meta_box('page_options', 'Page Options', 'page');
		$this->add_meta_box('contact_options', 'Contact Form Options', 'page');
		$this->add_meta_box('portfolio_options', 'Portfolio Options', 'portfolio');
		$this->add_meta_box('property_options', 'Property Options', 'property');
		$this->add_meta_box('slider_options', 'Slider Options', 'property');
		//$this->add_meta_box('team_options', 'Team Options', 'team');
	}
	
	public function add_meta_box($id, $label, $post_type)
	{
	    add_meta_box( 
	        'pyre_' . $id,
	        __($label),
	        array($this, $id),
	        $post_type
	    );
	}
	
	public function save_meta_boxes($post_id)
	{

		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
	
		//Portfolio, Post, and Page Wraps to Prevent WooCommerce Forcing Data Save
		if ( 'page' == $_POST['post_type'] || 'property' == $_POST['post_type'] || 'portfolio' == $_POST['post_type'] || 'post' == $_POST['post_type']  ) 
		
		{
			foreach($_POST as $key => $value) {
    			update_post_meta($post_id, $key, $value);
		}
	
	}
	
	}
	
	public function post_options()
	{	
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/post_options.php';
	}
	
	public function page_options()
	{	
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/page_options.php';
	}

	public function contact_options()
	{	
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/contact_options.php';
	}
	public function slider_options()
	{	
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/slider_options.php';
	}
	
	public function portfolio_options()
	{	
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/portfolio_options.php';
	}

	public function property_options()
	{	
		include 'views/metaboxes/style.php';
		include 'views/metaboxes/property_options.php';
	}
	
	public function text($id, $label, $desc, $html = '')
	{
		global $post;
		
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<input type="text" id="pyre_' . $id . '" name="pyre_' . $id . '" value="' . get_post_meta($post->ID, 'pyre_' . $id, true) . '" />';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function textarea($id, $label, $desc, $html = '')
	{
		global $post;
		
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<textarea id="pyre_' . $id . '" name="pyre_' . $id . '" cols="110" rows="5">' . get_post_meta($post->ID, 'pyre_' . $id, true)  . '</textarea>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	public function select($id, $label, $options, $desc, $html = '')
	{
		global $post;
		
		$html .= '<div class="pyre_metabox_field">';
			$html .= '<label for="pyre_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<select id="pyre_' . $id . '" name="pyre_' . $id . '">';
				foreach($options as $key => $option) {
					if(get_post_meta($post->ID, 'pyre_' . $id, true) == $key) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}
					
					$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
				}
				$html .= '</select>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
}

$metaboxes = new PyreThemeFrameworkMetaboxes;