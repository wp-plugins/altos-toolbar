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
Class for Altos Base.
*/
class Altos_Base
	{
		var $s, $sz, $rt, $ra, $q, $ts, $l, $th;
		/**/
		var $webservice = "http://charts.altosresearch.com/altos/app";
		/**/
		var $mce_plugin_path, $mce_plugin_path_js;
		var $errorMessages = array ();
		var $debug = 0;
		/**/
		function Altos_Base ()
			{
				$this->__construct ();
			}
		/**/
		function __construct ()
			{
				$this->s[0] = array ("median_price" => "Median Price", "median_inventory" => "Inventory", "mean_dom" => "Average Days on Market", "median_per_sqft" => "Median Price Per Square Foot", "median_market_heat" => "Median Market Action Index ");
				$this->s[1] = array ("price" => "Median Price", "dom" => "Days on Market", "zip_region_inventory" => "Inventory", "market_action" => "Market Action Index ", "price_per_sqft" => "Price Per Square Foot", "sqft" => "Square Feet ", "age" => "Age ");
				$this->s[2] = array ("none" => "None", "median_price" => "Median Price", "mean_dom" => "Average Days on Market", "median_inventory" => "Inventory", "median_market_heat" => "Median Market Action Index", "median_per_sqft" => "Median Price/Sqft", "mean_age" => "Average Age");
				/**/
				$this->sz = array ("t" => "Tiny [150px X 100px]", "b" => "Sidebar [180px X 120px]", "s" => "Small [240px X 160px]", "w" => "Tower [180px X 200px]", "i" => "Smallish [360px X 240px]", "m" => "Medium [480px X 320px]", "l" => "Large [600px X 400px]", "a" => "Large Landscape [520px X 240px]", "g" => "Small Landscape [340px X 160px]");
				/**/
				$this->rt[0] = array ("sf" => "Single Family Homes", "mf" => "Condos/Townhomes");
				$this->rt[1] = array ("sf" => "Single Family Homes", "mf" => "Condos/Townhomes", "sf,mf" => "SFH vs. Condos");
				/**/
				$this->ra = array ("a" => "7-day", "c" => "90-day", "a,c" => "7-day vs. 90-day");
				/**/
				$this->q = array ("a" => "All Quartiles Combined", "t" => "Top Quartile", "u" => "Upper Quartile", "l" => "Lower Quartile", "b" => "Bottom Quartile", "t,b" => "Top vs. Bottom Quartile", "t,u,l,b" => "Four Quartile Comparison");
				/**/
				$this->ts = array ("e" => "1-year", "f" => "2-year", "g" => "3-year", "z" => "All Available Data");
				/**/
				$this->l = array ("b" => "Narrow", "f" => "Wide");
				/**/
				$this->th = array("newchart" => "Red Pallet", "oldchart" => "Black Pallet");
				/**/
				$this->format = array ("narrow" => "Narrow", "wide" => "Wide");
				/**/
				$options = $this->get_backward_compatible_options ();
				/**/
				if (!$this->validate_pai ($options["pai"]))
					if (!preg_match ("/^altos-/", $_GET["page"]))
						add_action ("admin_notices", array (&$this, "login_notice"));
				/**/
				if (has_action ("wp_loaded")) /* Since WP 3.0. */
					add_action ("wp_loaded", array (&$this, "authenticate"));
				else /* Else use the older init action hook instead. */
					add_action ("init", array (&$this, "authenticate"));
			}
		/**/
		function get_backward_compatible_options ()
			{
				$options = get_option ("altos_toolbar_options");
				$options = (!is_array ($options) || empty ($options)) ? get_option ("altos_global_options") : $options;
				$options = (!is_array ($options) || empty ($options)) ? get_option ("widget_altos") : $options;
				$options = (!is_array ($options) || empty ($options)) ? array (): $options;
				/**/
				return $options;
			}
		/**/
		function authenticate ()
			{
				if (isset ($_POST["altos-submit"]))
					{
						$options = $this->get_backward_compatible_options ();
						/**/
						$options["username"] = strip_tags (stripslashes ($_POST["altos-username"]));
						/**/
						$options["password"] = strip_tags (stripslashes ($_POST["altos-password"]));
						/**/
						$options["pai"] = strip_tags (stripslashes ($this->auth ($options["username"], $options["password"])));
						/**/
						update_option ("altos_toolbar_options", $options);
						update_option ("altos_global_options", array ("username" => $options["username"], "password" => $options["password"], "pai" => $options["pai"]));
					}
			}
		/**/
		function get_posts_array ()
			{
				$posts_array = array ();
				/**/
				foreach (get_posts ("numberposts=-1") as $post)
					{
						$posts_array[$post->ID] = $post->post_title;
					}
				/**/
				return $posts_array;
			}
		/**/
		function get_categories_array ()
			{
				$categories_array = array ();
				/**/
				foreach (get_categories (array ("hide_empty" => false)) as $cat)
					{
						$categories_array[$cat->cat_ID] = $cat->category_nicename;
					}
				/**/
				return $categories_array;
			}
		/**/
		function login_notice ()
			{
				$this->login_form ();
			}
		/**/
		function login_form ()
			{
				$options = $this->get_backward_compatible_options ();
				/**/
				$username = attribute_escape ($options["username"]);
				$password = attribute_escape ($options["password"]);
				$pai = attribute_escape ($options["pai"]);
				/**/
				echo '<div id="altos-loginform" class="updated fade" style="max-width:500px;">';
				/**/
				echo '<form method="post" target="_self">';
				/**/
				if ($this->validate_pai ($pai))
					{
						echo '<p>';
						echo '<label for="altos-success" style="padding:6px">';
						echo '<img width="20" src="' . WP_PLUGIN_URL . '/' . basename (dirname (__FILE__)) . '/images/accepted_48.png" />';
						echo 'Your account is active.';
						echo '</label>';
						echo '</p>';
					}
				else
					{
						echo '<p>';
						echo '<label for="altos-error" style="padding:0px; font-size: 9px">';
						echo '<img width="15" src="' . WP_PLUGIN_URL . '/' . basename (dirname (__FILE__)) . '/images/cancel_48.png" />';
						echo strlen ($pai) ? $pai : 'Please enter your Altos Research credentials.';
						echo '</label>';
						echo '</p>';
					}
				/**/
				echo '<label for="altos-username">';
				echo 'Altos Research Username:<br />';
				echo '<input class="widefat" name="altos-username" type="text" value="' . $username . '" />';
				echo '</label>';
				/**/
				echo '<label for="altos-password">';
				echo 'Altos Research Password:<br />';
				echo '<input class="widefat" name="altos-password" type="password" value="' . $password . '" />';
				echo '</label>';
				/**/
				echo '<input type="hidden" id="altos-submit" name="altos-submit" value="1" />';
				echo '<input type="submit" name="submit" class="button-secondary action"  value="submit">';
				/**/
				echo '</form>';
				/**/
				echo '<br />';
				echo '</div>';
			}
		/**/
		function get_cache ($name)
			{
				$cache = get_option ("altos-" . $name);
				/**/
				if (is_array ($cache))
					{
						return false;
					}
				/**/
				if ($cache["time"] > time ())
					{
						return false;
					}
				else
					{
						return $cache["value"];
					}
			}
		/**/
		function save_cache ($name, $value)
			{
				$cache["time"] = time () + (60 * 5);
				/**/
				$cache["value"] = $value;
				/**/
				if (!get_option ("altos-" . $name))
					{
						add_option ($name, $cache);
					}
				else
					{
						update_option ($name, $cache);
					}
			}
		/**/
		function has_error ($response)
			{
				if ($response->responseCode == 200)
					{
						return false;
					}
				else
					{
						return true;
					}
			}
		/**/
		function print_error_message ($response)
			{
				$this->errorMessages[] = '<div class="altos-error" style="background-color:#FFFFE0; border-color:#aaa; padding:5px; margin:5px; width:95%">' ./**/
				$response->response->errorMessage ./**/
				'</div>';
			}
		/**/
		function show_error_message ()
			{
				if (count ($this->errorMessages))
					{
						foreach ($this->errorMessages as $message)
							{
								echo $message;
							}
					}
				/**/
				$this->errorMessages = array ();
			}
		/**/
		function print_options ($options, $selected = null)
			{
				foreach ($options as $key => $value)
					{
						if ($key) /* Don't print out empty keys. */
							{
								$_selected = ($selected == $key) ? ' selected="selected"' : '';
								/**/
								echo '<option value="' . $key . '"' . $_selected . '>' . $value . '</option>';
							}
					}
			}
		/**/
		function print_checkboxes ($options, $name, $selected = null)
			{
				$alt = "odd";
				/**/
				foreach ($options as $key => $value)
					{
						$_selected = ($selected == $key) ? ' checked="checked"' : '';
						/**/
						echo '<div class="checkbox_value ' . $alt . '">';
						echo '<input name="' . $name . '[]" type="checkbox" value="' . $key . '"' . $_selected . ' />';
						echo $value;
						echo '</div>';
						/**/
						$alt = ($alt == "odd") ? "even" : "odd";
					}
			}
		/**/
		function get_chart_state_city_zip_codes_array ()
			{
				$locations = array ();
				/**/
				foreach ($this->get_chart_state_city_zip_codes ()->list as $location)
					{
						$locations[$location->stateName . "," . $location->cityId . "," . $location->zipId] = $location->stateName . "/" . $location->cityDisplayName . "/" . $location->zipName;
					}
				/**/
				return $locations;
			}
		/**/
		function get_regions_codes_array ()
			{
				$locations = array ();
				/**/
				foreach ($this->get_regions_codes ()->list as $location)
					{
						$locations[$location->id] = $location->displayName;
					}
				/**/
				return $locations;
			}
		/**/
		function get_available_chart_dates_array ($st, $cid, $zid)
			{
				$dates = array ();
				/**/
				foreach ($this->get_available_chart_dates ($st, $cid, $zid)->list as $location)
					{
						$dates[$location->date] = $location->displayValue;
					}
				/**/
				return $dates;
			}
		/**/
		function get_available_regional_chart_dates_array ($zid)
			{
				$dates = array ();
				/**/
				foreach ($this->get_available_regional_chart_dates ($zid)->list as $location)
					{
						$dates[$location->date] = $location->displayValue;
					}
				/**/
				return $dates;
			}
		/**/
		function on_submit_altos_connect ($post)
			{
				$options = $this->get_backward_compatible_options ();
				/**/
				$post["pai"] = $options["pai"];
				/**/
				return strip_tags ($this->crmpost ($post));
			}
		/**/
		function get_available_locations ()
			{
				$options = $this->get_backward_compatible_options ();
				/**/
				$available = $this->listreports ($options["pai"]);
				/**/
				preg_match_all ('/label="(.+?)".+value="(.+?)"/', $available, $matches);
				/**/
				$locations = array ();
				/**/
				foreach ($matches[1] as $key => $name)
					{
						$locations[trim ($name)] = $matches[2][$key];
					}
				/**/
				return $locations;
			}
		/**/
		function print_locations_select_box ()
			{
				foreach ($this->get_available_locations () as $name => $value)
					{
						print '<option value="' . $value . '">' . $name . '</option>';
					}
			}
		/**/
		function is_authenticated ()
			{
				$options = $this->get_backward_compatible_options ();
				/**/
				if ($this->validate_pai ($options["pai"]))
					{
						return true;
					}
			}
		/**/
		function validate_pai ($pai)
			{
				if (is_numeric ($pai) && $pai > 0)
					{
						return true;
					}
			}
		/**/
		function auth ($username, $password)
			{
				$success = $this->post_request (array ("service" => "auth", "username" => $username, "password" => $password));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				if ($success->responseCode == "200")
					{
						return (int)$success->response->pai;
					}
			}
		/**/
		function get_chart_state_city_zip_codes ()
			{
				$response = $this->post_request (array ("service" => "listlocations"));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function get_regions_codes ()
			{
				$response = $this->post_request (array ("service" => "listregions"));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function get_state_city_zip_chart_url ($st, $cid, $zid, $s, $sz, $rt, $ra, $q, $ts, $endDate = null)
			{
				$response = $this->post_request (array ("service" => "charturl", "st" => $st, "cid" => $cid, "zid" => $zid, "s" => $s, "sz" => $sz, "rt" => $rt, "ra" => $ra, "q" => $q, "ts" => $ts, "endDate" => $endDate));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function get_flash_chart ($st, $cid, $zid, $rt, $ra, $q, $left, $right, $mini)
			{
				$response = $this->post_request (array ("service" => "flashvars", "left" => $left, "right" => $right, "st" => $st, "cid" => $cid, "zid" => $zid, "rt" => $rt, "ra" => $ra, "q" => $q, "mini" => $mini));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function get_regional_chart_url ($zid, $s, $sz, $rt, $ra, $q, $ts)
			{
				$response = $this->post_request (array ("service" => "regionalcharturl", "zid" => $zid, "s" => $s, "sz" => $sz, "rt" => $rt, "ra" => $ra, "q" => $q, "ts" => $ts));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function get_stat_table ($st, $cid, $zid, $rt, $ra, $q, $D = null)
			{
				$response = $this->post_request (array ("service" => "tablevalues", "st" => $st, "cid" => $cid, "zid" => $zid, "rt" => $rt, "ra" => $ra, "q" => $q, "d" => $D));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function get_available_regional_chart_dates ($zid)
			{
				$response = $this->post_request (array ("service" => "statsdates", "zid" => $zid));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function get_available_chart_dates ($st, $cid, $zid)
			{
				$response = $this->post_request (array ("service" => "statsdates", "st" => $st, "cid" => $cid, "zid" => $zid));
				/**/
				if ($this->has_error ($response))
					{
						$this->print_error_message ($response);
						$response->list = array ();
					}
				/**/
				return $response;
			}
		/**/
		function post_request ($parameters = null)
			{
				$options = $this->get_backward_compatible_options ();
				/**/
				$params["pai"] = $options["pai"];
				$params["rf"] = "json";
				/**/
				if (is_array ($parameters))
					{
						foreach ($parameters as $key => $param)
							{
								$params[$key] = $param;
							}
					}
				/**/
				$data = http_build_query ($params);
				/**/
				$context_options = array ("http" => array ("method" => "POST", "header" => "Content-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen ($data) . "\r\n", "content" => $data));
				/**/
				$context = stream_context_create ($context_options);
				/**/
				$response = null;
				/**/
				if (!$this->debug && $json = $this->fetch_url_contents ($this->webservice, false, $context))
					{
						$response = json_decode ($json);
					}
				else if ($this->debug && $json = $this->fetch_url_contents ($this->webservice, false, $context))
					{
						$response = json_decode ($json);
					}
				else
					{
						$response = (object)array ("responseCode" => false, "errorMessage" => "Server failed to respond. Please try again later.");
					}
				/**/
				return $response;
			}
		/**/
		function fetch_url_contents ($url = "", $flags = 0, $context = NULL)
			{
				if ($url && preg_match ("/^http(s)?\:/", $url))
					{
						if (ini_get ("allow_url_fopen"))
							return@file_get_contents ($url, $flags, $context);
						/**/
						else if (function_exists ("curl_init"))
							{
								$c = (is_resource ($context)) ? stream_context_get_options ($context) : "";
								return $this->curlpsr ($url, $c["http"]["content"]);
							}
						/**/
						else /* Both disabled! */
							return false;
					}
				/**/
				return false;
			}
		/**/
		function curlpsr ($url = FALSE, $vars = FALSE)
			{
				if ($url && ($connection = @curl_init ()))
					{
						@curl_setopt ($connection, CURLOPT_URL, $url);
						@curl_setopt ($connection, CURLOPT_POST, true);
						@curl_setopt ($connection, CURLOPT_TIMEOUT, 20);
						@curl_setopt ($connection, CURLOPT_CONNECTTIMEOUT, 20);
						@curl_setopt ($connection, CURLOPT_FOLLOWLOCATION, false);
						@curl_setopt ($connection, CURLOPT_MAXREDIRS, 0);
						@curl_setopt ($connection, CURLOPT_HEADER, false);
						@curl_setopt ($connection, CURLOPT_VERBOSE, true);
						@curl_setopt ($connection, CURLOPT_ENCODING, "");
						@curl_setopt ($connection, CURLOPT_SSL_VERIFYPEER, false);
						@curl_setopt ($connection, CURLOPT_RETURNTRANSFER, true);
						@curl_setopt ($connection, CURLOPT_FORBID_REUSE, true);
						@curl_setopt ($connection, CURLOPT_FAILONERROR, true);
						@curl_setopt ($connection, CURLOPT_POSTFIELDS, $vars);
						/**/
						$output = trim (@curl_exec ($connection));
						/**/
						@curl_close ($connection);
					}
				/**/
				return (strlen ($output)) ? $output : false;
			}
	}
?>