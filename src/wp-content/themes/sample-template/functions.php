<?php
define('THEME_URI', get_template_directory_uri());
define('THEME_DIR', get_template_directory());
define('DF_IMAGE', THEME_URI. '/assets/images/default/');
define('IMAGE', THEME_URI. '/assets/images/');
define('TP_PART', THEME_DIR. '/template-parts/');

// Local JSON acf
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    $path = get_stylesheet_directory() . '/acf-field';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-field';
    return $paths;
}

// Add file media upload
add_filter( 'upload_mimes', 'my_custom_mime_types' );
function my_custom_mime_types( $mimes ) {
    // New allowed mime types.
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}

// Add file post-thumbnails
add_theme_support( 'post-thumbnails' );

/** ADD CSS AND JS */
function add_style() {
	$date = date('l jS \of F Y h:i:s A');
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style('font', THEME_URI. '/assets/css/font.css');
    wp_enqueue_style('font-awesome5', THEME_URI. '/assets/fonts/fontawesome/css/all.css');
    wp_enqueue_style('bootstrap', THEME_URI. '/assets/css/bootstrap.css');
    wp_enqueue_style('slick', THEME_URI. '/assets/css/slick.css');
    wp_enqueue_style('main', THEME_URI. '/assets/css/main.css');

	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.js', '','' , true);
    wp_enqueue_script( 'bootstrap', THEME_URI. '/assets/js/bootstrap.min.js', '','' , true);
    wp_enqueue_script( 'ajax', THEME_URI. '/assets/js/ajax.js', '','' , true);
    wp_enqueue_script( 'slick', THEME_URI. '/assets/js/slick.min.js', '','' , true);
    wp_enqueue_script( 'main', THEME_URI. '/assets/js/main.js', '','' , true);
    
    wp_localize_script('ajax', 'ajaxData', array('url' => admin_url('admin-ajax.php')));

}
add_action('wp_enqueue_scripts', 'add_style' );

/** include additional php */
require_once(TEMPLATEPATH .'/function/init.php');
require_once(TEMPLATEPATH .'/function/hook-function.php');
require_once(TEMPLATEPATH .'/function/ajax.php');



