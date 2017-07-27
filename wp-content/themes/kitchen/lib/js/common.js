


jQuery(function($){
    
    $( document ).ready(function(){
     
        
        $('#menu-main-menu > li > a').click(function(event){
                       
            if (event.target.attributes.class.nodeValue == 'mobile-dropdown-btn'){
                event.stopPropagation();
                event.preventDefault();
                            
                $( this ).css({
                    'background': '#2ecc71'
                });
                
//                $( this ).live("mouseleave", function () {
//                    $(this).css({'background': '#2c3e50'});
//                });
                
                let choosedMenu = $(this).parent()
                
                let dropDownMenu = choosedMenu.find('>.sub-menu');

                if ( parseInt(dropDownMenu.css('max-height')) && parseInt(dropDownMenu.css('max-height')) > 0 ) {
                    dropDownMenu.removeClass('hidden-mobile-menu');
                    choosedMenu.removeClass('active-mobile-submenu');
                    dropDownMenu.css({'max-height': '100%'});
                    dropDownMenu.animate({
                        'max-height': '0px'
                    }, 1000, function(){
                         $(this).parent().find('>a').css({'background': '#2c3e50'});
                    });
                }else {
                    dropDownMenu.addClass('hidden-mobile-menu');
                    choosedMenu.addClass('active-mobile-submenu');
                }
                return true;
            }                        
        });
    
    })
    
});