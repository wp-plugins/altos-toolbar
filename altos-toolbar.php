<?php
/*
Copyright: © 2010 AltosResearch.com ( coded in the USA )
<mailto:support@altosresearch.com> <http://www.altosresearch.com/>

Released under the terms of the GNU General Public License.
You should have received a copy of the GNU General Public License.
If not, see: <http://www.gnu.org/licenses/>.
*/
/*
Version: 1.2
Stable tag: trunk
Tested up to: 2.9.2
Requires at least: 2.7
Plugin Name: Altos Toolbar

Author: AltosResearch.com
Contributors: AltosResearch
Author URI: http://www.altosresearch.com/
License: http://www.gnu.org/licenses/gpl-2.0.txt
Plugin URI: http://blog.altosresearch.com/ready-four-new-wordpress-plugins-for-real-estate-data/
Tags: widget, widgets, altos, altos research, altosresearch, real estate, property, charts, visual editor
Description: Easily insert Altos Charts, Regional Charts, Flash Charts and Stat Tables into your blog posts.
*/
/*
Direct access denial.
*/
if (realpath (__FILE__) === realpath ($_SERVER["SCRIPT_FILENAME"]))
	exit;
/*
Altos Post class.
*/
include_once (dirname (__FILE__) . "/altos-post.php");
/*
Class for Altos Toolbar.
*/
class Altos_Toolbar
	extends Altos_Post
	{
		var $mce_plugin_path, $mce_plugin_path_js;
		/*
		Constructor.
		*/
		function __construct ()
			{
				parent::__construct ();
				/**/
				add_action ("admin_menu", array (&$this, "on_admin_menu"));
				/**/
				$this->mce_plugin_path = WP_PLUGIN_URL . "/" . basename (dirname (__FILE__)) . "/mce/";
				$this->mce_plugin_path_js = WP_PLUGIN_URL . "/" . basename (dirname (__FILE__)) . "/mce/altos-toolbar/editor-plugin.js";
				/**/
				if ($this->is_authenticated ())
					{
						add_action ("init", array (&$this, "add_buttons"));
					}
			}
		/*
		These deal with menu pages.
		*/
		function on_admin_menu ()
			{
				add_filter ("plugin_action_links", array (&$this, "on_plugin_action_links"), 10, 2);
				add_menu_page ("Altos Toolbar", "Altos Toolbar", "edit_plugins", "altos-toolbar-options", array (&$this, "on_options_page"));
				add_submenu_page ("altos-toolbar-options", "General Options", "General Options", "edit_plugins", "altos-toolbar-options", array (&$this, "on_options_page"));
			}
		/**/
		function on_plugin_action_links ($links = array (), $file = "")
			{
				if (preg_match ("/" . preg_quote ($file, "/") . "$/", __FILE__) && is_array ($links))
					{
						$settings = '<a href="admin.php?page=altos-toolbar-options">Settings</a>';
						array_unshift ($links, $settings);
					}
				/**/
				return $links;
			}
		/**/
		function on_options_page () /* Handles General Options. */
			{
				$options = $this->update_all_options ();
				include_once dirname (__FILE__) . "/altos-options.php";
			}
		/**/
		function update_all_options () /* Updates all options. */
			{
				$options = $this->get_backward_compatible_options ();
				/**/
				if ($_POST["altos_toolbar_options_save"])
					{
						$_POST = stripslashes_deep ($_POST);
						/**/
						foreach ($_POST as $key => $value)
							{
								if ($key !== "altos_toolbar_options_save")
									if (preg_match ("/^" . preg_quote ("altos_toolbar_", "/") . "/", $key))
										{
											(is_array ($value)) ? array_shift ($value) : null;
											$options[preg_replace ("/^" . preg_quote ("altos_toolbar_", "/") . "/", "", $key)] = $value;
										}
							}
						/**/
						$options["pai"] = strip_tags (stripslashes ($this->auth ($options["username"], $options["password"])));
						/**/
						update_option ("altos_toolbar_options", $options);
						update_option ("altos_global_options", array ("username" => $options["username"], "password" => $options["password"], "pai" => $options["pai"]));
						/**/
						if (!$this->validate_pai ($options["pai"])) /* Validate the newly obtained pai value. */
							{
								$this->display_admin_notice ('<strong>Invalid login credentials, please try again.</strong>', true);
							}
						else /* Otherwise, everything looks good! */
							$this->display_admin_notice ('<strong>Options saved.</strong>');
					}
				/**/
				return $options;
			}
		/*
		This acquires options w/backward compatiblity.
		*/
		function get_backward_compatible_options ()
			{
				$options = get_option ("altos_toolbar_options");
				$options = (!is_array ($options) || empty ($options)) ? get_option ("altos_global_options") : $options;
				$options = (!is_array ($options) || empty ($options)) ? get_option ("widget_altos") : $options;
				$options = (!is_array ($options) || empty ($options)) ? array (): $options;
				/**/
				return $options;
			}
		/*
		Displays admin notifications.
		*/
		function display_admin_notice ($notice = FALSE, $error = FALSE)
			{
				if ($notice && $error) /* Special format for errors. */
					{
						echo '<div class="error fade"><p>' . $notice . '</p></div>';
					}
				else if ($notice) /* Otherwise, we just send it as an update notice. */
					{
						echo '<div class="updated fade"><p>' . $notice . '</p></div>';
					}
			}
		/*
		These add toolbar buttons.
		*/
		function add_buttons ()
			{
				if (!current_user_can ("edit_posts") && !current_user_can ("edit_pages"))
					return;
				/**/
				else if (get_user_option ("rich_editing") == "true")
					{
						add_filter ("mce_external_plugins", array (&$this, "add_mce_external_plugins"));
						add_filter ("mce_buttons", array (&$this, "register_mce_buttons"));
					}
			}
		/**/
		function register_mce_buttons ($buttons)
			{
				array_push ($buttons, "altos_toolbar");
				/**/
				return $buttons;
			}
		/**/
		function add_mce_external_plugins ($plugin_array)
			{
				$plugin_array["altos_toolbar"] = $this->mce_plugin_path_js;
				/**/
				return $plugin_array;
			}
	}
/*
New instance of Altos Toolbar class.
*/
$Altos_Toolbar = new Altos_Toolbar ();
?>