jQuery(function ($) {

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer, return version number
        var js = document.createElement("script");

        js.type = "text/javascript";
        js.src = 'wp-content/plugins/slider-home-page/js/slider-ie.js';

        document.body.appendChild(js);

        var css = document.createElement("link");

        css.type = "text/css";
        css.rel = "stylesheet";
        css.href = 'wp-content/plugins/slider-home-page/css/style-ie.css';

        document.body.appendChild(css);
    }else {
        var jsModern = document.createElement("script");

        jsModern.type = "text/javascript";
        jsModern.src = 'wp-content/plugins/slider-home-page/js/slider-modern-browsers.js';

        document.body.appendChild(jsModern);
    }
});
