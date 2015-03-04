tinymce.PluginManager.add('altos_toolbar', function (ed, url) {


	window.global_altos_toolbar_url = url;
	/**/
	ed.addCommand ('Altos_Charts', function()
		{
			ed.windowManager.open ({file: url + '/altos-toolbar-charts.php?ver=1.4.1', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 425 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
		});
	/**/
	ed.addCommand ('Altos_Regional_Chart', function()
		{
			ed.windowManager.open ({file: url + '/altos-toolbar-regional-charts.php?ver=1.4.1', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 428 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
		});
	/**/
	ed.addCommand ('Altos_Flash_Chart', function()
		{
			ed.windowManager.open ({file: url + '/altos-toolbar-flash-charts.php?ver=1.4.1', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 390 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
		});
	/**/
	ed.addCommand ('Altos_Stat_Table', function()
		{
			ed.windowManager.open ({file: url + '/altos-toolbar-stat-table.php?ver=1.4.1', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 220 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
		});
	/**/
	ed.addCommand ('Altos_All_In_One', function()
		{
			ed.windowManager.open ({file: url + '/altos-toolbar-all-in-one.php?ver=1.4.1', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 510 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
		});
	/**/
    ed.addCommand ('Altos_Edit', function()
    {
        var el = ed.selection.getNode();
        var src = el.getAttribute ('src');
        /**/
        if (src.match (/altos/)) /* Must be an Altos image insert. */
        {
            if (src.match (/service\=chart/))
                ed.windowManager.open ({file: url + '/altos-toolbar-charts.php?ver=1.4.1&edit=' + encodeURIComponent(src), width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 425 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
            /**/
            else if (src.match (/service\=zrchart/))
                ed.windowManager.open ({file: url + '/altos-toolbar-regional-charts.php?ver=1.4.1&edit=' + encodeURIComponent(src), width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 428 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
            /**/
            else if (src.match (/service\=flchart/))
                ed.windowManager.open ({file: url + '/altos-toolbar-flash-charts.php?ver=1.4.1&edit=' + encodeURIComponent(src), width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 390 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
            /**/
            else if (src.match (/service\=table/))
                ed.windowManager.open ({file: url + '/altos-toolbar-stat-table.php?ver=1.4.1&edit=' + encodeURIComponent(src), width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 220 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
        }
    });


                /**/
//				ed.on('init', function() {});
//            /*
//					{
//						tinymce.dom.on('scroll', function(e)
//							{
//								ed.plugins.altos_toolbar.hideEditButton ();
//							});
//						tinymce.dom.on('dragstart', function(e)
//							{
//								ed.plugins.altos_toolbar.hideEditButton ();
//							});
//					});
//			  */
//				ed.on('BeforeExecCommand', function(cmd, ui, val)
//					{
//						ed.plugins.altos_toolbar.hideEditButton ();
//					});
//				/**/
//				ed.on('SaveContent', function(e)
//					{
//						ed.plugins.altos_toolbar.hideEditButton ();
//					});
//				/**/
//				ed.on('MouseDown', function(e)
//					{
//						ed.plugins.altos_toolbar.hideEditButton ();
//						/**/
//						if (e.target.nodeName == 'IMG' && !ed.dom.getAttrib (e.target, 'class').match (/mceItem/))
//							if (ed.dom.getAttrib (e.target, 'src').match (/altos/))
//								ed.plugins.altos_toolbar.showEditButton ();
//					});
//				/**/

				/**/
    var myMenuList = [{text: 'Altos Research', icon: url + '/img/favicon.png'},
				{text: 'Altos City/Zip Charts', cmd: 'Altos_Charts', image: url + '/img/chart.png',
				  onclick: function() {ed.execCommand('Altos_Charts')}},
				{text: 'Altos Regional Charts', cmd: 'Altos_Regional_Chart', image: url + '/img/regional.png',
                    onclick: function() {ed.execCommand('Altos_Regional_Chart')}},

                {text: 'Altos Flash Charts', cmd: 'Altos_Flash_Chart', image: url + '/img/flash.png',
                    onclick: function() {ed.execCommand('Altos_Flash_Chart')}},

                {text: 'Altos Stat Tables', cmd: 'Altos_Stat_Table', image: url + '/img/table.png',
                    onclick: function() {ed.execCommand('Altos_Stat_Table')}},

                {text: 'Altos ( All-In-One )', cmd: 'Altos_All_In_One', image: url + '/img/favicon.png',
                    onclick: function() {ed.execCommand('Altos_All_In_One')}},
                ];



//    ed.addMenu('insertValueOfMyNewDropdown', {
//        icon: 'date',
//        text: 'Do something with this new dropdown',
//        context: 'insert'
//    });

//    ed.addMenuItem('', {});
//	ed.addButton('altos_toolbar',
//	    {title: 'Altos Research',
//
//	    cmd: 'Altos_Flash_Chart',
//	    image: url + '/img/favicon.png'});
//    ed.createDropMenu('altos_toolbar',
//        {title: 'Altos City/Zip Charts',
//        icon: url + '/img/chart.png'});
////    ed.addMenu();
	ed.addButton('altos_toolbar',
	    {type: 'menubutton',
	    text: 'Altos Research',
	    icon: true,
	    menu: myMenuList});
//	ed.addButton('altos_toolbar',
//	 {title: 'Altos Regional Charts',
//	  cmd: 'Altos_Regional_Chart',
//	  image: url + '/img/regional.png'});
//	ed.addMenuItem('altos_toolbar',
//	  {title: 'Altos Flash Charts',
//	  cmd: 'Altos_Flash_Chart',
//	  image: url + '/img/flash.png',
//	  context: 'insert'});
//	ed.addMenuItem('altos_toolbar',
//	  {title: 'Altos Stat Tables',
//	   cmd: 'Altos_Stat_Table',
//	   image: url + '/img/table.png',
//	   context: 'insert'});
//	ed.addMenuItem('altos_toolbar',
//	  {title: 'Altos ( All-In-One )', cmd: 'Altos_All_In_One', image: url + '/img/favicon.png'});
});


//    selector: "textarea",
//    plugins: "altos_toolbar",
//    setup: function(ed) {
//        ed.addButton('altos_toolbar_menu', {
//            icon: url + '/img/favicon.png
//        }
//    }
//});
//				this.createEditButton ();
//			},
//		/**/
//		createControl: function(n, cm)
//			{
//				switch (n) /* altos_toolbar */
//					{
//						case 'altos_toolbar':
//							/**/
//							var url = global_altos_toolbar_url, c = cm.createSplitButton ('altos_toolbar', {title: 'Altos Research', cmd: 'Altos_All_In_One', image: url + '/img/split-menu.png'});
//							/**/
//							c.onRenderMenu.add (function(c, m) /* Here we add the split menu items for the Altos Toolbar menu. */
//								{
//									m.add ({title: 'Altos Research', 'class': 'mceMenuItemTitle', image: url + '/img/favicon.png'}).setDisabled (1);
//									m.add ({title: 'Altos City/Zip Charts', cmd: 'Altos_Charts', image: url + '/img/chart.png'});
//									m.add ({title: 'Altos Regional Charts', cmd: 'Altos_Regional_Chart', image: url + '/img/regional.png'});
//									m.add ({title: 'Altos Flash Charts', cmd: 'Altos_Flash_Chart', image: url + '/img/flash.png'});
//									m.add ({title: 'Altos Stat Tables', cmd: 'Altos_Stat_Table', image: url + '/img/table.png'});
//									m.add ({title: 'Altos ( All-In-One )', cmd: 'Altos_All_In_One', image: url + '/img/favicon.png'});
//								});
//							/**/
//							return c;
//					}
//				/**/
//				return null;
//			},
//		/**/
//		createEditButton: function()
//			{
//				jQuery('#altos_toolbar_edit_button').remove ();
//				/**/
//				jQuery('#wp_editbtns').prepend ('<img src="' + global_altos_toolbar_url + '/img/edit-button.png" id="altos_toolbar_edit_button" title="Altos Toolbar ( Edit )" style="display:none; background-color:#EEEEEE; border-color:#999999; -moz-border-radius:3px 3px 3px 3px; border-style:solid; border-width:1px; margin:2px; padding:2px;" />');
//				/**/
//				jQuery('#altos_toolbar_edit_button').mousedown (function()
//					{
//						var ed = tinyMCE.activeEditor;
//						ed.windowManager.bookmark = ed.selection.getBookmark ('simple');
//						ed.execCommand ("Altos_Edit");
//					});
//			},
//		/**/
//		showEditButton: function()
//			{
//				jQuery('#altos_toolbar_edit_button').show ();
//				/**/
//				clearTimeout(global_altos_edit_button_tout);
//				global_altos_edit_button_tout = setTimeout(function()
//					{
//						var ed = tinyMCE.activeEditor;
//						ed.plugins.altos_toolbar.hideEditButton ();
//					}, 5000);
//			},
//		/**/
//		hideEditButton: function()
//			{
//				jQuery('#altos_toolbar_edit_button').hide ();
//			},
//		/**/
//		getInfo: function()
//			{
//				return{longname: 'Altos Toolbar', author: 'AltosResearch.com', authorurl: 'http://www.altosresearch.com/', infourl: 'http://www.altosresearch.com/', version: tinymce.majorVersion + "." + tinymce.minorVersion};
//			}
//		/**/
//		});
//		/**/
//		tinymce.PluginManager.add ('altos_toolbar', tinymce.plugins.AltosToolbar);
//	}) ();
