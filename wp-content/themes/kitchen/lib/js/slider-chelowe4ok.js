
(function () {

    
    function Slider() {
        this.elements = {
            slider : document.getElementById('chelowe4okslider'),
            chSlides : document.getElementsByClassName('ch-slide')
        }

        this.width = 700;
        this.height = 350;
        this.currentSlide = 1;
        this.nextSlide = 1;
        this.isWrappingSlide = false;  // is now wrapping
        this.srcImages = [];
        this.slides = [];
        this.chSlideContainer;
        this.containerTranlate = 0;
    }

    Slider.prototype.init = function () {
        this.readData();
        this.createDom();
        this.bindUI();
    };

    Slider.prototype.bindUI = function () {
        
        this.elements.btnNext.addEventListener("click", function () {
            this.showNextSlide();
        }.bind(this), false);

        this.elements.btnPrev.addEventListener("click", function () {
            this.showPrevSlide();
        }.bind(this), false);
    };

    Slider.prototype.readData = function () {    
        
        for (var i = 0; i < this.elements.slider.childNodes.length; i++) {
            if (this.elements.slider.childNodes[i].className && /ch-slide/gi.test(this.elements.slider.childNodes[i].className)) {
                this.srcImages.push(this.elements.slider.childNodes[i].getElementsByTagName('img')[0].getAttribute('data-src'));
            }
        }
    };

    Slider.prototype.createDom = function () {

        // clear stuff slider dom
        this.elements.slider.innerHTML = '';

        // create slider dom elements
        var innerControls = document.createElement('div'),
            chView = document.createElement('div');

        this.chSlideContainer = document.createElement('div');
        this.elements.btnNext = document.createElement('div');
        this.elements.btnPrev = document.createElement('div');
        
        // add class for dom elements
        innerControls.className += 'inner-controls';
        chView.className += 'ch-view';
        this.chSlideContainer.className += 'ch-slide-container';
        this.elements.btnPrev.className += 'btn-prev slider-button slider-display-left';
        this.elements.btnNext.className += 'btn-next slider-button slider-display-right';

        var valTranslate = this.srcImages.length > 2 ? -(this.width + 10) : this.width / 2;

        if (!isIE11()) {
            this.chSlideContainer.style.transform = 'translateX(' + valTranslate + 'px) translateZ(0px)';
            this.containerTranlate = valTranslate;
        }

        // create slide group element
        for (var i = 0; i < this.srcImages.length; i++) {
            
            var image = document.createElement('img'),
                slide = document.createElement('div'),
                wrapperImage = document.createElement('div');

            slide.className += 'ch-slide';
            image.src = this.srcImages[i];
            image.style.width = this.width + 'px';

            if (isIE11() && this.srcImages.length > 2) {
                if (i == 0) {
                    slide.style.left = -(this.width + 10) + 'px';
                } else {
                    slide.style.left = (this.width + 10) * (i - 1) + 'px';
                }
                
            } else if (isIE11()) {
                slide.style.left = (this.width + 10) * i + this.width / 2 + 'px';
            } else {
                slide.style.left = (this.width + 10) * i + 'px';

                if (this.srcImages.length > 2) {
                    switch (i) {
                        case 0:
                            slide.style.transform = 'translateZ(-100px) rotateY(50deg)';
                            break;
                        case 1:
                            slide.style.transform = 'translateZ(0px) rotateY(0deg)';
                            break;
                        case this.srcImages.length - 1:
                            slide.style.transform = 'translateZ(-100px) rotateY(50deg)';
                            slide.style.left = -(this.width + 10) + 'px';
                            break;
                        default:
                            slide.style.transform = 'translateZ(-100px) rotateY(-50deg)';
                    }
                } else {
                    switch (i) {
                        case 0:
                            slide.style.transform = 'translateZ(0px) rotateY(0deg)';
                            break;
                        default:
                            slide.style.transform = 'translateZ(-100px) rotateY(-50deg)';
                    }
                }
                
                
            }

            this.slides.push(slide);

            wrapperImage.appendChild(image);
            slide.appendChild(wrapperImage);
            console.log(this.srcImages.length);
            this.chSlideContainer.appendChild(slide);
        }


        
        // append created dom to html markup
        chView.appendChild(this.chSlideContainer);
        innerControls.appendChild(chView);
        chView.appendChild(this.elements.btnNext);
        chView.appendChild(this.elements.btnPrev);
        this.elements.slider.appendChild(innerControls);

        
    };

    Slider.prototype.showNextSlide = function () {

        if (this.isWrappingSlide) return;

        this.isWrappingSlide = true;
        var id = setInterval(move, 10);
        var tmpAngle = 0;
        var tmpTranslate = 0;
        var tmpAngleNext = -50;
        var tmpTranslateNext = -100;

        this.currentSlide = this.currentSlide >= this.slides.length ? 0 : this.currentSlide; 
        this.nextSlide = this.currentSlide == this.slides.length - 1 ? 0 : this.nextSlide + 1;

        var tmpContainerTranlate = this.containerTranlate;

        var self = this;
        function move() {
            if (tmpAngle == 50 && tmpTranslate == -100) {
                clearInterval(id);

                self.chSlideContainer.style.transform = 'translateX(' + self.containerTranlate + 'px)';
                var value = 0;
                for (var i = 0; i < self.slides.length; i++) {
                    value = parseInt(self.slides[i].style.getPropertyValue('left').replace(/px/gi, '')) - (self.width + 10);
                    if (value < -(self.width + 10)) {
                        value = (self.width + 10) * (self.slides.length - 2);
                        self.slides[i].style.transform = 'translateZ(-100px) rotateY(-50deg)';
                    }

                    self.slides[i].style.left = value + 'px';
                }
                self.isWrappingSlide = false;
                self.currentSlide++;
            } else {
                tmpAngle++;
                tmpTranslate -= 2;
                tmpAngleNext++;
                tmpTranslateNext += 2;

                self.slides[self.currentSlide].style.transform = 'translateZ(' + tmpTranslate + 'px) rotateY(' + tmpAngle + 'deg)';
                self.slides[self.nextSlide].style.transform = 'translateZ(' + tmpTranslateNext + 'px) rotateY(' + tmpAngleNext + 'deg)';

                console.log();
                tmpContainerTranlate = tmpContainerTranlate + (self.width + 10) / -50;
                self.chSlideContainer.style.transform = 'translateX(' + tmpContainerTranlate  + 'px)';
                
            }
        };
    }

    Slider.prototype.showPrevSlide = function () {

        if (this.isWrappingSlide) return;

        this.isWrappingSlide = true;
        var id = setInterval(move, 10);
        var tmpAngle = 0;
        var tmpTranslate = 0;
        var tmpAnglePrev = 50;
        var tmpTranslatePrev = -100;

        this.currentSlide = this.currentSlide < 0 ? this.slides.length - 1 : this.currentSlide;
        this.nextSlide = this.currentSlide == 0 ? this.slides.length - 1 : this.nextSlide - 1;
        console.log(this.currentSlide);
        console.log(this.nextSlide);
        var tmpContainerTranlate = this.containerTranlate;

        var self = this;
        function move() {
            if (tmpAngle == -50 && tmpTranslate == -100) {
                clearInterval(id);

                self.chSlideContainer.style.transform = 'translateX(' + self.containerTranlate + 'px)';
                var value = 0;
                for (var i = 0; i < self.slides.length; i++) {
                    value = parseInt(self.slides[i].style.getPropertyValue('left').replace(/px/gi, '')) + (self.width + 10);
                    if (value >= (self.width + 10) * (self.slides.length - 1)) {
                        value = -(self.width + 10);
                        self.slides[i].style.transform = 'translateZ(-100px) rotateY(50deg)';
                    }

                    self.slides[i].style.left = value + 'px';
                }

                self.isWrappingSlide = false;
                self.currentSlide--;
            } else {
                tmpAngle--;
                tmpTranslate -= 2;
                tmpAnglePrev--;
                tmpTranslatePrev += 2;

                self.slides[self.currentSlide].style.transform = 'translateZ(' + tmpTranslate + 'px) rotateY(' + tmpAngle + 'deg)';
                self.slides[self.nextSlide].style.transform = 'translateZ(' + tmpTranslatePrev + 'px) rotateY(' + tmpAnglePrev + 'deg)';

                console.log();
                tmpContainerTranlate = tmpContainerTranlate + (self.width + 10) / 50;
                self.chSlideContainer.style.transform = 'translateX(' + tmpContainerTranlate + 'px)';

            }
        };
    }

    function isIE11() {
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        return msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./); // If Internet Explorer 11 and less
    }
    

    document.addEventListener("DOMContentLoaded", function (event) {
        var slide = new Slider();
        slide.init();
    });
    
})();
