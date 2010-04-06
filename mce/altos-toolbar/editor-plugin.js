(function()
	{
		tinymce.create ('tinymce.plugins.AltosToolbar', {
		/**/
		init: function(ed, url)
			{
				global_altos_toolbar_url = url;
				/**/
				ed.addCommand ('Altos_Charts', function()
					{
						ed.windowManager.open ({file: url + '/altos-toolbar-charts.php', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 425 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
					});
				/**/
				ed.addCommand ('Altos_Regional_Chart', function()
					{
						ed.windowManager.open ({file: url + '/altos-toolbar-regional-charts.php', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 428 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
					});
				/**/
				ed.addCommand ('Altos_Flash_Chart', function()
					{
						ed.windowManager.open ({file: url + '/altos-toolbar-flash-charts.php', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 390 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
					});
				/**/
				ed.addCommand ('Altos_Stat_Table', function()
					{
						ed.windowManager.open ({file: url + '/altos-toolbar-stat-table.php', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 220 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
					});
				/**/
				ed.addCommand ('Altos_All_In_One', function()
					{
						ed.windowManager.open ({file: url + '/altos-toolbar-all-in-one.php', width: 450 + parseInt(ed.getLang ('highlight.delta_width', 0)), height: 510 + parseInt(ed.getLang ('highlight.delta_height', 0)), inline: 1}, {plugin_url: url});
					});
			},
		/**/
		createControl: function(n, cm)
			{
				switch (n) /* altos_toolbar */
					{
						case 'altos_toolbar':
							/**/
							var url = global_altos_toolbar_url, c = cm.createSplitButton ('altos_toolbar', {title: 'Altos Research', cmd: 'Altos_All_In_One', image: url + '/img/split-menu.png'});
							/**/
							c.onRenderMenu.add (function(c, m) /* Here we add the split menu items for the Altos Toolbar menu. */
								{
									m.add ({title: 'Altos Research', 'class': 'mceMenuItemTitle', image: url + '/img/favicon.png'}).setDisabled (1);
									m.add ({title: 'Altos City/Zip Charts', cmd: 'Altos_Charts', image: url + '/img/chart.png'});
									m.add ({title: 'Altos Regional Charts', cmd: 'Altos_Regional_Chart', image: url + '/img/regional.png'});
									m.add ({title: 'Altos Flash Charts', cmd: 'Altos_Flash_Chart', image: url + '/img/flash.png'});
									m.add ({title: 'Altos Stat Tables', cmd: 'Altos_Stat_Table', image: url + '/img/table.png'});
									m.add ({title: 'Altos All-In-One', cmd: 'Altos_All_In_One', image: url + '/img/favicon.png'});
								});
							/**/
							return c;
					}
				/**/
				return null;
			},
		/**/
		getInfo: function()
			{
				return{longname: 'Altos Toolbar', author: 'AltosResearch.com', authorurl: 'http://www.altosresearch.com/', infourl: 'http://www.altosresearch.com/', version: tinymce.majorVersion + "." + tinymce.minorVersion};
			}
		/**/
		});
		/**/
		tinymce.PluginManager.add ('altos_toolbar', tinymce.plugins.AltosToolbar);
	}) ();