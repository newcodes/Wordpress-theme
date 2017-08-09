<?php

get_header(); 

set_query_var( 'custom_fields',  $custom_fields );
get_template_part( 'template-parts/galery', 'subheader' );
?>

<h2>Page template</h2>

<?php get_footer(); ?>