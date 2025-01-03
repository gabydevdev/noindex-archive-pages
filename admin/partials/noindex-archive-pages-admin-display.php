<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Noindex_Archive_Pages
 * @subpackage Noindex_Archive_Pages/admin/partials
 */

?>

<div class="wrap">
	<h1><?php esc_html_e( 'Noindex Archive Settings', 'noindex-archive-pages' ); ?></h1>
	<form method="post" action="options.php">
		<?php settings_fields( 'archive_noindex' ); ?>
		<table class="form-table">
			<tr>
				<th scope="row"><?php esc_html_e( 'Apply noindex to:', 'noindex-archive-pages' ); ?></th>
				<td>
					<fieldset>
						<label>
							<input type="checkbox" name="archive_noindex_options[category]" value="1" <?php checked( ! empty( $this->options['category'] ) ); ?>>
							<?php esc_html_e( 'Category Archives', 'noindex-archive-pages' ); ?>
						</label><br>
						<label>
							<input type="checkbox" name="archive_noindex_options[tag]" value="1" <?php checked( ! empty( $this->options['tag'] ) ); ?>>
							<?php esc_html_e( 'Tag Archives', 'noindex-archive-pages' ); ?>
						</label><br>
						<label>
							<input type="checkbox" name="archive_noindex_options[author]" value="1" <?php checked( ! empty( $this->options['author'] ) ); ?>>
							<?php esc_html_e( 'Author Archives', 'noindex-archive-pages' ); ?>
						</label><br>
						<label>
							<input type="checkbox" name="archive_noindex_options[date]" value="1" <?php checked( ! empty( $this->options['date'] ) ); ?>>
							<?php esc_html_e( 'Date Archives', 'noindex-archive-pages' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php esc_html_e( 'Pagination Settings:', 'noindex-archive-pages' ); ?></th>
				<td>
					<fieldset>
						<label>
							<input type="checkbox" name="archive_noindex_options[paginated_only]" value="1" <?php checked( ! empty( $this->options['paginated_only'] ) ); ?>>
							<?php esc_html_e( 'Only noindex paginated pages (page 2 and beyond)', 'noindex-archive-pages' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>
