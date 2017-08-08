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
$outer_html .= '<div class="content-galery row col-sm-11 col-centered">';

 foreach ($custom_fields['fields'] as $field) {
     $meta = get_post_meta($post->ID, $field['id'], true);
     $outer_html .=  '<h1>'.$meta.'</h1>';
 }

$outer_html .= '</div>';

$count = 1;

if( wp_is_mobile() ) {
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
        
        if ($count == 1 || $count == 3 || $count == 4 || $count == 7){
            $outer_html .= '<div class="row">';
        }

        switch ($count) {
            case 1:
            case 2:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-6" data-size = ' .$image_url[2]. '>';
                break;
            case 3:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-12" data-size = ' .$image_url[2].'>';
                break;
            case 4:
            case 5:
            case 6:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-4" data-size = ' .$image_url[2].'>';
                break;
            case 7:
            case 8:
            case 9:
            case 10:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-3" data-size = ' .$image_url[2].'>';
                break;
            default:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $outer_html .= '<div class="col-xs-12" data-size = ' .$image_url[2].'>';

        }

        $outer_html .= '<div class="item-picture" data-type="image">';
        $outer_html .= '<a href="#" class="galery-pop" data-image="'. $image_full[0] . '" data-thumb="'. $image_thumb[0] . '"><img src="' . $image_url[0] . '" alt="'. $image_alt .'"></a>' ;
        $outer_html .= '<div class="image-overlay">';
        $outer_html .= '</div>';
//        $outer_html .= '<span class="item-label">' . $image_title . '</span>';
        $outer_html .= '</div>';
        $outer_html .= '</div>';
        
        if ($count == 2 || $count == 3 || $count == 6 || $count == 10){
            $outer_html .= '</div>';
        }
        
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
        
        if ($count == 1 || $count == 3 || $count == 4 || $count == 7){
            $outer_html .= '<div class="row">';
        }

        switch ($count) {
            case 1:
            case 2:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $outer_html .= '<div class="col-xs-6" data-size = ' .$image_url[2]. '>';
                break;
            case 3:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $outer_html .= '<div class="col-xs-12" data-size = ' .$image_url[2].'>';
                break;
            case 4:
            case 5:
            case 6:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'large' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $outer_html .= '<div class="col-xs-4" data-size = ' .$image_url[2].'>';
                break;
            case 7:
            case 8:
            case 9:
            case 10:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'medium' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $outer_html .= '<div class="col-xs-3" data-size = ' .$image_url[2].'>';
                break;
            default:
                $image_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
                $image_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
                $outer_html .= '<div class="col-xs-12" data-size = ' .$image_url[2].'>';

        }

        $outer_html .= '<div class="item-picture" data-type="image">';
        $outer_html .= '<a href="#" class="galery-pop" data-image="'. $image_full[0] . '" data-thumb="'. $image_thumb[0] . '"><img src="' . $image_url[0] . '" alt="'. $image_alt .'"></a>' ;
        $outer_html .= '<div class="image-overlay">';
        $outer_html .= '</div>';
//        $outer_html .= '<span class="item-label">' . $image_title . '</span>';
        $outer_html .= '</div>';
        $outer_html .= '</div>';
        
        if ($count == 2 || $count == 3 || $count == 6 || $count == 10){
            $outer_html .= '</div>';
        }
        
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