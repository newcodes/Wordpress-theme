jQuery(function ($) {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer, return version number
        var js = document.createElement("script");

        js.type = "text/javascript";
        js.src = '../wp-content/themes/kitchen/lib/js/newGalery-ie.js';

        document.body.appendChild(js);
    } else {
        var jsModern = document.createElement("script");

        jsModern.type = "text/javascript";
        jsModern.src = '../wp-content/themes/kitchen/lib/js/newGalery-modern-browsers.js';

        document.body.appendChild(jsModern);
    }
});