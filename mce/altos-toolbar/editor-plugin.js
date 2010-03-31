(function() {
	
	tinymce.create('tinymce.plugins.AltosToolbar', {
		
		init : function(ed, url) {

			// Register commands
			ed.addCommand('Altos_Charts', function() {
				ed.windowManager.open({
					file : url + '/altos-toolbar-charts.php',
					width : 450 + parseInt(ed.getLang('highlight.delta_width', 0)),
					height : 465 + parseInt(ed.getLang('highlight.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addCommand('Altos_Regional_Chart', function() {
				ed.windowManager.open({
					file : url + '/altos-toolbar-regional-charts.php',
					width : 450 + parseInt(ed.getLang('highlight.delta_width', 0)),
					height : 475 + parseInt(ed.getLang('highlight.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addCommand('Altos_Flash_Chart', function() {
				ed.windowManager.open({
					file : url + '/altos-toolbar-flash-charts.php',
					width : 450 + parseInt(ed.getLang('highlight.delta_width', 0)),
					height : 420 + parseInt(ed.getLang('highlight.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			
			ed.addCommand('Altos_Stat_Table', function() {
				ed.windowManager.open({
					file : url + '/altos-toolbar-stat-table.php',
					width : 450 + parseInt(ed.getLang('highlight.delta_width', 0)),
					height : 255 + parseInt(ed.getLang('highlight.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});


			// Register buttons			
			ed.addButton('altos_toolbar_charts', {title : 'Altos Charts', cmd : 'Altos_Charts', image: url + '/img/chart.png' });
			ed.addButton('altos_toolbar_regional_charts', {title : 'Altos Regional Charts', cmd : 'Altos_Regional_Chart', image: url + '/img/regional.png' });
			ed.addButton('altos_toolbar_stat_table', {title : 'Altos Stat Table', cmd : 'Altos_Stat_Table', image: url + '/img/table.png' });
			ed.addButton('altos_toolbar_flash_charts', {title : 'Altos Flash Charts', cmd : 'Altos_Flash_Chart', image: url + '/img/flash.png' });

		},

		getInfo : function() {
			return {
				longname : 'Altos Toolbar',
				author : 'Eddie A Tejeda',
				authorurl : 'http://visudo.com',
				infourl : 'http://altosresearch.com',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});

	tinymce.PluginManager.add('altos_toolbar_charts', tinymce.plugins.AltosToolbar);
	tinymce.PluginManager.add('altos_toolbar_flash_charts', tinymce.plugins.AltosToolbar);
	tinymce.PluginManager.add('altos_toolbar_regional_charts', tinymce.plugins.AltosToolbar);
	tinymce.PluginManager.add('altos_toolbar_stat_table', tinymce.plugins.AltosToolbar);

})();