"use strict";
!(function ($, elementor) {

    var postSelectControl = elementor.modules.controls.BaseData.extend({ 

        onReady: function() {
            this.control_select = this.$el.find('.preset-select');
            this.save_input = this.$el.find('.preset-selection-save-value');
            window.amoKPresetDesigns = window.amoKPresetDesigns || {};
            this.fetchPresets();
            this.control_select.on( 'change', (e) => {
                this.onPesetChange(e.currentTarget.value);
            });
        },
        isPresetControl: function (){
            return -1 !== this.getAmoWidgetName().indexOf("AmoKit") || 'section-title-addons' === this.getAmoWidgetName();
        },
        getAmoWidgetName: function () {
            return this.container.settings.get("widgetType");
        },
        getPresets: function (){
            return !_.isUndefined(window.amoKPresetDesigns) ? window.amoKPresetDesigns[this.getAmoWidgetName()] : {};
        },
        setPresets: function ( presetData ){
            window.amoKPresetDesigns[this.getAmoWidgetName()] = JSON.parse(presetData);
        },
        isFetchedPreset: function () {
            return !_.isUndefined(window.amoKPresetDesigns[this.getAmoWidgetName()]);
        },
        fetchPresets: function(){
            var t = this;
            if( this.isPresetControl() && !this.isFetchedPreset() && this.getAmoWidgetName() ){
                $.get(
                amopreset.ajaxUrl,
                {
                    action: "amokit_preset_design",
                    widget: this.getAmoWidgetName(),
                    nonce: amopreset.nonce
                }).done( function (e) {
                    if(e.success){
                        t.setPresets(e.data);
                    }
                });
            }
        },
        onPesetChange: function (presetValue) {
            var p = this.getPresets();
            if(!_.isUndefined(p[presetValue])){
                this.applyPreset(p[presetValue]);
            }
            this.saveValue();
        },
        applyPreset: function(p){
            var e = this.container.settings.controls,
                o = this,
                t = {};
            _.each(e, function(cv, ck){
                var cs;
                if(o.model.get("name") !== ck){
                    if(!_.isUndefined(p[ck])){
                        if(cv.is_repeater){
                            cs = o.container.settings.get(ck).clone();
                            cs.each(function (ep, i){
                                if(!_.isUndefined(p[ck][i])){
                                    _.each(ep.controls, function (ek, tk) {
                                        cs.at(i).set(tk, p[ck][i][tk]);
                                    });
                                }
                            });
                            t[ck] = cs;
                        }else{
                            t[ck] = p[ck];
                        }
                    }
                }
            });
            this.container.settings.setExternalChange(t);
        },
        saveValue: function() {
            this.setValue(this.control_select.val());
        }
    
    });

    elementor.addControlView( 'amokit-preset-select', postSelectControl );

})(window.jQuery, window.elementor);