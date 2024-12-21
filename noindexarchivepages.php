<?php
/**
 * Plugin Name: Noindex Archive Pages
 * Description: Add a noindex meta tag to archive pages.
 * Plugin URI:
 * Author: Nanato Media
 * Author URI:
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: noindex-archive-pages
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

class NoindexArchivePages {

	private static $instance = null;

	/**
	 * Creates or returns an instance of this class.
	 * @since  1.0.0
	 * @return NoindexArchivePages A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'wp_head', array( $this, 'add_noindex_meta' ) );
	}

	public function add_noindex_meta() {
		if ( is_archive() || is_date() || is_author() || is_category() || is_tag() ) {
			echo '<meta name="robots" content="noindex, follow">';
		}
	}

	public static function activate() {
		flush_rewrite_rules();
	}

	public static function deactivate() {
		flush_rewrite_rules();
	}
}

add_action( 'plugins_loaded', array( 'NoindexArchivePages', 'get_instance' ) );
register_activation_hook( __FILE__, array( 'NoindexArchivePages', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'NoindexArchivePages', 'deactivate' ) );
