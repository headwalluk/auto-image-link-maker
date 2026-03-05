<?php
/**
 * Uninstall handler — removes all plugin options from wp_options.
 *
 * @package Auto_Image_Link_Maker
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || die();

delete_option( 'ailm_css_selectors' );
delete_option( 'ailm_page_types' );
delete_option( 'ailm_hijack_image_links' );
delete_option( 'ailm_skip_emoji' );
delete_option( 'ailm_emoji_selectors' );
delete_option( 'ailm_exclude_selectors' );
