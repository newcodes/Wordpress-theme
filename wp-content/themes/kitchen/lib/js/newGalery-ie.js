"use strict";


jQuery(function ($) {

    $(document).ready(function () {

        $.fn.slider = function (customOptions) {

            $.each(customOptions, function (option, value) {
                galeryObj.options[option] = value;
            });

            new ArmadioGalery().init();

        }

        $('#galery').slider();

        $(window).load(function () {

            if (isMobile()) return;

            $('#galery img').each(function () {
                createCanvas(this);
            });



            function createCanvas(image) {

                var canvas = document.createElement('canvas');
                if (canvas.getContext) {
                    var ctx = canvas.getContext("2d");

                    var width = image.parentElement.clientWidth;
                    var height = image.parentElement.clientHeight;
                    // specify canvas size
                    canvas.width = width;
                    canvas.height = height;

                    // Once we have a reference to the source image object we can use 
                    // the drawImage(reference, x, y) method to render it to the canvas. 
                    //x, y are the coordinates on the target canvas where the image should be placed.
                    ctx.drawImage(image, 0, 0, width, height);

                    // Taking the image data and storing it in the imageData array. 
                    //You can read the pixel data on a canvas using the getImageData() method. 
                    // Image data includes the colour of the pixel (decimal, rgb values) and alpha value. 
                    // Each color component is represented by an integer between 0 and 255. 
                    //imageData.data contains height x width x 4 bytes of data, with index values ranging from 0 to (height x width x 4)-1.
                    var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height),
                        pixelData = imageData.data;

                    // Loop through all the pixels in the imageData array, and modify
                    // the red, green, and blue color values.
                    for (var y = 0; y < canvas.height; y++) {
                        for (var x = 0; x < canvas.width; x++) {

                            // You can access the color values of the (x,y) pixel as follows :
                            var i = (y * 4 * canvas.width) + (x * 4);

                            // Get the RGB values.
                            var red = pixelData[i];
                            var green = pixelData[i + 1];
                            var blue = pixelData[i + 2];

                            // Convert to grayscale. One of the formulas of conversion (e.g. you could try a simple average (red+green+blue)/3)   
                            var grayScale = (red * 0.3) + (green * 0.59) + (blue * .11);

                            pixelData[i] = grayScale;
                            pixelData[i + 1] = grayScale;
                            pixelData[i + 2] = grayScale;
                        }
                    }

                    // Putting the modified imageData back on the canvas.
                    ctx.putImageData(imageData, 0, 0, 0, 0, imageData.width, imageData.height);

                    // Inserting the canvas in the DOM, before the image:
                    image.parentNode.insertBefore(canvas, image);
                }
            }
        });
    });

    function isMobile() {
        $.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
        return $.browser.device;
    }

    /* 
    
    @poperty images: Array<Obj>; Obj = { fullSize, thumb, title }
    
    
    */
  

    var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

    function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

    var ArmadioGalery = function () {
        function ArmadioGalery() {
            _classCallCheck(this, ArmadioGalery);
        }

        _createClass(ArmadioGalery, [{
            key: "init",
            value: function init() {

                this.buildUIModal();
                this.defineElements();
                this.bindUIEvents();
                this.loadedImages = [];
                this.preloadImages();
            }
        }, {
            key: "bindUIEvents",
            value: function bindUIEvents() {

                var _this = this;
                this.itemPictures.on("click", function () {
                    _this.showModal($(this));
                });

                if (this.isMobile()) {
                    this.controllMobile();
                } else {
                    this.btnControll.on("click", function () {
                        _this.controllDesctop($(this));
                    });

                    this.modal.keyup(function (event) {
                        if (event['keyCode'] == 37 || event['keyCode'] == 40) {
                            _this.controllDesctop(1);
                        } else if (event['keyCode'] == 39 || event['keyCode'] == 38) {
                            _this.controllDesctop(-1);
                        }
                    });
                }
            }
        }, {
            key: "buildUIModal",
            value: function buildUIModal() {

                this.setDataSlider();
                var modal = void 0;
                if (this.isMobile()) {
                    modal = "<div class=\"modal fade\" id=\"galery-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"galery-modal-label\" aria-hidden=\"true\">\n                  <div class=\"modal-dialog\">\n                    <div class=\"modal-content\">\n                      <div class=\"modal-body\">\n                        <div id=\"galery-slider\">\n                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>\n                            <div class=\"holder\">\n                                <div id=\"viewport\" class=\"slide-wrapper-mobile\">\n                                    <div class=\"slide\"><img src='' alt='' class='slide-img'></div>\n                                    <div class=\"slide\"><img src='' alt='' class='slide-img'></div>\n                                    <div class=\"slide\"><img src='' alt='' class='slide-img'></div>\n                                </div>\n                            </div>\n                        </div>\n                      </div>\n                    </div>\n                  </div>\n                </div>";
                } else {
                    modal = "<div class=\"modal fade\" id=\"galery-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"galery-modal-label\" aria-hidden=\"true\">\n                  <div class=\"modal-dialog\">\n                    <div class=\"modal-content\">\n                      <div class=\"modal-body\">\n                        <div id=\"galery-slider\">\n                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Close</span></button>\n                            <div class=\"holder\">\n                                <div id=\"viewport\" class=\"slide-wrapper\">\n                                    <div class=\"slide\"><img src='' alt='' class='slide-img'></div>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"galery-btn btn-left\" data-next-slide=\"-1\"></div>\n                        <div class=\"galery-btn btn-right\" data-next-slide=\"+1\"></div>\n                      </div>\n                    </div>\n                  </div>\n                </div>";
                }

                $('#galery').after(modal);
            }
        }, {
            key: "showModal",
            value: function showModal(item) {

                this.currentSlide = this.itemPictures.index(item);
                this.renderSliderImages();
                this.modal.modal('show');
            }
        }, {
            key: "renderSliderImages",
            value: function renderSliderImages() {

                var index = this.currentSlide;
                var prePrevius = 0;
                var previus = 0;
                var current = 0;
                var preNext = 0;
                var next = 0;

                if (this.isMobile()) {
                    this.slideImages[1].attributes['src'].value = this.images[index].fullImage;
                    this.slideImages[1].attributes['alt'].value = this.images[index].title;
                } else {
                    this.slideImages[0].attributes['src'].value = this.images[index].fullImage;
                    this.slideImages[0].attributes['alt'].value = this.images[index].title;
                }
            }
        }, {
            key: "setDataSlider",
            value: function setDataSlider() {
                this.images = [];
                var _this = this;

                $('.galery-pop').each(function () {
                    _this.images.push({
                        id: _this.images.length,
                        fullImage: $(this).data('image'),
                        thumbImage: $(this).data('thumb'),
                        title: $(this).find('img').attr('alt')
                    });
                });
            }
        }, {
            key: "defineElements",
            value: function defineElements() {
                this.itemPictures = $(".galery-pop");
                this.modal = $('#galery-modal');
                this.slideImages = $('.slide-img');
                this.btnControll = $('.galery-btn');
                this.slider = $('#viewport');
            }
        }, {
            key: "controllDesctop",
            value: function controllDesctop(stepSlide) {

                var nextSlide = void 0;
                if ($.isNumeric(stepSlide)) {
                    nextSlide = this.currentSlide + stepSlide;
                } else {
                    var step = parseInt(stepSlide.attr('data-next-slide'));
                    nextSlide = this.currentSlide + step;
                }

                if (nextSlide < 0) {
                    this.currentSlide = this.images.length - 1;
                } else if (nextSlide > this.images.length - 1) {
                    this.currentSlide = 0;
                } else {
                    this.currentSlide = nextSlide;
                }

                this.renderSliderImages();
            }
        }, {
            key: "controllMobile",
            value: function controllMobile() {

                if (navigator.msMaxTouchPoints && false) {
                    this.slider.on('scroll', function () {
                        console.log('Scroll');
                    });
                } else {

                    var _this = this;

                    this.sliderMobile = {

                        el: {
                            nextSlide: $('.slide:eq(2)'),
                            currentSlide: $('.slide:eq(1)'),
                            prevSlide: $('.slide:eq(0)')
                        },

                        // Define these as global variables so we can use them across the entire script.
                        touchstartx: undefined,
                        touchmovex: undefined,
                        movex: undefined,
                        index: 0,
                        longTouch: undefined,
                        width: _this.slider.width(),

                        init: function init() {
                            this.bindUIEvents();
                        },

                        bindUIEvents: function bindUIEvents() {

                            _this.slider.on("touchstart", function (event) {
                                _this.sliderMobile.start(event);
                            });

                            _this.slider.on("touchmove", function (event) {
                                _this.sliderMobile.move(event);
                            });

                            _this.slider.on("touchend", function (event) {
                                _this.sliderMobile.end(event);
                            });
                        },

                        start: function start(event) {
                            this.longTouch = false;
                            setTimeout(function () {
                                // Since the root of setTimout is window we can’t reference this. That’s why this variable says window.slider in front of it.
                                _this.sliderMobile.longTouch = true;
                            }, 250);

                            this.touchstartx = event.originalEvent.touches[0].pageX;
                            this.el.currentSlide.removeClass('animate-slide-mobile');
                            this.el.nextSlide.removeClass('animate-slide-mobile');
                            this.el.prevSlide.removeClass('animate-slide-mobile');

                            this.el.currentSlide.find('>img').attr('src', _this.images[_this.currentSlide].fullImage);
                            this.el.currentSlide.find('>img').attr('alt', _this.images[_this.currentSlide].title);
                        },

                        move: function move(event) {

                            this.touchmovex = event.originalEvent.touches[0].pageX;
                            this.movex = this.touchstartx - this.touchmovex;
                            var go = -1 * this.movex;
                            this.el.currentSlide.css('transform', 'translate3d(' + go + 'px,0,0)');

                            if (this.movex > 0.1 * this.width) {
                                this.renderNexSlide();
                            } else if (this.movex < -0.1 * this.width) {
                                this.renderPrevSlide();
                            }
                        },

                        renderNexSlide: function renderNexSlide() {

                            var index = _this.currentSlide + 1 < _this.images.length ? _this.currentSlide + 1 : 0;
                            this.el.nextSlide.find('>img').attr('src', _this.images[index].fullImage);
                            this.el.nextSlide.find('>img').attr('alt', _this.images[index].title);

                            var positionNextSlide = this.width * 2 - this.movex;
                            var positionCurrentSlide = -this.movex;

                            this.el.prevSlide.css({ 'visibility': 'hidden' });
                            this.el.nextSlide.css({ 'visibility': 'visible' });

                            this.el.nextSlide.css({
                                'transform': 'scale(' + this.movex / (this.width * 2) + ') translate3d(' + positionNextSlide + 'px,0,0)'
                            });

                            this.el.currentSlide.css({
                                'transform': 'scale(' + this.width * 2 / (this.movex + this.width * 2) + ') translate3d(' + positionCurrentSlide + 'px,0,0)',
                                zIndex: 1
                            });
                        },

                        renderPrevSlide: function renderPrevSlide() {

                            var index = _this.currentSlide - 1 >= 0 ? _this.currentSlide - 1 : _this.images.length - 1;
                            this.el.prevSlide.find('>img').attr('src', _this.images[index].fullImage);
                            this.el.prevSlide.find('>img').attr('alt', _this.images[index].title);

                            var positionPrevSlide = -this.width * 1.5 + this.movex;
                            var positionCurrentSlide = -this.movex;

                            this.el.nextSlide.css({ 'visibility': 'hidden' });
                            this.el.prevSlide.css({ 'visibility': 'visible' });

                            this.el.prevSlide.css({
                                'transform': 'scale(' + -this.movex / (this.width * 2) + ') translate3d(' + positionPrevSlide + 'px,0,0)'
                            });

                            this.el.currentSlide.css({
                                'transform': 'scale(' + this.width * 2 / (-this.movex + this.width * 2) + ') translate3d(' + positionCurrentSlide + 'px,0,0)',
                                zIndex: 1
                            });
                        },

                        end: function end(event) {

                            if (this.el.currentSlide.position().left < -0.2 * this.width) {
                                this.el.currentSlide.addClass('animate-slide-mobile').css({
                                    'transform': 'scale(0) translate3d(' + -this.width + 'px,0,0)',
                                    zIndex: -1
                                });

                                this.el.nextSlide.addClass('animate-slide-mobile').css('transform', 'scale(1) translate3d(' + 0 + 'px,0,0)');

                                if (_this.currentSlide >= _this.images.length - 1) {
                                    _this.currentSlide = 0;
                                } else {
                                    _this.currentSlide++;
                                }
                            } else if (this.el.currentSlide.position().left > 0.2 * this.width) {

                                this.el.currentSlide.addClass('animate-slide-mobile').css({
                                    'transform': 'scale(0) translate3d(' + this.width + 'px,0,0)',
                                    zIndex: -1
                                });

                                this.el.prevSlide.addClass('animate-slide-mobile').css('transform', 'scale(1) translate3d(' + 0 + 'px,0,0)');

                                if (_this.currentSlide <= 0) {
                                    _this.currentSlide = _this.images.length - 1;
                                } else {
                                    _this.currentSlide--;
                                }
                            } else {
                                this.el.currentSlide.addClass('animate-slide-mobile').css({
                                    'transform': 'scale(1) translate3d(' + 0 + 'px,0,0)',
                                    zIndex: 1
                                });

                                this.el.nextSlide.addClass('animate-slide-mobile').css('transform', 'scale(0) translate3d(' + -2 * this.width + 'px,0,0)');

                                this.el.prevSlide.addClass('animate-slide-mobile').css('transform', 'scale(0) translate3d(' + -1.5 * this.width + 'px,0,0)');
                            }
                        }

                    };

                    this.sliderMobile.init();
                }
            }
        }, {
            key: "isMobile",
            value: function isMobile() {
                $.browser.device = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase());
                return $.browser.device;
            }
        }, {
            key: "preloadImages",
            value: function preloadImages() {
                var index = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;

                index = index || 0;
                var _this = this;
                if (this.images && this.images.length > index) {
                    var img = new Image();
                    this.loadedImages.push(img);
                    img.onload = function () {
                        _this.images[index].fullImage = img.src;
                        _this.preloadImages(index + 1);
                    };
                    img.src = this.images[index].fullImage;
                }
            }
        }]);

        return ArmadioGalery;
    }();

    var PageGalery = function () {
        function PageGalery() {
            _classCallCheck(this, PageGalery);
        }

        _createClass(PageGalery, [{
            key: "init",
            value: function init() {
                this.elements = {
                    galery: $('#galery'),
                    wrapImages: $('.elements')
                };

                this.defindWidthImages();
                this.getImagesProportion();
            }
        }, {
            key: "defindWidthImages",
            value: function defindWidthImages() {
                this.galeryWidth = this.elements.galery.width();
                this.elementWidth = this.galeryWidth / 4;
            }
        }, {
            key: "getImagesProportion",
            value: function getImagesProportion() {
                var _this = this;
                this.elements.wrapImages.each(function () {
                    var wid = $(this).data('size');

                    if (wid > 900) {
                        $(this).addClass('one-large-col');
                    } else if (wid < 600 && wid > 400) {
                        $(this).addClass('one-col');
                    } else if (prop < 0.3) {
                        $(this).addClass('three-col');
                    }

                    //$(this).height($(this).width() * prop);
                });
            }
        }, {
            key: "setPositionElements",
            value: function setPositionElements() {
                var _this = this;
                this.imagesProp.forEach(function (prop, index) { });
            }
        }]);

        return PageGalery;
    }();
});