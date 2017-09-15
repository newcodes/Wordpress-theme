<?php

class Armadio_Category_Image_Admin {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/armadio-category-image-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/armadio-category-image-admin.js', array( 'jquery' ), $this->version, false );

	}
    
	 public function add_category_image ( $taxonomy ) { ?>
	   <div class="form-field term-group">
		 <label for="category-image-id"><?php _e('Картинка', 'kitchen'); ?></label>
		 <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
		 <div id="category-image-wrapper"></div>
		 <p>
		   <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Добавити картинку', 'kitchen' ); ?>" />
		   <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Удалити картинку', 'kitchen' ); ?>" />
		</p>
	   </div>
	 <?php
	 }

	 public function add_category_short_description ( $taxonomy ) { ?>
	   <div class="form-field term-group">
		 <label for="category-short-desc-id"><?php _e('Короткий опис', 'kitchen'); ?></label>
		 <input type="hidden" id="category-short-desc-id" name="category-short-desc-id" class="custom_media_url" value="">
		 <div id="category-short-desc-wrapper">
			 <textarea name="category-short-desc-id" id="category-short-desc-id" rows="5" cols="40"></textarea>
		 </div>
	   </div>
	 <?php
	 }
 
	 /*
	  * Save the form field
	  * @since 1.0.0
	 */
	 public function save_category_image ( $term_id) {
	   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
		 $image = $_POST['category-image-id'];
		 add_term_meta( $term_id, 'category-image-id', $image, true );
	   }
	 }

	 public function save_category_short_description ( $term_id ) {
	   if( isset( $_POST['category-short-desc-id'] ) && '' !== $_POST['category-short-desc-id'] ){
		 $shortDesc = $_POST['category-short-desc-id'];
		 add_term_meta( $term_id, 'category-short-desc-id', $shortDesc, true );
	   }
	 }
 
	 /*
	  * Edit the form field
	  * @since 1.0.0
	 */
	 public function update_category_image ( $term ) { ?>
	   <tr class="form-field term-group-wrap">
		 <th scope="row">
		   <label for="category-image-id"><?php _e( 'Картинка', 'kitchen' ); ?></label>
		 </th>
		 <td>
		   <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
		   <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
		   <div id="category-image-wrapper">
			 <?php if ( $image_id ) { ?>
			   <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
			 <?php } ?>
		   </div>
		   <p>
			 <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Добавити картинку', 'kitchen' ); ?>" />
			 <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Удалити картинку', 'kitchen' ); ?>" />
		   </p>
		 </td>
	   </tr>
	 <?php
	 }

	 public function update_category_short_description ( $term ) { ?>
	   <tr class="form-field term-group-wrap">
		 <th scope="row">
		   <label for="category-short-desc-id"><?php _e( 'Короткий опис', 'kitchen' ); ?></label>
		 </th>
		 <td>
		   <?php $short_desc_id = get_term_meta ( $term -> term_id, 'category-short-desc-id', true ); ?>
		   <input type="hidden" id="category-short-desc-id" name="category-short-desc-id" value="<?php echo $short_desc_id; ?>">
		   <div id="category-short-desc-wrapper">
			 <?php if ( $short_desc_id ) { ?>
			   <textarea name="category-short-desc-id" id="category-short-desc-id" rows="5" cols="40"><?php echo $short_desc_id; ?></textarea>
			 <?php } else { ?>
				<textarea name="category-short-desc-id" id="category-short-desc-id" rows="5" cols="40"></textarea>
			 <?php }?>
		   </div>
		 </td>
	   </tr>
	 <?php
	 }

	/*
	 * Update the form field value
	 * @since 1.0.0
	 */
	 public function updated_category_image ( $term_id ) {
	   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
		 $image = $_POST['category-image-id'];
		 update_term_meta ( $term_id, 'category-image-id', $image );
	   } else {
		 update_term_meta ( $term_id, 'category-image-id', '' );
	   }
	 }

	 public function updated_category_short_description ( $term_id ) {
	   if( isset( $_POST['category-short-desc-id'] ) && '' !== $_POST['category-short-desc-id'] ){
		 $short_desc = $_POST['category-short-desc-id'];
		 update_term_meta ( $term_id, 'category-short-desc-id', $short_desc );
	   } else {
		 update_term_meta ( $term_id, 'category-short-desc-id', '' );
	   }
	 } 
}
