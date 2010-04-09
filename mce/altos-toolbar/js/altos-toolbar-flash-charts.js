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
		var include = jQuery('#altos-toolbar-dialog input[name=submit]').val() == 'Insert Flash Chart';
		var st_cid_zid = jQuery('#altos-toolbar-dialog select[name=st,cid,zid]').val().split(",");
		var date = jQuery('#altos-toolbar-dialog select[name=D]').val();
		var format = jQuery('#altos-toolbar-dialog select[name=format]').val();
		var rt = jQuery('#altos-toolbar-dialog select[name=rt]').val();
		var ra = jQuery('#altos-toolbar-dialog select[name=ra]').val();
		var q = jQuery('#altos-toolbar-dialog select[name=q]').val();
		var sz = jQuery('#altos-toolbar-dialog select[name=sz]').val();
		var charts_clickable_url = (jQuery('#altos-toolbar-dialog input[name=charts_clickable_url]').val() == 'http://') ? '' : ' link="' + jQuery('#altos-toolbar-dialog input[name=charts_clickable_url]').val() + '"';
		var ts = jQuery('#altos-toolbar-dialog select[name=ts]').val();
		var s = jQuery('#altos-toolbar-dialog select[name=s]').val();
		var endDate = jQuery('#altos-toolbar-dialog select[name=endDate]').val();

		var left = jQuery('#altos-toolbar-dialog select[name=left]').val();
		var right = jQuery('#altos-toolbar-dialog select[name=right]').val();
		var mini = jQuery('#altos-toolbar-dialog select[name=mini]').val();

		var width = jQuery('#altos-toolbar-dialog input[name=width]').val();
		var height = jQuery('#altos-toolbar-dialog input[name=height]').val();

		var output = AltosToolbarDialog.localprintd.selection.getContent();

		var date_format;
		
		if(include == true){
			
			date_format = (endDate == 'dynamic') ? '' : ' endDate = "' + endDate +'"';
			
			var content = '<p>[altos_flash_chart st="'+st_cid_zid[0]+'" cid="'+st_cid_zid[1]+'" zid="'+st_cid_zid[2]+'" rt="'+rt+'" ra="'+ra+'" q="'+q+'" right="'+right+'" left="'+left+'" mini="'+mini+'" width="'+width+'" height="'+height+'" /]</p>';
			
			output = AltosToolbarDialog.localprintd.selection.getContent() + content;
			
		}
		
		tinyMCEPopup.execCommand('mceInsertRawHTML', false, output);
		
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(AltosToolbarDialog.init, AltosToolbarDialog);