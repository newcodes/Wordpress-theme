<?php

//Armadio theme options


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
