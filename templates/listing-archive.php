<div id="pj-listings-app" class="pj-listings-app">

	<style>
		<?php require PJ_PLUGIN_DIR . '/assets/css/style.css'; ?>
	</style>

	<?php

	require PJ_PLUGIN_DIR . '/templates/search-form.php';

	if ( pj_is_search() ) {

		$queryArgs = [
			'post_type'    => 'pj-listing',
			'orderby'      => [
				'meta_value' => 'DESC',
				'title'      => 'ASC',
			],
			'meta_key'     => '_pj_plan',
			'meta_compare' => 'EXISTS',
			's'            => $_GET['pj-search'] ?? '',
			'paged'        => absint( $_GET['pj-page'] ?? 1 ),
		];

		if ( ! empty( $_GET['pj-cat'] ) && $_GET['pj-cat'] !== 'all' ) {
			$queryArgs['tax_query'] = [
				[
					'taxonomy' => 'pj-listing-category',
					'terms'    => $_GET['pj-cat'],
				]
			];
		}

		if ( ! empty( $_GET['pj-letter'] ) ) {
			$queryArgs['starts_with'] = sanitize_text_field( $_GET['pj-letter'] );
		}

		if ( isset( $_GET['pj-number'] ) ) {
			$queryArgs['starts_with'] = '0-9';
		}

		$query = new WP_Query( $queryArgs );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$plan = carbon_get_the_post_meta( 'pj_plan' );
				if ( ! $plan ) {
					continue;
				}
				if ( 'premium' === $plan ) {
					require PJ_PLUGIN_DIR . '/templates/premium.php';
				} else {
					require PJ_PLUGIN_DIR . '/templates/basic-enhanced.php';
				}
			}
			wp_reset_postdata();
		} else {
			echo '<div>' . esc_html__( 'No listings found.' ) . '</div>';
		}

		require PJ_PLUGIN_DIR . '/templates/pagination.php';
	} elseif (isset( $_GET['pj-cat'])) {
		echo '<div>' . esc_html__( 'Please select a category.' ) . '</div>';
	}

	?>

</div>
