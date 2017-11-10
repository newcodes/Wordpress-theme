jQuery(function ($) {
    'use strict';

    var currentSlide = 0;
    var next;
    var arraySrc;
    var numberSlides;
    var userControled = false;

    function readData() {

        if ($('#slide').attr('data-image-url')) {
            arraySrc = $('#slide').attr('data-image-url').split(/;/);
            var arrayText = $('#slide').attr('data-text').split(/;/);
            var arrayText2 = $('#slide').attr('data-text-2').split(/;/);
            arraySrc.pop();
            arrayText.pop();
            arrayText2.pop();
            numberSlides = arraySrc.length;

            var src = arraySrc[currentSlide];
            var srcUrl = 'url(' + src + ')';

            $("#slide").css('background', srcUrl);
        }
    }

    function bindEvents() {
        $('.slider-button').click(function () {
            next = parseInt($(this).attr('data-next-slide'));
            showNextSlide(next);
        });
    }

    function showNextSlide(step) {
        currentSlide = currentSlide + step;

        if (currentSlide >= numberSlides) {
            currentSlide = 0;
        } else if (currentSlide < 0){
            currentSlide = numberSlides - 1;
        }

        var src = arraySrc[currentSlide];
        
        var srcUrl = 'url(' + src + ')';

        $("#slide").css('background', srcUrl);
    }

    readData();
    bindEvents();
});


