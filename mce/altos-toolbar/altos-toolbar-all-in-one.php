<?php include("./altos-toolbar-header.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title>Altos ( All-In-One ) - Insert Tables/Charts</title>

	<link type="text/css" href="js/jquery/themes/base/ui.all.css" rel="stylesheet" />
	<link type="text/css" href="css/altos-toolbar.css" rel="stylesheet" />

	<script type="text/javascript" src="js/jquery/jquery.cookie.js"></script>
	<script type="text/javascript" src="js/altos-toolbar-all-in-one.js"></script>
	
	<script type="text/javascript">
		document.write('<base href="'+tinymce.baseURL+'" />');
	</script>
	
<base target="_self" />

</head>

<body>

	<div align="left" id="altos-toolbar-dialog" >
		
		<div id="all-in-one"></div>
		
		<table width="100%">
		
			<form action="/" method="get" accept-charset="utf-8">
	
				<tr class="odd">
					<td colspan="2">
						<p><label><?php _e("Select Location:"); ?></label><br><select id="altos-st-cid-zid" name="st,cid,zid"><option>Loading....</option></select></p>
					</td>
				<tr>
	
				<tr class="even">
					<td colspan="2">
						<p><label><?php _e("Date:"); ?></label><br><select id="endDate" name="endDate"><option>Loading....</option></select></p>						
					</td>
				<tr>
	
				<tr class="even">
					<td colspan="2">
						<p><strong><?php _e("Stat Tables:"); ?></strong></p>
						<input type="checkbox" id="sfTbl" name="sfTbl" value="1" checked="checked" /> <label for="sfTbl">Single Family Stat Table</label><br />
						<input type="checkbox" id="ctTbl" name="ctTbl" value="1" checked="checked" /> <label for="ctTbl">Condo/Townhome Stat Table</label>
					</td>
				<tr>
	
				<tr class="even">
					<td colspan="2">
						<p><strong><?php _e("Charts To Include:"); ?></strong></p>
						<input type="checkbox" id="mpChrt" name="mpChrt" value="1" checked="checked" /> <label for="mpChrt">Median Price</label><br />
						<input type="checkbox" id="invChrt" name="invChrt" value="1" checked="checked" /> <label for="invChrt">Inventory</label><br />
						<input type="checkbox" id="adomChrt" name="adomChrt" value="1" checked="checked" /> <label for="adomChrt">Average Days on Market</label><br />
						<input type="checkbox" id="mppsfChrt" name="mppsfChrt" value="1" checked="checked" /> <label for="mppsfChrt">Median Price per Square Foot</label><br />
						<input type="checkbox" id="mmhChrt" name="mmhChrt" value="1" checked="checked" /> <label for="mmhChrt">Median Market Heat</label><br />
					</td>
				<tr>
	
				<tr class="odd">
					<td colspan="2">
						<p><label><?php _e("Chart Size:"); ?></label><br><select name="sz"><?php $Altos_Toolbar->print_options($Altos_Toolbar->sz, "g"); ?></select></p>						
					</td>
				<tr>
	
				<tr class="even">
					<td colspan="2">
						<p><label><?php _e("Chart Rolling Average:"); ?></label><br><select name="ra"><?php $Altos_Toolbar->print_options($Altos_Toolbar->ra, "c"); ?></select></p>
					</td>
				<tr>
	
				<tr class="odd">
					<td colspan="2">
						<p><label><?php _e("Chart Time Span:"); ?></label><br><select name="ts"><?php $Altos_Toolbar->print_options($Altos_Toolbar->ts, "e"); ?></select></p>						
					</td>
				<tr>
	
				<tr class="even">
					<td colspan="2">
						<p><label><?php _e("Chart Property Type:"); ?></label><br><select name="rt"><?php $Altos_Toolbar->print_options($Altos_Toolbar->rt[1], "sf"); ?></select></p>
					</td>
				<tr>
	
				<tr>
					<td width="50%" align="center">
						<br />
						<input type="button" onclick="tinyMCEPopup.close();" class="submit button-primary" value="Close">
					</td>
					
					<td width="50%" align="center">
						<br />
						<input type="button" onclick="AltosToolbarDialog.insert();" class="submit button-primary" value="Insert">
					</td>
				</tr>
	
			</form>
		
		</table>

	</div>

</body>

</html>