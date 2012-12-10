<script type="text/javascript">
// Creates a new plugin class and a custom listbox
tinymce.create('tinymce.plugins.ExamplePlugin', {
    createControl: function(n, cm) {
        switch (n) {
            case 'mylistbox':
                var mlb = cm.createListBox('mylistbox', {
                     title : 'Variables',
                     onselect : function(v) {
                         //tinyMCE.activeEditor.windowManager.alert('Value selected:' + v);
                    	//inserts the corresponding value at the cursor position
                         tinyMCE.activeEditor.execCommand('mceInsertContent',false,v);
                     }
                });
 
                // Add some values to the list box
                <?php 
                include("variable_handling.php");
                if (isset($_SESSION['session_variables']) || isset($_SESSION['session_hints'])) {
                	$variables = unserialize($_SESSION['session_variables']);
                	$hints = unserialize($_SESSION['session_hints']);
                } else {
                	$variables = new set_of_vars();
                	$hints = new set_of_vars();
                }
                
                if (isset($variables)) {
					foreach ($variables->get_my_vars() as $name => $type_of_var) {
						if($name != ""){
							echo "mlb.add('" . $name . "', '<var>".$name."</var>&nbsp;');\n";		
						}			
					}				
				}
                ?>
                /*mlb.add('Variable 1', 'val1');
                mlb.add('Variable 2', 'val2');
                mlb.add('Varaible 3', 'val3');*/

                // Return the new listbox instance
                return mlb;

            case 'mysplitbutton': 
                var c = cm.createSplitButton('mysplitbutton', {
			title : 'My split button',
	               	image : '/example_data/example.gif',
			onclick : function() {
        	                tinyMCE.activeEditor.windowManager.alert('Button was clicked.');
			}
                });

                c.onRenderMenu.add(function(c, m) {
                    m.add({title : 'Some title', 'class' : 'mceMenuItemTitle'}).setDisabled(1);

                    m.add({title : 'Some item 1', onclick : function() {
                        tinyMCE.activeEditor.windowManager.alert('Some  item 1 was clicked.');
                    }});

                    m.add({title : 'Some item 2', onclick : function() {
                        tinyMCE.activeEditor.windowManager.alert('Some  item 2 was clicked.');
                    }});
                });

                // Return the new splitbutton instance
                return c;
        }

        return null;
    }
});

// Register plugin with a short name
tinymce.PluginManager.add('example', tinymce.plugins.ExamplePlugin);

// Initialize TinyMCE with the new plugin and listbox


/*tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    theme_advanced_buttons1 : "fontselect,fontsizeselect,formatselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,undo,redo",
    theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,backcolor,separator,hr,link,unlink,image,media,table,code,separator,asciimath,asciimathcharmap,asciisvg",
    theme_advanced_buttons3 : "",
    theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins : 'asciimath,asciisvg,table,inlinepopups,media',
   
    AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
    ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
        
    content_css : "./tinymce/css/content.css"
});*/


tinyMCE.init({
    plugins : "asciimath,asciisvg,-example,equation,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave", // - tells TinyMCE to skip the loading of the plugin
    mode : "specific_textareas",
    editor_selector : "active_textbox",
	theme : "advanced",
	skin : "o2k7",
	skin_variant : "silver",
    //theme_advanced_buttons1 : ",bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink",
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
	
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "asciimathcharmap,asciisvg,mylistbox,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
	//theme_advanced_buttons4 : "asciimath,asciimathcharmap,asciisvg,mylistbox,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
	theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
    ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
        
    content_css : "./tinymce/css/content.css"
    //theme_advanced_statusbar_location : "bottom"
});
tinyMCE.init({
    plugins : "asciimath,-example,equation,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave", // - tells TinyMCE to skip the loading of the plugin
    mode : "specific_textareas",
    editor_selector : "solution_textbox",
	theme : "advanced",
	skin : "o2k7",
	skin_variant : "silver",
    //theme_advanced_buttons1 : ",bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink",
    theme_advanced_buttons1 : "asciimathcharmap, mylistbox,|,code",
    AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
    ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
        
    content_css : "./tinymce/css/content.css"
	//theme_advanced_toolbar_location : "top",
    //theme_advanced_toolbar_align : "left",
    //theme_advanced_statusbar_location : "bottom"
});

</script>





