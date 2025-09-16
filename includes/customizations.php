<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Replace "Howdy" with the custom greeting
function transmit_admin_customizer_replace_text($translated, $text, $domain) {
    if (!is_admin() || 'default' != $domain)
        return $translated;
    if (false !== strpos($translated, 'Howdy')) {
        $transmit_admin_customizer_text = get_option('transmit_admin_customizer_text', 'Welcome');
        return str_replace('Howdy', $transmit_admin_customizer_text, $translated);
    }
    return $translated;
}
add_filter('gettext', 'transmit_admin_customizer_replace_text', 10, 3);

// Remove comments icon from admin bar
function transmit_admin_customizer_remove_comments_icon($wp_admin_bar) {
    $remove_comments_icon = get_option('transmit_admin_customizer_remove_comments_icon', false);
    if ($remove_comments_icon) {
        $wp_admin_bar->remove_node('comments');
    }
}
add_action('admin_bar_menu', 'transmit_admin_customizer_remove_comments_icon', 999);

// Admin bar color customizations
function transmit_admin_customizer_admin_bar_color() {
    // Get the current site URL
    $site_url = get_site_url();
    $local_url = get_option('transmit_admin_customizer_local_url');
    $local_color = get_option('transmit_admin_customizer_local_color');
    $local_append_text = get_option('transmit_admin_customizer_local_append_text');
    $staging_url = get_option('transmit_admin_customizer_staging_url');
    $staging_color = get_option('transmit_admin_customizer_staging_color');
    $staging_append_text = get_option('transmit_admin_customizer_staging_append_text');
    $production_url = get_option('transmit_admin_customizer_production_url');
    $production_color = get_option('transmit_admin_customizer_production_color');
    $production_append_text = get_option('transmit_admin_customizer_production_append_text');
    $background_color = '';
    $append_text = '';

    // Check the site URL and set the background color and append text accordingly
    if (!empty($local_url) && strpos($site_url, $local_url) !== false) {
        $background_color = $local_color;
        $append_text = $local_append_text;
    } elseif (!empty($staging_url) && strpos($site_url, $staging_url) !== false) {
        $background_color = $staging_color;
        $append_text = $staging_append_text;
    } elseif (!empty($production_url) && strpos($site_url, $production_url) !== false) {
        $background_color = $production_color;
        $append_text = $production_append_text;
    }

    // Output the custom CSS for changing the admin bar background color
    if ($background_color) {
        echo '
        <style>
            #wpadminbar {
                background-color: ' . esc_attr($background_color) . ' !important;
            }
        </style>
        ';
    }

    // Output the custom JavaScript to append text to the site name in the admin bar
    if ($append_text) {
        echo '
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var siteNameElement = document.getElementById("wp-admin-bar-site-name").querySelector(".ab-item");
                if (siteNameElement) {
                    siteNameElement.innerHTML += "' . esc_js($append_text) . '";
                }
            });
        </script>
        ';
    }
}
add_action('wp_head', 'transmit_admin_customizer_admin_bar_color');
add_action('admin_head', 'transmit_admin_customizer_admin_bar_color');

?>
