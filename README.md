# Auto Image Link Maker

![Version](https://img.shields.io/badge/version-0.5.0-blue)
![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-21759b?logo=wordpress)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-777bb4?logo=php&logoColor=white)
![License](https://img.shields.io/badge/license-GPLv2-green)
![GLightbox](https://img.shields.io/badge/GLightbox-3.3.1-orange)

A WordPress plugin that automatically wraps unwrapped images in clickable anchor links, with a built-in lightbox for smooth viewing.

## Problem

Content managed in the WordPress block editor (particularly HTML tables) often contains images that are not wrapped in links. These images should be clickable, linking to their full-size source.

## Approach

The plugin uses a client-side JavaScript approach rather than server-side HTML processing. A small script runs on the front end and:

1. Selects images within a configurable container (default: `#main img`).
2. For each matched image, checks whether it already has an `<a>` ancestor using `element.closest('a')`.
3. If no anchor ancestor exists, wraps the image in an `<a>` tag linking to the image's `src` (or full-size source if available).
4. Opens clicked images in a GLightbox lightbox for a smooth viewing experience.

### Why JavaScript instead of server-side?

- **Reliable parent detection** — `element.closest('a')` is a clean, native way to check ancestry. The server-side equivalent (`WP_HTML_Tag_Processor`) is a forward-only stream parser that cannot easily inspect parent elements.
- **Works with the real DOM** — no need to handle HTML serialization edge cases.
- **Non-destructive** — the stored content is never modified; links are added at render time in the browser.

## Third-Party Libraries

### GLightbox 3.3.1

- **Website:** https://github.com/biati-digital/glightbox
- **Licence:** MIT
- **Location:** `assets/vendor/glightbox/`
- **Files:** `glightbox.min.js`, `glightbox.min.css`

GLightbox is a dependency-free, touch-enabled lightbox used to display full-size images. It is bundled with the plugin — no external CDN references are used.

## Translations

The plugin ships with machine-generated translations for the following locales. These have not been reviewed by native speakers and may contain inaccuracies — contributions and corrections are welcome.

- German (de_DE)
- Greek (el_GR)
- English UK (en_GB)
- Spanish (es_ES)
- French (fr_FR)
- Italian (it_IT)
- Dutch (nl_NL)
- Polish (pl_PL)

A POT file is included at `languages/auto-image-link-maker.pot` for generating additional translations.

## Requirements

- WordPress 6.0+
- PHP 8.0+

## Development

- Dev site: `http://bench3.local/`
- WP-CLI: `wp` (installed globally)
- Code standards: `phpcs` / `phpcbf`
