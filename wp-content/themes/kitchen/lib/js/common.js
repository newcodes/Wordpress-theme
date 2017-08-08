


jQuery(function($){
    
    $( document ).ready(function(){
     
        $('#menu-main-menu > li > a').click(function(event){
                       
            if (event.target.attributes.class.nodeValue == 'mobile-dropdown-btn'){
                event.stopPropagation();
                event.preventDefault();
                
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    
                    let choosedMenu = $(this).parent();
                    let dropDownMenu = choosedMenu.find('>.sub-menu');
                    let btn = choosedMenu.find('a > .mobile-dropdown-btn');
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
    
});