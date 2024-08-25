;(function( $, window ){
    "use strict";

    var AmoKitBlocks = {

        /**
         * Slick Slider
         * @param string Slider Selector class
         */
        initSlickSlider: function( $slider ){
            const settings = $($slider).data('settings');
            if( settings ){
                $($slider).slick({
                    ...settings,
                    prevArrow: '<button type="button" class="slick-prev"><i class="dashicons dashicons-arrow-left-alt2"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="dashicons dashicons-arrow-right-alt2"></i></button>',
                });
            }
        },

        /**
         * Accordion
         * @param string Accordion Toggle Selector (accordion header class)
         */
        initAccordion: function( $trigger ){
            $($trigger).on('click', function() {
                const $accordionCard = $(this).closest('.amo-accordion-card'),
                    $accordionBody = $(this).siblings('.amo-accordion-card-body'),
                    $siblingsCard = $accordionCard.siblings();
                if($accordionCard.hasClass('amo-accordion-card-active')) {
                    $accordionCard.removeClass('amo-accordion-card-active');
                    $accordionBody.slideUp();
                } else {
                    $siblingsCard.each(function() {
                        const $card = $(this);
                        $card.removeClass('amo-accordion-card-active');
                        $card.find('.amo-accordion-card-body').slideUp();
                    });
                    $accordionCard.addClass('amo-accordion-card-active');
                    $accordionBody.slideDown();
                    $accordionCard.find('.slick-slider').slick('refresh');
                }
            })
        },

        /**
         * InitTab
         * @param string InitTab Toggle Selector
         */
        initTab: function( $trigger ){
            $($trigger).on('click', function() {
                const $this = $(this)[0],
                    $target = $this.dataset.tabTarget,
                    $tab = $this.closest('.amo-tab');

                $($this).addClass('amo-tab-nav-item-active').siblings().removeClass('amo-tab-nav-item-active');
                $($tab).find(`[data-tab-id="${$target}"]`).show().siblings().hide();
                $($tab).find(`[data-tab-id="${$target}"]`).find('.slick-slider').slick('refresh');
            })
        },


    };

    $(".amo-slick-slider").each(function(){
        AmoKitBlocks.initSlickSlider($(this));
    });

    $(".amo-accordion-card-header").each(function(){
        AmoKitBlocks.initAccordion($(this));
    });
    $(".amo-tab-nav-item").each(function(){
        AmoKitBlocks.initTab($(this)[0]);
    });

})(jQuery, window);
