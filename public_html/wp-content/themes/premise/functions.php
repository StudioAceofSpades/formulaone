<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

load_theme_textdomain('carrington-jam');

define('CFCT_DEBUG', false);
define('CFCT_PATH', trailingslashit(TEMPLATEPATH));

include_once(CFCT_PATH.'carrington-core/carrington.php');
include_once(CFCT_PATH.'functions/sidebars.php');

// Load our scripts
function saos_load_scripts() {
    wp_deregister_script('jquery');
    
    wp_enqueue_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", false, null);
    wp_enqueue_script('plugins', get_stylesheet_directory_uri().'/js/plugins.js', false, null);
    wp_enqueue_script('scripts', get_stylesheet_directory_uri().'/js/script.js', false, null);
    wp_enqueue_script('dealer', get_stylesheet_directory_uri().'/js/map.js', false, null);
    wp_enqueue_script('configurator', get_stylesheet_directory_uri().'/js/configurator.js', false, null);
    wp_enqueue_script('icons', 'https://kit.fontawesome.com/993c45b2e6.js', false, null);
    wp_enqueue_script('maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDtLKByGuUmy21VNhUjIQqAMyblIJlLad0&libraries=places,geometry', false, null);

    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap', array(), false, 'all');

    if(ENVIRONMENT == "development") {
        wp_enqueue_style('main', get_stylesheet_directory_uri().'/devcss/style.css', array(), false, 'all');
    } else {
        wp_enqueue_style('main', get_stylesheet_directory_uri().'/style.css', array(), false, 'all');
    }
    
    if ( is_singular('post') ) { 
      wp_enqueue_script( 'comment-reply' ); 
    }
} add_action( 'wp_enqueue_scripts', 'saos_load_scripts' );

// Add support for featured images
add_theme_support( 'post-thumbnails' );
add_image_size('excerpt', 900, 550, true);
add_image_size('trailer-small', 600, 600, false);
add_image_size('option', 400, 400, true);
add_image_size('hero', 1920, 490, true);

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
} add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function remove_embedded_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
} add_action('wp_enqueue_scripts', 'remove_embedded_style');

// Remove the REST API endpoint.
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
 
// Turn off oEmbed auto discovery.
add_filter( 'embed_oembed_discover', '__return_false' );
 
// Don't filter oEmbed results.
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
 
// Remove oEmbed discovery links.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
 
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

// Prevent BWP from minifying for admin users
add_filter("bwp_minify_is_loadable", "no_logged_in_minify");

function no_logged_in_minify($loadable) {
    if(is_user_logged_in() && !is_admin()) {
        $loadable = false;
    }   
    return $loadable;
}

function clever_debug($object = null) {
	if($object === null) {
		$object = debug_backtrace();
	}
    echo "<script>";
    echo "window.debug_message = window.debug_message || [];";
    echo "window.debug_message.push(" . json_encode($object) . ")";
    echo "</script>";
}

if(function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'    => 'Global Theme Settings',
        'menu_title'    => 'Site Settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header & Navigation',
        'parent_slug'   => 'acf-options-site-settings'
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'acf-options-site-settings'
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Blog Settings',
        'menu_title'    => 'Blog',
        'parent_slug'   => 'acf-options-site-settings'
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Configurator Settings',
        'menu_title'    => 'Configurator',
        'parent_slug'   => 'acf-options-site-settings'
    ));
}

function saos_configure_link($link) {
	 
	if(!isset($link)) {
		return false;
	}
 
	if(!isset($link['url']) || $link['url'] == '') {
		return false;
	}
 
	if($link['url'] == '#' && $link['title'] == '') {
		return false;
	}
	if($link['title'] == '' && $link['url'] == '') {
		return false;
	}

	if($link['title'] == '') {
		$post_id = url_to_postid($link['url']);
		$link['title'] = get_the_title($post_id);
	}

    return $link;
}

function saos_output_link($link, $classes="") {
	$link = saos_configure_link($link);
	if($link) {
		echo '<a class="'.$classes.'" href="'.$link['url'].'" target="'.$link['target'].'">'.$link['title'].'</a>';
	}
}

function cptui_register_my_cpts_trailer() {

	/**
	 * Post Type: Trailers.
	 */

	$labels = [
		"name" => __( "Trailers", "custom-post-type-ui" ),
		"singular_name" => __( "Trailer", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Trailers", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "trailer", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "trailer", $args );
}

add_action( 'init', 'cptui_register_my_cpts_trailer' );

function cptui_register_my_taxes_lifestyle() {

	/**
	 * Taxonomy: Lifestyles.
	 */

	$labels = [
		"name" => __( "Lifestyles", "custom-post-type-ui" ),
		"singular_name" => __( "Lifestyle", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => __( "Lifestyles", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'lifestyle', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "lifestyle",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "lifestyle", [ "trailer" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_lifestyle' );

function cptui_register_my_cpts_dealer() {

	/**
	 * Post Type: Dealer.
	 */

	$labels = [
		"name" => __( "Dealer", "custom-post-type-ui" ),
		"singular_name" => __( "Dealers", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Dealer", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "dealer", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "dealer", $args );
}

add_action( 'init', 'cptui_register_my_cpts_dealer' );

function cptui_register_my_cpts_configurations() {

	/**
	 * Post Type: Configurations.
	 */

	$labels = [
		"name" => __( "Configurations", "custom-post-type-ui" ),
		"singular_name" => __( "Configuration", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Configurations", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "configurations", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "configurations", $args );
}

add_action( 'init', 'cptui_register_my_cpts_configurations' );


function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyDtLKByGuUmy21VNhUjIQqAMyblIJlLad0';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function create_bg($term = '') {
    if($term == 'options') {
        $bg_type = get_field('video_hero_background_image_or_video', $term);
        $background = array();
        if ($bg_type == 'video') {
            $video_group = get_field('video_hero_background_video', $term);
            $background['mp4'] = $video_group['mp4'];
            $background['webm'] = $video_group['webm'];
            $background['cover'] = $video_group['cover_image'];
        } else {
            $background['image'] = get_field('video_hero_background_image', $term);
        }
    } else {
        $bg_type = get_field('background_image_or_video', $term);
        $background = array();
        if ($bg_type == 'video') {
            $video_group = get_field('background_video', $term);
            $background['mp4'] = $video_group['mp4'];
            $background['webm'] = $video_group['webm'];
            $background['cover'] = $video_group['cover_image'];
        } else {
            $background['image'] = get_field('background_image', $term);
        }
    }
    return $background;
}

function cptui_register_my_cpts_package() {

	/**
	 * Post Type: Packages.
	 */

	$labels = [
		"name" => __( "Packages", "custom-post-type-ui" ),
		"singular_name" => __( "Package", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Packages", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "package", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "package", $args );
}

add_action( 'init', 'cptui_register_my_cpts_package' );

function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_tag()) && 'post' == get_post_type();
}

function slugify($text, string $divider = '-') {
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

?>
