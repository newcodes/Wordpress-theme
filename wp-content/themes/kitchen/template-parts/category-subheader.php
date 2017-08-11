
<div class='row subheader'>
    <div class='col-xs-11 col-centered'>
        <div class='title'>
            <?php 
                
                if ( $title )
                    echo '<h1>'.$title.'</h1>';
            ?>
        </div>
    </div>
</div>
<div class='row'>
    <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
</div>