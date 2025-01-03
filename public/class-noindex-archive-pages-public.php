<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since 1.0.0
 * @package Noindex_Archive_Pages
 */

/**
 * Summary of Noindex_Archive_Pages_Public
 */
class Noindex_Archive_Pages_Public {

	/**
	 * Holds the plugin options.
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Noindex_Archive_Pages_Public constructor.
	 *
	 * @param array $options The plugin options.
	 */
	public function __construct( $options ) {
		$this->options = $options;
	}

	/**
	 * Adds a noindex meta tag to archive pages based on the plugin options.
	 */
	public function add_noindex_meta() {
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		if ( ( is_category() && ! empty( $this->options['category'] ) ) ||
			( is_tag() && ! empty( $this->options['tag'] ) ) ||
			( is_author() && ! empty( $this->options['author'] ) ) ||
			( is_date() && ! empty( $this->options['date'] ) ) ) {
			if ( empty( $this->options['paginated_only'] ) || $paged > 1 ) {
				echo '<meta name="robots" content="noindex, follow">';
			}
		}
	}
}
