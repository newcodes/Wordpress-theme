<?php


class Armadio_Category_Image {


	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {

		$this->plugin_name = 'armadio-category-image';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-armadio-category-image-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-armadio-category-image-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-armadio-category-image-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-armadio-category-image-public.php';

		$this->loader = new Armadio_Category_Image_Loader();

	}

	private function set_locale() {

		$plugin_i18n = new Armadio_Category_Image_i18n();
		
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function define_admin_hooks() {

		$plugin_admin = new Armadio_Category_Image_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'category_add_form_fields', $plugin_admin, 'add_category_image');
		$this->loader->add_action( 'created_category', $plugin_admin, 'save_category_image');
		$this->loader->add_action( 'category_edit_form_fields', $plugin_admin, 'update_category_image');
		$this->loader->add_action( 'edited_category', $plugin_admin, 'updated_category_image');

		$this->loader->add_action( 'category_add_form_fields', $plugin_admin, 'add_category_short_description');
		$this->loader->add_action( 'created_category', $plugin_admin, 'save_category_short_description');
		$this->loader->add_action( 'category_edit_form_fields', $plugin_admin, 'update_category_short_description');
		$this->loader->add_action( 'edited_category', $plugin_admin, 'updated_category_short_description');
	}

	private function define_public_hooks() {

		$plugin_public = new Armadio_Category_Image_Public( $this->get_plugin_name(), $this->get_version() );

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
