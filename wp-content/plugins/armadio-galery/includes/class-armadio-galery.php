<?php


class Armadio_Galery {


	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {

		$this->plugin_name = 'armadio-galery';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-armadio-galery-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-armadio-galery-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-armadio-galery-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-armadio-galery-public.php';

		$this->loader = new Armadio_Galery_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new Armadio_Galery_i18n();
		
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Armadio_Galery_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'build_form_text_galery');
		$this->loader->add_action( 'widgets_init', $plugin_admin, 'tutsplus_widgets_init');
	}

	private function define_public_hooks() {

		$plugin_public = new Armadio_Galery_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'show_galery');

	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
