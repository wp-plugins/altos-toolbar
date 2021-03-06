var AltosToolbarDialog = {
/**/
editor: null,
/**/
init: function(ed)
	{
		AltosToolbarDialog.editor = ed;
		tinyMCEPopup.resizeToInnerSize (), AltosToolbarDialog.onReady ();
		AltosToolbarDialog.pai = parent.global_altos_pai;
		AltosToolbarDialog.mce = parent.global_altos_mce;
	},
/**/
insert: function insertAltosToolbarSection(ed)
	{
		var a, zid = jQuery('#altos-toolbar-dialog select[name=zid]').val (), rt = jQuery('#altos-toolbar-dialog select[name=rt]').val (), ra = jQuery('#altos-toolbar-dialog select[name=ra]').val (), q = jQuery('#altos-toolbar-dialog select[name=q]').val (), sz = jQuery('#altos-toolbar-dialog select[name=sz]').val (), ts = jQuery('#altos-toolbar-dialog select[name=ts]').val (), s = jQuery('#altos-toolbar-dialog select[name=s]').val (), endDate = jQuery('#altos-toolbar-dialog select[name=endDate]').val (), url = jQuery('#altos-toolbar-dialog input[name=url]').val ();
		/**/
		url = (!url || url == 'http://') ? '' : url, url = (url && !url.match (/^http\:\/\//i)) ? 'http://' + url : url;
		/**/
		var content = ((url) ? '<a href="' + url + '">' : '') + '<img src="http://charts.altosresearch.com/altos/app?pai=' + escape(AltosToolbarDialog.pai) + '&service=zrchart&zid=' + escape(zid) + '&rt=' + escape(rt) + '&ra=' + escape(ra) + '&q=' + escape(q) + '&s=' + escape(s) + '&sz=' + escape(sz) + '&ts=' + escape(ts) + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" />' + ((url) ? '</a>' : '');
		/**/
		if (editing)
			{
				var range = AltosToolbarDialog.editor.selection.getRng ();
				/**/
				if ((a = AltosToolbarDialog.editor.dom.getParent (AltosToolbarDialog.editor.selection.getNode (), 'A')) && a.childNodes.length == 1)
					AltosToolbarDialog.editor.dom.remove (a);
				/**/
				AltosToolbarDialog.editor.dom.remove (AltosToolbarDialog.editor.selection.getNode ());
				/**/
				AltosToolbarDialog.editor.selection.setRng (range);
				/**/
				tinyMCEPopup.execCommand ('mceInsertRawHTML', false, AltosToolbarDialog.editor.selection.getContent () + content)
			}
		else
			tinyMCEPopup.execCommand ('mceInsertRawHTML', false, AltosToolbarDialog.editor.selection.getContent () + content);
		/**/
		tinyMCEPopup.close ();
	},
/**/
onReady: function()
	{
		if (editing && edit)
			{
				for (var a, i = 0, settings = {}, pairs = jQuery.trim (edit.split ('?', 2)[1]).split ('&'); i < pairs.length; i++)
					{
						settings[jQuery.trim (pairs[i].split ('=', 2)[0])] = jQuery.trim (unescape(pairs[i].split ('=', 2)[1]));
					}
				/**/
				if ((a = AltosToolbarDialog.editor.dom.getParent (AltosToolbarDialog.editor.selection.getNode (), 'A')) && a.childNodes.length == 1)
					settings['url'] = a.getAttribute ('href');
				/**/
				(settings['zid']) ? jQuery('select[name=zid]').attr ('prefill', settings['zid']) : null;
				(settings['rt']) ? jQuery('select[name=rt]').val (settings['rt']) : null;
				(settings['ra']) ? jQuery('select[name=ra]').val (settings['ra']) : null;
				(settings['q']) ? jQuery('select[name=q]').val (settings['q']) : null;
				(settings['sz']) ? jQuery('select[name=sz]').val (settings['sz']) : null;
				(settings['ts']) ? jQuery('select[name=ts]').val (settings['ts']) : null;
				(settings['s']) ? jQuery('select[name=s]').val (settings['s']) : null;
				(settings['endDate']) ? jQuery('select[name=endDate]').attr ('prefill', settings['endDate']) : null;
				(settings['url']) ? jQuery('input[name=url]').val (settings['url']) : null;
			}
	}
/**/
};
/**/
tinyMCEPopup.onInit.add (AltosToolbarDialog.init, AltosToolbarDialog);