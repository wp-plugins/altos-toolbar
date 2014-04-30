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
		var a, st_cid_zid = jQuery('#altos-toolbar-dialog select[name=st,cid,zid]').val ().split (','), right = jQuery('#altos-toolbar-dialog select[name=right]').val (), left = jQuery('#altos-toolbar-dialog select[name=left]').val (), mini = jQuery('#altos-toolbar-dialog select[name=mini]').val (), width = jQuery('#altos-toolbar-dialog input[name=width]').val (), height = jQuery('#altos-toolbar-dialog input[name=height]').val (), rt = jQuery('#altos-toolbar-dialog select[name=rt]').val (), ra = jQuery('#altos-toolbar-dialog select[name=ra]').val (), q = jQuery('#altos-toolbar-dialog select[name=q]').val ();
		/**/
		var content = '<img src="' + AltosToolbarDialog.mce + 'altos-toolbar/img/flash/placeholder.jpg?pai=' + escape(AltosToolbarDialog.pai) + '&service=flchart&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&right=' + escape(right) + '&left=' + escape(left) + '&mini=' + escape(mini) + '&width=' + escape(width) + '&height=' + escape(height) + '&rt=' + escape(rt) + '&ra=' + escape(ra) + '&q=' + escape(q) + '" width="' + width + '" height="' + height + '" alt="" />';
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
				(settings['right']) ? jQuery('select[name=right]').val (settings['right']) : null;
				(settings['left']) ? jQuery('select[name=left]').val (settings['left']) : null;
				(settings['mini']) ? jQuery('select[name=mini]').val (settings['mini']) : null;
				(settings['width']) ? jQuery('input[name=width]').val (settings['width']) : null;
				(settings['height']) ? jQuery('input[name=height]').val (settings['height']) : null;
				(settings['rt']) ? jQuery('select[name=rt]').val (settings['rt']) : null;
				(settings['ra']) ? jQuery('select[name=ra]').val (settings['ra']) : null;
				(settings['q']) ? jQuery('select[name=q]').val (settings['q']) : null;
			}
	}
/**/
};
/**/
tinyMCEPopup.onInit.add (AltosToolbarDialog.init, AltosToolbarDialog);