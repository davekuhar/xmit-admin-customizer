<?php
/**
 * Plugin Name: Transmit Studio Admin Customizer
 * Plugin URI: http://transmitstudio.com
 * Description: Admin bar indicates current environment. Removes Comments icon from Admin bar. Stops saying "Howdy" like some yokel. Negates auto-update.
 * Author: Dave Kuhar
 * Author URI: http://transmitstudio.com
 * Version: 1.7
 * @license GPL-2.0+
 */


//check for the existence of the ABSPATH constant defined by WordPress when loaded. If the constant exists, WordPress is requesting access to load this file. If the constant does not exist, someone is trying to directly access this file and we want to stop them immediately.
defined('ABSPATH') or die("Get lost!");

add_action('wp_head', 'xmit_wpengine_staging_notice');
add_action('admin_head', 'xmit_wpengine_staging_notice');
function xmit_wpengine_staging_notice() {
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
  var loc = window.location.href; // returns the full URL
  if(/staging/.test(loc)) {
    $('body').addClass('staging');
  }
  if(/sitedistrict/.test(loc)) {
    $('body').addClass('sitedistrict');
  }
  if(/local/.test(loc)) {
    $('body').addClass('localdev');
  }
  if(/cc/.test(loc)) {
    $('body').addClass('localdev');
  }
});
</script>
<?php
}

// Disable automatic WordPress plugin updates and remove the UI
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'plugins_auto_update_enabled', '__return_false' );

// // Disable automatic WordPress theme updates	and remove the UI
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'themes_auto_update_enabled', '__return_false' );

// remove elements from admin bar
function xmit_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'xmit_admin_bar_render' );

// Indicate staging site by coloring the admin bar
function xmit_admin_customizer() {
   echo '<style type="text/css">
           body.staging #wpadminbar {
           		background:rgb(107, 13, 13);
           }
           
           body.sitedistrict #wpadminbar {
           		background:rgb(0, 38, 163);
           }
           
           body.localdev #wpadminbar {
           		background:rgb(0, 102, 204);
           }
           
           body.staging #wp-admin-bar-site-name > a.ab-item:after {
           		content:" - STAGING SITE"
           }
           
           body.sitedistrict #wp-admin-bar-site-name > a.ab-item:after {
           		content:" - DEV SITE";
           }
           
           body.localdev #wp-admin-bar-site-name > a.ab-item:after {
           		content:" - LOCALDEV";
           }
         </style>';
}
add_action('admin_head', 'xmit_admin_customizer');
add_action('wp_head', 'xmit_admin_customizer');

// replace WordPress Howdy
function replace_howdy( $wp_admin_bar ) {
	$my_account=$wp_admin_bar->get_node('my-account');
	$newtitle = str_replace( 'Howdy,', 'Hello,', $my_account->title );
	$wp_admin_bar->add_node( array(
			'id' => 'my-account',
			'title' => $newtitle,
		) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );