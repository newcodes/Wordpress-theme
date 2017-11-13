<?php get_header() ?>
<?php if ( is_active_sidebar( 'armadio_slider' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'armadio_slider' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>


<h1><?php _e('Домашня сторінка', 'armadio') ?></h1>





<div class="style-kitchen container-fluid col-sm-11 col-md-11">
    <div class="ns-kitchen col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="image-style">
            <a href="#" target="_blank">
                <img src="<?php bloginfo("template_url"); ?>/images/hacker_main_21.jpg" alt="Classic kitchen"/>
            </a>
        </div>
        <div class="description-style">
            <h4>Класичные кухни</h4>
            <p>Класичные кухниКласичные кухниКласичные кухниКласичные кухниКласичные кухни</p>
        </div>
    </div>
    <div class="ns-kitchen col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="image-style">
            <a href="#" target="_blank">
                <img src="<?php bloginfo("template_url"); ?>/images/hacker_main_23.jpg" alt="Classic kitchen"/>
            </a>
        </div>
        <div class="description-style">
            <h4>DESIGN KITCHEN</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, facilis?</p>
        </div>
    </div>
    <div class="ns-kitchen col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="image-style">
            <a href="#" target="_blank">
                <img src="<?php bloginfo("template_url"); ?>/images/hacker_main_24.jpg" alt="Classic kitchen"/>
            </a>
        </div>
        <div class="description-style">
            <h4>MODERN KITCHEN</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, facilis?</p>
        </div>
    </div>
    <div class="ns-kitchen col-xs-6 col-sm-3 col-md-3 col-lg-3">
        <div class="image-style">
            <a href="#" target="_blank">
                <img src="<?php bloginfo("template_url"); ?>/images/hacker_main_22.jpg" alt="Classic kitchen"/>
            </a>
        </div>
        <div class="description-style">
            <h4>COUNTRY KITCHEN</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, facilis?</p>
        </div>
    </div>

</div>







<div class="shortcode-html">
    <div class="row">
        <div class="col-lg-6 g-mb-50 g-mb-0--lg">
            <img class="img-fluid" src="../../assets/img/inline/inline8.png" alt="Image Description">
        </div>

        <div class="col-lg-6 align-self-center">
            <header class="u-heading-v2-3--bottom g-brd-primary g-mb-20">
                <h2 class="h3 u-heading-v2__title text-uppercase g-font-weight-300">About Our Company</h2>
            </header>

            <p class="lead g-mb-30">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas moles</p>

            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-40">
                <li class="d-flex g-mb-10">
                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i>
                    Included Over 2000+ UI Components
                </li>
                <li class="d-flex g-mb-10">
                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i>
                    Beautiful Eye Catching Demos
                </li>
                <li class="d-flex g-mb-10">
                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i>
                    Over 30+ Beautiful Thematic Examples
                </li>
                <li class="d-flex g-mb-10">
                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i>
                    Semantic HTML5/CSS3 Codes
                </li>
            </ul>

            <a class="btn btn-md u-btn-primary rounded-0" href="#">Learn More</a>
        </div>
    </div>
</div>














<div class="shortcode-html">
    <div class="row text-center">
        <div class="col-md-3 col-sm-6 g-mb-30">
                      <span class="u-icon-v3 u-icon-size--xl g-bg-primary-opacity-0_1 rounded-circle g-mb-10">
                        <i class="et-icon-wallet g-color-primary"></i>
                      </span>

            <div class="js-counter g-color-primary g-font-size-40 g-font-weight-300 g-mb-7">9</div>
            <p>Сотрудников</p>
        </div>

        <div class="col-md-3 col-sm-6 g-mb-30">
                      <span class="u-icon-v3 u-icon-size--xl g-bg-cyan-opacity-0_1 rounded-circle g-mb-10">
                        <i class="et-icon-genius g-color-cyan"></i>
                      </span>

            <div class="js-counter g-color-cyan g-font-size-40 g-font-weight-300 g-mb-7">200</div>
        </div>

        <div class="col-md-3 col-sm-6 g-mb-30">
                      <span class="u-icon-v3 u-icon-size--xl g-bg-lightred-opacity-0_1 rounded-circle g-mb-10">
                        <i class="et-icon-tools g-color-lightred"></i>
                      </span>

            <div class="js-counter g-color-lightred g-font-size-40 g-font-weight-300 g-mb-7">1000</div>
        </div>

        <div class="col-md-3 col-sm-6 g-mb-30">
                      <span class="u-icon-v3 u-icon-size--xl g-bg-teal-opacity-0_1 rounded-circle g-mb-10">
                        <i class="et-icon-chat g-color-teal"></i>
                      </span>

            <div class="js-counter g-color-teal g-font-size-40 g-font-weight-300 g-mb-7">1500</div>
        </div>
    </div>
</div>

<?php get_footer() ?>
