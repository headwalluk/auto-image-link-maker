<?php
/**
 * Plugin Name: Auto Image Link Maker
 * Plugin URI:  https://headwall-hosting.com/plugins/auto-image-lightbox-plugins-for-wordpress/
 * Description: Automatically wraps unwrapped images in clickable anchor links.
 * Version:     1.0.2
 * Author:      Paul Faulkner
 * Author URI:  https://headwall-hosting.com
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: auto-image-link-maker
 * Domain Path: /languages
 * Requires PHP: 8.0
 *
 * @package Auto_Image_Link_Maker
 */

defined( 'ABSPATH' ) || die();

define( 'AILM_NAME', 'Auto Image Link Maker' );
define( 'AILM_VERSION', '1.0.2' );
define( 'AILM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AILM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once AILM_PLUGIN_DIR . 'constants.php';
require_once AILM_PLUGIN_DIR . 'includes/class-settings.php';
require_once AILM_PLUGIN_DIR . 'includes/class-plugin.php';

/**
 * Bootstrap the plugin and store the instance globally.
 *
 * @since 0.2.0
 *
 * @return void
 */
function ailm_plugin_run(): void {
	global $ailm_plugin;
	$ailm_plugin = new Auto_Image_Link_Maker\Plugin();
	$ailm_plugin->run();
}
ailm_plugin_run();
