jQuery(document).ready(function($) {
    // Custom Tabs
    function amokit_admin_tabs( $tabmenus, $tabpane ){
        $tabmenus.on('click', 'a', function(e){
            e.preventDefault();
            var $this = $(this),
                $target = $this.attr('href');
            $this.addClass('amotabactive').parent().siblings().children('a').removeClass('amotabactive');
            $( $tabpane + $target ).addClass('amotabactive').siblings().removeClass('amotabactive');
        });
    }
    amokit_admin_tabs( $(".amo-admin-tabs"), '.amo-admin-tab-pane' );

    // Toggle Element
    function amokit_admin_toggle( $button, $area_element ){
        $button.on('click', function() {
            var inputCheckbox = $area_element.find('.amo_table_row input[type="checkbox"]');
            if(inputCheckbox.prop("checked") === true){
                inputCheckbox.prop('checked', false)
            } else {
                inputCheckbox.prop('checked', true)
            }
        });
    }
    amokit_admin_toggle( $(".amo-open-element-toggle"), $("#amokit_element_tabs") );
    amokit_admin_toggle( $(".amo-open-element-toggle"), $("#amokit_thirdparty_element_tabs") );

   // facebook access token clear function
    $("#amokitopt-admin-panel").on('click','.amo-fb-clear-cache-btn', function(e) {
        var siteURL = site_url_data.site_url; // localize data
        e.preventDefault();
        $.ajax({
            url: siteURL+"/wp-admin/admin-ajax.php",
            data:{action:'my_delete_transient_action',security: AMOKIT.admin_ajax_nonce},// form data
            method : 'POST',
            success:function(data){
                $(".amo-admin-notify").html( "Cache has been cleared");
            }
        });
    });

// Coupon code copy function
// const couponButton = document.querySelector(".amooption-coupon-btn");
// const couponText = document.querySelector(".amooption-coupon-text");
//     couponButton.addEventListener("click", () => {
//         let textValue = couponText.value;
//         navigator.clipboard.writeText(textValue);
//         couponButton.classList.remove("amooption-btn-copy-status-copy");
//         couponButton.classList.add("amooption-btn-copy-status-copied");
//         setTimeout(() => {
//             couponButton.classList.remove("amooption-btn-copy-status-copied");
//             couponButton.classList.add("amooption-btn-copy-status-copy");
//         }, 2000);
//     });

// Send ajax request for newsletter subscription.
$( document ).on( 'click', '.amo-admin-subscribe-form button[type="submit"]', function( e ) {

    e.preventDefault();

    let button = $( this ),
        form = button.closest( 'form' ),
        email = form.find( 'input[type="email"]' ).val(),
        buttonText = form.attr( 'data-amokit-button-text' ),
        processingText = form.attr( 'data-amokit-processing-text' ),
        completedText = form.attr( 'data-amokit-completed-text' ),
        ajaxErrorText = form.attr( 'data-amokit-ajax-error-text' ),
        statusWrap = form.closest( '.amo-admin-subscribe-wrapper' ).find( '.amo-subscribe-status' );

    $.ajax( {
        type: 'POST',
        url: ajaxurl,
        data: {
            action: 'amokit_newsletter_subscribe',
            email: email,
            security: AMOKIT.admin_ajax_nonce,
        },
        beforeSend: function() {
            button.html( processingText );
            form.addClass( 'amo-admin-subscribe-processing' );
        },
        success: function( response ) {
            if ( ! response ) {
                form.removeClass( 'amo-admin-subscribe-processing' );
                return;
            }

            if ( 'string' === typeof response ) {
                response = JSON.parse( response );
            }


            let resStatus = ( response.hasOwnProperty( 'status' ) ? response.status : 'error' ),
                resMessage = ( response.hasOwnProperty( 'message' ) ? response.message : ajaxErrorText );

            if ( 'success' === resStatus ) {
                button.html( completedText );
                form.addClass( 'amo-admin-subscribe-success' );
                form.removeClass( 'amo-admin-subscribe-error' );
            } else {
                button.html( buttonText );
                form.addClass( 'amo-admin-subscribe-error' );
                form.removeClass( 'amo-admin-subscribe-success' );
            }

            statusWrap.html( resMessage );
            form.removeClass( 'amo-admin-subscribe-processing' );
        },
        error: function() {
            button.html( buttonText );
            statusWrap.html( ajaxErrorText );
            form.removeClass( 'amo-admin-subscribe-processing' );
        },
    });
});

    // Footer Sticky Save Button
    var footerSaveStickyToggler = function () {
        // Footer Sticky Save Button
        var $adminHeaderArea  = $('.amo-navigation-wrapper'),
            $stickyFooterArea = $('.amo-opt-footer');
        if ( $stickyFooterArea.length <= 0 || $adminHeaderArea.length <= 0 ) return;
        var totalOffset = $adminHeaderArea.offset().top + $adminHeaderArea.outerHeight();
        var windowScroll    = $(window).scrollTop(),
            windowHeight    = $(window).height(),
            documentHeight  = $(document).height();

        if (totalOffset < windowScroll && windowScroll + windowHeight != documentHeight) {
            $stickyFooterArea.addClass('amo-admin-sticky');
        } else if (windowScroll + windowHeight == documentHeight || totalOffset > windowScroll) {
            $stickyFooterArea.removeClass('amo-admin-sticky');
        }
    };
    $(window).on("scroll",footerSaveStickyToggler);
    //$(window).scroll(footerSaveStickyToggler);
    $(".amo-navigation-menu li a").on('click', function() {
        $(window).scroll(footerSaveStickyToggler);
    });

});