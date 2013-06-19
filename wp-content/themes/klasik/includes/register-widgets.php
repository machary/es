<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */


include_once (get_template_directory() . '/includes/widgets/klasik-recent-comment.php');
include_once (get_template_directory() . '/includes/widgets/klasik-recent-posts.php');

add_action("widgets_init", "load_klasik_widgets");

function load_klasik_widgets() {
	register_widget("Klasik_RecentCommentWidget");
	register_widget("Klasik_RecentPostWidget");
}