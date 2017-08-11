<?php

class Armadio_Galery_Admin {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/armadio-galery-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/armadio-galery-admin.js', array( 'jquery' ), $this->version, false );

	}
    
    public function build_admin_menu(){
        add_menu_page( 'Продукти', 'Продукти', 'manage_options', 'products', array( $this, 'settings_product_page' ), '', 4 ); 
    }
    
    public function settings_product_page(){
        ?>
        <div class="wrap">
            <h2><?php echo get_admin_page_title() ?></h2>

            <?php
            // settings_errors() не срабатывает автоматом на страницах отличных от опций
            if( get_current_screen()->parent_base !== 'options-general' )
                settings_errors('название_опции');
            ?>

            <form action="options.php" method="POST">
                <?php
                    settings_fields("opt_group");     // скрытые защитные поля
                    do_settings_sections("opt_page"); // секции с настройками (опциями).
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    
    public function init_post_type(){

        $labels = [
        'name'              => _x('Kitchens', 'taxonomy general name'),
        'singular_name'     => _x('Kitchen', 'taxonomy singular name'),
        'search_items'      => __('Search Kitchens'),
        'all_items'         => __('All Kitchens'),
        'parent_item'       => __('Parent Kitchens'),
        'parent_item_colon' => __('Parent Kitchen:'),
        'edit_item'         => __('Edit Kitchen'),
        'update_item'       => __('Update Kitchen'),
        'add_new_item'      => __('Add New Kitchen'),
        'new_item_name'     => __('New Kitchen Name'),
        'menu_name'         => __('Kitchen'),
        ];
        $args = [
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'course'],
        ];
        register_taxonomy('course', ['post'], $args);
    }
    
    public function galery_option_page(){
        
        add_option('armadio_text_galery_id', 'Текст галереї');

        $this->armadio_admin_edit_text_galery();

    }
    
    public function armadio_admin_edit_text_galery(){
           
        
        if ( isset($_POST['armadio_form_galery_btn']) ) {
            if (function_exists('current_user_can') && !current_user_can('manage_options')){
                die(_e('Hacker?', 'armadio'));
            }
    //        
    //        if (function_exists('check_admin_referer')){
    //            check_admin_referer('armadio_form_galery_form');
    //        }

            $armadio_text_galery_id_uk = $_POST['armadio_text_galery_id_uk'];

            update_option('armadio_text_galery_id_uk', $armadio_text_galery_id_uk);
        }
        
        if (function_exists('wp_nonce_field')){
            wp_nonce_field('armadio_form_galery_form');
        }
        
        require_once plugin_dir_path( __FILE__ ) . 'partials/armadio-galery-view.php';

    }
    
    public function tutsplus_widgets_init() {
 
    // First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Область для галереї', 'tutsplus' ),
        'id' => 'galery-widget-area',
        'description' => __( 'Розміщення галереї в шаблоні galery', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
         
}
 
}
