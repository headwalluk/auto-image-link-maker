<?php
/**
 * Plugin Name: Auto Image Link Maker
 * Description: Automatically wraps unwrapped images in clickable anchor links.
 * Version:     0.4.0
 * Author:      headwalluk
 * Text Domain: auto-image-link-maker
 * Requires PHP: 8.0
 *
 * @package Auto_Image_Link_Maker
 */

defined( 'ABSPATH' ) || die();

define( 'AILM_NAME', 'Auto Image Link Maker' );
define( 'AILM_VERSION', '0.4.0' );
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
