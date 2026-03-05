# Changelog

All notable changes to Auto Image Link Maker will be documented in this file.

## [0.5.0] - 2026-03-05

### Added

- Settings link on the Plugins page for quick access to configuration.
- Exclude Selectors setting: textarea to specify images that should be skipped (e.g. `.site-logo img`, `.avatar`).
- Emoji exclusion: checkbox to skip emoji images, with configurable emoji selectors (default: `img.wp-smiley`, `img.emoji`).
- `uninstall.php` to clean up all `ailm_*` options from `wp_options` on plugin deletion.

## [0.4.0] - 2026-03-05

### Added

- Option to hijack existing image links so they open in the lightbox instead of navigating to the raw file.
- New setting: "Hijack Image Links" under CSS Selectors section (enabled by default).
- Links to non-image content (e.g. posts, pages) are left untouched.
- GPLv2 LICENSE file.

### Changed

- PHP requirement updated to 8.0+.

## [0.3.0] - 2026-03-05

### Added

- Text domain loading for translation support.
- Machine-translated language files (de_DE, el_GR, en_GB, es_ES, fr_FR, it_IT, nl_NL, pl_PL).
- README badges (version, WordPress, PHP, licence, GLightbox).

## [0.2.0] - 2026-03-05

### Added

- Initial release.
- Settings page with configurable CSS selectors for image targeting.
- Page type toggles (single post, page, archive, front page, blog home, search).
- Client-side JavaScript to wrap unwrapped images in anchor links.
- GLightbox 3.3.1 integration for lightbox display.
- Full-size image resolution via srcset parsing and WP dimension suffix stripping.
