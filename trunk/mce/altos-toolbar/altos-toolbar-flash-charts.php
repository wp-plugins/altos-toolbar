<?php include("./altos-toolbar-header.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title><?php echo ($_GET["edit"]) ? 'Edit' : 'Insert An'; ?>  Altos Flash Chart</title>

	<link type="text/css" href="js/jquery/themes/base/ui.all.css" rel="stylesheet" />
	<link type="text/css" href="css/altos-toolbar.css?ver=1.4.1" rel="stylesheet" />

	<script type="text/javascript" src="js/altos-toolbar-flash-charts.js?ver=1.4.1"></script>
	
	<script type="text/javascript">
		document.write('<base href="'+tinymce.baseURL+'" />');
		var edit = editing = '<?php echo preg_replace("/'/", "\'", rawurldecode($_GET["edit"])); ?>';
	</script>
	
<base target="_self" />

</head>

<body>

	<div align="left" id="altos-toolbar-dialog" >

		<form action="/" method="get" accept-charset="utf-8">

			<tr class="odd altos_table_location">
				<td colspan="2">
					<p><label for="altos-flash-charts-st-cid-zid"><?php _e("Select Location:"); ?></label><br /><select id="altos-st-cid-zid" name="st,cid,zid"><option>Loading....</option></select></p>
				</td>
			<tr>

			<tr class="even altos_table_residence">
				<td colspan="2">
					<p><label for="altos-flash-charts-right"><?php _e("Right Axis Statistics:"); ?></label><br /><select name="right"><?php $Altos_Toolbar->print_options($Altos_Toolbar->s[2]); ?></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-flash-charts-left"><?php _e("Left Axis Statistics:"); ?></label><br/><select name="left"><?php $Altos_Toolbar->print_options($Altos_Toolbar->s[2]); ?></select></p>
				</td>
			<tr>

			<tr class="even">
				<td colspan="2">
					<p><label for="altos-flash-charts-mini"><?php _e("Mini Axis Statistics:"); ?></label><br/><select name="mini"><?php $Altos_Toolbar->print_options($Altos_Toolbar->s[2]); ?></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-flash-charts-size"><?php _e("Chart Size:"); ?></label><br/>
					Width: <input type="text" name="width" size="3" value="550">Height: <input type="text" name="height" size="3" value="400"><br />
					</p>
				</td>
			<tr>

			<tr class="even altos_table_residence">
				<td colspan="2">
					<p><label for="altos-charts-rt"><?php _e("Residence Type:"); ?></label><br/><select name="rt"><?php $Altos_Toolbar->print_options($Altos_Toolbar->rt[1], $options["rt"]); ?></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-charts-ra"><?php _e("Rolling Average:"); ?></label><br/><select name="ra"><?php $Altos_Toolbar->print_options($Altos_Toolbar->ra, $options["ra"]); ?></select></p>
				</td>
			<tr>

			<tr class="even">
				<td colspan="2">
					<p><label for="altos-charts-q"><?php _e("Quartile:"); ?></label><br/><select name="q"><?php $Altos_Toolbar->print_options($Altos_Toolbar->q); ?></select></p>
				</td>
			<tr>

			<tr>
				<td colspan="2">
					<br />
					<input type="button" onclick="AltosToolbarDialog.insert();" class="button-primary submit button-primary"  name="submit" value="<?php echo ($_GET["edit"]) ? 'Update' : 'Insert'; ?> Flash Chart">
					<br />
				</td>
			</tr>

		</form>		

	</div>

</body>

</html>