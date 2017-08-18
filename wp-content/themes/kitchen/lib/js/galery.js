
jQuery(function($){
    
    
    class Galery {
        
        constructor(){
            this.setOptions();
            this.getDataImage();
            this.setModal();
        }
    
        init(){
            
            let _this = this;
            
            $(".galery-pop").on("click", function() {
               let index = $(".galery-pop").index($(this));
               _this.currentSlide = index;
               let counter = 0;
               $('#viewport img').each(function(){
                   
                   if ((index + counter) >= _this.images.length){
                       index = 0;
                       counter = 0;
                   }
                   
                   $(this).attr('src', _this.loadedImages[counter + index].src);
                   $(this).attr('alt', _this.images[counter + index].title);
                                      
                   counter++;
               });

               $('#galery-modal').modal('show'); // galery-modal is the id attribute assigned to the bootstrap modal, then i use the show function
                
                
                _this.controll();
                
               
            });
            
            this.renderDom();
            
            this.loadedImages = [];
            this.preloadImages();
            $('#galery-modal .modal-footer .galery-carousel').css('width', ($(".galery-pop").length + 1) * 100);
            
        }
        
        isMobile(){
            $.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
            return $.browser.device;
        }
        
        setOptions(){
            this.options = {
                'start': 'strarty'
            }
        }
        
        preloadImages(index = 0){
            index = index || 0;
            let _this = this;
            if (this.images && this.images.length > index) {
                var img = new Image ();
                this.loadedImages.push(img);
                img.onload = function() {
                    _this.preloadImages(index + 1);
                }
                img.src = this.images[index].fullImage;

            }
        }
        
        
        setModal(){
            let modal = `<div class="modal fade" id="galery-modal" tabindex="-1" role="dialog" aria-labelledby="galery-modal-label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <div id="galery-slider">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div id="viewport">
                            <img src="" alt="" class="slide-img">
                        </div>
                    </div>
                    <div class="galery-slider-btn btn-left" data-next-slide="-1"></div>
                    <div class="galery-slider-btn btn-right" data-next-slide="+1"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="galery-carousel"></div>
                    <div class="galery-slider-btn btn-left" data-next-slide="-1"></div>
                    <div class="galery-slider-btn btn-right" data-next-slide="+1"></div>
                  </div>
                </div>
              </div>
            </div>`
            
            $('#galery').after(modal);
        }
        
        getDataImage(){
            
            this.images = [];
            let _this = this;
            
            $('.galery-pop').each(function() {
              _this.images.push({
                  id: _this.images.length,
                  fullImage: $(this).data('image'),
                  thumbImage: $(this).data('thumb'),
                  title: $(this).find('img').attr('alt')
              });
                
            _this.sliderWidth = _this.sliderWidth + 100;
            });
        }
        
        setTemplate({ thumbImage, title }){
            return `
              <div style="float: left; overflow: hidden; display: inline-block;"><img src="${thumbImage}" alt="${ title }"></div>
            `
        }
        
        renderDom(){
            $('#galery-modal .modal-footer .galery-carousel').html(this.images.map(this.setTemplate).join(''));    
        }
        
        controll(){
            
            let _this = this;
            
            if ( this.isMobile() ){
                this.controllMobileCarousel();
            }else{
                $('#galery-modal .modal-footer .galery-slider-btn').click(function(){
                                
                let step = parseInt($(this).attr('data-next-slide'));
                _this.renderCarousel(step);
                });
            }
            
            
            $('#galery-modal .modal-body .galery-slider-btn').click(function(){
                                
                let step = parseInt($(this).attr('data-next-slide'));
                _this.renderSlide(step);
            });
            
            $( '#galery-modal' ).keyup(function( event ){
                                
                if ( event['keyCode']  == 37 || event['keyCode']  == 40 ){
                    _this.renderSlide(1);    
                }else if ( event['keyCode']  == 39 || event['keyCode']  == 38 ){
                    _this.renderSlide(-1);
                }
            });
        }
        
        controllMobileCarousel(){
            
            $('#galery-modal .modal-footer .galery-carousel > div, #galery-modal .modal-footer .galery-carousel img').css({
                    width: '75px',
                    height: '75px'
            });    
            
            
            
            if (navigator.msMaxTouchPoints){
                $('#galery-slider').on('scroll', function() {
                    console.log('Scroll');
                });
            }else {
                
                let _this = this;
                this.sliderCarouselMobile = {

                    el: {
                      slider: $("#galery-slider .modal-footer"),
                      holder: $(".galery-carousel"),
                      imgSlide: $(".galery-carousel > div > img")
                    },

                    // Define these as global variables so we can use them across the entire script.
                    touchstartx: undefined,
                    touchmovex: undefined, 
                    movex: 0,
                    index: 0,
                    longTouch: undefined,
                    width: undefined,
                    totalWidthCarousel: ($(".galery-pop").length + 1) * 75,
                    currentPositionCarousel: undefined,
                    numberWrapingFullScreen: undefined,
                    
                    init: function() {
                      this.bindUIEvents();
                    },

                    bindUIEvents: function() {

                      this.el.holder.on("touchstart", function(event) {
                        _this.sliderCarouselMobile.start(event);
                      });

                      this.el.holder.on("touchmove", function(event) {
                        _this.sliderCarouselMobile.move(event);
                      });

                      this.el.holder.on("touchend", function(event) {
                        _this.sliderCarouselMobile.end(event);
                      });

                    },
                    
                    start: function(event){
                        this.longTouch = false;
                        setTimeout(function() {
                          // Since the root of setTimout is window we can’t reference this. That’s why this variable says window.slider in front of it.
                          _this.sliderCarouselMobile.longTouch = true;
                        }, 250);
                        
                        this.touchstartx =  event.originalEvent.touches[0].pageX;
                        $('.animate').removeClass('animate-carousel-mobile');
                        console.log('remove class animate');
                    },
                    
                    move: function(event){
                        this.width = $('#galery-modal .modal-footer').width() + 100;
                        this.currentPositionCarousel = Math.abs($('#galery-modal .galery-carousel').position().left);
                        this.numberWrapingFullScreen = ( this.totalWidthCarousel - this.totalWidthCarousel % this.width)  / this.width;
                        
                        this.touchmovex =  event.originalEvent.touches[0].pageX;
                        this.movex = this.currentPositionCarousel + (this.touchstartx - this.touchmovex);
                        var panx = 100-this.movex/6;
                        
                        
                        console.log('ddddddddddddddd: ' + (this.touchstartx - this.touchmovex));
                        console.log('movex: ' + this.movex);

                        
                        
//                        if ( this.totalWidthCarousel <= this.currentPositionCarousel + this.width) return;
                        if ( this.movex + this.width >= this.totalWidthCarousel){
                            return;
                        }

                        let chengetPositionLeft = "-="+this.width;
                        $('#galery-modal .galery-carousel').animate({
                            left: '-'+ this.movex + 'px'
                        }, 300, function(){
                            $('#galery-modal .galery-carousel').clearQueue();
                            $('#galery-modal .galery-carousel').stop();
                        });


                    },
                    
                    end: function(event){
                        console.log('end');
                        
                    }
                    
                };
                
                this.sliderCarouselMobile.init();
                
            }
        }
        
        renderSlide(step){
            
            this.currentSlide = this.currentSlide + step;
                
            if (this.currentSlide > this.images.length) {
                this.currentSlide = 1
            }else if( this.currentSlide < 1) {
                this.currentSlide = this.images.length;
            }
            
           $('#viewport img').attr('src', this.images[this.currentSlide - 1].fullImage);
           $('#viewport img').attr('alt', this.images[this.currentSlide - 1].title);
        }
        
        renderCarousel(step){
            
            let width = $('#galery-modal .modal-footer').width() + 100;
            let totalWidthCarousel = ($(".galery-pop").length + 1) * 100;
            let currentPositionCarousel = Math.abs($('#galery-modal .galery-carousel').position().left);
            let numberWrapingFullScreen = ( totalWidthCarousel - totalWidthCarousel % width)  / width;
            
            if ( step == 1) {
                if ( totalWidthCarousel <= currentPositionCarousel + width) return;
                if ( currentPositionCarousel + width * 2 >= totalWidthCarousel){
                    width = totalWidthCarousel - (numberWrapingFullScreen) * width;
                }
                
                let chengetPositionLeft = "-="+width;
                $('#galery-modal .galery-carousel').animate({
                    left: chengetPositionLeft
                }, 300, function(){
                    $('#galery-modal .galery-carousel').clearQueue();
                    $('#galery-modal .galery-carousel').stop();
                });
            }else if (step == -1 ){
                if ( -currentPositionCarousel >= 0) return;
                if ( -currentPositionCarousel + width >= 0){
                    width = currentPositionCarousel;
                }
                
                let chengetPositionLeft = "+="+width;
                $('#galery-modal .galery-carousel').animate({
                    left: chengetPositionLeft
                }, 300, function(){
                    $('#galery-modal .galery-carousel').clearQueue();
                    $('#galery-modal .galery-carousel').stop();
                });
            }
        }
    }
    
    $(document).ready(function () {
        
        $.fn.slider = function( customOptions ){
            let galeryObj = new Galery();
            
            $.each( customOptions, function( option, value ) {
              galeryObj.options[option] = value;
            });
        
            galeryObj.init();
            
        }
        
        $('#galery').slider();   
    });

    
 
});