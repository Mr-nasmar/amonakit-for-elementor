;jQuery(document).ready(function($) {
    "use strict";

    const
            $window = $(window),
            $body = $('body'),

            // Project Search
            amowptSearchSection = $('#amowpt-search-section'),
            amowptDemos = $('#amowpt-demos'),
            amowptBuilder = $('#amowpt-builder'),
            amowptSearchField = $('#amowpt-search-field'),
            amowptType = $('#amowpt-type'),

            // Project
            amowptProjectSection = $('#amowpt-project-section'),
            amowptProjectGrid = $('#amowpt-project-grid'),
            amowptProjectLoadMore = $('#amowpt-load-more-project'),

            // Project Count
            amowptInitProjectStartCount = 0,
            amowptInitProjectEndCount = 8,
            amowptProjectLoadCount = 4,

            // Project Loading/Load more
            amowptLoaderHtml = '<span id="amowpt-loader"></span>',
            amowptLoaderSelector = '#amowpt-loader',
            amowptLoadingText = '<span class="amowpt-pro-loading"></span>',
            amowptLoadedText = AMONAS.message.allload,
            amowptNothingFoundText = AMONAS.message.notfound,

            // Group Project 
            amowptGroupProjectSection = $('#amowpt-group-section'),
            amowptGroupProjectGrid = $('#amowpt-group-grid'),
            amowptGroupProjectBack = $('#amowpt-group-close'),
            amowptGroupProjectTitle = $('#amowpt-group-name');

        let
            // Project Data
            amowptProjectData = AMONAS.alldata,

            // Project Count
            amowptProjectStartCount = amowptInitProjectStartCount,
            amowptProjectEndCount = amowptInitProjectEndCount,

            // Project Options Value
            amowptDemosValue = amowptDemos.val(),
            amowptBuilderValue = amowptBuilder.val(),
            amowptSearchFieldValue = amowptSearchField.val(),
            amowptTypeValue = amowptType.val(),

            // Project Start End Count Fnction for Options
            amowptProjectStartEndCount,

            // Project Print Function
            amowptProjectPirnt,

            // Check Image Load Function
            imageLoad,

            // Scroll Magic Infinity & Reveal Function
            amowptInfinityLoad,
            amowptElementReveal,

            // Ajax Fail Message
            failMessage,
            msg = '';
        // Project Start End Count Fnction for Options
        amowptProjectStartEndCount = () => {
            amowptProjectStartCount = amowptInitProjectStartCount;
            amowptProjectEndCount = amowptInitProjectEndCount;
        };
        // Delete transient fourcely 
        $('body').on( 'click','.amo-template-library-page-sync i', function(e){
            $(this).addClass("eicon-animation-spin");
            var t = {
                data: {},
                success: function (t) {
                    amowptProjectData =  t.templates;
                    $('.amo-template-library-page-sync i').removeClass("eicon-animation-spin");
                },
            };
            t.data.sync = true, 
            elementorCommon.ajax.addRequest("get_amokit_library_data", t);
           
        }); 

        // Projects Demo Type Select
        amowptDemos.selectric({
            onChange: (e) => {
                amowptDemosValue = $(e).val();
                amowptSearchFieldValue = '';
                amowptSearchField.val('');
                amowptProjectStartEndCount();
                amowptProjectPirnt(amowptProjectData);
            },
        });

        // Projects Builder Type Select
        amowptBuilder.selectric({
            onChange: (e) => {
                amowptBuilderValue = $(e).val();
                amowptProjectStartEndCount();
                amowptProjectPirnt(amowptProjectData);
            },
        });

        // Projects Pro/Free Type Select
        amowptType.selectric({
            onChange: (e) => {
                amowptTypeValue = $(e).val();
                amowptProjectStartEndCount();
                amowptProjectPirnt(amowptProjectData);
            },
        });

        // Projects Search
        amowptSearchField.on('input', () => {
            if (!amowptSearchField.val()) {
                amowptSearchFieldValue = amowptSearchField.val().toLowerCase();
                amowptProjectStartEndCount();
                amowptProjectPirnt(amowptProjectData);
            }
        });
        amowptSearchField.on('keyup', (e) => {
            if (e.keyCode == 13) {
                amowptSearchFieldValue = amowptSearchField.val().toLowerCase();
                amowptProjectStartEndCount();
                amowptProjectPirnt(amowptProjectData);
            }
        });

        // Check Image Load Function
        imageLoad = () => {
            $('.amowpt-image img').each((i, e) => $(e).on('load', () => $(e).addClass('finish')));
        };

        // Projects Print/Append on HTML Dom Function
        amowptProjectPirnt = function (amowptProjectData, types = 'push') {
            // Projects Data Filter for Template/Blocks
            amowptProjectData = amowptProjectData.filter(i => i.demoType == amowptDemosValue)
            // Projects Data Filter for Builder Support
            if (amowptBuilderValue != "all") {
                amowptProjectData = amowptProjectData.filter(i => i.builder.filter(j => j == amowptBuilderValue)[0])
            }
            // Projects Data Filter for Free/Pro
            if (amowptTypeValue != "all") {
                // amowptProjectData = amowptProjectData.filter(i => i.isPro == amowptTypeValue)
                amowptProjectData = amowptProjectData.filter(i => i.tmpType == amowptTypeValue)
            }
            // Projects Data Filter by Search
            if (amowptSearchFieldValue != "") {
                amowptProjectData = amowptProjectData.filter(i => i.tags.filter(j => j == amowptSearchFieldValue)[0])
            }

            let amowptPrintDataArray = Array.from(new Set(amowptProjectData.map(i => i.shareId))).map(j => amowptProjectData.find(a => a.shareId === j)),
                amowptPrintData = amowptPrintDataArray.slice(amowptProjectStartCount, amowptProjectEndCount),
                html = '';
            for (let i = 0; i < amowptPrintData.length; i++) {
                let {
                    thumbnail,
                    id,
                    url,
                    shareId,
                    title
                } = amowptPrintData[i],
                    totalItem = amowptProjectData.filter(i => i.shareId == shareId).length,
                    singleItem = totalItem == 1 ? 'amowpt-project-item-signle' : '';
                html += `<div class="${singleItem} col-xl-4 col-md-6 col-12">
                            <div class="amowpt-project-item ${singleItem}" data-group="${shareId}">
                                <div class="amowpt-project-thumb">
                                    <div class="amowpt-image">
                                        <img src="${thumbnail}" alt="${title}" />
                                        <span class="img-loader"></span>
                                    </div>
                                </div>
                                <div class="amowpt-project-info">
                                    <h5 class="title">${shareId}</h5>
                                    <h6 class="sub-title">${totalItem} ${amowpUcfirst(amowptDemosValue)} ${AMONAS.message.packagedesc}</h6>
                                </div>
                            </div>
                        </div>`;
            }
            if (types == "append") {
                amowptProjectGrid.append(html);
            } else {
                amowptProjectGrid.html(html);
            }
            if (amowptPrintDataArray.length == 0) {
                amowptProjectGrid.html(`<h2 class="amowpt-project-message text-danger">${amowptNothingFoundText}</h2>`);
                $(amowptLoaderSelector).addClass('finish').html('');
            } else {
                if (amowptPrintDataArray.length <= amowptProjectEndCount) {
                    $(amowptLoaderSelector).addClass('finish').html(amowptLoadedText);
                } else {
                    $(amowptLoaderSelector).removeClass('finish').html(amowptLoadingText);
                }
            }
            imageLoad();
        }

        // Scroll Magic for Infinity Load Function
        amowptInfinityLoad = () => {
            setTimeout(() => {
                let amowptInfinityController = new ScrollMagic.Controller(),
                    amowptInfinityscene = new ScrollMagic.Scene({
                        triggerElement: '#amowpt-loader',
                        triggerHook: 'onEnter',
                        offset: 0
                    })
                    .addTo(amowptInfinityController)
                    .on('enter', (e) => {
                        if (!$(amowptLoaderSelector).hasClass('finish')) {
                            amowptProjectStartCount = amowptProjectEndCount;
                            amowptProjectEndCount += amowptProjectLoadCount;
                            setTimeout(() => {
                                amowptProjectPirnt(amowptProjectData, 'append')
                            }, 200);
                        }
                    });
            });
        }

        // Scroll Magic for Reveal Element Function
        amowptElementReveal = () => {
            let amowptInfinityController = new ScrollMagic.Controller();
            $('.amowpt-group-item').each(function () {
                new ScrollMagic.Scene({
                        triggerElement: this,
                        triggerHook: 'onEnter',
                        offset: 50
                    })
                    .setClassToggle(this, "visible")
                    .addTo(amowptInfinityController);
            })
        }

        if(amowptProjectData.length) {
            amowptProjectLoadMore.append(amowptLoaderHtml);
            amowptProjectPirnt(amowptProjectData);
            amowptInfinityLoad();
        }

        function amowpUcfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Group Project Open Function
        amowptProjectGrid.on('click', '.amowpt-project-item', function (e) {
            e.preventDefault();
            let amowptProjectGroupData = amowptProjectData;
            // Projects Data Filter for Template/Blocks
            amowptProjectGroupData = amowptProjectGroupData.filter(i => i.demoType == amowptDemosValue)
            // Projects Data Filter for Builder Support
            if (amowptBuilderValue != "all") {
                amowptProjectGroupData = amowptProjectGroupData.filter(i => i.builder.filter(j => j == amowptBuilderValue)[0])
            }
            // Projects Data Filter for Free/Pro
            if (amowptTypeValue != "all") {
                amowptProjectGroupData = amowptProjectGroupData.filter(i => i.tmpType == amowptTypeValue)
            }
            // Projects Data Filter by Search
            if (amowptSearchFieldValue != "") {
                amowptProjectGroupData = amowptProjectGroupData.filter(i => i.tags.filter(j => j == amowptSearchFieldValue)[0])
            }

            let $this = $(this),
                $group = $this.data('group'),
                amowptPrintGroupData = amowptProjectGroupData.filter(i => i.shareId == $group),
                amowptGroupHTML = '',
                $impbutton = '',
                $tmptitle = '';
            for (let i = 0; i < amowptPrintGroupData.length; i++) {
                let {
                    thumbnail,
                    id,
                    url,
                    shareId,
                    title,
                    isPro,
                    freePlugins,
                    proPlugins,
                    requiredtheme,
                } = amowptPrintGroupData[i];
                if(isPro == '1' ){
                    $impbutton = `<a href="${AMONAS.prolink}" target="_blank">${AMONAS.buttontxt.buynow}</a>`;
                    $tmptitle = `<h5 class="title">${title} <span>(${AMONAS.prolabel})</span></h5>`;
                }else{
                    $impbutton = `<a href="#" class="amowpttemplateimp button" data-templpateopt='{"parentid":"${shareId}","templpateid":"${id}","templpattitle":"${title}","message":"Successfully ${amowpUcfirst(shareId)+ ' -> ' + title} has been imported.","thumbnail":"${thumbnail}","freePlugins":"${freePlugins}", "proPlugins":"${proPlugins}","requiredtheme":"${requiredtheme}" }'>${AMONAS.buttontxt.import}</a>`;
                    $tmptitle = `<h5 class="title">${title}</h5>`;
                }
                amowptGroupHTML += `<div class="amowpt-group-item col-xl-4 col-md-6 col-12">
                            <div class="amowpt-project-item">
                                <div class="amowpt-project-thumb">
                                    <a href="${thumbnail}" class="amowpt-image amowpt-image-popup">
                                        <img src="${thumbnail}" data-preview='{"templpateid":"${id}","templpattitle":"${title}","parentid":"${shareId}","fullimage":"${thumbnail}"}' alt="${title}" />
                                        <span class="img-loader"></span>
                                    </a>
                                    <div class="amowpt-actions">
                                        <a href="${url}" target="_blank">${AMONAS.buttontxt.preview}</a>
                                        ${$impbutton}
                                    </div>
                                </div>
                                <div class="amowpt-project-info">
                                    ${$tmptitle}
                                    <h6 class="sub-title">${shareId}</h6>
                                </div>
                            </div>
                            <div id="amowpt-popup-prev-${id}" style="display: none;"><img src="${thumbnail}" alt="${title}" style="width:100%;"/></div>
                        </div>`;
            }
            if (!$(amowptLoaderSelector).hasClass('finish')) {
                $(amowptLoaderSelector).addClass('finish group-loaded');
            }
            amowptProjectSection.addClass('group-project-open');
            amowptSearchSection.addClass('group-project-open');
            let topPotision;
            
            amowptSearchSection.offset().top > 32 && $(window).scrollTop() < amowptSearchSection.offset().top ? topPotision = amowptSearchSection.offset().top - $(window).scrollTop() : topPotision = 32;

            amowptGroupProjectSection.fadeIn().css({
                "top": topPotision + 'px',
                "left": amowptSearchSection.offset().left + 'px'
            });
            $body.css('overflow-y', 'hidden');
            amowptGroupProjectTitle.html($group);
            amowptGroupProjectGrid.html(amowptGroupHTML);
            amowptElementReveal();
            imageLoad();
        });

        // Group Project Close Function
        amowptGroupProjectBack.on('click', function (e) {
            e.preventDefault();
            amowptGroupProjectSection.fadeOut('fast');
            amowptGroupProjectTitle.html('');
            amowptGroupProjectGrid.html('');
            amowptProjectSection.removeClass('group-project-open');
            amowptSearchSection.removeClass('group-project-open');
            $body.css('overflow-y', 'auto');
            imageLoad();
            if ($(amowptLoaderSelector).hasClass('group-loaded')) {
                $(amowptLoaderSelector).removeClass('finish group-loaded');
            }
        });

        // Scroll To Top
        let $amowptScrollToTop = $(".amowpt-scrollToTop"),
            $amowptGroupScrollToTop = $(".amowpt-groupScrollToTop");
        $window.on('scroll', function () {
            if ($window.scrollTop() > 100) {
                $amowptScrollToTop.addClass('show');
            } else {
                $amowptScrollToTop.removeClass('show');
            }
        });
        $amowptScrollToTop.on('click', function (e) {
            e.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            });
        });
        amowptGroupProjectSection.on('scroll', function () {
            if (amowptGroupProjectSection.scrollTop() > 100) {
                $amowptGroupScrollToTop.addClass('show');
            } else {
                $amowptGroupScrollToTop.removeClass('show');
            }
        });
        $amowptGroupScrollToTop.on('click', function (e) {
            e.preventDefault();
            amowptGroupProjectSection.animate({
                scrollTop: 0
            });
        });


    /*
    * PopUp button
    * Preview PopUp
    * Data Import Request
    */
    $('body').on('click', 'a.amowpttemplateimp', function(e) {
        e.preventDefault();

        var $this = $(this),
            template_opt = $this.data('templpateopt');

        $('.amowpt-edit').html('');
        $('#amowptpagetitle').val('');
        $(".amowptpopupcontent").show();
        $(".amowptmessage").hide();
        $(".amowptmessage p").html( template_opt.message );

        // dialog header
        $("#amowpt-popup-area").attr( "title", amowpUcfirst(template_opt.parentid) + ' → ' +template_opt.templpattitle );

        var amobtnMarkuplibrary = `<a href="#" class="wptemplataimpbtn" data-btnattr='{"templateid":"${template_opt.templpateid}","parentid":"${template_opt.parentid}","templpattitle":"${template_opt.templpattitle}"}'>${AMONAS.buttontxt.tmplibrary}</a>`;
        var htbtnMarkuppage = `<a href="#" class="wptemplataimpbtn amowptdisabled" data-btnattr='{"templateid":"${template_opt.templpateid}","parentid":"${template_opt.parentid}","templpattitle":"${template_opt.templpattitle}"}'>${AMONAS.buttontxt.tmppage}</a>`;

        // Enter page title then enable button
        $('#amowptpagetitle').on('input', function () {
            if( !$('#amowptpagetitle').val() == '' ){
                $(".amowptimport-button-dynamic-page .wptemplataimpbtn").removeClass('amowptdisabled');
            } else {
                $(".amowptimport-button-dynamic-page .wptemplataimpbtn").addClass('amowptdisabled');
            }
        });

        // button Dynamic content
        $( ".amowptimport-button-dynamic" ).html( amobtnMarkuplibrary );
        $( ".amowptimport-button-dynamic-page" ).html( htbtnMarkuppage );
        $( ".ui-dialog-title" ).html( amowpUcfirst( template_opt.parentid ) + ' &#8594; ' +template_opt.templpattitle );

        $this.addClass( 'updating-message' );
        // call dialog
        function OpenPopup(){
            $( "#amowpt-popup-area" ).dialog({
                modal: true,
                minWidth: 500,
                minHeight:300,
                buttons: {
                    Close: function() {
                      $( this ).dialog( "close" );
                    }
                }
            });
        }

        $.ajax( {
            url: AMONAS.ajaxurl,
            type: 'POST',
            data: {
                action: 'amokit_ajax_get_required_plugin',
                freeplugins: template_opt.freePlugins,
                proplugins: template_opt.proPlugins,
                requiredtheme: template_opt.requiredtheme,
                plgactivenonce: AMONAS.plgactivenonce,
            },
            complete: function( data ) {
                $( ".amowptemplata-requiredplugins" ).html( data.responseText );
                OpenPopup();
                $this.removeClass( 'updating-message' );
            }
        });


    });

    // Preview PopUp
    $('body').on( 'click','.amowpt-image-popup img', function(e){
        e.preventDefault();

        var $this = $(this),
            preview_opt = $this.data('preview');

        // dialog header
        $( "#amowpt-popup-prev-"+preview_opt.templpateid ).attr( "title", amowpUcfirst(preview_opt.parentid) + ' → ' + preview_opt.templpattitle );
        $( ".ui-dialog-title" ).html( amowpUcfirst( preview_opt.parentid ) + ' &#8594; ' +preview_opt.templpattitle );

        $( "#amowpt-popup-prev-"+preview_opt.templpateid ).dialog({
            modal: true,
            width: 'auto',
            maxHeight: ( $(window).height()-50 ),
            buttons: {
                Close: function() {
                  $( this ).dialog( "close" );
                }
            }
        });

    });
    // Import data request
    $('body').on('click', 'a.wptemplataimpbtn', function(e) {
        e.preventDefault();

        var $this = $(this),
            pagetitle = ( $('#amowptpagetitle').val() ) ? ( $('#amowptpagetitle').val() ) : '',
            databtnattr = $this.data('btnattr');
        $.ajax({
            url: AMONAS.ajaxurl,
            data: {
                'action'       : 'amokit_ajax_request',
                'amotemplateid' : databtnattr.templateid,
                'htparentid'   : databtnattr.parentid,
                'httitle'      : databtnattr.templpattitle,
                'pagetitle'    : pagetitle,
                'plgactivenonce' : AMONAS.plgactivenonce,
            },
            dataType: 'JSON',
            beforeSend: function(){
                $(".amowptspinner").addClass('loading');
                $(".amowptpopupcontent").hide();
            },
            success:function(data) {
                $(".amowptmessage").show();
                var tmediturl = AMONAS.adminURL+"post.php?post="+ data.id +"&action=elementor";
                $('.amowpt-edit').html('<a href="'+ tmediturl +'" target="_blank">'+ data.edittxt +'</a>');
            },
            complete:function(data){
                $(".amowptspinner").removeClass('loading');
                $(".amowptmessage").css( "display","block" );
            },
            error: function(errorThrown){
            }
        });

    });

});
