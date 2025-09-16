<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Create an options page
function transmit_admin_customizer_menu() {
    add_options_page(
        'Transmit Studio Admin Customizer Options', // Page title
        'Transmit Studio Admin Customizer',         // Menu title
        'manage_options',                    // Capability
        'transmit-admin-customizer',         // Menu slug
        'transmit_admin_customizer_options_page' // Function to display the page
    );
}
add_action('admin_menu', 'transmit_admin_customizer_menu');

// Display the options page
function transmit_admin_customizer_options_page() {
    ?>
    <div class="wrap">
        <h1>Transmit Admin Customizer Options</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('transmit_admin_customizer_options_group');
            do_settings_sections('transmit-admin-customizer');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register the settings
function transmit_admin_customizer_settings_init() {
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_text');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_remove_comments_icon');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_local_url');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_local_color');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_local_append_text');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_staging_url');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_staging_color');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_staging_append_text');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_production_url');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_production_color');
    register_setting('transmit_admin_customizer_options_group', 'transmit_admin_customizer_production_append_text');

    add_settings_section(
        'transmit_admin_customizer_section',
        'Custom Greeting Settings',
        'transmit_admin_customizer_section_callback',
        'transmit-admin-customizer'
    );

    add_settings_field(
        'transmit_admin_customizer_text',
        'Greeting Text',
        'transmit_admin_customizer_text_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_section'
    );

    add_settings_field(
        'transmit_admin_customizer_remove_comments_icon',
        'Remove Comments Icon',
        'transmit_admin_customizer_remove_comments_icon_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_section'
    );

    add_settings_section(
        'transmit_admin_customizer_local_section',
        'Development Environment',
        'transmit_admin_customizer_local_section_callback',
        'transmit-admin-customizer'
    );

    add_settings_field(
        'transmit_admin_customizer_local_url',
        'Development URL',
        'transmit_admin_customizer_local_url_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_local_section'
    );

    add_settings_field(
        'transmit_admin_customizer_local_color',
        'Development Environment Color',
        'transmit_admin_customizer_local_color_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_local_section'
    );

    add_settings_field(
        'transmit_admin_customizer_local_append_text',
        'Development Append Text',
        'transmit_admin_customizer_local_append_text_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_local_section'
    );

    add_settings_section(
        'transmit_admin_customizer_staging_section',
        'Staging Environment',
        'transmit_admin_customizer_staging_section_callback',
        'transmit-admin-customizer'
    );

    add_settings_field(
        'transmit_admin_customizer_staging_url',
        'Staging URL',
        'transmit_admin_customizer_staging_url_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_staging_section'
    );

    add_settings_field(
        'transmit_admin_customizer_staging_color',
        'Staging Environment Color',
        'transmit_admin_customizer_staging_color_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_staging_section'
    );

    add_settings_field(
        'transmit_admin_customizer_staging_append_text',
        'Staging Append Text',
        'transmit_admin_customizer_staging_append_text_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_staging_section'
    );

    add_settings_section(
        'transmit_admin_customizer_production_section',
        'Production Environment',
        'transmit_admin_customizer_production_section_callback',
        'transmit-admin-customizer'
    );

    add_settings_field(
        'transmit_admin_customizer_production_url',
        'Production URL',
        'transmit_admin_customizer_production_url_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_production_section'
    );

    add_settings_field(
        'transmit_admin_customizer_production_color',
        'Production Environment Color',
        'transmit_admin_customizer_production_color_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_production_section'
    );

    add_settings_field(
        'transmit_admin_customizer_production_append_text',
        'Production Append Text',
        'transmit_admin_customizer_production_append_text_render',
        'transmit-admin-customizer',
        'transmit_admin_customizer_production_section'
    );
}
add_action('admin_init', 'transmit_admin_customizer_settings_init');

function transmit_admin_customizer_section_callback() {
    echo 'Enter the text you want to replace "Howdy" with:';
}

