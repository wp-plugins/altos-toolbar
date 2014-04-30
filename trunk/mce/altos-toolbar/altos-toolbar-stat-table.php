<?php include("./altos-toolbar-header.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title><?php echo ($_GET["edit"]) ? 'Edit' : 'Insert An'; ?>  Altos Stat Table</title>

	<link type="text/css" href="js/jquery/themes/base/ui.all.css" rel="stylesheet" />
	<link type="text/css" href="css/altos-toolbar.css?ver=1.4.1" rel="stylesheet" />

	<script type="text/javascript" src="js/altos-toolbar-stat-table.js?ver=1.4.1"></script>

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
					<p><label for="altos-stat-table-st-cid-zid"><?php _e("Select Location:"); ?></label><br /><select id="altos-st-cid-zid" name="st,cid,zid"><option>Loading....</option></select></p>
				</td>
			<tr>

			<tr class="even altos_table_residence">
				<td colspan="2">
					<p><label for="altos-stat-table-rt"><?php _e("Residence Type:"); ?></label><br /><select name="rt"><?php $Altos_Toolbar->print_options($Altos_Toolbar->rt[1], $options["rt"]); ?></select></p>
				</td>
			<tr>

			<tr class="odd">
				<td colspan="2">
					<p><label for="altos-stat-table-D"><?php _e("Stats Date:"); ?></label><br /><select id="endDate" name="endDate"><option>Loading....</option></select></p>
				</td>
			<tr>

			<tr class="even">
				<td colspan="2">
					<p><label for="altos-stat-table-format"><?php _e("Format:"); ?></label><br /><select name="format"><?php $Altos_Toolbar->print_options($Altos_Toolbar->format, $options["format"]); ?></select></p>
				</td>
			<tr>

			<tr>
				<td colspan="2">
					<br />
					<input type="hidden" name="q" value="a"/>
					<input type="button" onclick="AltosToolbarDialog.insert();" class="button-primary submit button-primary" name="submit" value="<?php echo ($_GET["edit"]) ? 'Update' : 'Insert'; ?> Stat Table">
					<br />
				</td>
			</tr>

		</form>		

	</div>

</body>

</html>