<?php

get_header(); 

set_query_var( 'title',  single_cat_title( '', false ) );
get_template_part( 'template-parts/category', 'subheader' );
?>

<section id="primary" class="category-content col-xs-11 col-centered">
<div id="content" role="main">
    
<?php
    
 if (is_category( )) {

    $this_category = get_category( get_query_var( 'cat' ) );
    $child_categories=get_categories( array( 'child_of' => $this_category->cat_ID, 'taxonomy' => 'category'));
    
	?>

	<div class='description-category'>
		<?php echo category_description( get_query_var( 'cat' ) ); ?>
	</div>

	<?php  
	$category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;

	?>
	<?php
     foreach($child_categories as $category) { 
            $category_url = get_category_link( $category->term_id );
            $category_name = $category->cat_name;
            $category_description = $category->description;
			$image_id = get_term_meta ( $category->term_id, 'category-image-id', true );
			$short_desc = get_term_meta ( $category->term_id, 'category-short-desc-id', true );
			?>

            <div class="col-xs-6 child-category-info">
				<a href="<?php echo $category_url?>"><div class="category-image"><?php echo wp_get_attachment_image ( $image_id, 'category-thumb', false, array('alt'=>$category_name, 'title'=>$category_name) ); ?></div></a>
                <!-- noindex --><h3><a rel="no-index, nofollow" href="<?php echo $category_url?>"><?php echo $category_name?></a></h3><!-- /noindex -->
                <p><?php echo $short_desc?></p>
            </div>
     <?php } 


    $parent_list = (explode (',',get_category_parents($this_category->cat_ID,false,',')));
    $parent_name = ($parent_list[0]);
    $parent = get_cat_ID( $parent_name );

	$category_url = get_category_link( $category->term_id );
	$category_description = $category->description;
	$image_id = get_term_meta ( $category->term_id, 'category-image-id', true );

    $catlist = get_categories(
            array(
            'child_of' => $parent,
            'orderby' => 'id',
            'order' => 'DESC',
            'exclude' => $this_category->cat_ID,
            'hide_empty' => '0'
    ) );
     
        
    if ( empty($child_categories) ) {
		
		$count = 0;
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
				$count++;
				if ($count % 2 != 0) {?>
					<div class="row kitchen">
						<div class="col-xs-6 kitchen-image"><?php the_post_thumbnail('category-thumb') ?></div>
						<div class="col-xs-6 kitchen-content">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<div class="entry">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
				<?php } else {?>
					<div class="row kitchen">
						<div class="col-xs-6 kitchen-content">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<div class="entry">
								<?php the_excerpt(); ?>
							</div>
						</div>
						<div class="col-xs-6 kitchen-image"><?php the_post_thumbnail('category-thumb') ?></div>
					</div>
				<?php }?>
            <?php endwhile;
         else: ?>
            <p>Sorry, no kitchens.</p>
        <?php endif; 
    }else {
        
    }?>
    
<?php } ?>    
    
    
</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>