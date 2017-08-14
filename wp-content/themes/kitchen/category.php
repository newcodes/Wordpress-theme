<?php

get_header(); 

set_query_var( 'title',  single_cat_title( '', false ) );
get_template_part( 'template-parts/category', 'subheader' );
?>

<section id="primary" class="site-content col-xs-11 col-centered">
<div id="content" role="main">
    
<?php
    
 if (is_category( )) {

    $this_category = get_category( get_query_var( 'cat' ) );
    $child_categories=get_categories( array( 'child_of' => $this_category->cat_ID, 'taxonomy' => 'category'));
    
	?>

	<div class='desctiption'>
		<?php echo category_description( get_query_var( 'cat' ) ); ?>
	</div>

	<?php
     foreach($child_categories as $category) { 
            $category_url = get_category_link( $category->term_id );
            $category_name = $category->cat_name;
            $category_description = $category->description;?>
                
            <div class="col3">
                <h3><a href="<?php echo $category_url?>"><?php echo $category_name?></a></h3>
                <p><?php echo $category_description?></p>
                <a class="view-more" href="<?php echo $category_url?>">View More</a>
            </div>
     <?php } 


    $parent_list = (explode (',',get_category_parents($this_category->cat_ID,false,',')));
    $parent_name = ($parent_list[0]);
    $parent = get_cat_ID( $parent_name );

    $catlist = get_categories(
            array(
            'child_of' => $parent,
            'orderby' => 'id',
            'order' => 'DESC',
            'exclude' => $this_category->cat_ID,
            'hide_empty' => '0'
    ) );
     
        
    if ( empty($child_categories) ) {
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();?>
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry">
                        <?php the_excerpt(); ?>
                    </div>
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