jQuery(function($) {

	$( ".ospt-colorbox" ).colorbox({inline:true, maxWidth:'95%', maxHeight:'95%'});
	var resizeTimer;
	function resizeColorBox() {
	    if ( resizeTimer ) clearTimeout( resizeTimer );
	    resizeTimer = setTimeout(function() {
	            if ( $( '#cboxOverlay').is( ':visible' ) ) {
	                    $.colorbox.load( true );
	            }
	    }, 300 )
	}

	$(window).resize(resizeColorBox);
	window.addEventListener("orientationchange", resizeColorBox, false);

	$( '#ospt_card_number' ).payment( 'formatCardNumber' );
	$( '#ospt_card_expiry' ).payment('formatCardExpiry');
	$( '#ospt_card_cvc') .payment('formatCardCVC');

	$( "#ospt_payment_form" ).validate({
		rules: {
			ospt_card_number: {
				required: true,
				maxlength: 19,
				creditcard: true
			},
			ospt_card_expiry: "required",
			ospt_card_cvc: {
				required: true,
				maxlength: 4
			}
		},
		messages: {
			ospt_card_number: {
				required: "Please enter card number.",
				maxlength: "Please enter card number more than {0} characters.",
				creditcard: "Please enter a valid credit card number."
			},
			ospt_card_expiry: "Please enter expiry date.",
			ospt_card_cvc: {
				required: "Please enter ccv number.",
				maxlength: "Please enter ccv number more than {0} characters."
			}
		},
		submitHandler: function() {
			$( '.ospt_ajax_loader' ).show();
			$.ajax({  
            type: 'POST',  
            url: ospt_params.ajax_url,  
            data: {  
              action: 'ospt_process_payment',
              data: $( "#ospt_payment_form" ).serialize()
            },  
            success: function( data, textStatus, XMLHttpRequest ){
            	$( '.ospt_ajax_loader' ).hide();
            	var responses = data.split( 'c0d@' ); 
            	if( responses[1] == 1 ) {
            		$( '.ospt_alert' ).show().removeClass( 'alert-danger' ).addClass( 'alert-success' ).html( responses[0] );
            		setTimeout(function(){ 
            		$( '.ospt_alert' ).remove(); 
            		$.fancybox.close();
            	}, 3000);
            	} else {
            		$( '.ospt_alert' ).show().removeClass( 'alert-success' ).addClass( 'alert-danger' ).html( responses[0] );
            	}            	
            },  
            error: function( MLHttpRequest, textStatus, errorThrown ){  
                alert( errorThrown );  
            }  
        });
		}
	});
});