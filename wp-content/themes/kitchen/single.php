<?php

get_header(); 

// get all data

set_query_var( 'custom_fields',  $custom_fields );
get_template_part( 'template-parts/galery', 'subheader' );

$countImages = get_post_meta(get_the_ID(), 'armadio_images_kitchen_count' , true);

$subtitle = get_post_meta(get_the_ID(), 'armadio_h2' , true);
$videoId = get_post_meta(get_the_ID(), 'armadio_video' , true);
?>


<div id="product-page">

	<!-- display product images-->

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
	</div>

<!-- display subtitle-->
<?php if($subtitle){
	 echo '<h2>'.$subtitle.'</h2>';
}
?>

<!-- display description-->

<div class='description'>
	<?php 
		$id=get_the_ID(); 
		$post = get_post($id); 
		$content = apply_filters('the_content', $post->post_content);
		echo $content;  
	?>
</div>

<!-- display video -->
<?php if ($videoId){?>
	<div class="video">
		<iframe class="youtube-player" type="text/html" width="640px" height="385px" src="http://www.youtube.com/embed/<?php echo $videoId ?>" frameborder="0" style="max-width: 100%;"> </iframe>
	</div>
<?php } ?>



</div> 
<?php get_footer(); ?>