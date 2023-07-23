jQuery(function($){
    "use strict";

    /* -----------> Dependencies <------------ */
    jQuery('.custom_metabox').each(function(i, el){

        if( jQuery(el).hasClass('hidden_metabox') ){
            jQuery(el).closest('.postbox').addClass('hidden');
        }

        setTimeout(function(){

            var observable;
            var depend_by = jQuery(el).data('depend-by');
            var depend_operator = jQuery(el).data('depend-operator');
            var depend_val = jQuery(el).data('depend-value');

            if( depend_by == 'post_format' ){
                observable = jQuery('#post-format-selector-0').val();
            } else {
                observable = jQuery('#cws_'+depend_by).val();
            }

            metabox_dependency( depend_operator, depend_val, observable, jQuery(el) );

        }, 1);

    });

    setTimeout(function(){
        jQuery('#post-format-selector-0, .custom_metabox > input, .custom_metabox > select, .custom_metabox > textarea, .custom_metabox > checkbox').on('change', function(){

            var id = jQuery(this).attr('id');
            var observable = jQuery(this).val();

            id = id == 'post-format-selector-0' ? 'post_format' : id.slice(3);;

            jQuery('.custom_metabox').each(function(i, el){

                if( jQuery(el).data('depend-by') == id ){
                    var depended_el = jQuery(el);
                    var depend_operator = depended_el.data('depend-operator');
                    var depend_val = depended_el.data('depend-value');
                    
                    metabox_dependency( depend_operator, depend_val, observable, depended_el );
                }
            });
        });
    }, 1);

    function metabox_dependency( depend_operator, depend_val, observable, metabox ){

        switch(depend_operator){
            case '==':
                if( depend_val == observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
            case '!=':
                if( depend_val != observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
            case '===':
                if( depend_val === observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
            case '!==':
                if( depend_val !== observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
            case '>':
                if( depend_val > observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
            case '<':
                if( depend_val < observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
            case '>=':
                if( depend_val >= observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
            case '<=':
                if( depend_val <= observable ){
                    metabox.closest('.postbox').removeClass('hidden');
                } else {
                    metabox.closest('.postbox').addClass('hidden');
                }
                break;
        }
    }

    /* -----------> Media Upload <------------ */
    jQuery('.cws_upload_image').on('click', function(e){
        e.preventDefault();

        var button = jQuery(this);
        var input = button.next();

        var custom_uploader = wp.media({
            title: 'Choose Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Select Image'
            },
            multiple: false
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();

            button.removeClass('button').html('<img src="' + attachment.url + '" />');
            input.val(attachment.id);
            input.next().show();
            
        }).open();

        input.change();
    });

    jQuery('.cws_upload_gallery').on('click', function(e){
        e.preventDefault();

        var button = jQuery(this);
        var input = button.next();

        var custom_uploader = wp.media({
            title: 'Choose Images',
            library: {
                type: 'image'
            },
            button: {
                text: 'Apply Gallery'
            },
            multiple: true 
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();

            var attachments = custom_uploader.state().get('selection'),
            attachment_ids = new Array(),
            i = 0;

            button.removeClass('button').html('<div class="gallery"></div>');
            input.next().show();
            
            attachments.each(function(attachment) {
                attachment_ids[i] = attachment['id'];
                console.log( attachment_ids );

                button.find('.gallery').append('<img src="'+attachment['attributes']['url']+'" />');

                i++;
            });

            input.val(attachment_ids);

        }).open();

        input.change();
    });

    jQuery('.cws_remove_image').on('click', function(e){
        jQuery(this).hide().prev().val('').prev().addClass('button').html('Upload image');

        return false;
    });

    jQuery('.row_options').each(function(){
        initSelectImage(this);
    });

    var cws_frame;
    function initSelectImage(parent) {
        jQuery(parent).find('a.pb-gmedia-cws-pb').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var parent = e.target.parentNode;
            var input = parent.getElementsByTagName('input');

            var selection = getGSelection(input[0].value);

            var state = selection ? 'gallery-edit' : 'gallery-library';

            if (!cws_frame) {
                cws_frame = wp.media({
                    // Set the title of the modal.
                    id:				'cws-frame',
                    frame:		'post',
                    state:		state,
                    title:		wp.media.view.l10n.editGalleryTitle,
                    editing:	true,
                    multiple:	true,
                    selection: selection,

                    // Tell the modal to show only images.
                    library: { type: 'image' },

                    // Customize the submit button.
                    button: {	text: 'update',
                        close: true
                    }
                });
            } else {
                cws_frame.setState(state); // !!! options.state is not an option
                cws_frame.options.selection = selection;
            }
            cws_frame.open();
            cws_frame.on( 'update', function( selection ) {
                input[0].value = wp.media.gallery.shortcode( selection ).string();
                updateGalleryImages(selection.toArray(), parent);
            });
        });

        function updateGalleryImages(sel_arr, parent) {
            var cws_gallery = parent.parentNode.getElementsByClassName('cws_gallery')[0];
            if (cws_gallery) {
                cws_gallery.parentNode.removeChild(cws_gallery);
            }
            var images_html = '<div class="cws_gallery">';
            for (var i = 0; i < sel_arr.length; i++) {
                images_html += '<img src="' + sel_arr[i].attributes.url + '">'
            };
            images_html += '<div class="clear"></div></div>';
            parent.insertAdjacentHTML('afterend',images_html);
        }

        jQuery(parent).find('a.pb-media-cws-pb, .img-wrapper img').on('click', function() {
            var that = this;
            var media_editor_attachment_backup = wp.media.editor.send.attachment;
            wp.media.editor.send.attachment = function(props, attachment) {
                var row = that.parentNode.parentNode;
                var url, thumb;
                switch (attachment.type) {
                    case 'image':
                        url = attachment.sizes.full.url;
                        thumb = (attachment.sizes[props['size']].url || url);
                        break;
                    case 'video':
                        url = attachment.url;
                        thumb = attachment.image.src;
                        break;
                }
                row.querySelector('input[data-key="img"]').value = url;
                row.getElementsByTagName('img')[0].src = thumb;
                row.querySelector('input[data-key="img-id"]').value = attachment.id;

                jQuery(row.querySelector('input[data-key="img"]')).trigger('change'); // for customizer
                jQuery(row).find('a.pb-media-cws-pb').hide(0);
                jQuery(row).find('a.pb-remov-cws-pb').show(0);
                wp.media.editor.send.attachment = media_editor_attachment_backup;
                return;
            }
            window.original_send_to_editor = window.send_to_editor;
            window.send_to_editor = function(html) {
                console.log(html);
            }
            if (undefined !== this.dataset.media) {
                wp.media.editor.open(this, {library: {type:this.dataset.media}, multiple: false});
            } else {
                wp.media.editor.open(this, {multiple: false});
            }
            return false;
        });

        jQuery(parent).find('a.pb-remov-cws-pb').on('click', function(el) {
            var parent = jQuery(el.target).parent();
            parent.find('input[data-key="img"]').attr('value', '');
            jQuery(parent.find('input[data-key="img"]')).trigger('change'); // for customizer
            parent.find('input[data-key="img-id"]').attr('value', '');
            parent.find('img').attr('src', '');
            jQuery(this).hide(0);
            parent.find('a.pb-media-cws-pb').show(0);
        });

    }

    /* -----------> Sneaky Select <------------ */
    function sneaky_select(){
        jQuery('.sneaky-select').each(function(i, el){
            var start_value = jQuery(el).next().val();

            if( start_value != '' ){
                var current_value = jQuery(el).find('.sneaky-item[data-value="'+start_value+'"]').html();
                jQuery(el).find('.sneaky-selected').html(current_value);
            }
        });

        jQuery('.sneaky-selected').off();
        jQuery('.sneaky-selected').on('click', function(){
            jQuery(this).next().toggle();
        });

        jQuery('.sneaky-item').off();
        jQuery('.sneaky-item').on('click', function(){
            var value = jQuery(this).data('value');
            var html = jQuery(this).html();

            jQuery(this).closest('.metabox_repeater_field').find('.sneaky-input').val(value);
            jQuery(this).closest('.metabox_repeater_field').find('.sneaky-input').change();
            jQuery(this).closest('.sneaky-select').find('.sneaky-selected').html(html);

            jQuery(this).parent().hide();
        });
    }
    sneaky_select();

    /* -----------> Repeater <------------ */
    jQuery('.metabox_repeater_add_new').on('click', function(){
        var newField = jQuery(this).closest('.custom_metabox').find('li:first-child').clone();

        newField.find('input').val('');
        newField.find('.sneaky-selected').html('');

        jQuery(this).closest('.custom_metabox').find('ul').append(newField);

        sneaky_select();
        metabox_repeater_dublicate();
        metabox_repeater_remove();
        metabox_repeater_save();
    });

    function metabox_repeater_dublicate(){
        jQuery('.dublicate_metabox_repeater_field').off();
        jQuery('.dublicate_metabox_repeater_field').on('click', function(){
            var currentField = jQuery(this).parent().clone();

            currentField.insertAfter(jQuery(this).parent());

            sneaky_select();
            metabox_repeater_dublicate();
            metabox_repeater_remove();
            metabox_repeater_save();
        });
    }
    metabox_repeater_dublicate();

    function metabox_repeater_remove(){
        jQuery('.remove_metabox_repeater_field').off();
        jQuery('.remove_metabox_repeater_field').on('click', function(){

            if( jQuery(this).closest('ul').find('li').length > 1 ){
                jQuery(this).parent().remove();
            } else {
                jQuery(this).closest('.custom_metabox').find('input').val('');
                jQuery(this).closest('.custom_metabox').find('.sneaky-selected').html('');
            }

            jQuery('.metabox_repeater_field').find('input').change();
        });
    }
    metabox_repeater_remove();

    function metabox_repeater_save(){
        jQuery('.metabox_repeater_field input').off();
        jQuery('.metabox_repeater_field input').on('change', function(){
            var mainInput = jQuery(this).closest('.custom_metabox').children('input');
            var saveData = {};

            jQuery(this).closest('.custom_metabox').find('ul li').each(function(i, el){
                var currentValue = {};

                jQuery(el).find('input').each(function(key, value){
                    currentValue[jQuery(value).attr('id')] = jQuery(value).val();
                });

                saveData[i] = currentValue;
            });

            mainInput.val(JSON.stringify(saveData));
            mainInput.change();
        });
    }
    metabox_repeater_save();

});