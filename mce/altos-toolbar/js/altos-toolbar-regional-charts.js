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
		var include = jQuery('#altos-toolbar-dialog input[name=submit]').val() == 'Insert Regional Chart';
		var zid = jQuery('#altos-toolbar-dialog select[name=zid]').val();

		var date = jQuery('#altos-toolbar-dialog select[name=D]').val();
		var format = jQuery('#altos-toolbar-dialog select[name=format]').val();
		var rt = jQuery('#altos-toolbar-dialog select[name=rt]').val();
		var ra = jQuery('#altos-toolbar-dialog select[name=ra]').val();
		var q = jQuery('#altos-toolbar-dialog select[name=q]').val();
		var sz = jQuery('#altos-toolbar-dialog select[name=sz]').val();
		var charts_clickable_url = (jQuery('#altos-toolbar-dialog input[name=charts_clickable_url]').val() == 'http://') ? '' : ' link="' + jQuery('#altos-toolbar-dialog input[name=charts_clickable_url]').val() + '"';
		var ts = jQuery('#altos-toolbar-dialog select[name=ts]').val();
		var left = jQuery('#altos-toolbar-dialog select[name=s]').val();
		var endDate = jQuery('#altos-toolbar-dialog select[name=endDate]').val();
		var regionId = jQuery('#altos-toolbar-dialog select[name=regionId]').val();

		var output = AltosToolbarDialog.localprintd.selection.getContent();

		var date_format;
		
		if(include == true){
			
			date_format = (endDate == 'dynamic') ? '' : ' endDate = "' + endDate +'"';
			
			var content = '<p>[altos_regional_chart regionId="'+zid+'" rt="'+rt+'" ra="'+ra+'" q="'+ra+'" left="'+left+'" size="'+sz+'" timeSpan="'+ts+'" '+charts_clickable_url+'  '+date_format+' /]</p>';
			
			output = AltosToolbarDialog.localprintd.selection.getContent() + content;
		
		}
		
		tinyMCEPopup.execCommand('mceInsertRawHTML', false, output);

		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(AltosToolbarDialog.init, AltosToolbarDialog);