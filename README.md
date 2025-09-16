# xmit-admin-customizer
WP Admin customizer for Transmit Studio sites

* Admin bar indicates current environment by lighting up in different colors.
* Removes comments icon from admin bar because who uses comments anyway. Plus it wastes space.
* Stops saying "Howdy" to the user because we're not all hayseeds like Matt Mullenweg.
* Negates auto-update, because who can trust plugin developers?



# Transmit Studio Admin Customizer
Contributors: Dave Kuhar
Tags: admin, customization
Requires at least: 4.6
Tested up to: 5.8
Stable tag: 1.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A package of customizations for the WordPress admin screens.

## Description

This plugin provides customizations for the WordPress admin screens, including changing the greeting text, removing the comments icon, and modifying the admin bar color based on the environment.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/xmit-admin-customizer` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings->Transmit Admin Customizer screen to configure the plugin.

---
**Changelog**

= 1.9 =
* Ensure URL strings for Development, Staging, and Production environments are correctly evaluated.
* Added option to remove the comments icon from the admin bar.
* Added append text fields for Development, Staging, and Production environments.
* Initial release.
