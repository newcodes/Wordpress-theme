


jQuery(function($){
    
    $( document ).ready(function(){
     
        $('#menu-main-menu > li > a').click(function(event){
                       
            if (event.target.attributes.class.nodeValue == 'mobile-dropdown-btn'){
                event.stopPropagation();
                event.preventDefault();
                
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    
                    var choosedMenu = $(this).parent();
                    var dropDownMenu = choosedMenu.find('>.sub-menu');
                    var btn = choosedMenu.find('a > .mobile-dropdown-btn');
//                    choosedMenu.parent().find('>.mobile-menu').addClass('mobile-menu-is-close1');

                    if ( choosedMenu.hasClass('mobile-menu-is-open1') ) {
                        
//                        choosedMenu.find('> ul.sub-menu').css({maxHeight:'0px'});
//                        
//                        choosedMenu.find('> ul.sub-menu').animate({maxHeight:'500px'}, 1000);
                        
                        choosedMenu.removeClass('mobile-menu-is-open1');
                        choosedMenu.addClass('mobile-menu-is-close1');                        
                                                

                        btn.text('+');
                    }else {
                        
                        // close others opened menu
//                        choosedMenu.parent().find('>.mobile-menu > ul.sub-menu').css({maxHeight:'0px'});
//                        choosedMenu.find('> ul.sub-menu').css({maxHeight:'100%'});
//                        choosedMenu.parent().find('>.menu-item').removeClass('mobile-menu-is-open1');
//                        choosedMenu.parent().find('>.menu-item > a > .mobile-dropdown-btn').text('+');
                        choosedMenu.removeClass('mobile-menu-is-close1');
                        choosedMenu.addClass('mobile-menu-is-open1');
                        
                        btn.text('-');
                    }
                }

                return true;
            }                        
        });

    });

    $(window).load(function () {

        $('.child-category-info img').each(function () {

            createCanvas(this);
        });

        $('.kitchen-image img').each(function () {

            createCanvas(this);
        });

        function createCanvas(image) {

            var canvas = document.createElement('canvas');
            if (canvas.getContext) {
                var ctx = canvas.getContext("2d");

                var width = image.parentElement.clientWidth;
                var height = image.parentElement.clientHeight;

                canvas.width = width;
                canvas.height = height;

                ctx.drawImage(image, 0, 0, width, height);

                var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height),
                    pixelData = imageData.data;

                for (var y = 0; y < canvas.height; y++) {
                    for (var x = 0; x < canvas.width; x++) {

                        var i = (y * 4 * canvas.width) + (x * 4);
                        var red = pixelData[i];
                        var green = pixelData[i + 1];
                        var blue = pixelData[i + 2];
                        var grayScale = (red * 0.3) + (green * 0.59) + (blue * .11);

                        pixelData[i] = grayScale;
                        pixelData[i + 1] = grayScale;
                        pixelData[i + 2] = grayScale;
                    }
                }

                ctx.putImageData(imageData, 0, 0, 0, 0, imageData.width, imageData.height);
                image.parentNode.insertBefore(canvas, image);
            }
        }
    });
    
});