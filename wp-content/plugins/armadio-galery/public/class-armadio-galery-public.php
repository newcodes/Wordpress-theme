<?php

class Armadio_Galery_Public {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/armadio-galery-public.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/armadio-galery-public.js', array( 'jquery' ), $this->version, false );

	}
    
    public function show_galery(){
        $text = $_POST['armadio_text_galery_id_uk'];
//        require_once get_template_directory() . '/galery.php';
//        require_once plugin_dir_path( __FILE__ ) . 'partials/armadio-galery-view-public.php';
    }

}
