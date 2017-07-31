<?php
/**
 * Template Name: Galery Template
 *
 */

get_header(); ?>
<br/>
<br/>
<br/>
<br/>



<?php 

$gallery = get_post_gallery( get_the_ID(), false );
$args = array( 
    'post_type'      => 'attachment', 
    'posts_per_page' => -1, 
    'post_status'    => 'any', 
    'post__in'       => explode( ',', $gallery['ids'] ) 
); 
$attachments = get_posts( $args );

$outer_html = '';
$outer_html .= '<div class="content-galery row col-sm-11 col-centered"><h1> Galery page </h1></div>';

$count = 1;

if( wp_is_mobile() ) {
    $outer_html .= '<div id="galery" class="galery-mobile row col-sm-11 col-centered">';

    foreach ( $attachments as $attachment ) {
    
        $image_alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true);
        if ( empty( $image_alt )) {
            $image_alt = $attachment->post_title;
        }
        if ( empty( $image_alt )) {
            $image_alt = $attachment->post_excerpt;
        }
        $image_title = $attachment->post_title;

        switch ($count) {
            case 1:
            case 2:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $outer_html .= '<div class="col-xs-6">';
                break;
            case 3:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-12">';
                break;
            case 4:
            case 5:
            case 6:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $outer_html .= '<div class="col-xs-4">';
                break;
            case 7:
            case 8:
            case 9:
            case 10:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $outer_html .= '<div class="col-xs-3">';
                break;
            default:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-12">';

        }




        $outer_html .= '<div class="item-picture" data-type="image">';
        $outer_html .= '<img src="' . $image_url[0] . '" alt="'. $image_alt .'">' ;
        $outer_html .= '<div class="image-overlay">';
        $outer_html .= '<a href="' . $image_url[0] . '" data-rel="prettyPhoto[gallery]">
              <span class="zoom"></span></a>';
        $outer_html .= '</div>';
//        $outer_html .= '<span class="item-label">' . $image_title . '</span>';
        $outer_html .= '</div>';
        $outer_html .= '</div>';
        $count++;

        if ($count == 11) {
            $count = 1;
        }
    }
    
}else{
    $outer_html .= '<div id="galery" class="row col-sm-11 col-centered">';

    foreach ( $attachments as $attachment ) {
    
        $image_alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true);
        if ( empty( $image_alt )) {
            $image_alt = $attachment->post_title;
        }
        if ( empty( $image_alt )) {
            $image_alt = $attachment->post_excerpt;
        }
        $image_title = $attachment->post_title;

        switch ($count) {
            case 1:
            case 2:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-6">';
                break;
            case 3:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $outer_html .= '<div class="col-xs-12">';
                break;
            case 4:
            case 5:
            case 6:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-4">';
                break;
            case 7:
            case 8:
            case 9:
            case 10:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $outer_html .= '<div class="col-xs-3">';
                break;
            default:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $outer_html .= '<div class="col-xs-12">';

        }

        $outer_html .= '<div class="item-picture" data-type="image">';
        $outer_html .= '<img src="' . $image_url[0] . '" alt="'. $image_alt .'">' ;
        $outer_html .= '<div class="image-overlay">';
        $outer_html .= '<a href="' . $image_url[0] . '" data-rel="prettyPhoto[gallery]">
              <span class="zoom"></span></a>';
        $outer_html .= '</div>';
//        $outer_html .= '<span class="item-label">' . $image_title . '</span>';
        $outer_html .= '</div>';
        $outer_html .= '</div>';
        $count++;

        if ($count == 11) {
            $count = 1;
        }
    }
}

$outer_html .= '</div>';

echo $outer_html;
?>

<?php get_footer(); ?>