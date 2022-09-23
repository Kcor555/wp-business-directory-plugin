<?php

/**
 * The current query.
 *
 * @var WP_Query $query
 */

// $query->post_count - Items on current page
// $query->found_posts - All items found
// $query->max_num_pages - Total pages to paginate through

$hasPagination = $query->post_count !== $query->found_posts;
$currentPage   = absint( $_GET['pj-page'] ?? 1 );

// Check if we need to do pagination, if not bail early
if ( ! $hasPagination ) {
	return;
}

?>

<div class="pj-pagination">

	<?php if ( $currentPage > 1 ): ?>
		<a class="pj-page-numbers pj-prev" href="<?= esc_url( add_query_arg( [ 'pj-page' => $currentPage - 1 ] ) ) ?>">
			◀
		</a>
	<?php endif; ?>

	<?php for ( $i = 1; $i <= $query->max_num_pages; $i ++ ): ?>

		<?php if ( $i == $currentPage ): ?>

			<span class="pj-page-numbers pj-current"><?= absint( $i ); ?></span>

		<?php else: ?>

			<a class="pj-page-numbers" href="<?= esc_url( add_query_arg( [ 'pj-page' => $i ] ) ) ?>">
				<?= absint( $i ); ?>
			</a>

		<?php endif; ?>

	<?php endfor; ?>

	<?php if ( $currentPage < $query->max_num_pages ): ?>
		<a class="pj-page-numbers pj-next" href="<?= esc_url( add_query_arg( [ 'pj-page' => $currentPage + 1 ] ) ) ?>">
			▶
		</a>
	<?php endif; ?>

</div>
