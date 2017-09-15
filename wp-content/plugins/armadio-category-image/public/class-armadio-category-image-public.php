<?php

class Armadio_Category_Image_Public {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	public function enqueue_styles() {

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/armadio-category-image-public.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/armadio-category-image-public.js', array( 'jquery' ), $this->version, false );

	}
    
    public function show_galery(){
//        require_once get_template_directory() . '/galery.php';
//        require_once plugin_dir_path( __FILE__ ) . 'partials/armadio-galery-view-public.php';
    }

}
