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

	/**
	 * Holds the singleton instance of this class.
	 *
	 * @var NoindexArchivePages|null
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
	 * @return NoindexArchivePages A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * NoindexArchivePages constructor.
	 * Initializes the plugin options and adds the necessary actions.
	 */
	private function __construct() {
		$this->options = get_option( 'archive_noindex_options', array() );

		// Add action to insert the noindex meta tag in the head section.
		add_action( 'wp_head', array( $this, 'add_noindex_meta' ) );

		// Add action to create the admin menu.
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );

		// Add action to register the plugin settings.
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Adds a noindex meta tag to archive pages based on the plugin options.
	 */
	public function add_noindex_meta() {
		$paged = get_query_var( 'paged' ) ? get_query_var('paged') : 1;

		$should_noindex = false;

		if ( is_date() || is_author() || is_category() || is_tag() ) {
			if (!empty($this->options['paginated_only'])) {
				$should_noindex = ($paged > 1);
			} else {
				$should_noindex = true;
			}
		}

		if ($should_noindex) {
			echo '<meta name="robots" content="noindex, follow">';
		}
	}

	/**
	 * Adds the options page to the admin menu.
	 */
	public function add_admin_menu() {
		add_options_page(
			'Noindex Archive Settings',
			'Noindex Tag',
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
		?>
		<div class="wrap">
			<h1><?php _e( 'Noindex Archive Settings', 'noindex-archive-pages' ); ?></h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'archive_noindex' ); ?>
				<table class="form-table">
					<tr>
						<th scope="row"><?php _e( 'Apply noindex to:', 'noindex-archive-pages' ); ?></th>
						<td>
							<fieldset>
								<label>
									<input type="checkbox" name="archive_noindex_options[category]" value="1" <?php checked( ! empty( $this->options['category'] ) ); ?>>
									<?php _e( 'Category Archives', 'noindex-archive-pages' ); ?>
								</label><br>
								<label>
									<input type="checkbox" name="archive_noindex_options[tag]" value="1" <?php checked( ! empty( $this->options['tag'] ) ); ?>>
									<?php _e( 'Tag Archives', 'noindex-archive-pages' ); ?>
								</label><br>
								<label>
									<input type="checkbox" name="archive_noindex_options[author]" value="1" <?php checked( ! empty( $this->options['author'] ) ); ?>>
									<?php _e( 'Author Archives', 'noindex-archive-pages' ); ?>
								</label><br>
								<label>
									<input type="checkbox" name="archive_noindex_options[date]" value="1" <?php checked( ! empty( $this->options['date'] ) ); ?>>
									<?php _e( 'Date Archives', 'noindex-archive-pages' ); ?>
								</label>
							</fieldset>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e( 'Pagination Settings:', 'noindex-archive-pages' ); ?></th>
						<td>
							<fieldset>
								<label>
									<input type="checkbox" name="archive_noindex_options[paginated_only]" value="1" <?php checked( ! empty( $this->options['paginated_only'] ) ); ?>>
									<?php _e( 'Only noindex paginated pages (page 2 and beyond)', 'noindex-archive-pages' ); ?>
								</label>
							</fieldset>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
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
}

// Initialize the plugin.
add_action( 'plugins_loaded', array( 'NoindexArchivePages', 'get_instance' ) );

// Register activation and deactivation hooks.
register_activation_hook( __FILE__, array( 'NoindexArchivePages', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'NoindexArchivePages', 'deactivate' ) );
