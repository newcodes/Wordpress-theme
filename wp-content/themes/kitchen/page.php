<?php
/*
Template Name: Page
*/ 

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

	<div id="primary" class="content-area">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
					<?php endwhile; ?>
					<?php endif; ?>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>