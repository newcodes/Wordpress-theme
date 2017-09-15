<?php
/*
Template Name: Contact_my
*/ 
get_header(); ?>

<div id="primary" class="content-area">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; ?>
                <?php endif; ?>
    </div>
</div>

<div class="map-contact col-xs-12 col-sm-11 col-md-11 col-lg-11">

    <section id="cd-google-map">
        <div id="map-contact"></div>
        <div id="cd-zoom-in"></div>
        <div id="cd-zoom-out"></div>
        <address class="address-info office col-xs-12 col-sm-11 col-md-11 col-lg-11">Салон "Меблі для Вашого Дому" 4ROOM ТЦ ( -1 этаж, 131 ), Украина, 08130, Киевская обл., с. Петропавловская Борщаговка, ул. Петропавловская, 6 </address>
        <address class="address-info show-room col-xs-12 col-sm-11 col-md-11 col-lg-11">Шоу-room при производстве МДВД™ Украина, г. Киев, 03680, Соломенский р-н, б-р Вацлава Гавела, 16 </address>
    </section>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCp4kIA1rpEhdniApOP9DiPwH0Dd4r75PI&callback=initMap2">
    </script>
</div>

<div class="col-sm-11 col-md-11 col-lg-11" style="margin: auto; float: none;">
    <div class="col-sm-3 col-md-3 col-lg-3">
        <div class="contact">
            <h3>Contact</h3>
            <ul>
                <li class="address">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <p>60 MEDINAT HAYEHUDIM STREET, HERTZLIA PITUACH</p>
                </li>
                <li class="phone-footer">
                    <i class="glyphicon glyphicon-earphone"></i>
                    <p>+38 (044) 206 36 39 </p></li>
                <li class="mail">
                    <i class="glyphicon glyphicon-envelope"></i>
                    <p>home@mdvd.com.ua</p></li>
                <li class="www">
                    <i class="glyphicon glyphicon-globe"></i>
                    <p>armadio.com.ua</p></li>
            </ul>
        </div>
    </div>

    <div class="contact send-mail col-sm-9 col-md-9 col-lg-9">
        <h3>SEND US A QUESTION</h3>
        <div class="contact_form">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="name" value="Your name" required=""/>
                <input type="email" name="email" value="Your email" required=""/>
                <input type="text" name="subject" value="Subject" required=""/>
                <textarea name="Message" id="message" cols="30" rows="10" required=""></textarea>
                <input type="submit" value="Send message"/>
            </form>
        </div>
    </div>

    <style>
        /*///////////////////////////////*/
        /*
        .contact_form input[type="text"], input[type="email"] {
            float: left;
            margin-right: 15px;
            margin-bottom: 14px;
        }
        .contact_textarea textarea {
            clear: both;
            margin-bottom: 14px;
            height: 150px;
            min-height: 60px;
            width: 100%;
        }


        .contact_form input[type="submit"] {
            float: right;
            margin-bottom: 14px;
            background-color: #1BB852;
            color: #fff;
        }
        button, input[type="submit"], input[type="reset"], input[type="button"] {
            border-width: 0px;
            border-style: solid;
            display: inline-block;
            padding: 9px 21px;
            font-size: 14px;
            line-height: 14px;
            margin-bottom: 15px;
            text-decoration: none;
            cursor: pointer;
            overflow: visible;
            background-image: url(../images/bg_button.png);
            background-repeat: repeat-x;
            background-position: left top;
        }
        input[type="text"], input[type="password"], input[type="email"], textarea, select {
            background: #F9F9F9;
            color: #8C8C8C;
            border-top: 1px solid #D3D3D3;
            border-left: 1px solid #D3D3D3;
            border-bottom: 1px solid #f2f2f2;
            border-right: 1px solid #f2f2f2;
        }
        input[type="text"], input[type="password"], input[type="email"], textarea, select {
            padding: 10px;
            outline: none;
            */
        /*margin: 0;*//*

            width: 230px;
            max-width: 100%;
            display: block;
            margin-bottom: 20px;
            font-size: 13px;
        }
        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, textarea:focus, select:focus {
            border: 1px solid #96CCED;
            background: #E9F5FC;
            color: #1477B4;
        }
        .inp_error {
            border-color: #E38E8E !important;
        }*/</style>

    
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>