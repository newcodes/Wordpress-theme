jQuery(function ($) {
    $(document).ready(function () {

        let slider = new ProductSlider().init();

    });

    class ProductSlider{
        constructor() { }

        init() {

            this.initElements();
            this.createView();
            this.positionView()

            $(window).resize( () => {
                this.createView();
            });

            this.countWrap = 0;
            this.bindBtns();
        }

        initElements() {
            this.elements = {
                images: $(".product-image"),
                viewport: $(".viewport"),
                wrapper: $(".wrapper"),
                btnNext: $(".wrapper .galery-btn")
            };
        }

        createView() {

            this.firstImage = $("<div class='first-image slide-image'></div>");
            this.previousImage = $("<div class='previous-image slide-image'></div>");
            this.rootImage = $("<div class='root-image slide-image'></div>");
            this.nextImage = $("<div class='next-image slide-image'></div>");
            this.lastImage = $("<div class='last-image slide-image'></div>");

            this.elements.viewport.append(this.firstImage);
            this.elements.viewport.append(this.previousImage);
            this.elements.viewport.append(this.rootImage);
            this.elements.viewport.append(this.nextImage);
            this.elements.viewport.append(this.lastImage);

            this.elements.slides = $(".slide-image");

            for (let i = 0; i < this.elements.slides.length; i++) {
                this.elements.slides[i].append(this.elements.images[0]);
            }

            this.deviceWidth = $(window).width();

            

            this.elements.slides.css({ "float": "left", "position": "relative", "width": this.deviceWidth / 2 });
            this.elements.wrapper.css({ "overflow": "hidden", "position": "relative", "height": "500px" });
            let viewportWidth = 0;

            this.elements.images.each(index => {
                viewportWidth += this.elements.images[index].offsetWidth;
            });

            viewportWidth += 2; // add two pixels for one line
            this.currentLeftPosition = 0;

            this.elements.viewport.css({ "width": viewportWidth + 'px', "height": "600px", "position": "absolute", "left": -this.deviceWidth / 4 });
            this.currentLeftPosition = 0;
                       
        }

        bindBtns() {
            let _this = this;
            this.elements.btnNext.click(function() {
                let nextPhoto = parseInt($(this).data("next-slide"));
                _this.showNextPhoto(nextPhoto);
            });
        }

        showNextPhoto(nextPhoto) {
            let move = 0;

            if (nextPhoto === 1) {
                this.elements.viewport.append(this.elements.slides[0]);
                move = -this.deviceWidth / 2 + this.currentLeftPosition;

                this.countWrap += 1;
                this.currentLeftPosition = this.currentLeftPosition - (this.deviceWidth / 4 * this.countWrap);

                this.elements.viewport.css({ "left": this.currentLeftPosition + "px" });
                this.elements.slides = $(".image-slide");
                
            } else if (nextPhoto === -1) {
                this.elements.viewport.prepend(this.elements.slides[this.elements.slides.length - 1]);
                move = this.deviceWidth / 2 + this.currentLeftPosition;

                this.countWrap -= 1;
                this.currentLeftPosition = this.currentLeftPosition - (this.deviceWidth / 2 * this.countWrap);

                this.elements.viewport.css({ "left": this.currentLeftPosition + "px" });
                this.elements.slides = $(".image-slide");
                
            }

            console.log(this.currentLeftPosition);

            this.currentLeftPosition = move;
            
            console.log(this.countWrap);
            
            this.elements.viewport.css({ "transform": "translate(" + move + "px)" });
            
        }
    }
});