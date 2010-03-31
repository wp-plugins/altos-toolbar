var AltosToolbarDialog = {
	
	localprintd : 'ed',
	
	init : function(ed) {
		AltosToolbarDialog.localprintd = ed;
		tinyMCEPopup.resizeToInnerSize();
	},
	
	insert : function insertAltosToolbarSection(ed) {

		// Try and remove existing style / blockquote
		// tinyMCEPopup.execCommand('mceRemoveNode', false, null);

		// Get Properties
		var include = jQuery('#altos-toolbar-dialog input[name=submit]').val() == 'Insert Stat Table';
		var st_cid_zid = jQuery('#altos-toolbar-dialog select[name=st,cid,zid]').val().split(",");
		var endDate = jQuery('#altos-toolbar-dialog select[name=D]').val();
		var format = jQuery('#altos-toolbar-dialog select[name=format]').val();
		var rt = jQuery('#altos-toolbar-dialog select[name=rt]').val();

		var output = AltosToolbarDialog.localprintd.selection.getContent();

		var date_format;
		if(include == true){			
			date_format = (endDate == 'dynamic') ? '' : ' endDate = "' + endDate +'"';
			
			var content = '<p>[altos_stat_table st="'+st_cid_zid[0]+'" cid="'+st_cid_zid[1]+'" zid="'+st_cid_zid[2]+'" rt="'+rt+'" format="'+format+'" '+date_format+'/]</p>';
			
			output = AltosToolbarDialog.localprintd.selection.getContent() + content;
		}

		tinyMCEPopup.execCommand('mceInsertRawHTML', false, output);

		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(AltosToolbarDialog.init, AltosToolbarDialog);