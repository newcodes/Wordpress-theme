<?php

get_header(); 

set_query_var( 'custom_fields',  $custom_fields );
get_template_part( 'template-parts/galery', 'subheader' );

$countImages = get_post_meta(get_the_ID(), 'armadio_images_kitchen_count' , true);

?>

<div id="product-page">
	<div class="wrapper">
		<div class="viewport">
				<?php
				for ($i = 1; $i <= $countImages; $i++){
					$meta_field_image = get_post_meta(get_the_ID(), 'armadio_images_kitchen_'.$i , true);
					if ($meta_field_image){
						?>
			
							<?php 

							echo wp_get_attachment_image ( $meta_field_image, 'category-thumb', false, array("class" => "product-list-image") );

							?>
			
						<?php 
					}
				}
				?>
		</div>
		 <div class="galery-btn btn-left" data-next-slide="-1"></div>
		 <div class="galery-btn btn-right" data-next-slide="+1"></div>
	</div>






	<?php 
	$id=get_the_ID(); 
	$post = get_post($id); 
	$content = apply_filters('the_content', $post->post_content); 
	echo $content;  

	?>
</div> 
<?php get_footer(); ?>