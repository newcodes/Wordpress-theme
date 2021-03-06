<?php get_header() ?>
<?php if ( is_active_sidebar( 'armadio_slider' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'armadio_slider' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>


<h1 itemprop="name"><?php _e('Домашня сторінка', 'armadio') ?></h1>
<div itemprop="description" class="description">
	<?php _e('Опис', 'armadio') ?>
</div>




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

<div class="footer-information col-sm-11">
    <div class="block-information map col-xs-6 col-sm-4 col-md-3 col-lg-3">
        <div id="map"></div>
        <script itemprop="hasMap" async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp4kIA1rpEhdniApOP9DiPwH0Dd4r75PI&callback=initMap1">
        </script>
    </div>
    <div class="block-information col-xs-6 col-sm-4 col-md-3 col-lg-3">
        <div class="contact">
            <h3>Contact</h3>
            <ul>
                <li class="address">
                    <i class="glyphicon glyphicon-map-marker"></i>
					<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<span itemprop="streetAddress"><?php _e('бульвар Вацлава Гавела, 16', 'armadio') ?></span>,
						<span itemprop="addressRegion"><?php _e('Київ', 'armadio') ?></span>,
						<span itemprop="addressCountry"><?php _e('Україна', 'armadio') ?></span>
					</address>
                </li>
                <li class="phone-footer">
                    <i class="glyphicon glyphicon-earphone"></i>
                    <p itemprop="telephone">+38 (044) 206 36 39 </p></li>
                <li class="mail">
                    <i class="glyphicon glyphicon-envelope"></i>
                    <p itemprop="email">home@mdvd.com.ua</p></li>
                <li class="www">
                    <i class="glyphicon glyphicon-globe"></i>
                    <p itemprop="url">armadio.com.ua</p></li>
            </ul>
        </div>
    </div>
    <div class="block-information fb-block col-xs-6 col-sm-4 col-md-3 col-lg-3">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.10";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-page" data-href="https://www.facebook.com/&#x41c;&#x414;&#x412;&#x414;-&#x43c;&#x435;&#x431;&#x435;&#x43b;&#x44c;-&#x43d;&#x430;-&#x437;&#x430;&#x43a;&#x430;&#x437;-922762267844584/" data-tabs="timeline" data-height="330px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/&#x41c;&#x414;&#x412;&#x414;-&#x43c;&#x435;&#x431;&#x435;&#x43b;&#x44c;-&#x43d;&#x430;-&#x437;&#x430;&#x43a;&#x430;&#x437;-922762267844584/" class="fb-xfbml-parse-ignore">
                <a href="https://www.facebook.com/&#x41c;&#x414;&#x412;&#x414;-&#x43c;&#x435;&#x431;&#x435;&#x43b;&#x44c;-&#x43d;&#x430;-&#x437;&#x430;&#x43a;&#x430;&#x437;-922762267844584/">МДВД - мебель на заказ</a>
            </blockquote>
        </div>
    </div>
    <div class="block-information col-xs-6 hidden-sm col-md-3 col-lg-3">
        <div class="info-box">
            <div class="info-box-header">
                <h4><?php _e('Чому Armadio?', 'armadio') ?></h4>
                <span class="arrow-info"></span>
            </div>
            <div itemprop="description" class="info-box-desc">
                <ul>
                    <li><?php _e('Досвід роботи у цій галузі більше 10 років.', 'armadio') ?></li>
                    <li><?php _e('Відкриті ціни.', 'armadio') ?></li>
                    <li><?php _e('Висока якість виробництва кухонь.', 'armadio') ?></li>
                    <li><?php _e('Розвинена технологія, яка забезпечує комфортом та надійність у використанні кухонь.', 'armadio') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>
