<?php

function armadio_enqueue_styles() {
    wp_register_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
	wp_enqueue_style( 'armadio-style', get_stylesheet_uri(), $dependencies );
    
    if ( is_page_template('galery.php') ){
        wp_enqueue_style( 'galery_css',  get_template_directory_uri() . '/lib/css/newGalery.css', $dependencies );
    }
}

function armadio_enqueue_scripts() {
    
    $dependencies = array('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri().'/lib/jquery-3.2.1.min.js', '', true );
    wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', $dependencies, true );
    
    wp_enqueue_script('contact-maps', get_template_directory_uri() . '/js/contact-maps.js');
    
    if ( is_page_template('galery.php') ){
        wp_deregister_script( 'newGgalery' );
        wp_register_script('newGalery', get_template_directory_uri().'/lib/js/newGalery.js', $dependencies);
        wp_enqueue_script('newGalery');
    }
    
    wp_deregister_script( 'common' );
    wp_register_script('common', get_template_directory_uri().'/lib/js/common.js', $dependencies);
    wp_enqueue_script('common');
}



add_action( 'wp_enqueue_scripts', 'armadio_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'armadio_enqueue_scripts' );

function load_fonts(){
    wp_register_style('et-googleFonts', 'https://fonts.googleapis.com/css?family=Exo:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=latin-ext');
    wp_enqueue_style( 'et-googleFonts');
}

add_action('wp_print_styles', 'load_fonts');
include_once( get_template_directory() . '/lib/classes/armadio_menu.php' );

add_filter( 'locale', 'armadio_localized' );
function armadio_localized( $locale )
{
	if ( isset( $_GET['l'] ) )
	{
		return sanitize_key( $_GET['l'] );
	}

	return $locale;
}

function armadio_wp_setup() {
    add_theme_support( 'title-tag' );
    
    add_theme_support('widgets');
    
    load_theme_textdomain( 'armadio', get_template_directory() . '/languages' );
    
    add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true
    ) );
    
    register_nav_menu( 'primary', __( 'Primary Menu', 'armadio' ) );
    
}

add_action( 'after_setup_theme', 'armadio_wp_setup' );

// Load up our theme options page and related code.
require( get_template_directory() . '/inc/theme-options.php' );

// Регістрація віджетів

function register_widgets_init() {

	register_sidebar( array(
		'name'          => 'area_to_slider',
		'id'            => 'armadio_slider',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'register_widgets_init' );

require_once( get_template_directory() . "/lib/classes/armadio_menu.php");


//custm fields

$prefix = 'armadio_';

$custom_fields = array(
    'id' => 'custom-fields',
    'title' => 'Додаткові данні',
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'H1',
            'desc' => 'Введіть заголовок сторінки.',
            'id' => $prefix . 'h1',
            'type' => 'text',
            'std' => ''
        )
    )
);

add_action('admin_menu', 'theme_add_custom_fields');

function theme_add_custom_fields() {
    global $custom_fields;

    add_meta_box($custom_fields['id'], $custom_fields['title'], 'show_custom_fields', $custom_fields['page'], $custom_fields['context'], $custom_fields['priority']);
}

function show_custom_fields() {
    global $custom_fields, $post;

    echo '<input type="hidden" name="custom_fields_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    
    foreach ($custom_fields['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '</td><td>',
            '</td></tr>';
    }

    echo '</table>';
}

add_action('save_post', 'save_data_custom_fields');

function save_data_custom_fields($post_id) {
    global $custom_fields;

    if (!wp_verify_nonce($_POST['custom_fields_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($custom_fields['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}


?>