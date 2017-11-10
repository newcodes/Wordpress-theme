<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body itemscope itemtype="http://schema.org/FurnitureStore" <?php body_class(); ?>>
<header>
    <div class="row">
        <div class="top-bar col-xs-11 col-centered row">
            <div id='languages-switch'>
                <?php pll_the_languages(array('dropdown'=>1));  ?>
            </div>
            <div class="social">
                <ul>
                    <li class="facebook"><a target="_blank" href="#" title="Facebook">F</a></li>
                    <li class="instagram"><a target="_blank" href="#" title="Instagram">I</a></li>
                    <li class="googleplus"><a target="_blank" href="#" title="Google+">G</a></li>
                    <li class="youtube"><a target="_blank" href="#" title="Youtube">X</a></li>
                </ul>
            </div>
            <div class="phone">
                <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                <?php echo get_option('phone_number'); ?>
            </div>
        </div>
        <div class='col-xs-11 col-centered row'>
            <nav class="navbar">

                    <?php  if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {?>
                            <div class='navbar-header col-xs-12 col-sm-3 col-md-3 col-ld-2'>
                                <?php 
                                    if ( function_exists( 'the_custom_logo' ) && !is_front_page() && !is_home() ) {
                                        the_custom_logo();
                                    }else {
										$custom_logo_id = get_theme_mod('custom_logo');
										$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
										echo '<img itemprop="logo" src="'.$image[0].'" alt="Designer kitchens to order from Armadio" title="Designer kitchens to order from Armadio" />';
									}
                                ?>
                            </div>
                            <div class="navbar-content">
                                <div class='mobnav-button' data-toggle="collapse" data-target="#navbar">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                </div>
                                <div id='navbar' class="collapse col-xs-12 col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3">
                                    <?php 
                                        wp_nav_menu( array(
                                            'theme_location' => 'primary',
                                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                            'menu_id' => '',
                                            'walker' => new Armadio_nav_menu(),
                                            'menu_class' => 'nav navbar-nav'
                                        ) );
                                     ?>
                                </div>
                            </div>
                    <?php } else { ?>
                            <div class="navbar-content">
                                <div class='mobnav-button' data-toggle="collapse" data-target="#navbar">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                </div>
                                <div id='navbar' class="collapse col-xs-12 col-sm-10 col-centered" style="height:80px">
                                    <?php 

                                         wp_nav_menu( array(
                                            'theme_location' => 'primary',
                                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                            'menu_id' => '',
                                            'menu_class' => 'nav navbar-nav',
                                            'container' => '',
                                            'depht' => 4,
                                            'walker' => new Armadio_nav_menu()
                                        ) );
                                     ?>
                                </div>
                            </div>
                    <?php } ?>
                    
            </nav>
        </div>
    </div>
    </header>