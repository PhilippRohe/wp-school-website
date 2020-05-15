/* Admin JavaScript file */
jQuery(document).ready(function($) {
    $(document).ready(function($) {
        delete_admin_image();
        color_picker();
        media_opener();
        admin_settings_media_picker();
        console.log('%cLoad and initialize admin file', 'background: black; color: red; font-size: 24px; padding: 5px;', 'admin.js');
    });

    function delete_admin_image() {
        $('.js--delete-admin-image').on('click', function() {
            $(this).siblings().find('input[type~="hidden"]').val('');
        });
    }

    function color_picker() {
        if ( jQuery.isFunction( jQuery.fn.wpColorPicker ) ) {
            jQuery( 'input.login-color-picker' ).wpColorPicker();
        }
    }

    function admin_settings_media_picker() {
        let mediaUploader;
        $('.admin_upload_menu_logo').on('click', function(event) {
            let input_field = $(this);
            event.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Wähle ein Bild aus',
                button: {
                    text: 'Bild auswählen',
                },
                multiple: false,
            });
    
            mediaUploader.on('select', function() {
                attachment = mediaUploader.state().get('selection').first().toJSON();
                input_field.siblings('input').val(attachment.url);
                input_field.siblings('img').attr('src', attachment.url);
            });
    
            mediaUploader.open();
        });
    }

    function media_opener() {

        function in_array(el, arr) {
            for(var i in arr) {
                if(arr[i] == el) return true;
            }
            return false;
        }
        
        jQuery( function( $ ) {
            /*
            * Sortable images
            */
            $('ul.gallery_slider_list').sortable({
                items:'li',
                cursor:'-webkit-grabbing', /* mouse cursor */
                scrollSensitivity: 40,
                /*
                You can set your custom CSS styles while this element is dragging
                start:function(event,ui){
                    ui.item.css({'background-color':'grey'});
                },
                */
                stop:function(event,ui){
                    ui.item.removeAttr('style');
        
                    var sort = new Array(), /* array of image IDs */
                        gallery = $(this); /* ul.gallery_slider_list */
        
                    /* each time after dragging we resort our array */
                    gallery.find('li').each(function(index){
                        sort.push( $(this).attr('data-id') );
                    });
                    /* add the array value to the hidden input field */
                    gallery.parent().next().val( sort.join() );
                    /* console.log(sort); */
                }
            });
            /*
            * Multiple images uploader
            */
            $('.upload_to_slider_button').click( function(e){ /* on button click*/
                e.preventDefault();
        
                var button = $(this),
                    hiddenfield = button.prev(),
                    hiddenfieldvalue = hiddenfield.val().split(","), /* the array of added image IDs */
                        custom_uploader = wp.media({
                    title: 'Bilder hinzufügen', /* popup title */
                    library : {type : 'image'},
                    button: {text: 'Diese Bilder hinzufügen'}, /* "Insert" button text */
                    multiple: true
                    }).on('select', function() {
        
                    var attachments = custom_uploader.state().get('selection').map(function( a ) {
                        a.toJSON();
                                return a;
                    }),
                    thesamepicture = false,
                    i;
        
                    /* loop through all the images */
                        for (i = 0; i < attachments.length; ++i) {
        
                        /* if you don't want the same images to be added multiple time */
                        if( !in_array( attachments[i].id, hiddenfieldvalue ) ) {
        
                            /* add HTML element with an image */
                            $('ul.gallery_slider_list').append('<li data-id="' + attachments[i].id + '"><div class="image-inner" style="background-image:url(' + attachments[i].attributes.url + ')"><a href="#" class="remove_from_gallery"><span class="icon-cross">X</span></a></div></li>');
                            /* add an image ID to the array of all images */
                            hiddenfieldvalue.push( attachments[i].id );
                        } else {
                            thesamepicture = true;
                        }
                        }
                    /* refresh sortable */
                    $( "ul.gallery_slider_list" ).sortable( "refresh" );
                    /* add the IDs to the hidden field value */
                    hiddenfield.val( hiddenfieldvalue.join() );
                    /* you can print a message for users if you want to let you know about the same images */
                    if( thesamepicture == true ) alert('Die selben Bilder sind nicht erlaubt.');
                }).open();
            });
        
            /*
            * Remove certain images
            */
            $('body').on('click', '.remove_from_gallery', function(){
                var id = $(this).parent().parent().attr('data-id'),
                    gallery = $(this).parent().parent().parent(),
                    hiddenfield = gallery.parent().next(),
                    hiddenfieldvalue = hiddenfield.val().split(","),
                    i = hiddenfieldvalue.indexOf(id);
        
                $(this).parent().parent().remove();
        
                /* remove certain array element */
                if(i != -1) {
                    hiddenfieldvalue.splice(i, 1);
                }
        
                /* add the IDs to the hidden field value */
                hiddenfield.val( hiddenfieldvalue.join() );
        
                /* refresh sortable */
                gallery.sortable( "refresh" );
        
                return false;
            });
            /*
            * Selected item
            */
            $('body').on('mousedown', 'ul.gallery_slider_list li', function(){
                var el = $(this);
                el.parent().find('li').removeClass('image-active');
                el.addClass('image-active');
            });
        });
    }
});