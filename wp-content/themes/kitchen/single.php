<?php

get_header(); 

set_query_var( 'custom_fields',  $custom_fields );
get_template_part( 'template-parts/galery', 'subheader' );
?>

<h2>Page template</h2>

<?php 
$id=get_the_ID(); 
$post = get_post($id); 
$content = apply_filters('the_content', $post->post_content); 
echo $content;  
?>


<?php get_footer(); ?>