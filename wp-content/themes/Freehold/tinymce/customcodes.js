//////////////////////////////////////////////////////////////////
// Add Button button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.button', {  
        init : function(ed, url) {  
            ed.addButton('button', {  
                title : 'Add a button',  
                image : url+'/button-button.png',  
                onclick : function() {  
                     ed.selection.setContent('[button link="" target="" arrow="secondary-button"]Text here[/button]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button', tinymce.plugins.button);  
})();


//////////////////////////////////////////////////////////////////
// Add Background Area
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.background', {  
        init : function(ed, url) {  
            ed.addButton('background', {  
                title : 'Add a Background Area',  
                image : url+'/button-dropcap.png',  
                onclick : function() {  
                     ed.selection.setContent('[background heading="" ]Text here[/background]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('background', tinymce.plugins.background);  
})();



//////////////////////////////////////////////////////////////////
// Add bgarea Area
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.bgarea', {  
        init : function(ed, url) {  
            ed.addButton('bgarea', {  
                title : 'Add a Background Highlight',  
                image : url+'/bg-highlight.png',  
                onclick : function() {  
                     ed.selection.setContent('[bgarea]Text here... Short Code only works on Full Width Pages[/bgarea]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('bgarea', tinymce.plugins.bgarea);  
})();

//////////////////////////////////////////////////////////////////
// Add Checklist button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.checklist', {  
        init : function(ed, url) {  
            ed.addButton('checklist', {  
                title : 'Add a checklist',  
                image : url+'/button-checklist.png',  
                onclick : function() {  
                     ed.selection.setContent('[checklist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/checklist]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('checklist', tinymce.plugins.checklist);  
})();

//////////////////////////////////////////////////////////////////
//Add divider button
//////////////////////////////////////////////////////////////////
(function() {  
 tinymce.create('tinymce.plugins.divider', {  
     init : function(ed, url) {  
         ed.addButton('divider', {  
             title : 'Add a divider',  
             image : url+'/divider.png',  
             onclick : function() {  
                  ed.selection.setContent('[divider][/divider]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('divider', tinymce.plugins.divider);  
})();

//////////////////////////////////////////////////////////////////
// Add an arrow list button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.arrowlist', {  
        init : function(ed, url) {  
            ed.addButton('arrowlist', {  
                title : 'Add an arrow list',  
                image : url+'/button-arrow.png',  
                onclick : function() {  
                     ed.selection.setContent('[arrowlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/arrowlist]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('arrowlist', tinymce.plugins.arrowlist);  
})();

//////////////////////////////////////////////////////////////////
// Add One_half button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.one_half', {  
        init : function(ed, url) {  
            ed.addButton('one_half', {  
                title : 'Add a one_half column',  
                image : url+'/button-12.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_half last="no"]...[/one_half]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_half', tinymce.plugins.one_half);  
})();

//////////////////////////////////////////////////////////////////
// Add One_half button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.one_third', {  
        init : function(ed, url) {  
            ed.addButton('one_third', {  
                title : 'Add a one_third column',  
                image : url+'/button-13.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_third last="no"]...[/one_third]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_third', tinymce.plugins.one_third);  
})();

//////////////////////////////////////////////////////////////////
// Add Two_half button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.two_third', {  
        init : function(ed, url) {  
            ed.addButton('two_third', {  
                title : 'Add a two_third column',  
                image : url+'/button-23.png',  
                onclick : function() {  
                     ed.selection.setContent('[two_third last="no"]...[/two_third]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('two_third', tinymce.plugins.two_third);  
})();

//////////////////////////////////////////////////////////////////
// Add one_fourth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.one_fourth', {  
        init : function(ed, url) {  
            ed.addButton('one_fourth', {  
                title : 'Add a one_fourth column',  
                image : url+'/button-14.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_fourth last="no"]...[/one_fourth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_fourth', tinymce.plugins.one_fourth);  
})();

//////////////////////////////////////////////////////////////////
// Add three_fourth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.three_fourth', {  
        init : function(ed, url) {  
            ed.addButton('three_fourth', {  
                title : 'Add a three_fourth column',  
                image : url+'/button-34.png',  
                onclick : function() {  
                     ed.selection.setContent('[three_fourth last="no"]...[/three_fourth]');   
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('three_fourth', tinymce.plugins.three_fourth);  
})();

//////////////////////////////////////////////////////////////////
//Add slider button
//////////////////////////////////////////////////////////////////
(function() {  
 tinymce.create('tinymce.plugins.slider', {  
     init : function(ed, url) {  
         ed.addButton('slider', {  
             title : 'Add a slider',  
             image : url+'/slider.png',  
             onclick : function() {  
                  ed.selection.setContent('[slider][slide img="" caption=""][slide img="" caption=""][slide img="" caption=""][/slider]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('slider', tinymce.plugins.slider);  
})();

//////////////////////////////////////////////////////////////////
//Add Tabs button
//////////////////////////////////////////////////////////////////
(function() {  
 tinymce.create('tinymce.plugins.tabs', {  
     init : function(ed, url) {  
         ed.addButton('tabs', {  
             title : 'Add Tabs Pane',  
             image : url+'/button-tabs.png',  
             onclick : function() {  
                  ed.selection.setContent('[tabgroup][tab title="Tab 1"]Tab 1 content here[/tab][tab title="Tab 2"]Tab 2 content here[/tab][/tabgroup]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
})();


//////////////////////////////////////////////////////////////////
// Add additional features
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.additional_features', {  
        init : function(ed, url) {  
            ed.addButton('additional_features', {  
                title : 'Add additional property features',  
                image : url+'/bg-highlight.png',  
                onclick : function() {  
                     ed.selection.setContent('<h5 class="additional-features-headline">Additional Features</h5><ul class="additional-features"><li>Property Status: For Sale</li><li>MLS #: 21218082</li><li>Roof: Composition</li><li>Foundation: Concrete Perimeter</li><li>Heating Fuel: other</li><li>View: Vineyard</li></ul>');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('additional_features', tinymce.plugins.additional_features);  
})();