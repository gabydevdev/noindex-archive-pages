<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since 1.0.0
 * @package Noindex_Archive_Pages
 */

/**
 * Summary of Noindex_Archive_Pages_Admin
 */
class Noindex_Archive_Pages_Admin {

	/**
	 * Holds the plugin options.
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Noindex_Archive_Pages_Admin constructor.
	 *
	 * @param array $options The plugin options.
	 */
	public function __construct( $options ) {
		$this->options = $options;
	}

	/**
	 * Adds the options page to the admin menu.
	 */
	public function add_admin_menu() {
		add_options_page(
			__( 'Noindex Archive Settings', 'noindex-archive-pages' ),
			__( 'Noindex Tag', 'noindex-archive-pages' ),
			'manage_options',
			'noindex-archive-pages',
			array( $this, 'options_page' )
		);
	}

	/**
	 * Registers the plugin settings.
	 */
	public function register_settings() {
		register_setting( 'archive_noindex', 'archive_noindex_options' );
	}

	/**
	 * Renders the options page.
	 */
	public function options_page() {
		require_once plugin_dir_path( __FILE__ ) . 'partials/noindex-archive-pages-admin-display.php';
	}
}
