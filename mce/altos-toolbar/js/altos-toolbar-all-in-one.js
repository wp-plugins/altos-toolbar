var AltosToolbarDialog = {
/**/
init: function(ed)
	{
		global_altos_editor = ed, tinyMCEPopup.resizeToInnerSize ();
	},
/**/
insert: function() /* Uses global_altos_editor */
	{
		var st_cid_zid = jQuery('select[name=st,cid,zid]').val ().split (',');
		var endDate = jQuery('select[name=endDate]').val ();
		endDate = (endDate == 'dynamic') ? '' : ' endDate="' + endDate + '"';
		/**/
		var sfTbl = (jQuery('input[name=sfTbl]:checked').val ()) ? 1 : 0;
		var ctTbl = (jQuery('input[name=ctTbl]:checked').val ()) ? 1 : 0;
		/**/
		var mpChrt = (jQuery('input[name=mpChrt]:checked').val ()) ? 1 : 0;
		var invChrt = (jQuery('input[name=invChrt]:checked').val ()) ? 1 : 0;
		var adomChrt = (jQuery('input[name=adomChrt]:checked').val ()) ? 1 : 0;
		var mppsfChrt = (jQuery('input[name=mppsfChrt]:checked').val ()) ? 1 : 0;
		var mmhChrt = (jQuery('input[name=mmhChrt]:checked').val ()) ? 1 : 0;
		/**/
		var sz = jQuery('select[name=sz]').val (), ra = jQuery('select[name=ra]').val (), ts = jQuery('select[name=ts]').val (), rt = jQuery('select[name=rt]').val ();
		/**/
		var content = (sfTbl) ? '<p>[altos_stat_table format="wide" rt="sf" st="' + st_cid_zid[0] + '" cid="' + st_cid_zid[1] + '" zid="' + st_cid_zid[2] + '"' + endDate + ' /]</p>' : '';
		content += (ctTbl) ? '<p>[altos_stat_table format="wide" rt="mf" st="' + st_cid_zid[0] + '" cid="' + st_cid_zid[1] + '" zid="' + st_cid_zid[2] + '"' + endDate + ' /]</p>' : '';
		/**/
		content += (mpChrt) ? '<p>[altos_chart q="a" left="median_price" st="' + st_cid_zid[0] + '" cid="' + st_cid_zid[1] + '" zid="' + st_cid_zid[2] + '" rt="' + rt + '" ra="' + ra + '" size="' + sz + '" timeSpan="' + ts + '"' + endDate + ' /]</p>' : '';
		content += (invChrt) ? '<p>[altos_chart q="a" left="median_inventory" st="' + st_cid_zid[0] + '" cid="' + st_cid_zid[1] + '" zid="' + st_cid_zid[2] + '" rt="' + rt + '" ra="' + ra + '" size="' + sz + '" timeSpan="' + ts + '"' + endDate + ' /]</p>' : '';
		content += (adomChrt) ? '<p>[altos_chart q="a" left="mean_dom" st="' + st_cid_zid[0] + '" cid="' + st_cid_zid[1] + '" zid="' + st_cid_zid[2] + '" rt="' + rt + '" ra="' + ra + '" size="' + sz + '" timeSpan="' + ts + '"' + endDate + ' /]</p>' : '';
		content += (mppsfChrt) ? '<p>[altos_chart q="a" left="median_per_sqft" st="' + st_cid_zid[0] + '" cid="' + st_cid_zid[1] + '" zid="' + st_cid_zid[2] + '" rt="' + rt + '" ra="' + ra + '" size="' + sz + '" timeSpan="' + ts + '"' + endDate + ' /]</p>' : '';
		content += (mmhChrt) ? '<p>[altos_chart q="a" left="median_market_heat" st="' + st_cid_zid[0] + '" cid="' + st_cid_zid[1] + '" zid="' + st_cid_zid[2] + '" rt="' + rt + '" ra="' + ra + '" size="' + sz + '" timeSpan="' + ts + '"' + endDate + ' /]</p>' : '';
		/**/
		jQuery.cookie ('altos_all_in_one_settings', jQuery('select[name=endDate]').val () + '|' + sfTbl + '|' + ctTbl + '|' + mpChrt + '|' + invChrt + '|' + adomChrt + '|' + mppsfChrt + '|' + mmhChrt + '|' + sz + '|' + ra + '|' + ts + '|' + rt, {expires: 365});
		/**/
		tinyMCEPopup.execCommand ('mceInsertRawHTML', false, global_altos_editor.selection.getContent () + content);
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
				(settings[0]) ? jQuery('select[name=endDate]').attr ('cookie', settings[0]) : null;
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
/**/
jQuery(document).ready (AltosToolbarDialog.onReady);