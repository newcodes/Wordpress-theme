<?php
/*
Plugin Name: Armadio Category Image
Plugin URI:  http://armadio.com.ua
Description: Add image to categories
Version:     1
Author:      chelowe4ok.com.ua
Author URI:  http://armadio.com.ua/
Text Domain: armadio
Domain Path: /languages
License:     GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_armadio_category_image() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-armadio-category-image-activator.php';
	Armadio_Category_Image_Activator::activate();
}

function deactivate_armadio_category_image() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-armadio-category-image-deactivator.php';
	Armadio_Category_Image_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_armadio_category_image' );
register_deactivation_hook( __FILE__, 'deactivate_armadio_category_image' );

require plugin_dir_path( __FILE__ ) . 'includes/class-armadio-category-image.php';

function run_armadio_category_image() {
	$plugin = new Armadio_Category_Image();
	$plugin->run();
}

run_armadio_category_image();