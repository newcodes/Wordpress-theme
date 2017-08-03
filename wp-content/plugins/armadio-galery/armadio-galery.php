<?php
/*
Plugin Name: Galery Armadio
Plugin URI:  http://armadio.com.ua
Description: Basic Armdio Galery Plugin
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

function activate_armadio_galery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-armadio-galery-activator.php';
	Armadio_Galery_Activator::activate();
}

function deactivate_armadio_home_page() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-armadio-galery-deactivator.php';
	Armadio_Galery_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_armadio_galery' );
register_deactivation_hook( __FILE__, 'deactivate_armadio_galery' );

require plugin_dir_path( __FILE__ ) . 'includes/class-armadio-galery.php';

function run_armadio_galery() {
	$plugin = new Armadio_Galery();
	$plugin->run();
}

//if (is_admin()) {
//    run_armadio_galery();
//} elseif ( is_page_template('galery.php') ){
//    run_armadio_galery();
//}
//
//run_armadio_galery();