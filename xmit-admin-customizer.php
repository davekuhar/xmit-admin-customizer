<?php
/*
Plugin Name: Transmit Studio Admin Customizer
Plugin URI:  http://example.com
Description: A package of customizations for the WordPress admin screens.
Version:     1.9
Author:      Dave Kuhar
Author URI:  http://example.com
License:     GPL2
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include the settings and customization functions
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/customizations.php';

// Enqueue color picker scripts and styles
function transmit_admin_customizer_enqueue_color_picker($hook_suffix) {
    // Ensure the color picker script is only loaded on our plugin settings page
    if ('settings_page_transmit-admin-customizer' !== $hook_suffix) {
        return;
    }

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('transmit_admin_customizer_color_picker', plugins_url('color-picker.js', __FILE__), array('wp-color-picker'), false, true);
}
add_action('admin_enqueue_scripts', 'transmit_admin_customizer_enqueue_color_picker');
?>
