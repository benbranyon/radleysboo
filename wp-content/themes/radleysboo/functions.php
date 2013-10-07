<?php

function my_init() {

}

add_action('init', 'my_init');

function enque_scripts() {
	if (!is_admin()) {
		wp_enqueue_script('jquery');

		wp_enqueue_script('bootstrap', get_bloginfo('template_url') . '/js/libs/bootstrap.js', array('jquery'), '1.0', true);
		wp_enqueue_script('easing', get_bloginfo('template_url') . '/js/libs/jquery.easing.min.js', array('jquery'), '1.0', true);
		if ( is_front_page() ) {
			wp_enqueue_script('supersized', get_bloginfo('template_url') . '/js/libs/supersized.3.2.7.min.js', array('jquery'), '1.0', true);
		}
		wp_enqueue_script('isotope', get_bloginfo('template_url') . '/js/libs/masonry.pkgd.min.js', array('jquery'), '1.0', true);
	}	
}

add_action('wp_enqueue_scripts', 'enque_scripts');

function radleysboo_setup() {

	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));

	add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));

	add_theme_support('post-thumbnails');
	
	register_nav_menu('primary', __('Navigation Menu', 'radleysboo'));
}

add_action('after_setup_theme', 'radleysboo_setup');

function hide_admin_bar_from_front_end(){
  if (is_blog_admin()) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );

function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
  	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];
	
	if(empty($first_img)) {
		$first_img = "/path/to/default.png";
	}
	return $first_img;
}

