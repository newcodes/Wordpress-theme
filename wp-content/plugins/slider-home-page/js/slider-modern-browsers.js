jQuery(function ($) {
    class Slider {

        constructor() {
            this.currentSlide = 1;
            this.next = 1;
            this.nextSlide = 2;
            this.currentAutoPlayIndex = 0;
            this.currentTextEffect = 0;
            this.isEndAnimation = true;
            this.effects = ['book', 'opendoor', 'blinds'];
            this.textEffects = ['bridge', 'gate', 'gelicopter'];

            if ($('#slide').attr('data-image-url')) {
                let arraySrc = $('#slide').attr('data-image-url').split(/;/);
                let arrayText = $('#slide').attr('data-text').split(/;/);
                let arrayText2 = $('#slide').attr('data-text-2').split(/;/);
                arraySrc.pop();
                arrayText.pop();
                arrayText2.pop();
                this.arraySrc = arraySrc;
                this.arrayText = arrayText;
                this.arrayText2 = arrayText2;
                this.numberSlides = arraySrc.length;
            }
            let self = this;
            $('.slider-button').click(function () {
                self.next = parseInt($(this).attr('data-next-slide'));
                self.userControled = true;
                if (self.isEndAnimation) {
                    if (self.autoPlayTimeout) clearTimeout(self.autoPlayTimeout);
                    self.controlSlide(self.getNextEffect());
                }

            });
        }

        init() {
            this.effectText(this.getNextTextEffect());

            if (this.isEndAnimation) {
                if (this.currentSlide > this.numberSlides) {
                    this.currentSlide = 1;
                }
                if (this.currentSlide < 1) {
                    this.currentSlide = this.numberSlides;
                }
            }
            let src = this.arraySrc[this.currentSlide - 1];
            let srcUrl = 'url(' + src + ')';
            $("#slide").css('background', srcUrl);

            if (this.autoPlay) {
                this.userControled = false;
                this.auto();
            }
        }

        auto() {

            this.autoPlay = true;
            let self = this;
            clearTimeout(this.autoPlayTimeout);
            this.autoPlayTimeout = setTimeout(function () {
                this.next = 1;
                self.controlSlide(self.getNextEffect());
            }, 5000);
        }

        getRandomEffect() {
            let min = 0;
            let max = this.effects.length;
            let randomIndex = Math.floor(Math.random() * (max - min + 1)) + min - 1;
            return this.effects[this.randomIndex];
        }

        getNextTextEffect() {
            let min = 0;
            let max = this.textEffects.length;
            this.currentTextEffect = this.currentTextEffect >= max - 1 ? 0 : ++this.currentTextEffect;

            return this.textEffects[this.currentTextEffect];
        }

        getNextEffect() {
            let min = 0;
            let max = this.effects.length;
            this.currentAutoPlayIndex++;
            if (this.currentAutoPlayIndex == max) this.currentAutoPlayIndex = 0;
            return this.effects[this.currentAutoPlayIndex];
        }



        controlSlide(effect = 'opendoor') {

            let slides = $("#slide");

            if (this.currentSlide == this.numberSlides && this.next == 1) {
                this.nextSlide = 1;
            } else
                if (this.currentSlide == this.numberSlides && this.next == -1) {
                    this.nextSlide = this.numberSlides - 1;
                } else
                    if (this.currentSlide == 1 && this.next == 1) {
                        this.nextSlide = 2;
                    } else
                        if (this.currentSlide == 1 && this.next == -1) {
                            this.nextSlide = this.numberSlides;
                        } else {
                            this.nextSlide = this.currentSlide + this.next;
                        }

            if (!this.isEndAnimation) {


                if (this.currentSlide > this.numberSlides) {
                    this.currentSlide = 1;
                } else if (this.currentSlide < 1) {
                    this.currentSlide = this.numberSlides;
                } else if (this.currentSlide > 1 && this.currentSlide < this.numberSlides) {
                    this.currentSlide += this.next;
                } else if (this.currentSlide == this.numberSlides) {
                    this.currentSlide = this.next == 1 ? 1 : this.numberSlides - 1;
                } else if (this.currentSlide == 1) {
                    this.currentSlide = this.next == 1 ? 2 : this.numberSlides;
                }

                clearTimeout(this.animationTimeout);
                $('#slide').empty();
                $('#slide').addClass('animation-off');
                $('#nextSlide').addClass('animation-off');
                $('#nextSlide').removeClass('opendoor-animate');
                $('#nextSlide').css('display', 'none');

            }

            let self = this;
            this.effect(effect).then(function () {

                if (self.isEndAnimation) {
                    self.currentSlide += self.next;
                    self.init();

                } else {
                }

            });
        }

        addEffects(...args) {
            if (args.length != 0) {

            }
        }

        effect(name) {

            let self = this;

            return new Promise(function (resolve, reject) {

                if (!self.isEndAnimation) {
                    if (self.currentSlide == self.numberSlides && self.next == 1) {
                        self.nextSlide = 1;
                    } else
                        if (self.currentSlide == self.numberSlides && self.next == -1) {
                            self.nextSlide = self.numberSlides - 1;
                        } else
                            if (self.currentSlide == 1 && self.next == 1) {
                                self.nextSlide = 2;
                            } else
                                if (self.currentSlide == 1 && self.next == -1) {
                                    self.nextSlide = self.numberSlides;
                                } else {
                                    self.nextSlide = self.currentSlide + self.next;
                                }

                }

                let slide = $("#slide");
                let nextSlide = $("#nextSlide");

                slide.empty();
                nextSlide.empty();
                slide.removeClass();
                nextSlide.removeClass();
                nextSlide.css('background', 'none');

                let width = $("#slider").width();
                let height = $("#slider").height();
                let src = self.arraySrc[self.currentSlide - 1];
                let srcUrl = 'url(' + src + ')';
                let srcNext = self.arraySrc[self.nextSlide - 1];
                let srcNextUrl = 'url(' + srcNext + ')';

                if (name == 'opendoor') {

                    let topParts = $('<div class="topParts"></div>');
                    let bottomParts = $('<div class="bottomParts"></div>');

                    slide.append(topParts);
                    slide.append(bottomParts);

                    slide.css('background', 'none');

                    $('.topParts').css({
                        'height': height / 2,
                        'z-index': 5,
                        'background': srcUrl
                    });
                    $('.bottomParts').css({
                        'height': height / 2,
                        'z-index': 5,
                        'background': srcUrl,
                        'background-position-y': -height / 2
                    });


                    $('.topParts').animate({
                        'bottom': '1000px'
                    }, 2000, 'linear');

                    $('.bottomParts').animate({
                        'top': '1000px'
                    }, 2000, 'linear');

                    nextSlide.css({
                        'position': 'absolute',
                        'display': 'block',
                        'background': srcNextUrl
                    });

                    nextSlide.addClass('opendoor-animate');
                    $('.topParts').addClass('opnendor-animate-slide');
                    $('.bottomParts').addClass('opnendor-animate-slide');

                    self.isEndAnimation = false;
                    self.animationTimeout = setTimeout(function () {
                        self.userControled = false;
                        nextSlide.css('display', 'none');
                        if (!self.isEndAnimation) {
                            $('#slide').empty();
                            self.isEndAnimation = true;
                            return resolve(0);
                        } else {
                            $('#slide').empty();
                            nextSlide.removeClass('opendoor-animate');
                            self.isEndAnimation = true;
                            return resolve(1);
                        }

                    }, 2000);

                } else if (name == 'book') {


                    slide.removeClass('animation-off');
                    nextSlide.removeClass('animation-off');
                    slide.addClass('book-animation');

                    slide.css({
                        'z-index': '10',
                        'background': 'transperent'
                    });

                    if (!self.isEndAnimation) {
                        let srcNext1 = self.arraySrc[self.nextSlide - 1];
                        let srcNextUrl1 = 'url(' + srcNext1 + ')';
                        self.anotherAnimate = true;
                        nextSlide.addClass('book-animation-back');
                        slide.css({
                            'z-index': '0',
                            'background': 'none'
                        });
                        nextSlide.css({
                            'display': 'block',
                            'background': srcNextUrl1
                        });
                    } else {
                        self.anotherAnimate = false;
                        self.animationTimeout = setTimeout(function () {
                            nextSlide.addClass('book-animation-back');
                            if (!self.anotherAnimate) {
                                slide.css({
                                    'z-index': '0',
                                    //                                'background': 'none'
                                });
                                nextSlide.css({
                                    'display': 'block',
                                    'background': srcNextUrl
                                });
                            }


                        }, 500);
                    }



                    self.isEndAnimation = false;
                    self.animationTimeout = setTimeout(function () {

                        self.userControled = false;
                        nextSlide.css('display', 'none');
                        slide.css({
                            'background': srcNextUrl
                        });

                        nextSlide.removeClass('book-animation-back');

                        if (!self.isEndAnimation) {
                            self.isEndAnimation = true;
                            slide.removeClass('book-animation');
                            return resolve(0);
                        } else {
                            $('#slide').empty();
                            slide.removeClass('book-animation');
                            nextSlide.css('display', 'none');
                            self.isEndAnimation = true;
                            return resolve(1);
                        }

                    }, 1500);

                } else if (name == 'blinds') {


                    let widthSlide = $("#nextSlide").width();
                    nextSlide.css({
                        'display': 'block'
                    })

                    widthSlide = widthSlide - 1;

                    for (let i = 0; i < 8; i++) {

                        let blind = $('<div class="blind"></div>');
                        let position = i == 0 ? 0 : widthSlide / 8 * (i);

                        blind.css({
                            width: widthSlide / 8,
                            height: height,
                            'z-index': '10',
                            'background-position-x': -position,
                            'background-image': srcNextUrl
                        });

                        nextSlide.append(blind);

                    }

                    $('.blind').addClass('blind-animation-next');

                    self.isEndAnimation = false;
                    self.animationTimeout = window.setTimeout(function () {
                        $('.blind').removeClass('blind-animation-next');
                        self.userControled = false;
                        nextSlide.css('display', 'none');
                        nextSlide.empty();
                        slide.css({
                            'background': srcNextUrl
                        });
                        if (!self.isEndAnimation) {
                            self.isEndAnimation = true;
                            return resolve(0);
                        } else {
                            $('#slide').empty();
                            self.isEndAnimation = true;
                            return resolve(1);
                        }
                    }, 2000);

                }


            });


        }

        effectText(name) {
            let self = this;

            return new Promise(function (resolve, reject) {

                if (self.arrayText[self.currentSlide - 2] && self.arrayText2[self.currentSlide - 2]) {


                    let slide = $("#slide");
                    let nextSlide = $("#nextSlide");

                    let width = $("#slider").width();
                    let height = $("#slider").height();
                    let src = self.arraySrc[self.currentSlide - 2];
                    let srcUrl = 'url(' + src + ')';
                    let srcNext = self.arraySrc[self.nextSlide - 2];
                    let srcNextUrl = 'url(' + srcNext + ')';

                    let firstText = $('<div class="slider-text-one"></div>');
                    let spanOne = $('<span></span>');
                    let spanTwo = $('<span></span>');
                    spanOne.text(self.arrayText[self.currentSlide - 2]);
                    firstText.append(spanOne);
                    slide.append(firstText);
                    let secondText = $('<div class="slider-text-two"></div>');
                    spanTwo.text(self.arrayText2[self.currentSlide - 2]);
                    secondText.append(spanTwo);
                    slide.append(secondText);
                    if (name == 'bridge') {


                        firstText.addClass('bridge-animation-first-text').css('top', '30%');
                        secondText.addClass('bridge-animation-second-text').css('top', '30%');
                    } else if (name == 'gate') {

                        let indentLeft = width > 600 ? '20vw' : '2vw';
                        firstText.addClass('gate-animation-first-text').css('left', indentLeft);
                        secondText.addClass('gate-animation-second-text').css('left', indentLeft);
                    } else if (name == 'gelicopter') {
                        firstText.addClass('gelicopter-animation-text').css({ 'top': '30%', 'margin': '0 auto', 'textAlign': 'center' });
                        secondText.addClass('gelicopter-animation-text').css({ 'top': '40%', 'margin': '0 auto', 'textAlign': 'center' });
                    }

                }

            });
        }
    }



    let mySlide = new Slider();

    mySlide.init();

    setTimeout(function () { mySlide.auto() }, 2000);
});