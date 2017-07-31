<?php

function armadio_enqueue_styles() {
    wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
	wp_enqueue_style( 'armadio-style', get_stylesheet_uri(), $dependencies );
}

function armadio_enqueue_scripts() {
    
    $dependencies = array('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri().'/lib/jquery-3.2.1.min.js', '', true );
    wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', $dependencies, true );
    
    wp_enqueue_script('contact-maps', get_template_directory_uri() . '/js/contact-maps.js');
    
    wp_deregister_script( 'common' );
    wp_register_script('common', get_template_directory_uri().'/lib/js/common.js', $dependencies);
    wp_enqueue_script('common');
    
   
}



add_action( 'wp_enqueue_scripts', 'armadio_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'armadio_enqueue_scripts' );

function load_fonts(){
    wp_register_style('et-googleFonts', 'https://fonts.googleapis.com/css?family=Exo:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=latin-ext');
    wp_enqueue_style( 'et-googleFonts');
}

add_action('wp_print_styles', 'load_fonts');
include_once( get_template_directory() . '/lib/classes/armadio_menu.php' );

add_filter( 'locale', 'armadio_localized' );
function armadio_localized( $locale )
{
	if ( isset( $_GET['l'] ) )
	{
		return sanitize_key( $_GET['l'] );
	}

	return $locale;
}

function armadio_wp_setup() {
    add_theme_support( 'title-tag' );
    
    add_theme_support('widgets');
    
    load_theme_textdomain( 'armadio', get_template_directory() . '/languages' );
    
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true
    ) );
    
    register_nav_menu( 'primary', __( 'Primary Menu', 'armadio' ) );
    
}

add_action( 'after_setup_theme', 'armadio_wp_setup' );

// Load up our theme options page and related code.
require( get_template_directory() . '/inc/theme-options.php' );

// Регістрація віджетів

function register_widgets_init() {

	register_sidebar( array(
		'name'          => 'area_to_slider',
		'id'            => 'armadio_slider',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'register_widgets_init' );

require_once( get_template_directory() . "/lib/classes/armadio_menu.php");

//checking is mobile

function isMobile(){
   $useragent=$_SERVER['HTTP_USER_AGENT'];

if( wp_is_mobile() ){
    return true;
}else {
    return false;
}
}

?>