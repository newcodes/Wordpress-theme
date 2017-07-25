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
    wp_enqueue_script('contact-maps', get_template_directory_uri() . '/lib/contact-maps.js', array( 'jquery' ) );
}


add_action( 'wp_enqueue_scripts', 'armadio_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'armadio_enqueue_scripts' );

function armadio_wp_setup() {
    add_theme_support( 'title-tag' );
    
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true
    ) );
    
    register_nav_menu ('primary', 'Primary menu');
}

add_action( 'after_setup_theme', 'armadio_wp_setup' );

//Налаштування теми

add_action("admin_menu", "add_theme_menu_item");

function add_theme_menu_item(){
	add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

function theme_settings_page(){
    
    ?>
	    <div class="wrap">
	    <h1>Налаштування теми</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
    
}

function display_phone(){
	?>
    	<input type="text" name="phone_number" id="phone_number" value="<?php echo get_option('phone_number'); ?>" />
    <?php
}

add_action("admin_init", "display_theme_panel_fields");

function display_theme_panel_fields(){
	add_settings_section("section", "Всі налаштування", null, "theme-options");
	add_settings_field("phone_number", "Номер телефону", "display_phone", "theme-options", "section");

    register_setting("section", "phone_number");
}


add_action("admin_init", "display_theme_panel_fields");


//Кінець налаштування теми
?>