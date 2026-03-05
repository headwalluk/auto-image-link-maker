<?php
/**
 * Main plugin class.
 *
 * @package Auto_Image_Link_Maker
 */

namespace Auto_Image_Link_Maker;

defined( 'ABSPATH' ) || die();

/**
 * Core plugin class that wires up all hooks.
 *
 * @since 0.2.0
 */
class Plugin {

	/**
	 * Settings instance.
	 *
	 * @var Settings|null
	 */
	private ?Settings $settings = null;

	/**
	 * Register all plugin hooks.
	 *
	 * @since 0.2.0
	 *
	 * @return void
	 */
	public function run(): void {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		$this->get_settings()->register_hooks();
		add_action( 'wp_enqueue_scripts', array( $this, 'maybe_enqueue_script' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( \AILM_PLUGIN_DIR . 'auto-image-link-maker.php' ), array( $this, 'add_settings_link' ) );
	}

	/**
	 * Add a Settings link to the plugin action links on the Plugins page.
	 *
	 * @since 0.5.0
	 *
	 * @param array<string> $links Existing action links.
	 *
	 * @return array<string> Modified action links.
	 */
	public function add_settings_link( array $links ): array {
		$settings_link = sprintf(
			'<a href="%s">%s</a>',
			esc_url( admin_url( 'options-general.php?page=ailm-settings' ) ),
			esc_html__( 'Settings', 'auto-image-link-maker' )
		);

		array_unshift( $links, $settings_link );

		return $links;
	}

	/**
	 * Load the plugin text domain for translations.
	 *
	 * @since 0.2.0
	 *
	 * @return void
	 */
	public function load_textdomain(): void {
		load_plugin_textdomain(
			'auto-image-link-maker',
			false,
			dirname( plugin_basename( \AILM_PLUGIN_DIR . 'auto-image-link-maker.php' ) ) . '/languages'
		);
	}

	/**
	 * Get the Settings instance (lazy-loaded).
	 *
	 * @since 0.2.0
	 *
	 * @return Settings
	 */
	public function get_settings(): Settings {
		if ( is_null( $this->settings ) ) {
			$this->settings = new Settings();
		}

		return $this->settings;
	}

	/**
	 * Enqueue the front-end script if the current page type is enabled.
	 *
	 * @since 0.2.0
	 *
	 * @return void
	 */
	public function maybe_enqueue_script(): void {
		$should_enqueue = $this->is_enabled_page_type();

		/**
		 * Filter whether the plugin should enqueue its front-end scripts on the current page.
		 *
		 * @since 0.6.0
		 *
		 * @param bool $should_enqueue Whether the plugin would normally enqueue (based on page type settings).
		 */
		$should_enqueue = (bool) apply_filters( 'ailm_should_enqueue', $should_enqueue );

		if ( $should_enqueue ) {
			$selectors_raw = get_option( OPT_CSS_SELECTORS, DEF_CSS_SELECTORS );
			$selectors     = array_filter( array_map( 'trim', explode( "\n", $selectors_raw ) ) );

			/**
			 * Filter the CSS selectors used to find images.
			 *
			 * @since 0.6.0
			 *
			 * @param array<string> $selectors The image CSS selectors.
			 */
			$selectors = (array) apply_filters( 'ailm_css_selectors', $selectors );

			wp_enqueue_style(
				'glightbox',
				\AILM_PLUGIN_URL . 'assets/vendor/glightbox/glightbox.min.css',
				array(),
				'3.3.1'
			);

			wp_enqueue_script(
				'glightbox',
				\AILM_PLUGIN_URL . 'assets/vendor/glightbox/glightbox.min.js',
				array(),
				'3.3.1',
				true
			);

			wp_enqueue_script(
				'ailm-front',
				\AILM_PLUGIN_URL . 'assets/public/auto-image-link-maker.js',
				array( 'glightbox' ),
				\AILM_VERSION,
				true
			);

			$exclude_raw       = get_option( OPT_EXCLUDE_SELECTORS, DEF_EXCLUDE_SELECTORS );
			$exclude_selectors = array_filter( array_map( 'trim', explode( "\n", $exclude_raw ) ) );

			/**
			 * Filter the CSS selectors used to exclude images from processing.
			 *
			 * @since 0.6.0
			 *
			 * @param array<string> $exclude_selectors The exclude CSS selectors.
			 */
			$exclude_selectors = (array) apply_filters( 'ailm_exclude_selectors', $exclude_selectors );

			$hijack_image_links = (bool) filter_var(
				get_option( OPT_HIJACK_IMAGE_LINKS, DEF_HIJACK_IMAGE_LINKS ),
				FILTER_VALIDATE_BOOLEAN
			);

			/**
			 * Filter whether existing image links should be hijacked to open in the lightbox.
			 *
			 * @since 0.6.0
			 *
			 * @param bool $hijack_image_links Whether to hijack existing image links.
			 */
			$hijack_image_links = (bool) apply_filters( 'ailm_hijack_image_links', $hijack_image_links );

			$skip_emoji = (bool) filter_var(
				get_option( OPT_SKIP_EMOJI, DEF_SKIP_EMOJI ),
				FILTER_VALIDATE_BOOLEAN
			);

			/**
			 * Filter whether emoji images should be skipped.
			 *
			 * @since 0.6.0
			 *
			 * @param bool $skip_emoji Whether to skip emoji images.
			 */
			$skip_emoji = (bool) apply_filters( 'ailm_skip_emoji', $skip_emoji );

			$emoji_selectors = array();
			if ( $skip_emoji ) {
				$emoji_raw       = get_option( OPT_EMOJI_SELECTORS, DEF_EMOJI_SELECTORS );
				$emoji_selectors = array_filter( array_map( 'trim', explode( "\n", $emoji_raw ) ) );

				/**
				 * Filter the CSS selectors used to identify emoji images.
				 *
				 * @since 0.6.0
				 *
				 * @param array<string> $emoji_selectors The emoji CSS selectors.
				 */
				$emoji_selectors = (array) apply_filters( 'ailm_emoji_selectors', $emoji_selectors );
			}

			$gallery_grouping = (bool) filter_var(
				get_option( OPT_GALLERY_GROUPING, DEF_GALLERY_GROUPING ),
				FILTER_VALIDATE_BOOLEAN
			);

			/**
			 * Filter whether gallery grouping is enabled.
			 *
			 * @since 0.6.0
			 *
			 * @param bool $gallery_grouping Whether to group images into separate galleries.
			 */
			$gallery_grouping = (bool) apply_filters( 'ailm_gallery_grouping', $gallery_grouping );

			$gallery_containers = array();
			$group_ungrouped    = true;
			if ( $gallery_grouping ) {
				$containers_raw     = get_option( OPT_GALLERY_CONTAINERS, DEF_GALLERY_CONTAINERS );
				$gallery_containers = array_filter( array_map( 'trim', explode( "\n", $containers_raw ) ) );

				/**
				 * Filter the CSS selectors used to define gallery container boundaries.
				 *
				 * @since 0.6.0
				 *
				 * @param array<string> $gallery_containers The gallery container CSS selectors.
				 */
				$gallery_containers = (array) apply_filters( 'ailm_gallery_containers', $gallery_containers );

				$group_ungrouped = (bool) filter_var(
					get_option( OPT_GROUP_UNGROUPED, DEF_GROUP_UNGROUPED ),
					FILTER_VALIDATE_BOOLEAN
				);

				/**
				 * Filter whether loose images (not inside any gallery container) are grouped together.
				 *
				 * @since 0.6.0
				 *
				 * @param bool $group_ungrouped Whether to group ungrouped images into a shared gallery.
				 */
				$group_ungrouped = (bool) apply_filters( 'ailm_group_ungrouped', $group_ungrouped );
			}

			$script_data = array(
				'selectors'         => $selectors,
				'excludeSelectors'  => $exclude_selectors,
				'hijackImageLinks'  => $hijack_image_links,
				'skipEmoji'         => $skip_emoji,
				'emojiSelectors'    => $emoji_selectors,
				'galleryGrouping'   => $gallery_grouping,
				'galleryContainers' => $gallery_containers,
				'groupUngrouped'    => $group_ungrouped,
			);

			/**
			 * Filter the full data array passed to the front-end script.
			 *
			 * This is a catch-all filter applied after all individual filters. It allows
			 * developers to modify any value passed to the JavaScript, including adding
			 * custom keys for use in their own scripts.
			 *
			 * @since 0.6.0
			 *
			 * @param array<string, mixed> $script_data The localised script data.
			 */
			$script_data = (array) apply_filters( 'ailm_script_data', $script_data );

			wp_localize_script(
				'ailm-front',
				'ailmData',
				$script_data
			);
		}
	}

	/**
	 * Check whether the current page type is enabled in settings.
	 *
	 * @since 0.2.0
	 *
	 * @return bool
	 */
	private function is_enabled_page_type(): bool {
		$page_types = get_option( OPT_PAGE_TYPES, DEF_PAGE_TYPES );
		$enabled    = false;

		$checks = array(
			'is_single'     => 'is_single',
			'is_page'       => 'is_page',
			'is_archive'    => 'is_archive',
			'is_front_page' => 'is_front_page',
			'is_home'       => 'is_home',
			'is_search'     => 'is_search',
		);

		foreach ( $checks as $key => $func ) {
			if ( ! empty( $page_types[ $key ] ) && (bool) filter_var( $page_types[ $key ], FILTER_VALIDATE_BOOLEAN ) && $func() ) {
				$enabled = true;
				break;
			}
		}

		return $enabled;
	}
}
