<?php
require ("../../../../../wp-blog-header.php");
/**/
global $Altos_Toolbar;
/**/
if ($_GET["ajax"])
	{
		status_header (200);
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Content-type: application/json");
		$json = null;
		switch ($_GET["ajax"])
			{
				case "get_chart_state_city_zip_codes_array":
					$json = json_encode ($Altos_Toolbar->get_chart_state_city_zip_codes_array ());
					break;
				case "get_available_chart_dates_array":
					$json = json_encode ($Altos_Toolbar->get_available_chart_dates_array ($_GET["st"], $_GET["cid"], $_GET["zid"]));
					break;
				case "get_regions_codes_array":
					$json = json_encode ($Altos_Toolbar->get_regions_codes_array ());
					break;
				case "get_available_regional_chart_dates_array":
					$json = json_encode ($Altos_Toolbar->get_available_regional_chart_dates_array ($_GET["zid"]));
					break;
			}
		die ($json);
	}
?>
<script type = "text/javascript" src = "js/jquery/jquery-1.3.2.min.js?ver=1.4.1"></script>
<script type = "text/javascript" src = "js/jquery/ui/ui.core.js?ver=1.4.1"></script>
<script type = "text/javascript" src = "js/jquery/ui/ui.tabs.js?ver=1.4.1"></script>
<script type = "text/javascript" src = "js/tiny-mce-popup.js?ver=1.4.1"></script>
<script type = "text/javascript">
	jQuery (document).ready (function ()
		{
			if (jQuery ('#altos-st-cid-zid').length > 0)
				{
					var regions_codes_url = window.location.href + '&ajax=get_chart_state_city_zip_codes_array';
					jQuery.getJSON (regions_codes_url, function (data)
						{
							jQuery ('#altos-st-cid-zid').empty ();
							/**/
							jQuery.each (data, function (key, value)
								{
									jQuery ('#altos-st-cid-zid').append (jQuery ('<option></option>').attr ('value', key).text (value));
								});
							if (jQuery ('#altos-st-cid-zid').attr ('prefill'))
								{
									jQuery ('#altos-st-cid-zid').val (jQuery ('#altos-st-cid-zid').attr ('prefill'));
								}
							/**/
							var src = jQuery ("#altos-st-cid-zid :selected").val ();
							/**/
							var available_dates_url = window.location.href + '&st=' + src.split (',')[0] + '&cid=' + src.split (',')[1] + '&zid=' + src.split (',')[2] + '&ajax=get_available_chart_dates_array';
							/**/
							jQuery.getJSON (available_dates_url, function (data)
								{
									jQuery ('#endDate').empty ();
									jQuery ('#endDate').append ('<option value="dynamic">Dynamic - Update values every week</option>');
									jQuery.each (data, function (key, value)
										{
											jQuery ('#endDate').append (jQuery ('<option></option>').attr ("value", key).text (value));
										});
									if (jQuery ('#endDate').attr ('prefill'))
										{
											jQuery ('#endDate').val (jQuery ('#endDate').attr ('prefill'));
										}
								});
						});
				}
			/**/
			else if (jQuery ('#zid').length > 0)
				{
					var regions_codes_url = window.location.href + '&ajax=get_regions_codes_array';
					/**/
					jQuery.getJSON (regions_codes_url, function (data)
						{
							jQuery ('#zid').empty ();
							/**/
							jQuery.each (data, function (key, value)
								{
									jQuery ('#zid').append (jQuery ('<option></option>').attr ('value', key).text (value));
								});
							if (jQuery ('#zid').attr ('prefill'))
								{
									jQuery ('#zid').val (jQuery ('#zid').attr ('prefill'));
								}
							/**/
							var src = jQuery ("#zid :selected").val ();
							/**/
							var available_dates_url = window.location.href + '&zid=' + src + '&ajax=get_available_regional_chart_dates_array';
							/**/
							jQuery.getJSON (available_dates_url, function (data)
								{
									jQuery ('#endDate').empty ();
									jQuery ('#endDate').append ('<option value="dynamic">Dynamic - Update values every week</option>');
									jQuery.each (data, function (key, value)
										{
											jQuery ('#endDate').append (jQuery ('<option></option>').attr ('value', key).text (value));
										});
									if (jQuery ('#endDate').attr ('prefill'))
										{
											jQuery ('#endDate').val (jQuery ('#endDate').attr ('prefill'));
										}
								});
						});
				}
		});
</script>
<style type = "text/css">
	body
		{
			margin: 0;
			padding: 5px;
		}
	input
		{
			border-style: solid;
			border-width: 1px;
			cursor: pointer;
			font-size: 11px !important;
			line-height: 16px;
			padding: 2px 8px;
			text-decoration: none;
		}
	.submit
		{
			-moz-border-radius-bottomleft:11px;
			-moz-border-radius-bottomright:11px;
			-moz-border-radius-topleft:11px;
			-moz-border-radius-topright:11px;
			-moz-box-sizing:content-box;
			-moz-background-clip:border;
			-moz-background-inline-policy:continuous;
			-moz-background-origin:padding;
			background: #21759B url(../images/button-grad.png) repeat-x scroll left top;
			border-color: #298CBA !important;
			color: #FFFFFF !important;
			font-weight: bold;
			text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);
		}
</style>