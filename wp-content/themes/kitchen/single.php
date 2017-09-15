<?php

get_header(); 

set_query_var( 'custom_fields',  $custom_fields );
get_template_part( 'template-parts/galery', 'subheader' );
?>

<h2>Page template</h2>

<?php 

$countImages = get_post_meta(get_the_ID(), 'armadio_images_kitchen_count' , true);



for ($i = 1; $i <= $countImages; $i++){
	$meta_field_image = get_post_meta(get_the_ID(), 'armadio_images_kitchen_'.$i , true);
	?>
	<div class="col-xs-4"> 
	<?php 

	echo wp_get_attachment_image ( $meta_field_image, 'category-thumb' );

	?>
	</div> 
	<?php 
}


?>







<?php 
$id=get_the_ID(); 
$post = get_post($id); 
$content = apply_filters('the_content', $post->post_content); 
echo $content;  

?>

<?php get_footer(); ?>