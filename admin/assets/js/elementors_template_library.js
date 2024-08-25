;(function ( $, winelementor ) {
    window.amokit = window.amokit || {};
    
    var moduleExp = { 
        Views: {},
        Models: {},
        Collections: {},
        Behaviors: {},
        Layout: null,
        Manager: null
    };

    var htFilterText = 'page';

    moduleExp.Models.Template = Backbone.Model.extend( 
        { 
            defaults: { 
                template_id: 0, 
                title: '', 
                type: '', 
                thumbnail: '',
                url: '', 
                tags: [], 
                isPro: false 
            } 
        } 
    );

    moduleExp.Collections.Template = Backbone.Collection.extend(
        { 
            model: moduleExp.Models.Template 
        }
    );

    moduleExp.Views.Logo = Marionette.ItemView.extend(
        {
            template: "#tmpl-amokit-template-library-logo",
            className: "amo_templateLibrary_logo",
            templateHelpers: function () {
                return { title: this.getOption("title") };
            },
        }
    );

    // moduleExp.Views.Actions = Marionette.ItemView.extend(
    //     {
    //         template: "#tmpl-amokit-template-library-header-actions",
    //         id: "elementor-template-library-header-actions",
    //         ui: { sync: "#amokit-template-library-header-sync i" },
    //         events: { "click @ui.sync": "onSyncClick" },
    //         onSyncClick: function () {
    //             var e = this;
    //             e.ui.sync.addClass("eicon-animation-spin"),
    //             amokit.library.getLibraryData({
    //                 onUpdate: function () {
    //                     e.ui.sync.removeClass("eicon-animation-spin"), amokit.library.updateBlocksView();
    //                 },
    //                 forceUpdate: true,
    //                 forceSync: true,
    //             });
    //         },
    //     }
    // );
    moduleExp.Views.Actions = Marionette.ItemView.extend(
        {
            template: "#tmpl-amokit-template-library-header-actions",
            id: "elementor-template-library-header-actions",
            ui: { sync: "#amokit-template-library-header-sync i" },
            //events: { "click @ui.sync": "onSyncClick" },
            events: function () {
                return { click: "onClick" };
            },
            onClick: function () {
                var e = this;
                e.ui.sync.addClass("eicon-animation-spin"),
                amokit.library.getLibraryData({
                    onUpdate: function () {
                        e.ui.sync.removeClass("eicon-animation-spin"), amokit.library.updateBlocksView();
                    },
                    forceUpdate: true,
                    forceSync: true,
                });
            },
        }
    );

    moduleExp.Views.Menu = Marionette.ItemView.extend(
        {
            template: "#tmpl-amokit-template-library-header-menu",
            id: "elementor-template-library-header-menu",
            className: "amo_templateLibrary_header_menu",
            ui: { 
                items: "> .elementor-component-tab" 
            },
            events: { 
                "click @ui.items": "onTabItemClick" 
            },
            onTabItemClick: function (target) {
                var currenttab = $( target.currentTarget ),
                    value = currenttab.data("tab");
                    amokit.library.setFilter("type", value),
                currenttab.addClass("elementor-active").siblings().removeClass("elementor-active");
                htFilterText = value;
            },
            templateHelpers: function () {
                amokit.library.setFilter("type", htFilterText);
                return amokit.library.getTabs();
            },
        }
    );

    moduleExp.Views.ResponsiveMenu = Marionette.ItemView.extend(
        {
            template: "#tmpl-amokit-template-library-header-menu-responsive",
            id: "elementor-template-library-header-menu-responsive",
            className: "amo-template-library-header-menu-responsive",
            ui: { items: "> .elementor-component-tab" },
            events: { "click @ui.items": "onTabItemClick" },
            onTabItemClick: function (e) {
                var e = $(e.currentTarget),
                    t = e.data("tab");
                amokit.library.channels.tabs.trigger("change:device", t, e);
            }
        }
    );

    moduleExp.Views.BackButton = Marionette.ItemView.extend(
        {
            template: "#tmpl-amokit-template-library-header-back",
            id: "elementor-template-library-header-preview-back",
            className: "amokit_templateLibrary_back",
            events: function () {
                return { click: "onClick" };
            },
            onClick: function (target) {
                amokit.library.showBlocksView();
                $('[data-tab="'+htFilterText+'"]').addClass("elementor-active").siblings().removeClass("elementor-active");
            },
        }
    );

    moduleExp.Behaviors.InsertTemplate = Marionette.Behavior.extend(
        {
            ui: { 
                insertButton: ".amo-template-library-template-insert" 
            },
            events: { 
                "click @ui.insertButton": "onInsertButtonClick" 
            },
            onInsertButtonClick: function () {
                amokit.library.insertTemplate( { model: this.view.model } );
            },
        } 
    );

    moduleExp.Views.EmptyTemplateCollection = Marionette.ItemView.extend(
        {
            id: "elementor-template-library-templates-empty",
            template: "#tmpl-elementor-amokit-library-templates-empty",
            ui: { 
                title: ".elementor-template-library-blank-title", 
                message: ".elementor-template-library-blank-message" 
            },
            modesStrings: {
                empty: {
                    title: "No Templates Found", 
                    message: "Try different category or sync for new templates."
                },
                noResults: { 
                    title: "No Results Found", 
                    message: "Please make sure your search is spelled correctly or try a different words." 
                },
            },
            getCurrentMode: function () {
                return amokit.library.getFilter("text") ? "noResults" : "empty";
            },
            onRender: function () {
                var e = this.modesStrings[this.getCurrentMode()];
                this.ui.title.html(e.title), this.ui.message.html(e.message);
            },
        }
    );

    moduleExp.Views.TemplateCollection = Marionette.CompositeView.extend(
        {
            template: "#tmpl-amokit-template-library-templates",
            id: "amokit_template_library_templates",
            childViewContainer: "#amokit-template-library-list",
            emptyView: function () {
                return new moduleExp.Views.EmptyTemplateCollection();
            },
            ui:{ 
                textFilter: "#amokit-template-library-filter-text", 
            },
            events:{ 
                "input @ui.textFilter": "onTextFilterInput"
            },
            getChildView: function (e) {
                return moduleExp.Views.Template;
            },
            initialize: function () {
                this.listenTo(amokit.library.channels.templates, "filter:change", this._renderChildren);
            },
            filter: function (e) {
                var t = amokit.library.getFilterTerms(),
                    i = true;
                return (
                    _.each(t, function (t, a) {
                        var n = amokit.library.getFilter(a);
                        if (n && t.callback) {
                            var r = t.callback.call(e, n);
                            return r || (i = false), r;
                        }
                    }),
                    i
                );
            },
            
            onTextFilterInput: function () {
                var e = this;
                _.defer(function () {
                    amokit.library.setFilter("text", e.ui.textFilter.val());
                });
            },
            
        }
    );

    moduleExp.Views.Template = Marionette.ItemView.extend(
        {
            template: "#amokit-template-library-template",
            className: "amo_template_library_template",
            ui: { 
                previewButton: ".amo-template-library-preview-button, .amo-template-library-preview" 
            },
            events: { 
                "click @ui.previewButton": "onPreviewButtonClick"
            },
            behaviors: { 
                insertTemplate: { behaviorClass: moduleExp.Behaviors.InsertTemplate } 
            },
            onPreviewButtonClick: function () {
                amokit.library.showPreviewView(this.model);
            },
        }
    );

    moduleExp.Views.Loading = Marionette.ItemView.extend(
        { 
            template: "#tmpl-amokit-template-library-loading", 
            id: "amo_templateLibrary_loading" 
        }
    );

    moduleExp.Views.InsertWrapper = Marionette.ItemView.extend(
        {
            template: "#tmpl-amokit-template-library-header-insert",
            id: "elementor-template-library-header-preview",
            behaviors: { 
                insertTemplate: { behaviorClass: moduleExp.Behaviors.InsertTemplate }
            },
        }
    );

    moduleExp.Views.Preview = Marionette.ItemView.extend(
        {
            template: "#tmpl-amokit-template-library-preview",
            className: "amo_templateLibrary_preview",
            ui: function () {
                return { iframe: "> iframe" };
            },
            onRender: function () {
                this.ui.iframe.attr("src", this.getOption("url")).hide();
                var e = this,
                    t = new moduleExp.Views.Loading().render();
                this.$el.append(t.el),
                this.ui.iframe.on("load", function () {
                    e.$el.find("#amokit_templateLibrary_loading").remove(), e.ui.iframe.show();
                });
            },
        }
    );

    moduleExp.Modal = elementorModules.common.views.modal.Layout.extend({
        
        getModalOptions: function () {
            return { 
                id: "amokit-template-library-modal"
            };
        },

        getLogo: function ( title ) {
            this.getHeaderView().logoArea.show(new moduleExp.Views.Logo(title));
        },

        showDefaultHeader: function () {
            this.getLogo({ title: "Amona Kit LIBRARY" });
            var headerview = this.getHeaderView();
            headerview.menuArea.show( new moduleExp.Views.Menu() ),
            headerview.tools.show( new moduleExp.Views.Actions() );
        },

        getTemplateActionButton: function (e) {
            var buttonClass = e.isPro && !false ? "get-pro-button" : "insert-button";
            return ( viewId = "#tmpl-amokit-template-library-" + buttonClass ), 
            (template = Marionette.TemplateCache.get(viewId)), 
            Marionette.Renderer.render(template);
        },

        showPreviewView: function (e) {
            var headerview = this.getHeaderView();
            headerview.logoArea.show(new moduleExp.Views.BackButton()),
            headerview.menuArea.show(new moduleExp.Views.ResponsiveMenu()),
            headerview.tools.show(new moduleExp.Views.InsertWrapper({ model: e })), 
            this.modalContent.show(new moduleExp.Views.Preview({ url: e.get("url") }));
        },

        showBlocksView: function (e) {
            this.modalContent.show(new moduleExp.Views.TemplateCollection({ collection: e }));
        },
    });

    moduleExp.Manager = function () {
        var l,
            s,
            d,
            c,
            m = this,
            s = { desktop: "100%", tab: "768px", mobile: "360px" };
        function a() {
            var t = $(this).closest(".elementor-top-section"),
                i = t.data("model-cid"),
                a = window.elementor.sections;
            a.currentView.collection.length &&
                _.each(a.currentView.collection.models, function (e, t) {
                    i === e.cid && (m.atIndex = t);
                }),
                t.prev(".elementor-add-section").find(FIND_SELECTOR).before(HtLibraryPopUpBtn);
        }

        function n(e) {
            var t = e.find(FIND_SELECTOR);
            t.length && t.before(HtLibraryPopUpBtn), e.on("click.onAddElement", ".elementor-editor-section-settings .elementor-editor-element-add", a);
        }

        function r(t, i) {
            $(".htemega_templateLibrary_preview").css("width", "100%");
        }

        function p(e, t) {
            t.addClass("elementor-active").siblings().removeClass("elementor-active");
            t = s[e] || s.desktop;
            $(".amo_templateLibrary_preview").css("width", t);
        }

        function o() {
            var e = window.elementor.$previewContents,
                t = setInterval(function () {
                    n(e), e.find(".elementor-add-new-section").length > 0 && clearInterval(t);
                }, 100);

                e.on("click.onAddTemplateButton", ".elementor-add-amokit-template-button", m.showModal.bind(m));
                this.channels.tabs.on("change:device", p);
        }

        this.updateBlocksView = function () {
            amokit.library.setFilter("tags", "", !0), amokit.library.setFilter("text", "", !0), amokit.library.getModal(),amokit.library.showBlocksView();
        };

        FIND_SELECTOR = ".elementor-add-new-section .elementor-add-section-drag-title";

        HtLibraryPopUpBtn = '<div class="elementor-add-section-area-button elementor-add-amokit-template-button"><img src="'+AMOKITETMP.icon+'" /></div>';

        this.atIndex = -1;

        this.channels = { 
            tabs: Backbone.Radio.channel("tabs"), 
            templates: Backbone.Radio.channel("templates") 
        };

        this.init = function () {
            winelementor.on("preview:loaded", o.bind(this));
        };

        this.showModal = function (){
            m.getModal().showModal(),m.showBlocksView();
        };

        this.getModal = function () {
            return l || (l = new moduleExp.Modal()), l;
        };

        this.getTabs = function () {
            return { 
                tabs: { 
                    section: { 
                        title: "Blocks", 
                        active: false 
                    },
                    page: { 
                        title: "Pages", 
                        active: true 
                    }
                }
            };
        };

        this.setFilter = function (e, t, i) {
            m.channels.templates.reply("filter:" + e, t), 
            i || m.channels.templates.trigger("filter:change");
        };

        this.getFilter = function (e) {
            return m.channels.templates.request("filter:" + e);
        };

        this.getFilterTerms = function () {
            return {
                text: {
                    callback: function (e) {
                        return (
                            (e = e.toLowerCase()),
                            this.get("title").toLowerCase().indexOf(e) >= 0 ||
                                _.any(this.get("tags"), function (t) {
                                    return t.indexOf(e) >= 0;
                                })
                        );
                    },
                },
                type: {
                    callback: function (e) {
                        return (
                            (e = e.toLowerCase()),
                            this.get("type").toLowerCase().indexOf(e) >= 0
                        );
                    },
                },

            };
        };

        this.showBlocksView = function () {
            m.getModal().showDefaultHeader();
            $('[data-tab="'+htFilterText+'"]').addClass("elementor-active").siblings().removeClass("elementor-active");
            m.setFilter("text", "", true),
            m.loadTemplates(function () {
                m.getModal().showBlocksView(d);
            });
        };

        this.showPreviewView = function (e) {
            m.getModal().showPreviewView(e);
        };

        this.loadTemplates = function (e) {
            m.getLibraryData({
                onBeforeUpdate: m.getModal().showLoadingView.bind(m.getModal()),
                onUpdate: function () {
                    m.getModal().hideLoadingView(), e && e();
                },
            });
        };

        this.getLibraryData = function (e) {
            if (d && !e.forceUpdate) return void (e.onUpdate && e.onUpdate());
            e.onBeforeUpdate && e.onBeforeUpdate();
            var t = {
                data: {},
                success: function (t) {
                    (d = new moduleExp.Collections.Template(t.templates)), t.tags && (s = t.tags), e.onUpdate && e.onUpdate();
                },
            };
            e.forceSync && (t.data.sync = true), 
            elementorCommon.ajax.addRequest("get_amokit_library_data", t);
        };

        this.getTemplateContent = function (id, ajaxOptions) {
            var options = { 
                unique_id: id, 
                data: { 
                    edit_mode: true,
                    display: true,
                    template_id: id 
                } 
            };
            ajaxOptions && jQuery.extend( true, options, ajaxOptions), 
            elementorCommon.ajax.addRequest("get_amokit_template_data", options);
        };

        this.insertTemplate = function (e) {
            var t = e.model,
                i = this;             
            i.getModal().showLoadingView(),
            i.getTemplateContent(t.get("id"), {
                success: function (e) {
                    i.getModal().hideLoadingView(), 
                    i.getModal().hideModal();
                    var a = {};
                    -1 !== i.atIndex && (a.at = i.atIndex), 
                    $e.run(
                        "document/elements/import", 
                        { 
                            model: t, 
                            data: e, 
                            options: a 
                        }
                    ), 
                    (i.atIndex = -1);
                },
                error: function (e) {
                    i.showErrorDialog(e);
                },
                complete: function (e) {
                    i.getModal().hideLoadingView();
                },
            });
        };

        this.showErrorDialog = function (e) {
            if ("object" == typeof e) {
                var t = "";
                _.each(e, function (e) {
                    t += "<div>" + e.message + ".</div>";
                }),
                (e = t);
            } else e ? (e += ".") : (e = "<i>&#60;The error message is empty&#62;</i>");
            m.getErrorDialog()
                .setMessage('The following error(s) occurred while processing the request:<div id="elementor-template-library-error-info">' + e + "</div>")
                .show();
        };

        this.getErrorDialog = function () {
            return c || (
                c = elementorCommon.dialogsManager.createWidget(
                    "alert", 
                    { 
                        id: "elementor-template-library-error-dialog", 
                        headerMessage: "An error occurred" 
                    }
                )
            ), 
            c;
        };


    };

    window.amokit.library = new moduleExp.Manager();
    window.amokit.library.init();

})(jQuery, window.elementor);
