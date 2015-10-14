jQuery(document).ready(function($) {
    // Settings uploader
	var file_frame;
	window.formfield = '';

	$('body').on('click', '.affwp_settings_upload_button', function(e) {

		e.preventDefault();

		var button = $(this);

		window.formfield = $(this).parent().prev();

		// If the media frame already exists, reopen it.
		if( file_frame ) {
			file_frame.open();
			return;
		}

		// Create the media frame
		file_frame = wp.media.frames.file_frame = wp.media({
			frame: 'post',
			state: 'insert',
			title: button.data( 'uploader_title' ),
			button: {
				text: button.data( 'uploader_button_text' )
			},
			multiple: false
		});

		file_frame.on( 'menu:render:default', function( view ) {
			// Store our views in an object,
			var views = {};

			// Unset default menu items
			view.unset( 'library-separator' );
			view.unset( 'gallery' );
			view.unset( 'featured-image' );
			view.unset( 'embed' );

			// Initialize the views in our view object
			view.set( views );
		});

		// When an image is selected, run a callback
		file_frame.on( 'insert', function() {
			var selection = file_frame.state().get( 'selection' );

			selection.each( function( attachment, index ) {
				attachment = attachment.toJSON();
				window.formfield.val(attachment.url);
			});
		});

		// Open the modal
		file_frame.open();
	});

	var file_frame;
	window.formfield = '';

	// Show referral export form
	$('.affwp-referrals-export-toggle').click(function() {
		$('.affwp-referrals-export-toggle').toggle();
		$('#affwp-referrals-export-form').slideToggle();
	});

	$('#affwp-referrals-export-form').submit(function() {
		if( ! confirm( affwp_vars.confirm ) ) {
			return false;
		}
	});

	// datepicker
	if( $('.affwp-datepicker').length ) {
		$('.affwp-datepicker').datepicker();
	}

	var user_search_delay;

	// ajax user search
	$('body').on( 'input change', '.affwp-user-search', function() {
		clearTimeout( user_search_delay );

		$('.affwp-ajax').hide();

		var user_search = $(this).val(), status = $(this).data('affwp-status');

		// delay search 500ms between keypress for performance
		user_search_delay = setTimeout( function() {
			$('.affwp-ajax').show();

			data = {
				action: 'affwp_search_users',
				search: user_search,
				status: status
			};

			$.ajax({
				type: "POST",
				data: data,
				dataType: "json",
				url: ajaxurl,
				success: function (search_response) {
					$('.affwp-ajax').hide();

					$('#affwp_user_search_results').html('');

					$(search_response.results).appendTo('#affwp_user_search_results');

					if( $('.affwp-woo-coupon-field').length ) {
						var height = $('.affwp-woo-coupon-field #affwp_user_search_results' ).height();
						$('.affwp-woo-coupon-field #affwp_user_search_results').css('top', '-' + height + 'px' );
					}
				}
			});
		}, 500);
	});

	$('body').on('click.rcpSelectUser', '#affwp_user_search_results a', function(e) {
		e.preventDefault();
		var login = $(this).data('login'), id = $(this).data('id');
		$('#user_name').val(login);
		$('#user_id').val(id);
		$('#affwp_user_search_results').html('');
	});

    // creative page title
    $('body.affiliates_page_affiliate-wp-creatives').on('click', '#titlewrap', function(e) {
        $('#titlewrap label').addClass('screen-reader-text');
        $('#titlewrap input').select();
    });

    $('body.affiliates_page_affiliate-wp-creatives').on('blur', '#titlewrap', function(e) {
    	if ( $('#titlewrap input').val() === '' ) {
            $('#titlewrap label').removeClass('screen-reader-text');
        }
    });

    // creative fields
    $('body.affiliates_page_affiliate-wp-creatives').on('change', '#affwp-creative-type select', function(e) {
    	var selected = $(this).val();

        if ( selected == 'swf' ) {
            $('#affwp-creative-image').css('display', 'none');
            $('#affwp-creative-text').css('display', 'none');
            $('#affwp-creative-url').css('display', 'none');
            $('#affwp-creative-dimensions').css('display', 'block');
            $('#affwp-creative-swf').css('display', 'block');
            $('#affwp-creative-html').css('display', 'none');
            $('#preview_creative img').css('display', 'none');
        } else if ( selected == 'html' ) {
            $('#affwp-creative-image').css('display', 'none');
            $('#affwp-creative-text').css('display', 'none');
            $('#affwp-creative-url').css('display', 'none');
            $('#affwp-creative-dimensions').css('display', 'none');
            $('#affwp-creative-swf').css('display', 'none');
            $('#affwp-creative-html').css('display', 'block');
            $('#preview_creative img').css('display', 'none');
        } else {
            $('#affwp-creative-image').css('display', 'block');
            $('#affwp-creative-text').css('display', 'block');
            $('#affwp-creative-url').css('display', 'block');
            $('#affwp-creative-dimensions').css('display', 'none');
            $('#affwp-creative-swf').css('display', 'none');
            $('#affwp-creative-html').css('display', 'none');
            $('#preview_creative img').css('display', 'block');
        }
    });

	// select image for creative
	var file_frame;
	$('body').on('click', '.upload_image_button', function(e) {

		e.preventDefault();

		var formfield = $(this).prev();

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			//file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			frame: 'select',
			title: 'Choose Image',
			multiple: false,
			library: {
				type: 'image'
			},
			button: {
				text: 'Use Image'
			}
		});

		file_frame.on( 'menu:render:default', function(view) {
	        // Store our views in an object.
	        var views = {};

	        // Unset default menu items
	        view.unset('library-separator');
	        view.unset('gallery');
	        view.unset('featured-image');
	        view.unset('embed');

	        // Initialize the views in our view object.
	        view.set(views);
	    });

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			var attachment = file_frame.state().get('selection').first().toJSON();
			formfield.val(attachment.url);

			var img = $('<img />');
			img.attr('src', attachment.url);
			// replace previous image with new one if selected
			$('#preview_creative').empty().append( img );

			// show preview div when image exists
			if ( $('#preview_creative img') ) {
				$('#preview_creative').show();
			}
		});

		// Finally, open the modal
		file_frame.open();
	});

    // select SWF for creative
	var file_frame;
	$('body').on('click', '.upload_swf_button', function(e) {

		e.preventDefault();

		var formfield = $(this).prev();

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			//file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			frame: 'select',
			title: 'Choose SWF File',
			multiple: false,
			library: {
				type: 'swf'
			},
			button: {
				text: 'Use SWF'
			}
		});

		file_frame.on( 'menu:render:default', function(view) {
	        // Store our views in an object.
	        var views = {};

	        // Unset default menu items
	        view.unset('library-separator');
	        view.unset('gallery');
	        view.unset('featured-image');
	        view.unset('embed');

	        // Initialize the views in our view object.
	        view.set(views);
	    });

		// When an SWF is selected, run a callback.
		file_frame.on( 'select', function() {
			var attachment = file_frame.state().get('selection').first().toJSON();
			formfield.val(attachment.url);

			var img = $('<img />');
			img.attr('src', attachment.url);
			// replace previous image with new one if selected
			$('#preview_creative').empty().append( img );

			// show preview div when image exists
			if ( $('#preview_creative img') ) {
				$('#preview_creative').show();
			}
		});

		// Finally, open the modal
		file_frame.open();
	});

	// Confirm referral deletion
	$('body').on('click', '.affiliates_page_affiliate-wp-referrals .delete', function(e) {

		if( confirm( affwp_vars.confirm_delete_referral) ) {
			return true;
		}

		return false;

	});

	function maybe_activate_migrate_users_button() {
		var checked = $('#affiliate-wp-migrate-user-accounts input:checkbox:checked' ).length,
		    $button = $('#affiliate-wp-migrate-user-accounts input[type=submit]');

		if ( checked > 0 ) {
			$button.prop( 'disabled', false );
		} else {
			$button.prop( 'disabled', true );
		}
	}

	maybe_activate_migrate_users_button();

	$('body').on('change', '#affiliate-wp-migrate-user-accounts input:checkbox', function() {
		maybe_activate_migrate_users_button();
	});

});
