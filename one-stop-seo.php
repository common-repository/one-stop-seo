<?php
/**
Plugin Name: One Stop SEO
Author:      Fahad Bin Zafar
Author URI:  https://fahadbinzafar.com/
Version:     2.4.1
Description: The is going to be the one and only one stop seo plugin Soon.
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
 


/**
* @version 2.3.1
  One Stop SEO
*/
 
//https://www.smashingmagazine.com/2016/04/three-approaches-to-adding-configurable-fields-to-your-plugin/ 
/* -==========- Constants  -==========- */
define("OSSM_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
define('OSSM_PLUGIN_URL', plugins_url());
define('OSSM_SITE_URL', get_site_url());
define('OSSM_ROOTWPPATH', dirname(__FILE__) . '/');

include('plugin_functions.php');
include('hooks.php');


/* -==========- Plugin GUI Call  -==========- */



// Main Page 
function ossm_setting_page()
{

include('welcome.php');

}
function ossm_all_pages()
{

include('tools/all-pages.php');

}

function ossm_check_status()
{

include('tools/check-status.php');

}
function ossm_site_tools()
{

include('tools/site-tools.php');

}
