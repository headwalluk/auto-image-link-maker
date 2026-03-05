=== Auto Image Link Maker ===
Contributors: headwalluk
Tags: images, lightbox, links, tables, accessibility
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 8.0
Stable tag: 0.4.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Automatically wraps unwrapped images in clickable anchor links and opens them in a lightbox.

== Description ==

Auto Image Link Maker scans your pages for images that are not already inside a link and wraps them in anchor tags. Clicked images open in a smooth, touch-friendly lightbox powered by GLightbox.

This is especially useful for content with HTML tables (from the WordPress block editor) where images are not always clickable.

**Features:**

* Configurable CSS selectors to target specific images
* Choose which page types to enable (posts, pages, archives, front page, etc.)
* Built-in GLightbox lightbox for smooth image viewing
* No jQuery dependency
* Optional hijacking of existing image links to open in the lightbox
* Lightweight and non-destructive — stored content is never modified
* Translations included for de_DE, el_GR, en_GB, es_ES, fr_FR, it_IT, nl_NL, pl_PL (machine-translated — human review welcome)

== Installation ==

1. Upload the `auto-image-link-maker` folder to `/wp-content/plugins/`.
2. Activate the plugin through the Plugins menu in WordPress.
3. Go to Settings > Image Link Maker to configure CSS selectors and page types.

== Frequently Asked Questions ==

= Which images are affected? =

Only images matching your configured CSS selectors that are not already inside an `<a>` tag.

= Does this modify my content? =

No. The plugin works entirely in the browser. Your saved content is never changed.

= What lightbox does this use? =

The plugin bundles GLightbox 3.3.1 (MIT licence), a lightweight, dependency-free lightbox library.

== Changelog ==

= 0.4.0 =
* Add option to hijack existing image links so they open in the lightbox.
* Images linking to non-image content (e.g. posts) are left untouched.
* New setting: "Hijack Image Links" (enabled by default).
* Update PHP requirement to 8.0+.
* Add GPLv2 LICENSE file.

= 0.3.0 =
* Add text domain loading for translations.
* Add machine-translated language files (de, el, en_GB, es, fr, it, nl, pl).
* Add README badges.

= 0.2.0 =
* Initial release.
* Configurable CSS selectors for image targeting.
* Page type toggles (single, page, archive, front page, home, search).
* GLightbox integration for lightbox display.
* Full-size image resolution via srcset parsing and dimension suffix stripping.
