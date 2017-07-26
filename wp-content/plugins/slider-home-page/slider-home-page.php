<?php
/*
Plugin Name: Слайдер
Plugin URI: http://armadio.com.ua
Description: Slider by home page to armadio site
Version: 1.0
Author: Chelowe4ok
Author URI: http://armadio.com.ua
Text Domain: armadio_slider_textdomain
License: GPLv2
 
Copyright 2017  Slider home page
 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
 
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

    add_action( 'widgets_init', create_function( '', "register_widget( 'Armadio_Slider_Widget' );" ) );
 
class Armadio_Slider_Widget extends WP_Widget {
    
    private $version = '1.0';
    private $varr;
    
 
    public function __construct() {
     
        parent::__construct(
            'armadio_home_widget',
            __( 'Слайдер', 'armadio_slider_textdomain' ),
            array(
                'classname'   => 'armadio_home_widget',
                'description' => __( 'Armadio slider to the home page.', 'armadio_slider_textdomain' )
                )
        );
       
        load_plugin_textdomain( 'armadio_slider_textdomain', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
    }
 
    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
         
        extract( $args );
         
        $count    = $instance['count'];
         
        echo $before_widget;
        
        wp_register_style('myStyleSheets',  plugin_dir_url( __FILE__ ) . '/css/style.css');
        wp_enqueue_style( 'myStyleSheets');
         
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        
        ?>
        <div id='slider'>                   
            <div class='slider-wrapper'>
                    <?php 
                    $tmpImageUrl;
                    $tmpText;
                    $tmpText2;
        
                    for ($i=0; $i < $count + 1; $i++){ 
                        $tmp_val =  esc_attr( isset( $instance['images1'.$i] ) ? $instance['images1'.$i] : '' );
                        $tmpText_val = esc_attr( isset( $instance['images1_text'.$i] ) ? $instance['images1_text'.$i] : '' );
                        $tmpText2_val = esc_attr( isset( $instance['images1_text_2'.$i] ) ? $instance['images1_text_2'.$i] : '' );
                        if ( $tmp_val ){
                                $tmpImageUrl .= wp_get_attachment_url( $tmp_val).';';
                                $tmpText .= $tmpText_val.';';
                                $tmpText2 .= $tmpText2_val.';';
                        }
                    } ?>
                
                    <div id='slide' data-image-url='<?php echo $tmpImageUrl ?>' data-text='<?php echo $tmpText ?>' data-text-2='<?php echo $tmpText2 ?>'></div>
                    <div id='nextSlide'></div>
                    <div class="slider-button slider-display-left" data-next-slide='-1'></div>
                    <div class="slider-button slider-display-right" data-next-slide='+1'></div>

            </div>
        </div>
        
        <?php
        
        wp_enqueue_script( 'Слайдер', plugin_dir_url( __FILE__ ) . 'js/slider.js', array( 'jquery' ), $this->version, true );
        
        echo $after_widget;
         
    }
 
  
    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {        
         
        $instance = $old_instance;
 
        $instance['count']            = strip_tags( $new_instance['count'] );
        $tmp = intval($new_instance['count']);
        
        for ($i = 0; $i < $tmp + 1; $i++) {
            
            if (isset($new_instance['images1'.$i])) {
                $instance['images1'.$i] = strip_tags( $new_instance['images1'.$i] );
                $instance['images1_text'.$i] = strip_tags( $new_instance['images1_text'.$i] );
                $instance['images1_text_2'.$i] = strip_tags( $new_instance['images1_text_2'.$i] );
            }
                
        }
                  
        return $instance;
         
    }
  
    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    
     
          $count = esc_attr( isset( $instance['count'] ) ? $instance['count'] : 0 );
        
          $count = intval ($count);
          $check_free_instance = true;
          $free_instance_id;
          $form = '';
          
          $this->varr = plugin_dir_url( __FILE__ );

            for ($i=0; $i < $count+1; $i++) {
                $tmp_val =  esc_attr( isset( $instance['images1'.$i] ) ? $instance['images1'.$i] : '' );
                if ( $tmp_val ){
                    
                    $imagePreview = wp_get_attachment_image( $tmp_val, $size = 'thumbnail',false, array( 'class' => 'preview-image'.' '.$this->get_field_name('images1'.$i)) );
                    
                    if ( isset( $instance[ 'images1_text'.$i ] ) ) {
                            $text = $instance[ 'images1_text'.$i ];
                    }else {
                        $text = '';
                    }
                    
                    if ( isset( $instance[ 'images1_text_2'.$i ] ) ) {
                            $text2 = $instance[ 'images1_text_2'.$i ];
                    }else {
                        $text2 = '';
                    }

                    
                    
                    
                    $form .= '<div class="container-image"><div class="slider_text">'.$imagePreview
                         . sprintf(
                        '<input type="text" name="%1$s" value="%2$s"/>',
                        $this->get_field_name('images1_text'.$i),  esc_attr( $text ))
                        . sprintf(
                        '<input type="text" name="%1$s" value="%2$s"/></div>',
                        $this->get_field_name('images1_text_2'.$i),  esc_attr( $text2 ))
                        .sprintf(
                        '<input type="hidden" name="%1$s" value="%2$s" class="widefat"/>
                        <div type="button" name="%1$s" class="btn-delete" >
                            <image src="%3$s"/> 
                        </div>',
                        $this->get_field_name('images1'.$i), $tmp_val, plugin_dir_url( __FILE__ ) . 'red-delete-button.jpg').'</div><hr/>';
                }elseif (!$tmp_val && $check_free_instance){
                    $check_free_instance = false;
                    $free_instance_id = $i;
                }
                
            }
        
            $text_field;
            if (!$check_free_instance && ($free_instance_id == 0 || $free_instance_id)){
                $form .= sprintf(
                        '<input type="hidden" name="%1$s" value="%2$s"/>',
                        $this->get_field_name('count'), $count)
                . sprintf(
                        '<input type="hidden" name="%1$s" value="" class="past_new"/>',
                        $this->get_field_name('images1'.$free_instance_id ));
                $text_field = sprintf(
                        '<input type="text" name="%1$s" value="" class="past_new_text"/>',
                        $this->get_field_name('images1_text'.$free_instance_id ));
                $text_field_2 = sprintf(
                        '<input type="text" name="%1$s" value="" class="past_new_text_2"/>',
                        $this->get_field_name('images1_text_2'.$free_instance_id ));
            }else{
                $form .= sprintf(
                        '<input type="hidden" name="%1$s" value="%2$s"/>',
                        $this->get_field_name('count'), ++$count)
                . sprintf(
                        '<input type="hidden" name="%1$s" value="" class="past_new"/>',
                        $this->get_field_name('images1'.$count ));
                $text_field = sprintf(
                        '<input type="text" name="%1$s" value="" class="past_new_text"/>',
                        $this->get_field_name('images1_text'.$count ));
                $text_field_2 = sprintf(
                        '<input type="text" name="%1$s" value="" class="past_new_text_2"/>',
                        $this->get_field_name('images1_text_2'.$count ));
            }
        
            $form .= "
            <label>Передогляд нової картинки</label>
            <div class='container-image'>
                <div type='button' class='hidden createdBtnDlt'><img src='".plugin_dir_url( __FILE__ )."red-delete-button.jpg'/></div>
                <div type='button' class='btn-update hidden'><img src='".plugin_dir_url( __FILE__ )."yellow-exclude-button.jpg'/></div>
                <img class='preview-image preview-image-load' src='".plugin_dir_url( __FILE__ )."icon-upload.png' width='150' height='150px'/>
                ".$text_field.$text_field_2."
            </div>";
            

            echo $form;
        
          $this->add_options_to_script();
          ?>
            <div type="button" name="add" class="btn-add media_manager" >
                            <image src="<?php echo plugin_dir_url( __FILE__ )?>blue-add-button.jpg"/> 
            </div> 
            
            <?php
            
            wp_register_style('myStyleSheets',  plugin_dir_url( __FILE__ ) . '/css/style.css');
            wp_enqueue_style( 'myStyleSheets');
            wp_enqueue_script( 'myscript', plugin_dir_url( __FILE__ ) . 'js/myscript.js', array( 'jquery' ), $this->version, true );
            wp_enqueue_script( 'Слайдер', plugin_dir_url( __FILE__ ) . 'js/slider_admin.js', array( 'jquery' ), $this->version, true );
            


    }
    
    function add_options_to_script(){
       //If there is data to add, add it
        $imagesPreviews = array(
            "plugingDir" => plugin_dir_url( __FILE__ ),
            "deleteImg" =>  plugin_dir_url( __FILE__ ).'red-delete-button.jpg',
            "defaultImg" =>  plugin_dir_url( __FILE__ ).'icon-upload.png',
            "updateImg" =>  plugin_dir_url( __FILE__ ).'yellow-exclude-button.jpg'
        );
            
        plugin_dir_url( __FILE__ );
//       if(!empty($this->$var))
            wp_localize_script( 'myscript', 'imagesPreviews', $imagesPreviews);   
    }      
     
}


                  // As you are dealing with plugin settings,
            // I assume you are in admin side
            add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
            function load_wp_media_files( $page ) {
              // change to the $page where you want to enqueue the script
              if( $page == 'options-general.php' ) {
                // Enqueue WordPress media scripts
                wp_enqueue_media();
                // Enqueue custom script that will interact with wp.media
                wp_enqueue_script( 'myprefix_script', plugins_url( 'slider-home-page/js/myscript.js' , __FILE__ ), array('jquery'), '0.1' );
              }
            }
        
        // Ajax action to refresh the user image
        add_action( 'wp_ajax_myprefix_get_image', 'myprefix_get_image'   );
        function myprefix_get_image() {
            if(isset($_GET['id']) ){
                $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'preview-image' ) );
                $data = array(
                    'image'    => $image,
                );
                wp_send_json_success( $data );
            } else {
                wp_send_json_error();
            }
        }