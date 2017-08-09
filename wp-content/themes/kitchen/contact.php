<?php
/*
Template Name: Contact
*/ 

get_header(); ?>

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