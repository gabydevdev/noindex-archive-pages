<?php
/**
 * The core plugin class.
 *
 * @since 1.0.0
 * @package Noindex_Archive_Pages
 */

/**
 * Summary of Noindex_Archive_Pages
 */
class Noindex_Archive_Pages {

	/**
	 * Holds the singleton instance of this class.
	 *
	 * @var Noindex_Archive_Pages|null
	 */
	private static $instance = null;

	/**
	 * Holds the plugin options.
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  1.0.0
	 * @return Noindex_Archive_Pages A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Noindex_Archive_Pages constructor.
	 * Initializes the plugin options and adds the necessary actions.
	 */
	private function __construct() {
		$this->options = get_option( 'archive_noindex_options', array() );

		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Define the hooks related to the admin area.
	 */
	private function define_admin_hooks() {
		require_once NOINDEX_ARCHIVE_PAGES_PLUGIN_PATH . 'admin/class-noindex-archive-pages-admin.php';
		$plugin_admin = new Noindex_Archive_Pages_Admin( $this->options );

		add_action( 'admin_menu', array( $plugin_admin, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $plugin_admin, 'register_settings' ) );
	}

	/**
	 * Define the hooks related to the public-facing side of the site.
	 */
	private function define_public_hooks() {
		require_once NOINDEX_ARCHIVE_PAGES_PLUGIN_PATH . 'public/class-noindex-archive-pages-public.php';
		$plugin_public = new Noindex_Archive_Pages_Public( $this->options );

		add_action( 'wp_head', array( $plugin_public, 'add_noindex_meta' ) );
	}

	/**
	 * Flushes rewrite rules on plugin activation.
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

	/**
	 * Flushes rewrite rules on plugin deactivation.
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Run the plugin.
	 */
	public function run() {
		// Add any additional initialization code here.
	}
}

// Register activation and deactivation hooks.
register_activation_hook( __FILE__, array( 'Noindex_Archive_Pages', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Noindex_Archive_Pages', 'deactivate' ) );
