# Project Tracker

**Version:** 0.4.0
**Last Updated:** 5 March 2026
**Current Phase:** Complete
**Overall Progress:** 100%

---

## Overview

WordPress plugin that automatically wraps unwrapped images in clickable anchor links and opens them in a GLightbox lightbox. Targets images via configurable CSS selectors, with per-page-type controls. Client-side JS approach using `element.closest('a')` for reliable ancestor detection.

---

## Active TODO Items

None — testing on client site.

---

## Milestones

### Milestone 1: Plugin Foundation (DONE)

- [x] Main plugin file and bootstrap function
- [x] Constants file (option keys, defaults, page type labels)
- [x] Plugin class with hook registration and conditional enqueue
- [x] Settings class with WP Settings API integration
- [x] Settings page: CSS selectors textarea (one per line)
- [x] Settings page: page type checkboxes
- [x] Admin template for settings page (code-first, no inline HTML)
- [x] phpcs.xml configuration
- [x] Activate plugin and verify settings page loads

### Milestone 2: GLightbox Integration (DONE)

- [x] Enqueue GLightbox JS (`assets/vendor/glightbox/glightbox.min.js`)
- [x] Enqueue GLightbox CSS (`assets/vendor/glightbox/glightbox.min.css`)
- [x] Update front-end JS to add GLightbox class/attributes to generated anchors
- [x] Initialise GLightbox instance after image wrapping completes
- [x] Verify scripts load on enabled page types
- [x] Verify images already inside links are not affected

### Milestone 3: Full-Size Image Resolution (DONE)

- [x] Parse `srcset` to find the largest available source
- [x] Strip WordPress dimension suffix (e.g. `-1024x768`) as fallback
- [x] Set anchor `href` to full-size URL for lightbox display
- [x] Fallback to `src` if no full-size URL can be determined

### Milestone 4: Testing and Edge Cases (DONE)

- [x] Test with images on a page with srcset (full-size resolution verified)
- [x] Test with images inside nested elements (closest('a') handles all depths)
- [x] Test page types: is_page enabled loads scripts, is_search disabled does not
- [x] Test with no selectors configured (empty array, JS bails gracefully)
- [x] Test with selectors that match zero images (querySelectorAll returns empty NodeList)
- [x] Verify script does not load on disabled page types (search confirmed)
- [x] Note: static front page matches is_page() — this is correct WP behaviour

### Milestone 6: Hijack Existing Image Links (DONE)

- [x] New constant OPT_HIJACK_IMAGE_LINKS / DEF_HIJACK_IMAGE_LINKS
- [x] Settings field: checkbox to enable/disable hijacking
- [x] JS: detect existing anchors whose href points to an image file
- [x] JS: add glightbox class and update href to full-size URL
- [x] JS: leave non-image links untouched
- [x] Pass setting to front-end via wp_localize_script
- [x] Tested on dev site

### Milestone 5: Polish and Release (DONE)

- [x] Review all PHP against phpcs (zero violations)
- [x] Review JS for edge cases and browser compatibility
- [x] Final update to README.md, readme.txt, and CHANGELOG.md
- [x] Update version to 1.0.0 across all files
- [x] Update CLAUDE.md with GLightbox and vendor directory info

---

## Technical Debt

None yet.

---

## Notes for Development

- GLightbox 3.3.1 is bundled in `assets/vendor/glightbox/` (MIT licence).
- Front-end JS is vanilla — no jQuery dependency.
- Settings are stored in three wp_options: `ailm_css_selectors` (string), `ailm_page_types` (array), `ailm_hijack_image_links` (boolean).
- Dev site: `http://bench3.local/`
