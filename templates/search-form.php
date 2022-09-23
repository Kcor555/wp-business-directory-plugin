<?php

use wpscholar\Url;

$currentUrl = new Url();

// Show selected categories at top
$show_at_top = get_terms( [
	'taxonomy'   => 'pj-listing-category',
	'meta_key'   => '_pj-show-at-top',
	'meta_value' => 'yes',
] );

$terms = get_terms( [
	'taxonomy' => 'pj-listing-category',
	'exclude'  => wp_list_pluck( $show_at_top, 'term_id' ),
] );

$terms = array_merge( $show_at_top, $terms );

$activeTerm = $_GET['pj-cat'] ?? '';

?>

<div class="pj-form-container">
	<form method="get" class="pj-form">
		<div class="pj-search-container">

			<select
				class="pj-search-box"
				aria-label="<?php esc_attr_e( 'Category' ); ?>"
				name="pj-cat"
			>

				<option value="">
					<?php esc_html_e( 'Select Category' ); ?>
				</option>

				<option value="all"  <?php echo selected( 'all', $_GET['pj-cat']) ?>>
					<?php esc_html_e( 'All Categories' ); ?>
				</option>

				<?php foreach ( $terms as $term ) : ?>

					<option value="<?php echo $term->term_id; ?>" <?php echo selected( $activeTerm, $term->term_id ) ?>>
						<?php echo $term->name; ?>
					</option>

				<?php endforeach; ?>

			</select>

			<input class="pj-search-btn" type="submit" value="<?php esc_html_e( 'Search' ); ?>">

			<div class="pj-search-wrap">

				<a class="pj-search-letters-link" href="#">
					<?php esc_html_e( 'Search By Letter' ); ?>
				</a>

				<?php if ( pj_is_search() ): ?>
					<a class="pj-new-search" href="<?= esc_html( get_permalink() ); ?>">
						<?php esc_html_e( 'New Search' ); ?>
					</a>
				<?php endif; ?>

				<div class="pj-search-letters grow">
					<?php foreach ( range( 'A', 'Z' ) as $list_ltr ) : ?>
						<a
							class="pj-search-letter-btn"
							href="<?= esc_url( add_query_arg( 'pj-letter', $list_ltr, Url::stripQueryString( $currentUrl->toString() ) ) ); ?>"
						>
							<?= esc_html( $list_ltr ); ?>
						</a>

					<?php endforeach; ?>

					<a
						class="pj-search-number-btn"
						href="<?= esc_url( add_query_arg( 'pj-number', '', Url::stripQueryString( $currentUrl->toString() ) ) ) ?>"
					>
						<?php esc_html_e( '0-9' ); ?>
					</a>

				</div>
			</div>

		</div>
	</form>
	<script src="<?= esc_url( PJ_PLUGIN_URL . 'assets/js/script.js' ) ?>"></script>
</div>
