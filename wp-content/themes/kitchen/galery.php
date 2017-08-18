<?php
/**
 * Template Name: Galery Template
 *
 */

get_header(); 

set_query_var( 'custom_fields',  $custom_fields );
get_template_part( 'template-parts/galery', 'subheader' );
?>


<?php 


$gallery = get_post_gallery( get_the_ID(), false );
$args = array( 
    'post_type'      => 'attachment', 
    'posts_per_page' => -1, 
    'post_status'    => 'any', 
    'post__in'       => explode( ',', $gallery['ids'] ) 
); 
$attachments = get_posts( $args );

$galery_images_size = [new imageSizes('galery-thumb-1', 2, 1)];


class imageSizes{
	var $name;
	var $occupiesSpaceWidth;
	var $occupiesSpaceHeight;
	
	function __construct($name, $occupiesSpaceWidth, $occupiesSpaceHeight){
		$this->name = $name;
		$this->occupiesSpaceWidth = $occupiesSpaceWidth;
		$this->occupiesSpaceHeight = $occupiesSpaceHeight;
	}

	function SetName($name){
		$this->name = $name;
	}

	function GetName(){
		return $this->name;
	}

	function SetOccupiesSpace($occupiesSpaceWidth, $occupiesSpaceHeight){
		$this->occupiesSpaceWidth = $occupiesSpaceWidth;
		$this->occupiesSpaceHeight = $occupiesSpaceHeight;
	}
}

?>

<div class="content-galery row col-sm-11 col-centered"></div>

<?php 
if( wp_is_mobile() ) {
    
}else{ ?>
    <div id="galery" class="row col-sm-11 col-centered">
	<?php

	$number_image;
	$count = 0;
    foreach ( $attachments as $attachment ) {
    
        $image_alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true);
        if ( empty( $image_alt )) {
            $image_alt = $attachment->post_title;
        }
        if ( empty( $image_alt )) {
            $image_alt = $attachment->post_excerpt;
        }
        $image_title = $attachment->post_title;
        
		$image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
        $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
        $image_full = wp_get_attachment_image_src( $attachment->ID, 'full' );

		//$number_image = calcPosition();

		$image_galery = wp_get_attachment_image_src( $attachment->ID, $galery_images_size[0]->name);
		$count++;
		?>



		<div class="elements col-xs-4" data-size = "<?php echo $image_galery[1] ?>">
			<div class="item-picture" data-type="image">
				<a href="#" class="galery-pop" data-image="<?php echo $image_full[0] ?>" data-thumb="<?php echo $image_thumb[0] ?>">
					<div class='image-container'><img src="<?php echo $image_galery[0] ?>" alt="<?php echo $image_alt ?>" /></div>
					<!--<div style="height:870px; background-image: url('<?php echo $image_url[0] ?>');background-position: center; background-size: cover;"></div>-->
				</a>
				<div class='cbp-plus'></div>
	<!--        <span class="item-label"><?php echo $image_title ?> </span> -->
			</div>
		</div>
        

    <?php } ?>
    
    </div>
<?php } ?>

<?php get_footer(); ?>