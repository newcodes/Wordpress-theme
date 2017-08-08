jQuery(function($){

    $(document).ready(function(){

            $.fn.slider = function( customOptions ){

                $.each( customOptions, function( option, value ) {
                  galeryObj.options[option] = value;
                });

                new ArmadioGalery().init();

            }

            $('#galery').slider();    
    });
    
    /* 
    
    @poperty images: Array<Obj>; Obj = { fullSize, thumb, title }
    
    
    */
    class ArmadioGalery{
        constructor(){}
        
        init(){
            console.log('initialization');
    
            this.buildUIModal();
            this.defineElements();
            this.bindUIEvents();
            this.loadedImages = [];
            this.preloadImages();
        }
        
        bindUIEvents(){
            
            let _this = this;
            this.itemPictures.on("click", function() {
                _this.showModal($(this));
            });
            
            
            if ( this.isMobile() ){
                this.controllMobile();
            }else{
                this.btnControll.on("click", function() {
                    _this.controllDesctop($(this));
                });
                
                this.modal.keyup(function( event ){
                    if ( event['keyCode']  == 37 || event['keyCode']  == 40 ){
                        _this.controllDesctop(1);    
                    }else if ( event['keyCode']  == 39 || event['keyCode']  == 38 ){
                        _this.controllDesctop(-1);
                    }
                });
            }
        }
        
        buildUIModal(){
            
            this.setDataSlider();
            let modal;
            if ( this.isMobile() ){
                modal = `<div class="modal fade" id="galery-modal" tabindex="-1" role="dialog" aria-labelledby="galery-modal-label" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div id="galery-slider">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <div class="holder">
                                <div id="viewport" class="slide-wrapper-mobile">
                                    <div class="slide"><img src='' alt='' class='slide-img'></div>
                                    <div class="slide"><img src='' alt='' class='slide-img'></div>
                                    <div class="slide"><img src='' alt='' class='slide-img'></div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>`
            }else{
                modal = `<div class="modal fade" id="galery-modal" tabindex="-1" role="dialog" aria-labelledby="galery-modal-label" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div id="galery-slider">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <div class="holder">
                                <div id="viewport" class="slide-wrapper">
                                    <div class="slide"><img src='' alt='' class='slide-img'></div>
                                </div>
                            </div>
                        </div>
                        <div class="galery-btn btn-left" data-next-slide="-1"></div>
                        <div class="galery-btn btn-right" data-next-slide="+1"></div>
                      </div>
                    </div>
                  </div>
                </div>`
            }
            
            
            $('#galery').after(modal);
        }
            
        showModal(item){
            
            this.currentSlide = this.itemPictures.index(item);
            this.renderSliderImages();
                            
            this.modal.modal('show');
        }
        
        renderSliderImages(){
            
            let index = this.currentSlide;
            let prePrevius = 0;
            let previus = 0;
            let current = 0;
            let preNext = 0;
            let next = 0;
            
            if ( this.isMobile() ){
                this.slideImages[1].attributes['src'].value = this.images[index].fullImage;
                this.slideImages[1].attributes['alt'].value = this.images[index].title;
            }else{
                this.slideImages[0].attributes['src'].value = this.images[index].fullImage;
                this.slideImages[0].attributes['alt'].value = this.images[index].title;
            }          
        }
        
        setDataSlider(){
            this.images = [];
            let _this = this;
            
            $('.galery-pop').each(function() {
              _this.images.push({
                  id: _this.images.length,
                  fullImage: $(this).data('image'),
                  thumbImage: $(this).data('thumb'),
                  title: $(this).find('img').attr('alt')
              }); 
            });
        }
        
        defineElements(){
            this.itemPictures = $(".galery-pop");
            this.modal = $('#galery-modal');
            this.slideImages = $('.slide-img');
            this.btnControll = $('.galery-btn');
            this.slider = $('#viewport');
        }
        
        controllDesctop(stepSlide){
            
                let nextSlide;
                if ( $.isNumeric(stepSlide) ){
                    nextSlide = this.currentSlide + stepSlide;
                }else{
                    let step= parseInt(stepSlide.attr('data-next-slide'));
                    nextSlide = this.currentSlide + step;
                }
                
                if ( nextSlide < 0 ){
                    this.currentSlide = this.images.length - 1;
                }else if ( nextSlide > this.images.length - 1){
                    this.currentSlide = 0;
                }else{
                    this.currentSlide = nextSlide;
                }
    
                this.renderSliderImages();
        }
        
        controllMobile(){
            
            if (navigator.msMaxTouchPoints){
                this.slider.on('scroll', function() {
                    console.log('Scroll');
                });
            }else {
                
                let _this = this;
                
                this.sliderMobile = {
                    
                    el: {
                        nextSlide : $('.slide:eq(2)'),
                        currentSlide : $('.slide:eq(1)'),
                        prevSlide : $('.slide:eq(0)')
                    },

                    // Define these as global variables so we can use them across the entire script.
                    touchstartx: undefined,
                    touchmovex: undefined, 
                    movex: undefined,
                    index: 0,
                    longTouch: undefined,
                    width: _this.slider.width(),
                    
                    init: function() {
                      this.bindUIEvents();
                    },

                    bindUIEvents: function() {

                      _this.slider.on("touchstart", function(event) {
                        _this.sliderMobile.start(event);
                      });

                      _this.slider.on("touchmove", function(event) {
                        _this.sliderMobile.move(event);
                      });

                      _this.slider.on("touchend", function(event) {
                        _this.sliderMobile.end(event);
                      });

                    },
                    
                    start: function(event){
                        this.longTouch = false;
                        setTimeout(function() {
                          // Since the root of setTimout is window we can’t reference this. That’s why this variable says window.slider in front of it.
                          _this.sliderMobile.longTouch = true;
                        }, 250);
                        
                        this.touchstartx =  event.originalEvent.touches[0].pageX;
                        this.el.currentSlide.removeClass('animate-slide-mobile');
                        this.el.nextSlide.removeClass('animate-slide-mobile');
                        this.el.prevSlide.removeClass('animate-slide-mobile');

                        this.el.currentSlide.find('>img').attr('src', _this.images[ _this.currentSlide].fullImage);
                        this.el.currentSlide.find('>img').attr('alt', _this.images[ _this.currentSlide].title);
                    },
                    
                    move: function(event){
                        
                        this.touchmovex =  event.originalEvent.touches[0].pageX;
                        this.movex = (this.touchstartx - this.touchmovex);
                        let go = -1 * this.movex;
                        this.el.currentSlide.css('transform','translate3d(' + go + 'px,0,0)');
                        
                        if ( this.movex > 0.1 * this.width){
                            this.renderNexSlide();
                        }else if ( this.movex < -0.1 * this.width){
                            this.renderPrevSlide();
                        }
                    },
                    
                    renderNexSlide: function(){
                   
                        let index = _this.currentSlide + 1 < _this.images.length ? _this.currentSlide + 1 : 0;
                        this.el.nextSlide.find('>img').attr('src', _this.images[index].fullImage);
                        this.el.nextSlide.find('>img').attr('alt', _this.images[index].title);
                        
                        let positionNextSlide = this.width * 2 - this.movex;
                        let positionCurrentSlide = - this.movex;
                        
                        this.el.prevSlide.css({'visibility': 'hidden'});
                        this.el.nextSlide.css({'visibility': 'visible'});

                        this.el.nextSlide.css({
                            'transform':'scale(' + this.movex / (this.width * 2) + ') translate3d(' + positionNextSlide + 'px,0,0)'
                        });
                        
                        this.el.currentSlide.css({
                            'transform':'scale(' + ((this.width * 2) / (this.movex + (this.width * 2)))  + ') translate3d(' + positionCurrentSlide + 'px,0,0)',
                            zIndex: 1
                        });
                    },
                    
                    renderPrevSlide: function(){
                      
                        let index = _this.currentSlide - 1 >= 0 ? _this.currentSlide - 1 : _this.images.length - 1;
                        this.el.prevSlide.find('>img').attr('src', _this.images[index].fullImage);
                        this.el.prevSlide.find('>img').attr('alt', _this.images[index].title);
                        
                        let positionPrevSlide = -this.width * 1.5  + this.movex;
                        let positionCurrentSlide = - this.movex;
                        
                        this.el.nextSlide.css({'visibility': 'hidden'});
                        this.el.prevSlide.css({'visibility': 'visible'});

                        this.el.prevSlide.css({
                            'transform':'scale(' + -this.movex / (this.width * 2) + ') translate3d(' + positionPrevSlide + 'px,0,0)'
                        });
                        
                        this.el.currentSlide.css({
                            'transform':'scale(' + ((this.width * 2) / (-this.movex + (this.width * 2)))  + ') translate3d(' + positionCurrentSlide + 'px,0,0)',
                            zIndex: 1
                        });
                        
                    },
                    
                    end: function(event){
                
                        if ( this.el.currentSlide.position().left < -0.2 * this.width){
                            this.el.currentSlide.addClass('animate-slide-mobile').css({
                                'transform': 'scale(0) translate3d(' + -this.width + 'px,0,0)',
                                zIndex: -1
                            });
                            
                            this.el.nextSlide.addClass('animate-slide-mobile').css('transform', 'scale(1) translate3d(' + 0 + 'px,0,0)');
                            
                            if (  _this.currentSlide >= _this.images.length - 1){
                                 _this.currentSlide = 0;
                            }else{
                                 _this.currentSlide++;
                            }
                            
                            
                            
                        }else if ( this.el.currentSlide.position().left > 0.2 * this.width ){
                            
                            this.el.currentSlide.addClass('animate-slide-mobile').css({
                                'transform': 'scale(0) translate3d(' + this.width + 'px,0,0)',
                                zIndex: -1
                            });
                            
                            this.el.prevSlide.addClass('animate-slide-mobile').css('transform', 'scale(1) translate3d(' + 0 + 'px,0,0)');
                            
                            if ( _this.currentSlide <= 0 ){
                                 _this.currentSlide = _this.images.length - 1;
                            }else{
                                 _this.currentSlide--;
                            }
                            
                        } else{
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
        
        isMobile(){
            $.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
            return $.browser.device;
        }
        
        preloadImages(index = 0){
            index = index || 0;
            let _this = this;
            if (this.images && this.images.length > index) {
                var img = new Image ();
                this.loadedImages.push(img);
                img.onload = function() {
                    _this.images[index].fullImage = img.src;
                    _this.preloadImages(index + 1);
                }
                img.src = this.images[index].fullImage;
            }
        }
        
    }
});