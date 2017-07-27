


jQuery(function($){
    
    $( document ).ready(function(){
     
        $('#menu-main-menu > li > a').click(function(event){
                       
            if (event.target.attributes.class.nodeValue == 'mobile-dropdown-btn'){
                event.stopPropagation();
                event.preventDefault();
                
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

                    if ( !$('#menu-main-menu').find('>li.menu-tem').hasClass('mobile-menu') ){
                        $('#menu-main-menu').find('>li.menu-tem').addClass('mobile-menu');
                    }
                    
                    let choosedMenu = $(this).parent();
                    let dropDownMenu = choosedMenu.find('>.sub-menu');
                    let btn = choosedMenu.find('a > .mobile-dropdown-btn');

                    if ( parseInt(dropDownMenu.css('max-height')) > 0 ) {
                        choosedMenu.removeClass('mobile-menu-is-open1');
                        choosedMenu.addClass('mobile-menu-is-close1');
                        
                        setTimeout( () => {
                            choosedMenu.css({background:'#2c3e50'});
                            choosedMenu.find('>a').css({background:'#2c3e50'});
                        }, 800);
                        

                        btn.text('+');
                    }else {
                        
                        // close others opened menu
                        choosedMenu.parent().find('>.menu-item').removeClass('mobile-menu-is-open1');
                        choosedMenu.parent().find('>.mobile-menu > a').css({background:'#2c3e50'});
                        choosedMenu.parent().find('>.menu-item > a > .mobile-dropdown-btn').text('+');
                        choosedMenu.removeClass('mobile-menu-is-close1');
                        choosedMenu.addClass('mobile-menu-is-open1');
                        
                        choosedMenu.find('>a').css({background:'#2ecc71'});
                        choosedMenu.css({background:'#2ecc71'});

                        btn.text('-');
                    }
                }

                return true;
            }                        
        });

    });
    
});