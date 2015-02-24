=== Altos Toolbar ===

Version: 1.6.1
Stable tag: 1.6.1
Tested up to: 4.1
Requires at least: 3.9
Plugin Name: Altos Toolbar

Author: AltosResearch.com
Contributors: AltosResearch
Author URI: http://www.altosresearch.com/
License: http://www.gnu.org/licenses/gpl-2.0.txt
Plugin URI: http://www.altosresearch.com/wordpress-plugins
Tags: widget, widgets, altos, altos research, altosresearch, real estate, property, charts, visual editor
Description: Easily insert Altos Charts, Regional Charts, Flash Charts and Stat Tables into your blog posts using the Visual Editor for WordPress®.

Easily insert Altos Charts, Regional Charts, Flash Charts and Stat Tables into your blog posts using the Visual Editor for WordPress®.

== Installation ==

1. Upload the `/altos-toolbar` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin through the `Plugins` menu in WordPress®.
3. Go to `Posts -> Add New` and find the toolbar buttons in your Visual Editor.

== Description ==

Easily insert Altos Charts, Regional Charts, Flash Charts and Stat Tables into your blog posts using the Visual Editor for WordPress®.

== Screenshots ==

1. Altos Toolbar / Screenshot #1
2. Altos Toolbar / Screenshot #2

== Changelog ==

= 1.6.1 = 
* Remove extra files

= 1.6 = 
* Allow for more charts

= 1.5.1 = 
* Redo toolbar plugin to agree with TinyMCE version 4.x

= 1.5.0 = 
* Updated icons and confirmed working with 3.6

= 1.4.9 =
* Fixed a TinyMCE error that caused our charts not to be loaded into posts while editing/adding.

= 1.4.8 =
* Spelling mistake for wide stat tables

= 1.4.7 =
* Added new chart theme to list of options

= 1.4.6 =
* Version number bump to trigger auto-updates

= 1.4.5 =
* Fixed problem with stats tables using data from 2011-10-07 instead of most recent data.

= 1.4.4 =
* Added support for WordPress® 3.0 `wp_loaded`.
* Fully tested in WordPress® 3.0, including with `MULTISITE` ( i.e. networking ) enabled. Everything looks good.
* Added support for 2-year/3-year chart timespans.

= 1.4.3 =
* Bug fix. Narrow Stat Tables were not properly implemented. This has been resolved in v1.4.3.

= 1.4.2 =
* Bug fixed in `validate_pai()` method. This function now returns null on failure.
* Support for both `file_get_contents()`, and a fallback on cURL has been established through a new method, `fetch_url_contents()`. This makes the plugin compatible with GoDaddy, Dreamhost, and other hosts that disable `allow_url_fopen` by default.
* A new administrative notice is displayed on the Plugins Panel whenever `pai` authentication is non-existent or invalid.

= 1.4.1 =
* The Altos Toolbar v1.4.1 now works in Google Chrome. Adjusted tinyMCE commands to fix a bug in WebKit browsers with respect to tinyMCE.activeEditor.selection range restoration.

= 1.4 =
* No more Shortcodes. We've added "UI Elements" for all Altos Research Tables &amp; Charts ( including Flash Charts ). You will now have ( instant previews! ) inside the Visual Editor for WordPress®.
* Editing panels have also been integrated into the Visual Editor for WordPress®. After you've inserted an Altos Research Chart or Table, use the Visual Editor inside WordPress® to select it ( just click on it ). You'll now see an Altos Research Icon appear on top of your existing Chart/Table. If you click this special Icon, a window will pop open. You can make all sorts of quick adjustments without having to re-insert anything new.
* With these improvements, the Altos Toolbar no longer relies on WordPress® Shortcodes. However, backwards compatibility for Shortcode processing remains unaffected. Existing Shortcodes will continue to work just as they always have :-)

= 1.3 =
* The four toolbar buttons have condensed into a single Altos Research pull-down menu.
* Added a new All-In-One option to the Visual Editor for WordPress.
* The new All-In-One option remembers your settings.
* Code cleanup, minor re-organization.

= 1.2 =
* Initial release on WordPress.org.
