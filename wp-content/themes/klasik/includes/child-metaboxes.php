<?php
/********** METABOXES CONFIGURATION *************/
global $meta_boxes;

$optarrange = array(
	'ASC' => 'Ascending',
	'DESC' => 'Descending'
);

$meta_boxes[] = array(
	'id' => 'page-slider-option-meta-box',
	'title' => __('Page Slider Settings','klasik'),
	'page' => 'page',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Enable Slider','klasik'),
			'desc' => '<em>'.__('Tick this checkbox if you want to show the slider.','klasik').'</em>',
			'id' => 'klasik_enable_slider',
			'type' => 'checkbox',
			'std' => ''
		),
		array(
			'name' => __('Slider Category','klasik'),
			'desc' => '<em>'.__('Select the slider category that you want to show.','klasik').'</em>',
			'id' => 'klasik_slider_cat',
			'type' => 'select-slider-category',
			'std' => ''
		),
		array(
			'name' => __('Slider Category','klasik'),
			'desc' => '<em>'.__('Select the slider category that you want to show.','klasik').'</em>',
			'id' => 'klasik_slider_arrange',
			'options' => $optarrange,
			'type' => 'select',
			'std' => 'DESC'
		),
		array(
			'name' => __('Disable Slider Text','klasik'),
			'desc' => '<em>'.__('Tick this checkbox if you want to remove the slider text.','klasik').'</em>',
			'id' => 'klasik_slider_disable_text',
			'type' => 'checkbox',
			'std' => ''
		)
	)
);

$meta_boxes[] = array(
	'id' => 'feature-option-meta-box',
	'title' => __('Feature Item Settings','klasik'),
	'page' => 'feature',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('URL','klasik'),
			'desc' => '<em>'.__('Enter a URL to link the feature post.','klasik').'</em>',
			'id' => 'klasik_link',
			'type' => 'text',
			'std' => ''
		)
	)
);

$meta_boxes[] = array(
	'id' => 'portfolio-option-meta-box',
	'title' => __('Portfolio Item Settings','klasik'),
	'page' => 'portfolio',
	'showbox' => 'meta_option_show_box',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Disable lightbox','klasik'),
			'desc' => '<em>'.__('When checked the image will link to single portfolio page','klasik').'</em>',
			'id' => 'klasik_disable_lightbox',
			'type' => 'checkbox',
			'std' => ''
		),
		array(
			'name' => __('Lightbox URL','klasik'),
			'desc' => '<em>'.__('Enter an optional video or image URL to show in the lighbox.','klasik').'</em>',
			'id' => 'klasik_lightboxurl',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => __('External URL','klasik'),
			'desc' => '<em>'.__('Enter an external URL if you want to redirect this portfolio item to another site.','klasik').'</em>',
			'id' => 'klasik_extlink',
			'type' => 'text',
			'std' => ''
		)
	)
);