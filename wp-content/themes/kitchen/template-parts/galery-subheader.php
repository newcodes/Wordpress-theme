
<div class='row subheader'>
    <div class='col-xs-11 col-centered'>
        <div class='title'>
            <?php 
                $h1 = get_post_meta($post->ID, $custom_fields['fields']['0']['id'], true);
                if ( $h1 )
                    echo '<h1>'.$h1.'</h1>';
            ?>
        </div>
    </div>
</div>
<div class='row'>
    <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
</div>