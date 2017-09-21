jQuery(function ($) {
    $(document).ready(function () {

        let slider = new ProductSlider().init();

    });

    class ProductSlider{
        constructor() { }

        init() {

            this.initElements();
            this.loadImages();
            //this.createView();

            $(window).resize( () => {
                this.onResize();
            });

            this.countWrap = 0;
            this.bindBtns();
        }

        initElements() {
            this.elements = {
                listImages: $(".product-list-image"),
                viewport: $(".viewport"),
                wrapper: $(".wrapper"),
                btnNext: $(".wrapper .galery-btn")
            };
        }

        onResize() {
            this.deviceWidth = $(window).width();



            this.elements.slides.css({ "float": "left", "position": "relative", "width": this.deviceWidth / 2 });

            let viewportWidth = 0;
            let wrapperHeight = 0;
            this.elements.images.each(index => {
                viewportWidth += this.elements.images[index].offsetWidth;
                if (this.elements.images[index].offsetHeight > wrapperHeight) {
                    wrapperHeight = this.elements.images[index].offsetHeight;
                }
            });

            this.elements.wrapper.css({ "overflow": "hidden", "position": "relative", "height": wrapperHeight });

            viewportWidth += 2; // add two pixels for one line

            this.elements.viewport.css({ "width": viewportWidth + 'px', "height": "600px", "position": "absolute", "left": -3 * this.deviceWidth / 4 });
        }

        loadImages() {

            $("#product-page").css({ "opacity": "0" });
            this.elements.wrapper.css({"height": "100vh"});
            let loadedImages = 0;
            this.elements.listImages.each(index => {
                var image = new Image();
                let _this = this;
                image.onload = function () {
                    let indx = index;
                    loadedImages++;
                    if (loadedImages == _this.elements.listImages.length) {
                        $("#product-page").css({ "opacity": "1" });
                        _this.createView();
                    }
                }
                image.onerror = function () {
                    console.error("Cannot load image");
                }
                image.src = this.elements.listImages[index].src;
            });
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

            if (this.elements.listImages.length < 5) {
                this.containImages();
            }

            let startLoopImages = 0;

            this.elements.slides.each(index => {

                if (this.elements.listImages.length - 1 < index) {
                    let imgUrl = this.elements.listImages[startLoopImages].src;
                    let img = $("<img class='product-image'/>");
                    img.attr("src", imgUrl);
                    startLoopImages++;
                    this.elements.slides[index].append(img[0]);
                } else {
                    let imgUrl = this.elements.listImages[index].src;
                    let img = $("<img class='product-image'/>");
                    img.attr("src", imgUrl);
                    this.elements.slides[index].append(img[0]);
                }

            });

            this.elements.images = $(".product-image");
            this.deviceWidth = $(window).width();

            this.elements.slides.css({ "float": "left", "position": "relative", "width": this.deviceWidth / 2 });
            
            let viewportWidth = 0;
            let wrapperHeight = 0;

            this.elements.images.each(index => {
                viewportWidth += this.elements.images[index].offsetWidth;
                if (this.elements.images[index].offsetHeight > wrapperHeight) {
                    wrapperHeight = this.elements.images[index].offsetHeight;
                }
            });

            this.elements.wrapper.css({ "overflow": "hidden", "position": "relative", "height": wrapperHeight });

            viewportWidth += 2; // add two pixels for one line

            this.elements.viewport.css({ "width": viewportWidth + 'px', "height": "600px", "position": "absolute", "left": -3 * this.deviceWidth / 4 });

            this.rootImage.css({ "transition": "transform 1s, opacity 1s", "transform": "scale(1.2)", "z-index": "10" });
            this.previousImage.css({ "opacity": "0.4", "transition": "transform 1s, opacity 1s" });
            this.nextImage.css({ "opacity": "0.4", "transition": "transform 1s, opacity 1s" });
            this.lastImage.css({ "opacity": "0.4", "transition": "transform 1s, opacity 1s" });
            this.firstImage.css({ "opacity": "0.4", "transition": "transform 1s, opacity 1s" });


            this.currentImage = 2;
                       
        }

        containImages() {
            let needsToAdd = 5 - this.elements.listImages.length;
            
            this.elements.listImages.each(index => {
                if (needsToAdd >= 1 && index != this.elements.listImages.length - 1) {
                    this.elements.listImages.push(this.elements.listImages[index]);
                    needsToAdd--;
                } else if (index == this.elements.listImages.length - 1 && needsToAdd > 1) {
                    this.elements.listImages.push(this.elements.listImages[index]);
                    needsToAdd--;
                    this.containImages();
                }
            });
        }

        bindBtns() {
            let _this = this;
            this.elements.btnNext.click(function() {
                let nextPhoto = parseInt($(this).data("next-slide"));
                _this.showNextPhoto(nextPhoto);
            });
        }

        showNextPhoto(nextPhoto) {

            if (this.isShowingNextImage) return;

            this.isShowingNextImage = true;

            let move = 0;

            this.rootImage.css({ "transition": "transform 1s, opacity 1s" });
            this.nextImage.css({ "transition": "transform 1s, opacity 1s" });
            this.previousImage.css({ "transition": "transform 1s, opacity 1s" });

            if (nextPhoto === 1) {
                move = -5 * this.deviceWidth / 4;
                this.elements.viewport.animate({ "left": move + "px" }, 1000, () => {
                    this.setCurrentImage(1);

                    this.rootImage.css({ "transition": "none", "transform": "scale(1.2)", "opacity": "1" });
                    this.nextImage.css({ "transition": "none", "transform": "scale(1)", "opacity": "0.4", "z-index": "0" });

                    this.isShowingNextImage = false;
                });

                this.rootImage.css({ "transform": "scale(1)", "opacity": "0.4" });
                this.nextImage.css({ "transform": "scale(1.2)", "opacity": "1", "z-index": "10" });
            } else if (nextPhoto === -1) {
                move = -this.deviceWidth / 4;
                this.elements.viewport.animate({ "left": move + "px" }, 1000, () => {
                    this.setCurrentImage(-1);

                    this.rootImage.css({ "transition": "none", "transform": "scale(1.2)", "opacity": "1" });
                    this.previousImage.css({ "transition": "none", "transform": "scale(1)", "opacity": "0.4", "z-index": "0" });

                    this.isShowingNextImage = false;
                });

                this.rootImage.css({ "transform": "scale(1)", "opacity": "0.4" });
                this.previousImage.css({ "transform": "scale(1.2)", "opacity": "1", "z-index": "11" });

            }
        }

        setCurrentImage(step) {

            let firstImage;
            let previousImage;
            let nextImage;
            let lastImage;

            if (this.currentImage + step + 2 < this.elements.listImages.length && this.currentImage + step - 2 >=0 ) {
                this.currentImage = this.currentImage + step;

                firstImage = this.currentImage - 2;
                previousImage = this.currentImage - 1;
                nextImage = this.currentImage + 1;
                lastImage = this.currentImage + 2;

            } else if (step == 1 && this.currentImage + 2 == this.elements.listImages.length - 1) {
                this.currentImage = this.currentImage + step;

                firstImage = this.currentImage - 2;
                previousImage = this.currentImage - 1;
                nextImage = this.currentImage + 1;
                lastImage = 0;

            } else if (step == 1 && this.currentImage + 1 == this.elements.listImages.length - 1) {
                this.currentImage = this.currentImage + step;

                firstImage = this.currentImage - 2;
                previousImage = this.currentImage - 1;
                nextImage = 0;
                lastImage = 1;
            } else if (step == -1 && this.currentImage - 2 == 0 || (step == 1 && this.currentImage == 0)) {
                this.currentImage = this.currentImage + step;

                firstImage = this.elements.listImages.length - 1;
                previousImage = 0;
                nextImage = this.currentImage + 1;
                lastImage = this.currentImage + 2;
            } else if (step == -1 && this.currentImage - 1 == 0) {
                this.currentImage = this.currentImage + step;

                firstImage = this.elements.listImages.length - 2;
                previousImage = this.elements.listImages.length - 1;
                nextImage = this.currentImage + 1;
                lastImage = this.currentImage + 2;
            } else if ( step == 1 && this.currentImage == this.elements.listImages.length - 1) {
                this.currentImage = 0;

                firstImage = this.elements.listImages.length - 2;
                previousImage = this.elements.listImages.length - 1;
                nextImage = this.currentImage + 1;
                lastImage = this.currentImage + 2;
            } else if (step == -1 && this.currentImage == 0) {
                this.currentImage = this.elements.listImages.length - 1;

                firstImage = this.elements.listImages.length - 3;
                previousImage = this.elements.listImages.length - 2;
                nextImage = 0;
                lastImage = 1;
            } else if (step == -1 && this.currentImage == this.elements.listImages.length - 1) {
                this.currentImage = this.currentImage + step;

                firstImage = this.elements.listImages.length - 4;
                previousImage = this.elements.listImages.length - 3;
                nextImage = this.elements.listImages.length - 1;
                lastImage = 0;
            }

            this.firstImage.find('img').attr("src", this.elements.listImages[firstImage].src);
            this.previousImage.find('img').attr("src", this.elements.listImages[previousImage].src);
            this.rootImage.find('img').attr("src", this.elements.listImages[this.currentImage].src);
            this.nextImage.find('img').attr("src", this.elements.listImages[nextImage].src);
            this.lastImage.find('img').attr("src", this.elements.listImages[lastImage].src);

            this.elements.viewport.css({"left": -3 * this.deviceWidth / 4 });

            
        }
    }
});