
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
                   
                   $(this).attr('src', _this.images[counter + index].fullImage);
                   $(this).attr('alt', _this.images[counter + index].title);
                                      
                   counter++;
               });

               $('#galery-modal').modal('show'); // galery-modal is the id attribute assigned to the bootstrap modal, then i use the show function
                
                _this.controll();
                
               
            });
            
            this.renderDom();
            
            this.loadedImages = [];
            this.preloadImages();
            $('#galery-modal .modal-footer').css('width', ($(".galery-pop").length + 1) * 100);
            console.log('sdf: ' + this.options.start);
            
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
                    console.log('load image ' + index);
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

            $('#galery-modal .modal-footer').html(this.images.map(this.setTemplate).join(''));
            
        }
        
        controll(){
            
            $('#galery-modal .galery-slider-btn').unbind('click');
            let _this = this;
            $('#galery-modal .galery-slider-btn').click(function(){
                let step = parseInt($(this).attr('data-next-slide'));
                
                _this.currentSlide = _this.currentSlide + step;
                
                if (_this.currentSlide > _this.images.length) {
                    _this.currentSlide = 1
                }else if( _this.currentSlide < 1) {
                    _this.currentSlide = _this.images.length;
                }
    
                console.log('_this.currentSlide: ' + _this.currentSlide);
                
                _this.renderSlide();
            })
        }
        
        renderSlide(){
            
           $('#viewport img').attr('src', this.images[this.currentSlide - 1].fullImage);
           $('#viewport img').attr('alt', this.images[this.currentSlide - 1].title);
        }

    }
    
    $(document).ready(function(){
        
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