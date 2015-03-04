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
insert: function() /* Uses global_altos_editor */
	{
		var content = '', st_cid_zid = jQuery('select[name=st,cid,zid]').val ().split (','), endDate = jQuery('select[name=endDate]').val (), sfTbl = (jQuery('input[name=sfTbl]:checked').val ()) ? 1 : 0, ctTbl = (jQuery('input[name=ctTbl]:checked').val ()) ? 1 : 0, mpChrt = (jQuery('input[name=mpChrt]:checked').val ()) ? 1 : 0, invChrt = (jQuery('input[name=invChrt]:checked').val ()) ? 1 : 0, adomChrt = (jQuery('input[name=adomChrt]:checked').val ()) ? 1 : 0, mppsfChrt = (jQuery('input[name=mppsfChrt]:checked').val ()) ? 1 : 0, mmhChrt = (jQuery('input[name=mmhChrt]:checked').val ()) ? 1 : 0, sz = jQuery('select[name=sz]').val (), ra = jQuery('select[name=ra]').val (), ts = jQuery('select[name=ts]').val (), rt = jQuery('select[name=rt]').val ();
		/**/
		content += (sfTbl) ? '<p><img src="' + AltosToolbarDialog.mce + 'altos-toolbar/img/table/wide-placeholder.png?pai=' + escape(AltosToolbarDialog.pai) + '&service=table&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=sf&format=wide&q=a' + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" /></p>' : '';
		content += (ctTbl) ? '<p><img src="' + AltosToolbarDialog.mce + 'altos-toolbar/img/table/wide-placeholder.png?pai=' + escape(AltosToolbarDialog.pai) + '&service=table&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=mf&format=wide&q=a' + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" /></p>' : '';
		/**/
		content += (mpChrt) ? '<p><img src="http://charts.altosresearch.com/altos/app?pai=' + escape(AltosToolbarDialog.pai) + '&service=chart&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=' + escape(rt) + '&ra=' + escape(ra) + '&q=a&s=median_price&sz=' + escape(sz) + '&ts=' + escape(ts) + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" /></p>' : '';
		content += (invChrt) ? '<p><img src="http://charts.altosresearch.com/altos/app?pai=' + escape(AltosToolbarDialog.pai) + '&service=chart&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=' + escape(rt) + '&ra=' + escape(ra) + '&q=a&s=median_inventory&sz=' + escape(sz) + '&ts=' + escape(ts) + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" /></p>' : '';
		content += (adomChrt) ? '<p><img src="http://charts.altosresearch.com/altos/app?pai=' + escape(AltosToolbarDialog.pai) + '&service=chart&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=' + escape(rt) + '&ra=' + escape(ra) + '&q=a&s=mean_dom&sz=' + escape(sz) + '&ts=' + escape(ts) + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" /></p>' : '';
		content += (mppsfChrt) ? '<p><img src="http://charts.altosresearch.com/altos/app?pai=' + escape(AltosToolbarDialog.pai) + '&service=chart&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=' + escape(rt) + '&ra=' + escape(ra) + '&q=a&s=median_per_sqft&sz=' + escape(sz) + '&ts=' + escape(ts) + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" /></p>' : '';
		content += (mmhChrt) ? '<p><img src="http://charts.altosresearch.com/altos/app?pai=' + escape(AltosToolbarDialog.pai) + '&service=chart&st=' + escape(st_cid_zid[0]) + '&cid=' + escape(st_cid_zid[1]) + '&zid=' + escape(st_cid_zid[2]) + '&rt=' + escape(rt) + '&ra=' + escape(ra) + '&q=a&s=median_market_heat&sz=' + escape(sz) + '&ts=' + escape(ts) + ((endDate && endDate !== 'dynamic') ? '&endDate=' + escape(endDate) : '') + '" alt="" /></p>' : '';
		/**/
		jQuery.cookie ('altos_all_in_one_settings', endDate + '|' + sfTbl + '|' + ctTbl + '|' + mpChrt + '|' + invChrt + '|' + adomChrt + '|' + mppsfChrt + '|' + mmhChrt + '|' + sz + '|' + ra + '|' + ts + '|' + rt, {expires: 365});
		/**/
		tinyMCEPopup.execCommand ('mceInsertRawHTML', false, AltosToolbarDialog.editor.selection.getContent () + content);
		/**/
		tinyMCEPopup.close ();
	},
/**/
onReady: function()
	{
		if (typeof jQuery.cookie ('altos_all_in_one_settings') === 'string')
			{
				var settings = jQuery.cookie ('altos_all_in_one_settings').split ('|');
				/**/
				(settings[0]) ? jQuery('select[name=endDate]').attr ('prefill', settings[0]) : null;
				/**/
				jQuery('input[name=sfTbl]').attr ('checked', ((settings[1] == 1) ? true : false));
				jQuery('input[name=ctTbl]').attr ('checked', ((settings[2] == 1) ? true : false));
				/**/
				jQuery('input[name=mpChrt]').attr ('checked', ((settings[3] == 1) ? true : false));
				jQuery('input[name=invChrt]').attr ('checked', ((settings[4] == 1) ? true : false));
				jQuery('input[name=adomChrt]').attr ('checked', ((settings[5] == 1) ? true : false));
				jQuery('input[name=mppsfChrt]').attr ('checked', ((settings[6] == 1) ? true : false));
				jQuery('input[name=mmhChrt]').attr ('checked', ((settings[7] == 1) ? true : false));
				/**/
				(settings[7]) ? jQuery('select[name=sz]').val (settings[8]) : null;
				(settings[8]) ? jQuery('select[name=ra]').val (settings[9]) : null;
				(settings[9]) ? jQuery('select[name=ts]').val (settings[10]) : null;
				(settings[10]) ? jQuery('select[name=rt]').val (settings[11]) : null;
			}
	}
/**/
};
/**/
tinyMCEPopup.onInit.add (AltosToolbarDialog.init, AltosToolbarDialog);