<?php

function armadio_enqueue_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
	wp_enqueue_style( 'armadio-style', get_stylesheet_uri(), $dependencies ); 
}

function armadio_enqueue_scripts() {
    $dependencies = array('jquery', 'tether');
    wp_enqueue_script('jquery', get_template_directory_uri().'/lib/jquery-3.2.1.min.js', '', true );
    wp_enqueue_script('tether', get_template_directory_uri().'/lib/bootstrap/js/tether.min.js', '', true );
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/lib/bootstrap/js/bootstrap.min.js', $dependencies, '', true );
}

add_action( 'wp_enqueue_scripts', 'armadio_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'armadio_enqueue_scripts' );

function armadio_wp_setup() {
    add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'armadio_wp_setup' );
?>