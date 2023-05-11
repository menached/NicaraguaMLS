<?php
/*
Plugin Name: Nicaragua MLS Listings Administration by David Menache
Description:  This plugin will provide an admin page to display records from the property_links table.
Version: 1.0
Author: David Menache
Author URI: https://www.devopsandplatforms.com
Text Domain: nicaragua-mls-listings-admin
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Create admin page
function nmla_admin_page() {
	add_menu_page(
		__( 'Nicaragua MLS Listings Administration', 'nicaragua-mls-listings-admin' ),
		__( 'Nicaragua MLS Listings', 'nicaragua-mls-listings-admin' ),
		'manage_options',
		'nicaragua_mls_listings_admin',
		'nmla_admin_page_content',
		'dashicons-admin-site',
		20
	);
}
add_action( 'admin_menu', 'nmla_admin_page' );

// Admin page content
function nmla_admin_page_content() {
	global $wpdb;

	// Get records from table
	$table_name = $wpdb->prefix . 'property_links';
	$results = $wpdb->get_results( "SELECT * FROM $table_name" );

	// Table headers
	$column_headers = array(
		'ID',
		'Agency',
		'Title',
		'Summary',
		'Tags',
		'Button Text',
		'Terms',
		'Thumbnail',
		'Thumbnail Alt',
		'Thumbnail Link'
	);
	?>

	<div class="wrap">
		<h1><?php _e( 'Nicaragua MLS Listings Administration', 'nicaragua-mls-listings-admin' ); ?></h1>

		<table class="wp-list-table widefat striped">
			<thead>
				<tr>
					<?php
					foreach ( $column_headers as $column_header ) {
						$column_header_sanitized = sanitize_text_field( $column_header );
						printf( '<th class="manage-column">%s</th>', $column_header_sanitized );
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ( $results as $result ) {
					printf(
						'<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
						$result->ID,
						sanitize_text_field( $result->Agency ),
						sanitize_text_field( $result->Title ),
						sanitize_text_field( $result->Summary ),
						sanitize_text_field( $result->Tags ),
						sanitize_text_field( $result->Button_Text ),
						sanitize_text_field( $result->Terms ),
						sanitize_text_field( $result->Thumbnail ),
						sanitize_text_field( $result->Thumbnail_alt ),
						sanitize_text_field( $result->Thumbnail_link )
					);
				}
				?>
			</tbody>
		</table>
	</div>
	<?php
}
