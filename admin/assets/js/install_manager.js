(function($) {
"use strict";

    /*
    * Plugin Installation Manager
    */
    var AmoKittemplataPluginManager = {

        init: function(){
            $( document ).on('click','.install-now', AmoKittemplataPluginManager.installNow );
            $( document ).on('click','.activate-now', AmoKittemplataPluginManager.activatePlugin);
            $( document ).on('wp-plugin-install-success', AmoKittemplataPluginManager.installingSuccess);
            $( document ).on('wp-plugin-install-error', AmoKittemplataPluginManager.installingError);
            $( document ).on('wp-plugin-installing', AmoKittemplataPluginManager.installingProcess);
        },

        /**
         * Installation Error.
         */
        installingError: function( e, response ) {
            e.preventDefault();
            var $card = $( '.amowptemplata-plugin-' + response.slug );
            $button = $card.find( '.button' );
            $button.removeClass( 'button-primary' ).addClass( 'disabled' ).html( wp.updates.l10n.installFailedShort );
        },

        /**
         * Installing Process
         */
        installingProcess: function(e, args){
            e.preventDefault();
            var $card = $( '.amowptemplata-plugin-' + args.slug ),
                $button = $card.find( '.button' );
                $button.text( AMONAS.buttontxt.installing ).addClass( 'updating-message' );
        },

        /**
        * Plugin Install Now
        */
        installNow: function(e){
            e.preventDefault();

            var $button = $( e.target ),
                $plugindata = $button.data('pluginopt');

            if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
                return;
            }
            if ( wp.updates.shouldRequestFilesystemCredentials && ! wp.updates.ajaxLocked ) {
                wp.updates.requestFilesystemCredentials( e );
                $( document ).on( 'credential-modal-cancel', function() {
                    var $message = $( '.install-now.updating-message' );
                    $message.removeClass( 'updating-message' ).text( wp.updates.l10n.installNow );
                    wp.a11y.speak( wp.updates.l10n.updateCancel, 'polite' );
                });
            }
            wp.updates.installPlugin( {
                slug: $plugindata['slug']
            });

        },

        /**
         * After Plugin Install success
         */
        installingSuccess: function( e, response ) {
            var $message = $( '.amowptemplata-plugin-' + response.slug ).find( '.button' );

            var $plugindata = $message.data('pluginopt');

            $message.removeClass( 'install-now installed button-disabled updated-message' )
                .addClass( 'updating-message' )
                .html( AMONAS.buttontxt.activating );

            setTimeout( function() {
                $.ajax( {
                    url: AMONAS.ajaxurl,
                    type: 'POST',
                    data: {
                        action   : 'amokit_ajax_plugin_activation',
                        location : $plugindata['location'],
                        plgactivenonce : AMONAS.plgactivenonce,
                    },
                } ).done( function( result ) {
                    if ( result.success ) {
                        $message.removeClass( 'button-primary install-now activate-now updating-message' )
                            .attr( 'disabled', 'disabled' )
                            .addClass( 'disabled' )
                            .text( AMONAS.buttontxt.active );

                    } else {
                        $message.removeClass( 'updating-message' );
                    }

                });

            }, 1200 );

        },

        /**
         * Plugin Activate
         */
        activatePlugin: function( e, response ) {
            e.preventDefault();

            var $button = $( e.target ),
                $plugindata = $button.data('pluginopt');

            if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
                return;
            }

            $button.addClass( 'updating-message button-primary' ).html( AMONAS.buttontxt.activating );

            $.ajax( {
                url: AMONAS.ajaxurl,
                type: 'POST',
                data: {
                    action   : 'amokit_ajax_plugin_activation',
                    location : $plugindata['location'],
                    nonce    : htrp_params.nonce
                },
            }).done( function( response ) {
                if ( response.success ) {
                    $button.removeClass( 'button-primary install-now activate-now updating-message' )
                        .attr( 'disabled', 'disabled' )
                        .addClass( 'disabled' )
                        .text( AMONAS.buttontxt.active );
                }
            });

        },

        
    };

    /*
    * Theme Installation Manager
    */
    var AmoKittemplataThemeManager = {

        init: function(){
            $( document ).on('click','.themeinstall-now', AmoKittemplataThemeManager.installNow );
            $( document ).on('click','.themeactivate-now', AmoKittemplataThemeManager.activateTheme);
            $( document ).on('wp-theme-install-success', AmoKittemplataThemeManager.installingSuccess);
            $( document ).on('wp-theme-install-error', AmoKittemplataThemeManager.installingError);
            $( document ).on('wp-theme-installing', AmoKittemplataThemeManager.installingProcess);
        },

        /**
         * Installation Error.
         */
        installingError: function( e, response ) {
            e.preventDefault();
            var $card = $( '.amowptemplata-theme-' + response.slug ),
            $button = $card.find( '.button' );
            $button.removeClass( 'button-primary' ).addClass( 'disabled' ).html( wp.updates.l10n.installFailedShort );
        },

        /**
         * Installing Process
         */
        installingProcess: function(e, args){
            e.preventDefault();
            var $card = $( '.amowptemplata-theme-' + args.slug ),
                $button = $card.find( '.button' );
                $button.text( AMONAS.buttontxt.installing ).addClass( 'updating-message' );
        },

        /**
        * Theme Install Now
        */
        installNow: function(e){
            e.preventDefault();

            var $button = $( e.target ),
                $themedata = $button.data('themeopt');

            if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
                return;
            }
            if ( wp.updates.shouldRequestFilesystemCredentials && ! wp.updates.ajaxLocked ) {
                wp.updates.requestFilesystemCredentials( e );
                $( document ).on( 'credential-modal-cancel', function() {
                    var $message = $( '.themeinstall-now.updating-message' );
                    $message.removeClass( 'updating-message' ).text( wp.updates.l10n.installNow );
                    wp.a11y.speak( wp.updates.l10n.updateCancel, 'polite' );
                });
            }
            wp.updates.installTheme( {
                slug: $themedata['slug']
            });

        },

        /**
         * After Theme Install success
         */
        installingSuccess: function( e, response ) {
            var $message = $( '.amowptemplata-theme-' + response.slug ).find( '.button' );

            var $themedata = $message.data('themeopt');

            $message.removeClass( 'install-now installed button-disabled updated-message' )
                .addClass( 'updating-message' )
                .html( AMONAS.buttontxt.activating );

            setTimeout( function() {
                $.ajax( {
                    url: AMONAS.ajaxurl,
                    type: 'POST',
                    data: {
                        action   : 'amokit_ajax_theme_activation',
                        themeslug : $themedata['slug'],
                        plgactivenonce : AMONAS.plgactivenonce,
                    },
                } ).done( function( result ) {
                    if ( result.success ) {
                        $message.removeClass( 'button-primary install-now activate-now updating-message' )
                            .attr( 'disabled', 'disabled' )
                            .addClass( 'disabled' )
                            .text( AMONAS.buttontxt.active );

                    } else {
                        $message.removeClass( 'updating-message' );
                    }

                });

            }, 1200 );

        },

        /**
         * Theme Activate
         */
        activateTheme: function( e, response ) {
            e.preventDefault();

            var $button = $( e.target ),
                $themedata = $button.data('themeopt');

            if ( $button.hasClass( 'updating-message' ) || $button.hasClass( 'button-disabled' ) ) {
                return;
            }

            $button.addClass( 'updating-message button-primary' ).html( AMONAS.buttontxt.activating );

            $.ajax( {
                url: AMONAS.ajaxurl,
                type: 'POST',
                data: {
                    action   : 'amokit_ajax_theme_activation',
                    themeslug : $themedata['slug'],
                    plgactivenonce : AMONAS.plgactivenonce,
                },
            }).done( function( response ) {
                if ( response.success ) {
                    $button.removeClass( 'button-primary install-now activate-now updating-message' )
                        .attr( 'disabled', 'disabled' )
                        .addClass( 'disabled' )
                        .text( AMONAS.buttontxt.active );
                }
            });

        },

        
    };

    /**
     * Initialize AmoKittemplataPluginManager
     */
    $( document ).ready( function() {
        AmoKittemplataPluginManager.init();
        AmoKittemplataThemeManager.init();
    });

})(jQuery);