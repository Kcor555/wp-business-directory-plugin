<?php
$businessName = get_the_title();
$planName     = carbon_get_post_meta( get_the_ID(), 'pj_plan' );
$phone        = carbon_get_post_meta( get_the_ID(), 'pj_phone' );
$street       = carbon_get_post_meta( get_the_ID(), 'pj_street' );
$city         = carbon_get_post_meta( get_the_ID(), 'pj_city' );
$state        = carbon_get_post_meta( get_the_ID(), 'pj_state' );
$zip          = carbon_get_post_meta( get_the_ID(), 'pj_zip' );
$phone        = carbon_get_post_meta( get_the_ID(), 'pj_phone' );
?>

<div>

	<div
		class="pj-business-card"
		itemscope
		itemtype="https://schema.org/Organization"
	>

		<div
			class="pj-business-title"
			itemprop="name"
		>
			<?php the_title(); ?>
		</div>

		<div
			itemprop="address"
			itemscope
			itemtype="https://schema.org/PostalAddress"
		>

			<?php if ( $street ) : ?>

				<div itemprop="streetAddress">
					<?php echo esc_html( $street ); ?>
				</div>

			<?php endif; ?>

			<div>

				<?php if ( $city ) : ?>
					<span itemprop="addressLocality">
						<?php echo esc_html( $city . "," ); ?>
					</span>
				<?php endif; ?>

				<?php if ( $state ) : ?>
					<span itemprop="addressRegion">
						<?php echo esc_html( $state ); ?>
					</span>
				<?php endif; ?>

				<?php if ( $zip ) : ?>
					<span itemprop="postalCode">
						<?php echo esc_html( $zip ); ?>
					</span>
				<?php endif; ?>

			</div>
		</div>

		<?php if ( $phone ): ?>
			<?php if ( $planName === 'enhanced' ) : ?>
				<div>
					<a itemprop="telephone" href="tel:<?php echo esc_attr( $phone ) ?>"
					   onclick="gtag('event', 'Action', {'event_category': 'Category', 'event_label': 'Label', 'value': 'Value'})">
						<?php echo esc_html( $phone ); ?>
					</a>
				</div>
			<?php else : ?>
				<div>
					<?php echo esc_html( $phone ); ?>
					<br>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</div>
