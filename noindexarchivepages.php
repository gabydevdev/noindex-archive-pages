<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://nanatomedia.com/
 * @since             1.0.0
 * @package           Noindex_Archive_Pages
 *
 * @wordpress-plugin
 * Plugin Name:       Noindex Archive Pages
 * Plugin URI:        https://nanatomedia.com/
 * Description:       Add a noindex meta tag to archive pages.
 * Version:           1.0.0
 * Author:            Nanato Media
 * Author URI:        https://nanatomedia.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       noindex-archive-pages
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define plugin version.
define( 'NOINDEX_ARCHIVE_PAGES_VERSION', '1.0.0' );
define( 'NOINDEX_ARCHIVE_PAGES_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// Include the core plugin class.
require NOINDEX_ARCHIVE_PAGES_PLUGIN_PATH . 'includes/class-noindex-archive-pages.php';

/**
 * Begins execution of the plugin.
 *
 * @since 1.0.0
 */
function run_noindex_archive_pages() {
	$plugin = Noindex_Archive_Pages::get_instance();
	$plugin->run();
}
run_noindex_archive_pages();
