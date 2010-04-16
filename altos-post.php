<?php
/*
Copyright: © 2010 AltosResearch.com ( coded in the USA )
<mailto:support@altosresearch.com> <http://www.altosresearch.com/>

Released under the terms of the GNU General Public License.
You should have received a copy of the GNU General Public License.
If not, see: <http://www.gnu.org/licenses/>.
*/
/*
Direct access denial.
*/
if (realpath (__FILE__) === realpath ($_SERVER["SCRIPT_FILENAME"]))
	exit;
/*
Include class for Altos Base.
*/
include_once (dirname (__FILE__) . "/altos-base.php");
/*
Class for Altos Post.
*/
class Altos_Post
	extends Altos_Base
	{
		function __construct ()
			{
				parent::__construct ();
				/**/
				add_action ("the_content", array (&$this, "on_the_content"));
				add_action ("wp_head", array (&$this, "on_wp_head"));
				add_action ("wp_print_scripts", array (&$this, "on_wp_print_styles"));
			}
		/**/
		function on_the_content ($content)
			{
				global $post;
				/**/
				$altos_chart = array ();
				/**/
				preg_match_all ("#\[(altos_chart|altos_regional_chart|altos_flash_chart|altos_stat_table)\s+([^\]]+)\/\]#si", strip_tags (str_replace ("\n", "", $content)), $match_attributes);
				/**/
				foreach ($match_attributes[1] as $key => $tag)
					{
						$options = null;
						/**/
						$string = str_replace ("\"", "", str_replace (" ", "&", trim ($match_attributes[2][$key])));
						/**/
						parse_str ($string, $options);
						/**/
						$markup = $match_attributes[0][$key];
						/**/
						switch ($tag):
							/**/
							case "altos_flash_chart":
								/**/
								$options["s"] = null;
								/**/
								$response = $this->get_flash_chart ($options["st"], $options["cid"], $options["zid"], $options["rt"], $options["ra"], $options["q"], $options["left"], $options["right"], $options["mini"]);
								/**/
								$flash_chart_html = null;
								/**/
								if ($this->has_error ($response))
									{
										$flash_chart_html = $response->errorMessage;
									}
								else
									{
										$flashvars = $response->response->url;
										/**/
										$flash_chart_html = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="AltosChart" width="' . $options['width'] . '" height="' . $options['height'] . '" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab">';
										$flash_chart_html .= '<param name="movie" value="http://www.altosresearch.com/altos/widgets/AltosChart.swf" />';
										$flash_chart_html .= '<param name="quality" value="high" />';
										$flash_chart_html .= '<param name="FlashVars" value="' . $flashvars . '" />';
										$flash_chart_html .= '<param name="allowScriptAccess" value="sameDomain" />';
										$flash_chart_html .= '<embed src="http://www.altosresearch.com/altos/widgets/AltosChart.swf" quality="high" width="' . $options['width'] . '" height="' . $options['height'] . '" name="AltosChart" align="middle" play="true" loop="false" flashvars="' . $flashvars . '" quality="high" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer">';
										$flash_chart_html .= '</embed>';
										$flash_chart_html .= '</object>';
									}
								/**/
								$content = str_replace ($markup, $flash_chart_html, $content);
								/**/
								break;
							/**/
							case "altos_stat_table":
								/**/
								$stat_table_html = null;
								/**/
								foreach (explode (",", $options["rt"]) as $rt)
									{
										$response = $this->get_stat_table ($options["st"], $options["cid"], $options["zid"], $rt, $options["ra"], $options["q"], $timeframe);
										/**/
										if ($this->has_error ($response))
											{
												$stat_table_html = $response->errorMessage;
											}
										else
											{
												$stat_table = $response->response;
												/**/
												$stat_table_html = '<table border="0" padding="0" cellspacing="0" class="stat_table stat_table_wide">';
												/**/
												$stat_table_html .= '<tr class="head">';
												$stat_table_html .= '<th colspan="4">';
												$stat_table_html .= $stat_table->rollingAverage . ' stats for ' . $stat_table->residenceType . ' properties in<br />';
												$stat_table_html .= $stat_table->cityName . ', ' . $stat_table->state . '' . $stat_table->zipCode . ' as of ' . date ("F j, Y", strtotime ($stat_table->date));
												$stat_table_html .= '</th>';
												$stat_table_html .= '</tr>';
												/**/
												$stat_table_html .= '<tr class="odd">';
												$stat_table_html .= '<td class="bold">Median List Price</td>';
												$stat_table_html .= '<td>' . $stat_table->medianPrice . '</td>';
												$stat_table_html .= '<td class="bold">Average List Price</td>';
												$stat_table_html .= '<td>' . $stat_table->meanPrice . '</td>';
												$stat_table_html .= '</tr>';
												/**/
												$stat_table_html .= '<tr class="even">';
												$stat_table_html .= '<td class="bold">Total Inventory</td>';
												$stat_table_html .= '<td>' . $stat_table->inventory . '</td>';
												$stat_table_html .= '<td class="bold">Price per Square Foot</td>';
												$stat_table_html .= '<td>' . $stat_table->pricePerSquareFoot . '</td>';
												$stat_table_html .= '</tr>';
												/**/
												$stat_table_html .= '<tr class="odd">';
												$stat_table_html .= '<td class="bold">Average Home Size</td>';
												$stat_table_html .= '<td>' . $stat_table->medianSquareFoot . '</td>';
												$stat_table_html .= '<td class="bold">Median Lot Size</td>';
												$stat_table_html .= '<td>' . $stat_table->medianLotSize . '</td>';
												$stat_table_html .= '</tr>';
												/**/
												$stat_table_html .= '<tr class="even">';
												$stat_table_html .= '<td class="bold">Average # Beds</td>';
												$stat_table_html .= '<td>' . $stat_table->meanBeds . '</td>';
												$stat_table_html .= '<td class="bold">Average # Baths</td>';
												$stat_table_html .= '<td>' . $stat_table->meanBaths . '</td>';
												$stat_table_html .= '</tr>';
												/**/
												$stat_table_html .= '<tr class="odd">';
												$stat_table_html .= '<td class="bold">Homes Absorbed</td>';
												$stat_table_html .= '<td>' . $stat_table->medianAbsorbed . '</td>';
												$stat_table_html .= '<td class="bold">Newly Listed</td>';
												$stat_table_html .= '<td>' . $stat_table->newlyListed . '</td>';
												$stat_table_html .= '</tr>';
												/**/
												$stat_table_html .= '<tr class="even">';
												$stat_table_html .= '<td class="bold">Days on Market</td>';
												$stat_table_html .= '<td>' . $stat_table->daysOnMarket . '</td>';
												$stat_table_html .= '<td class="bold">Average Age</td>';
												$stat_table_html .= '<td>' . $stat_table->meanAge . '</td>';
												$stat_table_html .= '</tr>';
												/**/
												$stat_table_html .= '</table>';
											}
									}
								/**/
								$content = str_replace ($markup, $stat_table_html, $content);
								/**/
								break;
							/**/
							case "altos_chart":
								/**/
								$chart_link = $altoschart = $timeframe = null;
								/**/
								$stat_table_nicenames = array ("median_price" => "Median Price", "median_inventory" => "Inventory", "mean_dom" => "Average Days on Market", "median_per_sqft" => "Median Price Per Square Foot", "median_market_heat" => "Median Market Action Index");
								$stat_table_varname = array ("median_price" => "medianPrice", "median_inventory" => "inventory", "mean_dom" => "daysOnMarket", "median_per_sqft" => "pricePerSquareFoot", "median_market_heat" => "medianMarketHeat");
								/**/
								$chart_link = strstr ($options["link"], "http://") ? $options["link"] : "http://" . $options["link"];
								$chart_link = ($chart_link == "http://") ? false : $chart_link;
								/**/
								if ($options["endDate"] != "dynamic")
									{
										$timeframe = $options["endDate"];
									}
								/**/
								$options["s"] = null;
								/**/
								if (strlen ($options["left"]))
									{
										$options["s"] = $options["left"] . ":l";
									}
								/**/
								if (strlen ($options["right"]))
									{
										if (strlen ($options["s"]) > 1)
											{
												$options["s"] .= ",";
											}
										$options["s"] .= $options["right"] . ":r";
									}
								/**/
								$options["sz"] = $options["size"];
								$options["ts"] = $options["timeSpan"];
								/**/
								$response = $this->get_state_city_zip_chart_url ($options["st"], $options["cid"], $options["zid"], $options["s"], $options["sz"], $options["rt"], $options["ra"], $options["q"], $options["ts"], $timeframe);
								/**/
								if ($this->has_error ($response))
									{
										$altos_charts_html = $response->errorMessage;
									}
								else
									{
										$altoschart = $response->response;
									}
								/**/
								$altos_charts_html = ($chart_link) ? '<a href="' . $chart_link . '">' : '';
								$altos_charts_html .= '<img alt="' . $altoschart->alt . '" src="' . $altoschart->url . '" />';
								$altos_charts_html .= ($chart_link) ? '</a>' : '';
								/**/
								$content = str_replace ($markup, $altos_charts_html, $content);
								/**/
								break;
							/**/
							case "altos_regional_chart":
								/**/
								$chart_link = $altoschart = $timeframe = null;
								/**/
								$stat_table_nicenames = array ("median_price" => "Median Price", "median_inventory" => "Inventory", "mean_dom" => "Average Days on Market", "median_per_sqft" => "Median Price Per Square Foot", "median_market_heat" => "Median Market Action Index");
								$stat_table_varname = array ("median_price" => "medianPrice", "median_inventory" => "inventory", "mean_dom" => "daysOnMarket", "median_per_sqft" => "pricePerSquareFoot", "median_market_heat" => "medianMarketHeat");
								/**/
								$chart_link = strstr ($options["link"], "http://") ? $options["link"] : "http://" . $options["link"];
								$chart_link = ($chart_link == "http://") ? false : $chart_link;
								/**/
								if ($options["endDate"] != "dynamic")
									{
										$timeframe = $options["endDate"];
									}
								/**/
								$options["s"] = null;
								/**/
								if (strlen ($options["left"]))
									{
										$options["s"] = $options["left"] . ":l";
									}
								/**/
								if (strlen ($options["right"]))
									{
										if (strlen ($options["s"]) > 1)
											{
												$options["s"] .= ",";
											}
										$options["s"] .= $options["right"] . ":r";
									}
								/**/
								$options["sz"] = $options["size"];
								$options["ts"] = $options["timeSpan"];
								/**/
								$response = $this->get_regional_chart_url ($options["regionId"], $options["s"], $options["sz"], $options["rt"], $options["ra"], $options["q"], $options["ts"]);
								/**/
								$altos_regional_charts_html = null;
								/**/
								if ($this->has_error ($response))
									{
										$altos_regional_charts_html = $response->errorMessage;
									}
								else
									{
										$altos_regional_chart = $response->response;
									}
								/**/
								$altos_regional_charts_html = ($chart_link) ? '<a href="' . $chart_link . '">' : '';
								$altos_regional_charts_html .= '<img alt="' . $altos_regional_chart->alt . '" src="' . $altos_regional_chart->url . '" />';
								$altos_regional_charts_html .= ($chart_link) ? '</a>' : '';
								/**/
								$content = str_replace ($markup, $altos_regional_charts_html, $content);
							/**/
							default:
						/**/
						endswitch;
					}
				/**/
				return $content;
			}
		/**/
		function on_wp_print_styles ()
			{
				echo '<style type="text/css">';
				echo '.stat_table_wide{ }';
				echo '.stat_table tr td { padding: 10px 0 10px 5px; }';
				echo '.even table td { border: 0px !important; padding-bottom: 5px; padding-top: 5px; }';
				echo '.column_one { float: left; }';
				echo '.column_two { float: right; }';
				echo '.stat_table_wide .head { background-color:#000; color: white; }';
				echo '.stat_table_wide .odd { background-color: #eee; }';
				echo '.stat_table_wide .even { background-color: #ddd; }';
				echo '.stat_table_wide .bold { font-weight: bold; }';
				echo '.stat_table { margin:15px 0 0; }';
				echo '.chart_image { text-align: center; padding: 10px 0; }';
				echo '#chart-table{ width: 100%; text-align: center; }';
				echo '#chart-table .chartname { display: block; }';
				echo '#chart-table .chartvalue { display: inline; }';
				echo '</style>';
			}
		/**/
		function on_wp_head ()
			{
				echo '<style type="text/css">';
				echo '.stat_table { font-size: 10px !important; font-style: normal; border:1px solid; padding: 0px; margin:0px; min-width: 100px; width: 100%; }';
				echo '.stat_table tr { padding-top: 3px; padding-left: 5px; }';
				echo '.stat_table_wide tr > td + td { padding: 0px 5px; border-right:1px solid #333; }';
				echo '.stat_table tr > td + td + td { padding: 0px 5px; border:0px; }';
				echo '.stat_table td { padding: 3px 5px; }';
				echo '.stat_table th { border-bottom: 1px solid #333; text-align: center; padding: 5px 5px 5px 5px; }';
				echo '.chart_style { padding-top: 10px; }';
				echo '</style>';
			}
	}
?>