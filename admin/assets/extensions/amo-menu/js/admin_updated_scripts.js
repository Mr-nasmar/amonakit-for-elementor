;(function($){
"use strict";


    var AmoKitMenuAdmin = {

        instance: [],
        menuId: 0,
        depth: 0,

        init: function() {
            this.menuButton();

             $( document )
                 .on( 'click.amoMenuAdmin', '.amomenu-menu-settings-save', this.saveMenuOpt )
                 .on( 'click.amoMenuAdmin', '.amo-menu-trigger', this.openPopup )
                 .on( 'click.amoMenuAdmin', '.amo-menu-popup-close', this.closePopup )
                 .on( 'click.amoMenuAdmin', '.amo-menu-popup-close-btn', this.closePopup )
                 .on( 'click.amoMenuAdmin', '.amo-menu-submit-btn', this.saveMenuData );
        },

        saveMenuOpt: function() {
            var spinner = $(this).parent().find('.spinner');
            spinner.addClass('loading');
            AmoKitMenuAdmin.save_menu_options( $(this) );
        },

        save_menu_options: function( that ){
            var parent = that.parents("#AmoKit__Menu_meta_box"),
                settings = {
                    'enable_menu': ( parent.find("#amokitmenu-menu-metabox-input-is-enabled").is(':checked') === true ) ? 'on' : 'off'
                };
                
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action          : "AmoKit_Menu_Panels_ajax_requests",
                    sub_action      : "save_menu_options",
                    settings        : settings,
                    menu_id         : $("#amokitmenu-metabox-input-menu-id").val(),
                    nonce           : AMOKITMENU.nonce
                },
                cache: false,
                success: function(response) {
                    that.parent().find('.spinner').removeClass('loading');
                }
            });

        },
      

        menuButton: function(){
            var button = wp.template( 'amomenubutton' );

            $( '#menu-to-edit .menu-item' ).each( function() {
                var $this = $( this ),
                    depth = AmoKitMenuAdmin.getItemDepth( $this ),
                    id    = AmoKitMenuAdmin.getItemId( $this );

                $this.find( '.item-title' ).append( button( {
                    id: id,
                    depth: depth,
                    label: 'Amona Kit Menu'
                } ) );
            });

        },

        getItemId: function( $item ) {
            var id = $item.attr( 'id' );
            return id.replace( 'menu-item-', '' );
        },

        getItemDepth: function( $item ) {
            var depthClass = $item.attr( 'class' ).match( /menu-item-depth-\d/ );
            if ( ! depthClass[0] ) {
                return 0;
            }
            return depthClass[0].replace( 'menu-item-depth-', '' );
        },

        openPopup: function() {
            var $this   = $( this ),
                id      = $this.data( 'item-id' ),
                depth   = $this.data( 'item-depth' ),
                popupid = '#amokit-popup-' + id,
                content = null,
                wrapper = wp.template( 'amomenupopup' );

                if ( ! AmoKitMenuAdmin.instance[ id ] ) {

                $('body').append('<div class="amo-menu-loader"></div>');

                $.ajax({ 
                    url: ajaxurl,
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        action          : "AmoKit_Menu_Panels_ajax_requests",
                        sub_action      : "get_menu_options",
                        menu_item_id    : id,

                    },
                    cache: false,
                    beforeSend: function(){
                        $('.amo-menu-loader').html('<span class="amo-menu-loading-close"></span><div class="amomenus-css"><div style="width:100%;height:100%" class="amomenus-ripple"><div></div><div></div>');
                    },
                     success: function( response ) {

                        $( '.amo-menu-loader' ).hide();

                        content = wrapper( {
                            id: id,
                            depth: depth,
                            content:response.data.content,
                            templatelist:response.data.temp_list,
                        } );

                        $( 'body' ).append( content );

                        var savebtn = $(popupid).find('.amo-menu-submit-btn');

                        $('.amo-color-picker-field').wpColorPicker({
                            change: function(event, ui) {
                                savebtn.removeClass('disabled').attr('disabled', false).text( AMOKITMENU.button.text );
                            }
                        });
                        $( popupid+' .wp-picker-clear' ).on( 'click',function(){
                            savebtn.removeClass('disabled').attr('disabled', false).text( AMOKITMENU.button.text );
                        });

                        var iconfield = $( popupid ).find('.amo-menu-icon');
                        AmoKitMenuAdmin.init_fontpicker( iconfield );
                        AmoKitMenuAdmin.init_tab( '.amo-menu-popup-tab-menu' );

                        $( popupid +' form.amo-menu-data').on( 'keyup', 'input[type="text"]' , function() {
                            savebtn.removeClass('disabled').attr('disabled', false).text( AMOKITMENU.button.text );
                        });
                        $( popupid +' form.amo-menu-data').on( 'change', 'select.widefat' , function() {
                            savebtn.removeClass('disabled').attr('disabled', false).text( AMOKITMENU.button.text );
                        });

                        $( popupid +' form.amo-menu-data').on('change', 'select.amomenu-bg-type', function() {

                            if( this.value == 'gradient' ){
                                $(popupid+' .amomenu-gradient-field').show();
                                $(popupid+' .amomenu-default-field').css('border-width','1px');
                            }else{
                                $(popupid+' .amomenu-gradient-field').hide();
                                $(popupid+' .amomenu-default-field').css('border-width','0');
                            }
                        });

                        $( '.amomenu-pro' ).click(function() {
                            $( "#amokitpro-dialog" ).dialog({
                                modal: true,
                                minWidth: 500,
                                buttons: {
                                    Ok: function() {
                                      $( this ).dialog( "close" );
                                    }
                                }
                            });
                        });

                        $(".amomenu-pro .wp-picker-container .wp-color-result,.amomenu-pro input,.amomenu-pro select").attr("disabled", true);

                        $(".amomenu-pro .wp-picker-container").css({"z-index": "-1"});

                    },

                    complete: function( data ) {
                        $( 'body' ).removeClass('amo-menu-loading');
                    },

                });

                AmoKitMenuAdmin.instance[ id ] = popupid;
            }

            $( AmoKitMenuAdmin.instance[ id ] ).removeClass( 'amo-hide' );
        },

        closePopup: function( e ) {
            e.preventDefault();
            $( this ).closest( '.amo-menu-popup' ).addClass( 'amo-hide' );
        },

        saveMenuData: function(){
            var $this   = $( this ),
                id      = $this.data( 'id' );

            var $menu_form = $('#amokit-menu-form-'+id),
            $savebtn = $menu_form.find('.amo-menu-submit-btn');

            $menu_form.on('submit', function( event ) {
                event.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action          : "AmoKit_Menu_Panels_ajax_requests",
                        sub_action      : "save_menu_settings",
                        settings        : $menu_form.serialize(),
                        menu_item_id    : id,
                        nonce           : AMOKITMENU.nonce
                    },
                    cache: false,
                    beforeSend: function(){
                        $savebtn.text( AMOKITMENU.button.lodingtext ).addClass('updating-message');
                    },
                    success: function( response ) {
                        $savebtn.removeClass('updating-message').addClass('disabled').attr('disabled', true).text( AMOKITMENU.button.successtext );
                    },
                    complete: function( data ) {
                        $savebtn.removeClass('updating-message').addClass('disabled').attr('disabled', true).text( AMOKITMENU.button.successtext );
                    },

                });

            });

        },
       
       init_fontpicker: function( $el ){

            $el.fontIconPicker({
                source: AMOKITMENU.iconlist,
                emptyIcon: true,
                hasSearch: true,
                theme: 'fip-bootstrap'
            });

            $('.submit-add-to-menu').on('click', function(){
                $el.fontIconPicker({
                    source: AMOKITMENU.iconlist,
                    emptyIcon: true,
                    hasSearch: true,
                    theme: 'fip-bootstrap'
                });
            })

        },

        init_tab: function( menu ){
            $( menu ).on('click', 'a', function (e) {
                e.preventDefault();
                var $this = $(this),
                $target = $this.data('target'),
                $tabPane = $this.closest( menu ).siblings('.amo-menu-popup-tab-content').find('.amo-menu-popup-tab-pane[data-id='+$target+']');
                $this.addClass('active').closest('li').siblings().find('a').removeClass('active');
                $tabPane.addClass('active').siblings().removeClass('active');
            })
        },
        
    };

    AmoKitMenuAdmin.init();
    
})(jQuery);