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
    
    wp_enqueue_script('footer-maps', get_template_directory_uri() . '/js/contact-maps.js');

    if ( is_page_template('galery.php') ){
        wp_deregister_script( 'newGgalery' );
        wp_register_script('newGalery', get_template_directory_uri().'/lib/js/newGalery.js', $dependencies);
        wp_enqueue_script('newGalery');
    }

	if ( is_single() ){
        wp_deregister_script( 'productSlider' );
        wp_register_script('productSlider', get_template_directory_uri().'/lib/js/productSlider.js', $dependencies);
        wp_enqueue_script('productSlider');
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
	add_theme_support( 'post-thumbnails' );
    add_image_size( 'galery-thumb-1', 600, 600, true );
	add_image_size( 'category-thumb', 800, 600, true );
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
        'flex-width'  => true,
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
    'page' => array('post', 'page', 'link', 'attachment', 'custom_post_type'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Заголовок',
            'desc' => 'Введіть заголовок сторінки.',
            'id' => $prefix . 'h1',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Підзаголовок',
            'desc' => 'Введіть підзаголовок сторінки.',
            'id' => $prefix . 'h2',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Відео',
            'desc' => 'Введіть youtube id',
            'id' => $prefix . 'video',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => '',
            'desc' => 'Добавити фотографії кухні',
            'id' => $prefix . 'images_kitchen',
            'type' => 'image',
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
    global $custom_fields, $post, $prefix;

    echo '<input type="hidden" name="custom_fields_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    
    foreach ($custom_fields['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

		
        echo '<tr>';
		if (get_current_screen()->post_type == 'post'){
                echo '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>';
		}
        
		echo '<td>';

        switch ($field['type']) {
            case 'text':
				if (get_current_screen()->post_type == 'post'){
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                }else if($field['id'] != $prefix.'h2' && $field['id'] != $prefix.'video'){
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
				}
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
			case 'image':
				if (get_current_screen()->post_type == 'post'){
					$meta_count_image = get_post_meta($post->ID, $field['id'].'_count', true);
					echo ' <p>
							<label for="', $field['id'], '">Загрузити фотографії</label><br>
							<input type="hidden" name="', $field['id'], '" id="', $field['id'], '" class="meta-kitchen-image regular-text" value="', $meta, '">
							<input type="hidden" name="', $field['id'].'_count', '" id="', $field['id'].'_count', '" class="count-images" value="', $meta_count_image ? $meta_count_image : 0, '">
							<div id="kitchen-image-wrapper">';
						
								for ($i = 1; $i <= $meta_count_image; $i++){
									$strId = $field['id'].'_'.$i;
									$meta_field_image = get_post_meta($post->ID, $strId , true);
									if ($meta_field_image){
										$prefix = '_'.$i;
										echo '<div id="armadio_image', $prefix, '">';
											echo wp_get_attachment_image ( $meta_field_image, 'thumbnail' );
											echo '<input type="hidden" class="added-field" id="', $field['id'].$prefix, '" name="', $field['id'].$prefix, '" value="',$meta_field_image,'"/>';
											echo '<input type="button" class="button button-secondary ct_tax_media_button"  id="', 'ct_tax_media_button'.$prefix, '" name="', 'ct_tax_media_button'.$prefix, '" data-add-id="armadio_images_kitchen', $prefix, '" value="Вставити картинку" />';
											echo '<input type="button" class="button button-secondary ct_tax_media_remove_field"  id="', 'ct_tax_media_remove_field'.$prefix, '" name="', 'ct_tax_media_remove_field'.$prefix, '" data-remove-id="armadio_images_kitchen', $prefix, '" value="Удалити поле" />';
										echo '</div>';
									}
								
								
								}				
							echo '</div></p>';
                
					echo '<p>
							 <input type="button" class="button button-secondary ct_tax_media_add_field" id="ct_tax_media_add_field" name="ct_tax_media_add_field" value="Добавити поле" />
						  </p>';

				}
				break;
        }
        echo     '</td><td>',
            '</td></tr>';
    }

    echo '</table>';
	?>

	<script>
    jQuery(document).ready(function ($) {
		function ct_media_upload(button_class) {
			var _custom_media = true,
				_orig_send_attachment = wp.media.editor.send.attachment;
			$('body').on('click', button_class, function (e) {
				var button_id = '#' + $(this).attr('id');
				let fieldId = '#' + $(button_id).attr('data-add-id');
				var send_attachment_bkp = wp.media.editor.send.attachment;
				var button = $(button_id);
				_custom_media = true;
				wp.media.editor.send.attachment = function (props, attachment) {
					if (_custom_media) {
						$(fieldId).attr('value', attachment.id);
						let image = $('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
						image.attr('src', attachment.sizes.thumbnail.url).css('display', 'block');
						
						$(fieldId).after(image);
						
					} else {
						return _orig_send_attachment.apply(button_id, [props, attachment]);
					}
				}
				wp.media.editor.open(button);
				return false;
			});
		}
		ct_media_upload('.ct_tax_media_button.button');
		$('body').on('click', '.ct_tax_media_remove', function () {
			$('.meta-kitchen-image').val('');
			$('#kitchen-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
		});

		$('body').on('click', '.ct_tax_media_add_field', function(){
			let count = $('#armadio_images_kitchen_count').attr('value');
			let freeField = getFreeField(count);
			$('#armadio_images_kitchen_count').attr('value', ++count);
			
			let wrapperDiv = $('<div></div>');
			wrapperDiv.attr('id', 'armadio_image_' + freeField);

			let newField = $("<input type='hidden' class='added-field'/> ");
			newField.attr('name', 'armadio_images_kitchen_' + freeField);
			newField.attr('id', 'armadio_images_kitchen_' + freeField);
			newField.attr('value', '');

			let newFieldRemoveBtn = $('<input type="button" class="button button-secondary ct_tax_media_remove_field" value="Удалити поле" /></br>');
			newFieldRemoveBtn.attr('data-remove-id', 'armadio_images_kitchen_' + freeField);
			newFieldRemoveBtn.attr('name', 'ct_tax_media_remove_field_' + freeField);

			let newImageUpdateBtn = $('<input type="button" class="button button-secondary ct_tax_media_button" value="Вставити картинку" />');
			newImageUpdateBtn.attr('id', 'ct_tax_media_button_' + freeField);
			newImageUpdateBtn.attr('name', 'ct_tax_media_button_' + freeField);
			newImageUpdateBtn.attr('data-add-id', 'armadio_images_kitchen_' + freeField);

			let newImageRemoveBtn = $('<input type="button" class="button button-secondary ct_tax_media_remove" value="Удалити картинку" />');
			newImageRemoveBtn.attr('data-remove-id', 'armadio_images_kitchen_' + freeField);
			newImageRemoveBtn.attr('id', 'ct_tax_media_remove_' + freeField);
			newImageRemoveBtn.attr('name', 'ct_tax_media_remove_' + freeField);
			
			wrapperDiv.append(newField);
			wrapperDiv.append(newImageUpdateBtn);
			wrapperDiv.append(newFieldRemoveBtn);
			$('#kitchen-image-wrapper').append(wrapperDiv);
		
		});

		$('body').on('click', '.ct_tax_media_remove_field', function(){
			let count = $('#armadio_images_kitchen_count').attr('value');
			$('#armadio_images_kitchen_count').attr('value', --count);
			let id = $(this).attr('data-remove-id');
			$('#' + id).remove();
			$(this).parent().remove();
		});

		function getFreeField(count){
			let allFields = $('.added-field');
			let freeItem = 0;

			let items = [];
			let currentItems = [];

			for (var i = 1; i <= count; i++) {
			   items.push(i);
			}

			allFields.each(function() {
				let index = $( this ).attr('id').slice(23);
				currentItems.push(parseInt(index));
			});

			for ( var i = 0; i < items.length; i++ ) {
				let fined = false;
				for ( var e = 0; e < currentItems.length; e++ ) {
					if ( items[i] === currentItems[e] ) fined = true;
				}

				if (!fined){
					freeItem = items[i];
					break;
				}
			}

			return freeItem == 0 ? ++count : freeItem;
			
		}


		$(document).ajaxComplete(function (event, xhr, settings) {
			var queryStringArr = settings.data.split('&');
			if ($.inArray('action=add-tag', queryStringArr) !== -1) {
				var xml = xhr.responseXML;
				$response = $(xml).find('term_id').text();
				if ($response != "") {
					// Clear the thumb image
					
				}
			}
		});
	});
  </script>

  <?php
}

add_action('save_post', 'save_data_custom_fields');

function save_data_custom_fields($post_id) {
    global $custom_fields;

	if (!isset($_POST['custom_fields_nonce'])) return;

    if ( !wp_verify_nonce($_POST['custom_fields_nonce'], basename(__FILE__))) {
        return $post_id;
    }
	
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    }elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

	

		foreach ($custom_fields['fields'] as $field) {

				if (get_current_screen()->post_type == 'post'){
					$old = get_post_meta($post_id, $field['id'], true);
					$new = $_POST[$field['id']];

					if( get_current_screen()->post_type == 'post' && $field['type'] == 'image' ){
						$countStr = $field['id'].'_count';


						$oldCount = get_post_meta($post_id, $countStr, true);
						$newCount = $_POST[$countStr];
						if ($newCount && $newCount != $oldCount) {
							update_post_meta($post_id, $countStr, $newCount);
						} elseif ('' == $newCount && $oldCount) {
							delete_post_meta($post_id, $countStr, $oldCount);
						}

						$count = $_POST[$countStr];

						for ($i = 1; $i <= $count; $i++) {
							$imageId = $field['id'].'_'.$i;
							$oldImage = get_post_meta($post_id, $imageId, true);

							if (isset($_POST[$imageId])){
								$newImage = $_POST[$imageId];
								if ($newImage && $newImage != $oldImage){
									update_post_meta($post_id, $imageId, $newImage);
									// add_term_meta( $term_id, $field['id'], $image, true );
								}elseif('' == $newImage && $oldImage){
									delete_post_meta($post_id, $imageId, $oldImage);
								}
							}else{
								delete_post_meta($post_id, $imageId, $oldImage);
							}
					
						}

					}else {
						
						if ($new && $new != $old) {
							update_post_meta($post_id, $field['id'], $new);
						} elseif ('' == $new && $old) {
							delete_post_meta($post_id, $field['id'], $old);
						}
					}
				}elseif (isset($_POST[$field['id']])) {
					$old = get_post_meta($post_id, $field['id'], true);
					$new = $_POST[$field['id']];

					if ($new && $new != $old) {
							update_post_meta($post_id, $field['id'], $new);
					} elseif ('' == $new && $old) {
							delete_post_meta($post_id, $field['id'], $old);
					}
				}
		}

}

/*
 * breadcrumbs
*/
function breadcrumbs() {

  /* === ОПЦИИ === */
  $text['home'] = 'Главная'; // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора
  $text['404'] = 'Ошибка 404'; // текст для страницы 404
  $text['page'] = 'Страница %s'; // текст 'Страница N'
  $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before = '<div class="breadcrumbs col-xs-11 col-centered" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
  $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
  $sep = '›'; // разделитель между "крошками"
  $sep_before = '<span class="sep">'; // тег перед разделителем
  $sep_after = '</span>'; // тег после разделителя
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
  $before = '<span class="current">'; // тег перед текущей "крошкой"
  $after = '</span>'; // тег после текущей "крошки"
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_url = home_url('/');
  $link_before = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
  $link_after = '</span>';
  $link_attr = ' itemprop="item"';
  $link_in_before = '<span itemprop="name">';
  $link_in_after = '</span>';
  $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
  $frontpage_id = get_option('page_on_front');
  $parent_id = ($post) ? $post->post_parent : '';
  $sep = ' ' . $sep_before . $sep . $sep_after . ' ';
  $home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

  if (is_home() || is_front_page()) {

    if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

  } else {

    echo $wrap_before;
    if ($show_home_link) echo $home_link;

    if ( is_category() ) {
      $cat = get_category(get_query_var('cat'), false);
      if ($cat->parent != 0) {
        $cats = get_category_parents($cat->parent, TRUE, $sep);
        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        if ($show_home_link) echo $sep;
        echo $cats;
      }
      if ( get_query_var('paged') ) {
        $cat = $cat->cat_ID;
        echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
      }

    } elseif ( is_search() ) {
      if (have_posts()) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
      } else {
        if ($show_home_link) echo $sep;
        echo $before . sprintf($text['search'], get_search_query()) . $after;
      }

    } elseif ( is_day() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
      echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
      if ($show_current) echo $sep . $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
      if ($show_current) echo $sep . $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ($show_home_link) echo $sep;
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($show_current) echo $sep . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $sep);
        if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
        if ( get_query_var('cpage') ) {
          echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
        } else {
          if ($show_current) echo $before . get_the_title() . $after;
        }
      }

    // custom post type
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      if ( get_query_var('paged') ) {
        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . $post_type->label . $after;
      }

    } elseif ( is_attachment() ) {
      if ($show_home_link) echo $sep;
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $sep);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($show_home_link) echo $sep;
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $sep;
        }
      }
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      if ( get_query_var('paged') ) {
        $tag_id = get_queried_object_id();
        $tag = get_tag($tag_id);
        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
      }

    } elseif ( is_author() ) {
      global $author;
      $author = get_userdata($author);
      if ( get_query_var('paged') ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
      }

    } elseif ( is_404() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . $text['404'] . $after;

    } elseif ( has_post_format() && !is_singular() ) {
      if ($show_home_link) echo $sep;
      echo get_post_format_string( get_post_format() );
    }

    echo $wrap_after;

  }
} // end of breadcrumbs()


// Products fields

function ST4_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, array(15,15));
        return $post_thumbnail_img[0];
    }
}

function ST4_columns_head($defaults) {
    $defaults['featured_image'] = 'Зображення';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function ST4_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = ST4_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" />';
        }
    }
}

add_filter('manage_posts_columns', 'ST4_columns_head');
add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);


// Register the three useful image sizes for use in Add Media modal
add_filter( 'image_size_names_choose', 'galery_custom_sizes' );
function galery_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'galery-thumb-1' => __( 'Галерея (продовгувата в висоту)' ),
		'category-thumb' => __( 'Категорія' ),
    ) );
}
?>