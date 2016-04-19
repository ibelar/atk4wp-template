<?php
/**
 * @wordpress-plugin
 * Plugin Name:       YOUR_PLUGIN_NAME
 * Plugin URI:        YOUR_SITE
 * Description:       YOUR_DESCRIPTION
 * Version:           1.0.0
 * Author:            YOUR_NAME
 */

// ===============
// = Plugin =
// ===============

//Rename using your namespace.
namespace PLUGIN_NAMESPACE;

require_once __DIR__ . '/vendor/autoload.php';
require_once WP_CONTENT_DIR . '/atk4-wp/vendor/autoload.php';

if (array_search(ABSPATH . 'wp-admin/includes/plugin.php', get_included_files()) === false)
{
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

//Rename using your plugin name.
$atk_plugin_name  = "PLUGIN_NAME";
$atk_plugin_classname = __NAMESPACE__."\\Plugin";


$$atk_plugin_name = new $atk_plugin_classname( $atk_plugin_name, plugin_dir_path( __FILE__ ) );

if ( ! is_null( $$atk_plugin_name)) {
	register_activation_hook(__FILE__, [ $$atk_plugin_name, 'activatePlugin']);
	register_deactivation_hook(__FILE__, [ $$atk_plugin_name, 'deactivatePlugin']);

	$$atk_plugin_name->boot();
}