function transmit_admin_customizer_text_render() {
    $transmit_admin_customizer_text = get_option('transmit_admin_customizer_text', 'Welcome');
    ?>
    <input type="text" name="transmit_admin_customizer_text" value="<?php echo esc_attr($transmit_admin_customizer_text); ?>" />
    <?php
}

function transmit_admin_customizer_remove_comments_icon_render() {
    $transmit_admin_customizer_remove_comments_icon = get_option('transmit_admin_customizer_remove_comments_icon', false);
    ?>
    <input type="checkbox" name="transmit_admin_customizer_remove_comments_icon" value="1" <?php checked(1, $transmit_admin_customizer_remove_comments_icon, true); ?> />
    <?php
}

function transmit_admin_customizer_local_section_callback() {
    echo 'Settings for development environment:';
}

function transmit_admin_customizer_local_url_render() {
    $transmit_admin_customizer_local_url = get_option('transmit_admin_customizer_local_url');
    ?>
    <input type="text" name="transmit_admin_customizer_local_url" value="<?php echo esc_attr($transmit_admin_customizer_local_url); ?>" />
    <?php
}

function transmit_admin_customizer_local_color_render() {
    $transmit_admin_customizer_local_color = get_option('transmit_admin_customizer_local_color');
    ?>
    <input type="text" class="color-field" name="transmit_admin_customizer_local_color" value="<?php echo esc_attr($transmit_admin_customizer_local_color); ?>" />
    <?php
}

function transmit_admin_customizer_local_append_text_render() {
    $transmit_admin_customizer_local_append_text = get_option('transmit_admin_customizer_local_append_text');
    ?>
    <input type="text" name="transmit_admin_customizer_local_append_text" value="<?php echo esc_attr($transmit_admin_customizer_local_append_text); ?>" />
    <?php
}

function transmit_admin_customizer_staging_section_callback() {
    echo 'Settings for staging environment:';
}

function transmit_admin_customizer_staging_url_render() {
    $transmit_admin_customizer_staging_url = get_option('transmit_admin_customizer_staging_url');
    ?>
    <input type="text" name="transmit_admin_customizer_staging_url" value="<?php echo esc_attr($transmit_admin_customizer_staging_url); ?>" />
    <?php
}

function transmit_admin_customizer_staging_color_render() {
    $transmit_admin_customizer_staging_color = get_option('transmit_admin_customizer_staging_color');
    ?>
    <input type="text" class="color-field" name="transmit_admin_customizer_staging_color" value="<?php echo esc_attr($transmit_admin_customizer_staging_color); ?>" />
    <?php
}

function transmit_admin_customizer_staging_append_text_render() {
    $transmit_admin_customizer_staging_append_text = get_option('transmit_admin_customizer_staging_append_text');
    ?>
    <input type="text" name="transmit_admin_customizer_staging_append_text" value="<?php echo esc_attr($transmit_admin_customizer_staging_append_text); ?>" />
    <?php
}

function transmit_admin_customizer_production_section_callback() {
    echo 'Settings for production environment:';
}

function transmit_admin_customizer_production_url_render() {
    $transmit_admin_customizer_production_url = get_option('transmit_admin_customizer_production_url');
    ?>
    <input type="text" name="transmit_admin_customizer_production_url" value="<?php echo esc_attr($transmit_admin_customizer_production_url); ?>" />
    <?php
}

function transmit_admin_customizer_production_color_render() {
    $transmit_admin_customizer_production_color = get_option('transmit_admin_customizer_production_color');
    ?>
    <input type="text" class="color-field" name="transmit_admin_customizer_production_color" value="<?php echo esc_attr($transmit_admin_customizer_production_color); ?>" />
    <?php
}

function transmit_admin_customizer_production_append_text_render() {
    $transmit_admin_customizer_production_append_text = get_option('transmit_admin_customizer_production_append_text');
    ?>
    <input type="text" name="transmit_admin_customizer_production_append_text" value="<?php echo esc_attr($transmit_admin_customizer_production_append_text); ?>" />
    <?php
}
?>
