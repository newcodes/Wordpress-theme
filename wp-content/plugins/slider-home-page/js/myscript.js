
jQuery(document).ready( function($) {
    
    jQuery('div.media_manager').click(function(e) {
             e.preventDefault();
             var image_frame;
             if(image_frame){
                 image_frame.open();
             }
             // Define image_frame as wp.media object
             image_frame = wp.media({
                           title: 'Select Media',
                           multiple : false,
                           library : {
                                type : 'image',
                            }
            });

            image_frame.on('close',function() {
                          // On close, get selections and save to the hidden input
                          // plus other AJAX stuff to refresh the image preview
                          var selection =  image_frame.state().get('selection');
                          var gallery_ids = new Array();
                          var my_index = 0;
                          selection.each(function(attachment) {
                             gallery_ids[my_index] = attachment['id'];
                             my_index++;
                          });
                          var ids = gallery_ids.join(",");
                          jQuery('input.past_new').val(ids);
                           var attachment = selection.first().toJSON();
                            
                           let newElemContainerImage = $("<div class='container-image'></div>");

                            let newElemBtnDelete = $("<div type='button' class='btn-delete' id='created'></div>").append("<img src='"+imagesPreviews.deleteImg+"'/>");
                            let newElemBtnUpdate = $("<div type='button' class='btn-update'></div>").append("<img src='"+imagesPreviews.updateImg+"'/>");
                            let newElemImagePreview = $("<img class='preview-image' id='preview-image-load' width='150' height='150px'/>").attr('src', attachment.url);
                
                
                
                
                
                            newElemContainerImage.append(newElemImagePreview);
                            newElemContainerImage.append(newElemBtnDelete);
                            newElemContainerImage.append(newElemBtnUpdate);
                            let sdf = $('#first-footer-widget-area').find('.widget-content');
//                            sdf.prepend(newElemContainerImage);
                            $('.preview-image-load').attr('src', attachment.url);
                            $('.createdBtnDlt').removeClass('hidden');
                            
                            $(".createdBtnDlt").click(function() {
                                jQuery('input.past_new').val('');
                                $( this ).parent().find('img.preview-image-load').attr('src', imagesPreviews.defaultImg);;
                            });
                
                            $('#preview-image-load').last().attr('src', attachment.url);
                            $('#preview-image-load').last().val(attachment.url);
                
//                            $('.btn-add').attr('class', 'btn-add media_manager disabled');
//                            $('.btn-add').unbind( "click" );
                            
                           
//                          Refresh_Image(ids);
            });

            image_frame.on('open',function() {
                        // On open, get the id from the hidden input
                        // and select the appropiate images in the media manager
                
                        var selection =  image_frame.state().get('selection');
                        ids = jQuery('input.past_new').val().split(',');
                        ids.forEach(function(id) {
                          attachment = wp.media.attachment(id);
                          attachment.fetch();
                          selection.add( attachment ? [ attachment ] : [] );
                        });
                                

                      });

                    image_frame.open();
     });

    $(".btn-delete").click(function() {
        alert("Deleted");
        let name = 'input[name="' + $( this ).attr('name') + '"]';
        let inputData = $(name);
        console.log(inputData);
        inputData.val('');
//        $( this ).parent().remove();
        $( this ).parent().css('display', 'none');;
    });

});
