<?php include("./altos-toolbar-header.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title>Insert An Altos Regional Chart</title>

	<link type="text/css" href="js/jquery/themes/base/ui.all.css" rel="stylesheet" />
	<link type="text/css" href="css/altos-toolbar.css" rel="stylesheet" />

	<script type="text/javascript" src="js/altos-toolbar-regional-charts.js"></script>

	<script type="text/javascript">
		document.write('<base href="'+tinymce.baseURL+'" />');
	</script>

<base target="_self" />

</head>

<body>

	<div align="left" id="altos-toolbar-dialog" >

		<div id="regional_charts"></div>

		<form action="/" method="get" accept-charset="utf-8">

			<tr class="odd altos_table_location">
				<td colspan="2">
					<p><label for="altos-regional-charts-zid"><?php _e("Select Location:"); ?> </label><br><select id="zid" name="zid"><option>Loading....</option></select></p>
				</td>
			<tr>

			<tr class="even altos_table_charts">
				<td colspan="2">
					<p><label for="altos-regional-charts-s"><?php _e("Statistic:"); ?></label><br><select name="s"><?php $Altos_Toolbar->print_options($Altos_Toolbar->s[1]); ?></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-regional-charts-sz"><?php _e("Chart size:"); ?></label><br><select name="sz"><?php $Altos_Toolbar->print_options($Altos_Toolbar->sz); ?></select></p>						
				</td>
			<tr>

			<tr class="even altos_table_residence">
				<td colspan="2">
					<p><label for="altos-regional-charts-rt"><?php _e("Residence Type:"); ?></label><br><select name="rt"><?php $Altos_Toolbar->print_options($Altos_Toolbar->rt[1]); ?></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-regional-charts-ra"><?php _e("Rolling Average:"); ?></label><br><select name="ra"><?php $Altos_Toolbar->print_options($Altos_Toolbar->ra); ?></select></p>
				</td>
			<tr>

			<tr class="even">
				<td colspan="2">
					<p><label for="altos-regional-charts-q"><?php _e("Quartile:"); ?></label><br><select name="q"><?php $Altos_Toolbar->print_options($Altos_Toolbar->q); ?></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-regional-charts-ts"><?php _e("Timespan:"); ?></label><br><select name="ts"><?php $Altos_Toolbar->print_options($Altos_Toolbar->ts); ?></select></p>						
				</td>
			<tr>

			<tr class="even">
				<td colspan="2">
					<p><label for="altos-regional-charts-endDate"><?php _e("Chart Date"); ?></label><br><select id="endDate" name="endDate"><option>Loading....</option></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-regional-charts-charts_clickable_url"><?php _e("Link Chart to Url"); ?></label><br><input name="charts_clickable_url" type="text" value="http://"></p>
				</td>
			<tr>

			<tr>
				<td colspan="2">
					<br />
					<input type="hidden" name="altos-market-data" value="add"/>
					<input type="button" onclick="javascript:AltosToolbarDialog.insert(AltosToolbarDialog.localprintd)" class="button-primary submit button-primary"  name="submit" value="Insert Regional Chart">
					<br />
				</td>
			</tr>

		</form>		

	</div>

</body>

</html>