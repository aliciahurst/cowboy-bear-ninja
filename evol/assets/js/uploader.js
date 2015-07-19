rainyuploader = {
	inituploader: function( sel ) {
		jQuery( sel ).each( function() {
			jQuery( this ).click( function() {
				var rainy_w = jQuery( this ).parent(); // this uploader instance full container (wrapper of everything)

				// backup original window.send_to_editor
				window.original_send_to_editor = window.send_to_editor;

				// override window.send_to_editor
				window.send_to_editor = function( html ) {
					// html argument might not be useful in this case
					// use the data from var attachment (attachment) here to make your own ajax call or use data from b and send it back to your defined input fields etc.
					// restore original window.send_to_editor
					window.send_to_editor = window.original_send_to_editor;
				}

				// backup of original send function
				var send_attachment_backup = wp.media.editor.send.attachment;

				// temporary send function
				wp.media.editor.send.attachment = function( props, attachment ) {

					var chosenSize = props.size; // full, large, medium, thumbnail
					// Empty current input data
					rainy_w.find( '.image_preview' ).empty();

					if ( attachment.type == 'image' ) {
						if ( 'sizes' in attachment ) {
							var preview_image = jQuery( '<img />' ).attr( 'src', attachment.sizes[chosenSize].url ).attr( 'alt', attachment.alt );
						} else {
							var preview_image = jQuery( '<img />' ).attr( 'src', attachment.url ).attr( 'alt', attachment.alt );
						}

						// Add preview image
						rainy_w.find( '.image_preview' ).empty().append( preview_image ).append( '<span class="image_remove">Remove</span>' );
					}

					// Add attachment URL to input
					if ( 'sizes' in attachment ) {
						rainy_w.find( '.image_url' ).val( attachment.sizes[chosenSize].url );
					} else {
						rainy_w.find( '.image_url' ).val( attachment.url );
					}
					rainy_w.find( '.image_url' ).trigger( 'change' );

					// restore original send function
					wp.media.editor.send.attachment = send_attachment_backup;
				}
				wp.media.editor.open();

				// Init blur function
				var el = jQuery( this ).parent().find( '.image_url' );
				if ( el.length ) {
					rainyuploader.reloadimgonblur( el );
					el.blur();
				}

				return false;
			} );
		} );
	},
	reloadimgonblur: function( el ) {
		jQuery( el ).blur( function() {
			var el_val = jQuery( this ).val();
			if ( el_val ) {
				if ( el_val.match(/(^.*\.jpg|jpeg|png|gif|ico|svg|svgz*)/gi) ) {
					var preview_container = jQuery( this ).parent().find( '.image_preview' );
					if ( preview_container.length ) {
						preview_container.html( '<div class="image-error">Image will appear here if its URL above is valid.</div><span class="image_remove">Remove</span>' );
						jQuery( '<img />' ).attr( 'src', el_val ).load( function() {
							var real_width = jQuery( this ).get( 0 ).width;
							var real_height = jQuery( this ).get( 0 ).height;
							var fileSize = real_width + 'x' + real_height + 'px';
							preview_container.html( '<img src="'+el_val+'" alt="" /><span class="image_remove">Remove</span>' );
						} );

						rainyuploader.removeonclick( preview_container.find( '.image_remove' ) );
					}
				} else {
					var rainy_p = jQuery( this ).parent().find( '.image_preview' );
					if ( rainy_p.length ) {
						rainy_p.html( "" );
					}
				}
			}
		} );
	},
	removeonclick: function( el ) {
		jQuery( el ).click( function() {

			// Remove URL from input
			var rainy_f = jQuery( this ).parent().parent().find( '.image_url' );
			if ( rainy_f.length ) {
				rainy_f.val( "" );
			}

			// Remove preview image
			var rainy_p = jQuery( this ).parent().parent().find( '.image_preview' );
			if ( rainy_p.length ) {
				rainy_p.html( "" );
			}

			// Remove remove button
			if ( jQuery( this ).length ) {
				jQuery( this ).remove();
			}

		} );
	},
	remove: function( el ) {
		el.each( function() {
			// Remove URL from input
			var rainy_f = jQuery( this ).parent().parent().find( '.image_url' );
			if ( rainy_f.length ) {
				rainy_f.val( "" );
			}

			// Remove preview image
			var rainy_p = jQuery( this ).parent().parent().find( '.image_preview' );
			if ( rainy_p.length ) {
				rainy_p.html( "" );
			}

			// Remove remove button
			if ( jQuery( this ).length ) {
				jQuery( this ).remove();
			}
		} );
	}
};

jQuery( document ).ready( function() {
	// Init blur function
	var el = jQuery( '.image_url' );
	if ( el.length ) {
		rainyuploader.reloadimgonblur( el );
		el.blur();
	}
	// Init remove function
	jQuery( document ).on( 'click', '.image_remove', function() {
		rainyuploader.remove( jQuery( this ) );
	} );

	rainyuploader.inituploader( '.image_upload' );
} );