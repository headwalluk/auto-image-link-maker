<?php
/**
 * Plugin constants.
 *
 * @package Auto_Image_Link_Maker
 */

namespace Auto_Image_Link_Maker;

defined( 'ABSPATH' ) || die();

// wp_options keys.
const OPT_CSS_SELECTORS      = 'ailm_css_selectors';
const OPT_PAGE_TYPES         = 'ailm_page_types';
const OPT_HIJACK_IMAGE_LINKS = 'ailm_hijack_image_links';
const OPT_EXCLUDE_SELECTORS  = 'ailm_exclude_selectors';
const OPT_SKIP_EMOJI         = 'ailm_skip_emoji';
const OPT_EMOJI_SELECTORS    = 'ailm_emoji_selectors';

// Default values.
const DEF_CSS_SELECTORS      = "#main img\n.entry-content img";
const DEF_HIJACK_IMAGE_LINKS = true;
const DEF_EXCLUDE_SELECTORS  = ".site-logo img\n.custom-logo\n.avatar";
const DEF_SKIP_EMOJI         = true;
const DEF_EMOJI_SELECTORS    = "img.wp-smiley\nimg.emoji";

const DEF_PAGE_TYPES = array(
	'is_single'     => true,
	'is_page'       => true,
	'is_archive'    => false,
	'is_front_page' => false,
	'is_home'       => false,
	'is_search'     => false,
);

// Page type labels for the settings UI.
const PAGE_TYPE_LABELS = array(
	'is_single'     => 'Single Posts',
	'is_page'       => 'Pages',
	'is_archive'    => 'Archive Pages',
	'is_front_page' => 'Front Page',
	'is_home'       => 'Blog Home',
	'is_search'     => 'Search Results',
);
