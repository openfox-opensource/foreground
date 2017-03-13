

mw.loader.using( 'ext.visualEditor.desktopArticleTarget.init', function () {
    // Register plugins to VE. will be loaded once the user opens VE
    mw.libs.ve.addPlugin( function () { 
        //הטמעת דף 
        if (!mw.messages.exists('WikiEmbed-toolname')) {
            mw.messages.set('WikiEmbed-toolname', 'הטמעת דף בויקי');
        }

        function WikiEmbed(toolGroup, config) {
            OO.ui.Tool.call(this, toolGroup, config);
        }
        OO.inheritClass(WikiEmbed, OO.ui.Tool);

        WikiEmbed.static.name = 'WikiEmbed';
        WikiEmbed.static.title = mw.msg('WikiEmbed-toolname');
        //WikiEmbed.static.icon = 'addDoc';
        WikiEmbed.static.icon = 'article';

        WikiEmbed.prototype.onSelect = function () {
            this.toolbar
                .getSurface()
                .getModel()
                .getFragment()
                .collapseToEnd()
                .insertContent([{
                    'type' : 'mwTransclusionInline',
                    'attributes' : {
                        'mw' : {
                            parts : [{
                                template : {
                                    target : {
                                        href : 'תבנית:הטמעת דף',
                                        wt : 'הטמעת דף'
                                    },
                                    params : {}
                                }
                            }
                                    ]
                        }
                    }
                }
                               ]);
        };

        WikiEmbed.prototype.onUpdateState = function () {
            this.setActive(false);
        };

        ve.ui.toolFactory.register(WikiEmbed);

        //google drive tool
        // localization for button name
        if (!mw.messages.exists('GFTool-toolname')) {
            mw.messages.set('GFTool-toolname', 'תיקיית דרייב');
        }

        // localization for embed template name
        /*if (!mw.config.exists('embedTemplateName')) {
			mw.config.set('embedTemplateName', 'דרייב מכון');
		}*/
        //end of localization

        function GFTool(toolGroup, config) {
            OO.ui.Tool.call(this, toolGroup, config);
        }
        OO.inheritClass(GFTool, OO.ui.Tool);

        GFTool.static.name = 'GFTool';
        GFTool.static.title = mw.msg('GFTool-toolname');
        GFTool.static.icon = 'googleDrive';

        GFTool.prototype.onSelect = function () {
            this.toolbar
                .getSurface()
                .getModel()
                .getFragment()
                .collapseToEnd()
                .insertContent([{
                    'type' : 'mwTransclusionInline',
                    'attributes' : {
                        'mw' : {
                            parts : [{
                                template : {
                                    target : {
                                        href : 'תבנית:תיקיות גוגל',
                                        wt : 'תיקיות גוגל'
                                    },
                                    params : {}
                                }
                            }
                                    ]
                        }
                    }
                }
                               ]);
        };

        GFTool.prototype.onUpdateState = function () {
            this.setActive(false);
        };

        ve.ui.toolFactory.register(GFTool);

        //any embed localization for button name
        if (!mw.messages.exists('EmbedTool-toolname')) {
            mw.messages.set('EmbedTool-toolname', 'מדיה חיצונית');
        }
        // localization for embed template name
        /*if (!mw.config.exists('embedTemplateName')) {
		mw.config.set('embedTemplateName', 'הטמעה');
	}*/
        //end of localization

        function EmbedTool(toolGroup, config) {
            OO.ui.Tool.call(this, toolGroup, config);
        }
        OO.inheritClass(EmbedTool, OO.ui.Tool);

        EmbedTool.static.name = 'EmbedTool';
        EmbedTool.static.title = mw.msg('EmbedTool-toolname');
        //EmbedTool.static.icon = 'embedTool';
        EmbedTool.static.icon = 'linkExternal';

        EmbedTool.prototype.onSelect = function () {
            this.toolbar
                .getSurface()
                .getModel()
                .getFragment()
                .collapseToEnd()
                .insertContent([{
                    'type' : 'mwTransclusionInline',
                    'attributes' : {
                        'mw' : {
                            parts : [{
                                template : {
                                    target : {
                                        href : 'תבנית:הטמעה',
                                        wt : 'הטמעה'
                                    },
                                    params : {}
                                }
                            }
                                    ]
                        }
                    }
                }
                               ]);
        };

        EmbedTool.prototype.onUpdateState = function () {
            this.setActive(false);
        };

        ve.ui.toolFactory.register(EmbedTool);

        //video tool
        // localization for button name
        if (!mw.messages.exists('VideoTool-toolname')) {
            mw.messages.set('VideoTool-toolname', 'סרטון יוטיוב');
        }
        // localization for embed template name
        /*if (!mw.config.exists('embedTemplateName')) {
		mw.config.set('embedTemplateName', 'סרטון יוטיוב');
	}*/
        //end of localization

        function VideoTool(toolGroup, config) {
            OO.ui.Tool.call(this, toolGroup, config);
        }
        OO.inheritClass(VideoTool, OO.ui.Tool);

        VideoTool.static.name = 'VideoTool';
        VideoTool.static.title = mw.msg('VideoTool-toolname');
        VideoTool.static.icon = 'youtube';

        VideoTool.prototype.onSelect = function () {
            this.toolbar
                .getSurface()
                .getModel()
                .getFragment()
                .collapseToEnd()
                .insertContent([{
                    'type' : 'mwTransclusionInline',
                    'attributes' : {
                        'mw' : {
                            parts : [{
                                template : {
                                    target : {
                                        href : 'תבנית:סרטון',
                                        wt : 'סרטון'
                                    },
                                    params : {}
                                }
                            }
                                    ]
                        }
                    }
                }
                               ]);
        };

        VideoTool.prototype.onUpdateState = function () {
            this.setActive(false);
        };

        ve.ui.toolFactory.register(VideoTool);
        //מסמך גוגל 
        if (!mw.messages.exists('GDoc-toolname')) {
            mw.messages.set('GDoc-toolname', 'מסמך דרייב');
        }

        function GDoc(toolGroup, config) {
            OO.ui.Tool.call(this, toolGroup, config);
        }
        OO.inheritClass(GDoc, OO.ui.Tool);

        GDoc.static.name = 'GDoc';
        GDoc.static.title = mw.msg('GDoc-toolname');
        GDoc.static.icon = 'driveFile';

        GDoc.prototype.onSelect = function () {
            this.toolbar
                .getSurface()
                .getModel()
                .getFragment()
                .collapseToEnd()
                .insertContent([{
                    'type' : 'mwTransclusionInline',
                    'attributes' : {
                        'mw' : {
                            parts : [{
                                template : {
                                    target : {
                                        href : 'תבנית:מסמך גוגל',
                                        wt : 'מסמך גוגל'
                                    },
                                    params : {}
                                }
                            }
                                    ]
                        }
                    }
                }
                               ]);
        };

        GDoc.prototype.onUpdateState = function () {
            this.setActive(false);
        };

        ve.ui.toolFactory.register(GDoc);

        //הטמעת אתר
        if (!mw.messages.exists('WebEmbed-toolname')) {
            mw.messages.set('WebEmbed-toolname', 'הטמעת אתר');
        }

        function WebEmbed(toolGroup, config) {
            OO.ui.Tool.call(this, toolGroup, config);
        }
        OO.inheritClass(WebEmbed, OO.ui.Tool);

        WebEmbed.static.name = 'WebEmbed';
        WebEmbed.static.title = mw.msg('WebEmbed-toolname');
        //WebEmbed.static.icon = 'internetWeb';
        WebEmbed.static.icon = 'browser';

        WebEmbed.prototype.onSelect = function () {
            this.toolbar
                .getSurface()
                .getModel()
                .getFragment()
                .collapseToEnd()
                .insertContent([{
                    'type' : 'mwTransclusionInline',
                    'attributes' : {
                        'mw' : {
                            parts : [{
                                template : {
                                    target : {
                                        href : 'תבנית:הטמעת אתר',
                                        wt : 'הטמעת אתר'
                                    },
                                    params : {}
                                }
                            }
                                    ]
                        }
                    }
                }
                               ]);
        };

        WebEmbed.prototype.onUpdateState = function () {
            this.setActive(false);
        };

        ve.ui.toolFactory.register(WebEmbed);
    } );
});