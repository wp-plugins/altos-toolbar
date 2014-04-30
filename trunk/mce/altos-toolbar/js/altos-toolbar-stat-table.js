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
		var a, st_cid_zid = jQuery('#altos-toolbar-dialog select[name=st,cid,zid]').val ().split (','), rt = jQuery('#altos-toolbar-dialog select[name=rt]').val (), endDate = jQuery('#altos-toolbar-dialog select[name=endDate]').val (), format = jQuery('#altos-toolbar-dialog select[name=format]').val (), q = jQuery('#altos-toolbar-dialog input[name=q]').val ();
		/**/
		var content = '<img src="' + AltosToolbarDialog.mce + 'altos-toolbar/img/table/' + format + '-placeholder.png?pai=' + escape(AltosToolbarDialog.pai) + '&service=table&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=' + escape(rt) + '&format=' + escape(format) + '&q=' + escape(q) + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" />';
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
				settings['st,cid,zid'] = jQuery.trim (settings['st'] + ',' + settings['cid'] + ',' + settings['zid']);
				/**/
				(settings['st,cid,zid']) ? jQuery('select[name=st,cid,zid]').attr ('prefill', settings['st,cid,zid']) : null;
				(settings['rt']) ? jQuery('select[name=rt]').val (settings['rt']) : null;
				(settings['endDate']) ? jQuery('select[name=endDate]').attr ('prefill', settings['endDate']) : null;
				(settings['format']) ? jQuery('select[name=format]').val (settings['format']) : null;
				(settings['q']) ? jQuery('input[name=q]').val (settings['q']) : null;
			}
	}
/**/
};
/**/
tinyMCEPopup.onInit.add (AltosToolbarDialog.init, AltosToolbarDialog);