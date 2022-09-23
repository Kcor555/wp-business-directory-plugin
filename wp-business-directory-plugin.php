<?php
/*
 * Plugin Name: WP Business Directory
 * Description: A WordPress Business Directory Plugin
 * Author: Kris Cochran
 * Author URI: https://github.com/Kcor555/wp-business-directory-plugin
 * Version: 1.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Copyright 2022 - All rights reserved.
 */

define( 'PJ_PLUGIN_DIR', __DIR__ );
define( 'PJ_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/carbon-fields.php';

add_action(
	'init',
	function () {

		register_post_type(
			'pj-listing',
			[
				'labels'   => [
					'name'          => 'Listings',
					'singular_name' => 'Listing',
					'add_new'       => 'Add New Listing'
				],
				'public'   => false,
				'show_ui'  => true,
				'supports' => [ 'title' ],
			]
		);

		register_taxonomy(
			'pj-listing-category',
			'pj-listing',
			[
				'hierarchical'      => true,
				'show_admin_column' => true,
			]
		);

	}
);

add_filter(
	'posts_where',
	function ( $where, WP_Query $query ) {
		global $wpdb;

		$starts_with = esc_sql( $query->get( 'starts_with' ) );

		if ( $starts_with ) {

			if ( $starts_with === '0-9' ) {
				$where .= " AND {$wpdb->posts}.post_title REGEXP '^[0-9]'";
			} else {
				$where .= " AND {$wpdb->posts}.post_title LIKE '{$starts_with}%'";
			}

		}

		return $where;
	},
	10,
	2
);

/**
 * Check if a search is being performed.
 *
 * @return bool
 */
function pj_is_search() {
	return isset( $_GET['pj-search'] ) || !empty( $_GET['pj-cat'] ) || isset( $_GET['pj-letter'] ) || isset( $_GET['pj-number'] );
}
