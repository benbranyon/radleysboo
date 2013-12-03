<?php

function my_init() {

}

add_action('init', 'my_init');

function enque_scripts() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		//wp_register_script();
		wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3');

		wp_enqueue_script('bootstrap', get_bloginfo('template_url') . '/js/libs/bootstrap.min.js', array('jquery'), '1.0', true);
		if ( is_front_page() ) {
			wp_enqueue_script('supersized', get_bloginfo('template_url') . '/js/libs/supersized.3.2.7.min.js', array('jquery'), '1.0', true);
		}
		else
		{
			wp_enqueue_script('easing', get_bloginfo('template_url') . '/js/libs/jquery.easing.min.js', array('jquery'), '1.0', true);
			wp_enqueue_script( 'imagesLoaded', get_template_directory_uri(). '/js/libs/imagesloaded.pkgd.min.js', array('jquery'), '', true);
			wp_enqueue_script('masonry', get_bloginfo('template_url') . '/js/libs/masonry.pkgd.min.js', array('jquery'), '1.0', true);
			wp_enqueue_script('mosaic', get_bloginfo('template_url') . '/js/libs/mosaic.1.0.1.min.js', array('jquery'), '1.0', true);
		}
	}	
}

add_action('wp_enqueue_scripts', 'enque_scripts');

function radleysboo_styles() {
	if(!is_admin()) {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/libs/bootstrap.min.css');
		wp_enqueue_style( 'mosaic', get_template_directory_uri() . '/css/libs/mosaic.css');
		if( is_front_page() ) {
			wp_enqueue_style( 'supersized', get_Template_directory_uri() . '/css/libs/supersized.css');
		}
		wp_enqueue_style( 'radleysboo', get_Template_directory_uri() . '/css/radleysboo.css');
	}
}

add_action( 'wp_enqueue_scripts', 'radleysboo_styles' );

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

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="fb:admins" content="1843534856"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Radley\'s Boo Photography"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://example.com/image.jpg"; 
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

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

// Create a new filtering function that will add our where clause to the query
function my_portfolio_post_filter( $where = '' ) {
    // Make sure this only applies to loops / feeds on the frontend
    if (!is_single() && !is_admin() && is_page( array( '43', 'portfolios', 'Portfolios' ) )) {
        // exclude password protected
        $where .= " AND post_password = ''";
    }

    return $where;
}

add_filter( 'posts_where', 'my_portfolio_post_filter' );

function the_title_trim($title) {
    $title = attribute_escape($title);
    $findthese = array(
        '#Protected:#',
        '#Private:#'
    );
    $replacewith = array(
        '', // What to replace "Protected:" with
        '' // What to replace "Private:" with
    );
    $title = preg_replace($findthese, $replacewith, $title);
    return $title;
}
add_filter('the_title', 'the_title_trim');


