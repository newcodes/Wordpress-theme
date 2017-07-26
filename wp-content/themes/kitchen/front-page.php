<?php get_header() ?>
<?php if ( is_active_sidebar( 'armadio_slider' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'armadio_slider' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>


<h1><?php _e('Домашня сторінка', 'armadio') ?></h1>





<?php get_footer() ?>
