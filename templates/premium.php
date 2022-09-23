<?php

$attachmentID  = carbon_get_post_meta( get_the_ID(), 'pj_image' );
$attachmentURL = wp_get_attachment_url( $attachmentID );
$businessName  = get_the_title();
$street        = carbon_get_post_meta( get_the_ID(), 'pj_street' );
$city          = carbon_get_post_meta( get_the_ID(), 'pj_city' );
$state         = carbon_get_post_meta( get_the_ID(), 'pj_state' );
$zip           = carbon_get_post_meta( get_the_ID(), 'pj_zip' );
$phone         = carbon_get_post_meta( get_the_ID(), 'pj_phone' );
$email         = carbon_get_post_meta( get_the_ID(), 'pj_email' );
$website       = carbon_get_post_meta( get_the_ID(), 'pj_website' );
$facebook      = carbon_get_post_meta( get_the_ID(), 'pj_facebook' );
$instagram     = carbon_get_post_meta( get_the_ID(), 'pj_instagram' );
$linkedin      = carbon_get_post_meta( get_the_ID(), 'pj_linkedin' );
$pinterest     = carbon_get_post_meta( get_the_ID(), 'pj_pinterest' );
$twitter       = carbon_get_post_meta( get_the_ID(), 'pj_twitter' );
$youtube       = carbon_get_post_meta( get_the_ID(), 'pj_youtube' );
?>

<div>
	<div
			class="pj-business-card premium"
			itemscope itemtype="https://schema.org/Organization"
	>
		<div>

			<?php if ( $attachmentURL ) : ?>
				<img
						class="pj-business-img"
						itemprop="logo"
						src="<?php echo esc_url( $attachmentURL ); ?>"
						alt="<?php echo esc_attr__( $businessName . ' logo' ); ?>"
				>
			<?php endif; ?>

			<div class="pj-business-title premium">
				<?php the_title(); ?>
			</div>

		</div>

		<div>

			<div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">

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
						<span itemprop="addressRegion"><?php echo esc_html( $state ); ?></span>
					<?php endif; ?>

					<?php if ( $zip ) : ?>
						<span itemprop="postalCode"><?php echo esc_html( $zip ); ?></span>
					<?php endif; ?>

				</div>
			</div>

			<?php if ( $phone ) : ?>
				<div>
					<a

							itemprop="telephone"
							href="tel:<?php echo esc_attr( $phone ) ?>"
							onclick="gtag('event', 'pj_click', {'event_category': 'Phone Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
					>
						<?php echo esc_html( $phone ); ?>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( $website ) : ?>
				<div>
					<a

							itemprop="url"
							class="pj-website-link"
							href="<?php echo esc_url( $website ); ?>"
							onclick="gtag('event', 'pj_click', {'event_category': 'Website Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
							target="_blank"
					>

						<?php echo '<div>' . esc_html__( 'Website' ) . '</div>'; ?>

					</a>
				</div>
			<?php endif; ?>

			<?php if ( $email ) : ?>
				<div>
					<a
							itemprop="email"
							class="pj-website-email"
							href="<?php echo esc_url( "mailto:$email" ); ?>"
							onclick="gtag('event', 'pj_click', {'event_category': 'Email Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
					>
						<?php echo esc_html( $email ); ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="pj-social-container">

				<?php if ( $facebook ) : ?>
					<div>
						<a
								itemprop="sameAs"
								href="<?php echo esc_url( $facebook ); ?>"
								onclick="gtag('event', 'pj_click', {'event_category': 'Social Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
						>
							<?php echo file_get_contents( PJ_PLUGIN_DIR . '/assets/images/Facebook.svg' ); ?>
							<span class="pj-screen-reader-text"><?php esc_html_e( 'Facebook' ); ?></span>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( $instagram ) : ?>
					<div>
						<a
								itemprop="sameAs"
								href="<?php echo esc_url( $instagram ); ?>"
								onclick="gtag('event', 'pj_click', {'event_category': 'Social Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
						>
							<?php echo file_get_contents( PJ_PLUGIN_DIR . '/assets/images/Instagram.svg' ); ?>
							<span class="pj-screen-reader-text"><?php esc_html_e( 'Instagram' ); ?></span>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( $linkedin ) : ?>
					<div>
						<a
								itemprop="sameAs"
								href="<?php echo esc_url( $linkedin ); ?>"
								onclick="gtag('event', 'pj_click', {'event_category': 'Social Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
						>
							<?php echo file_get_contents( PJ_PLUGIN_DIR . '/assets/images/LinkedIn.svg' ); ?>
							<span class="pj-screen-reader-text"><?php esc_html_e( 'LinkedIn' ); ?></span>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( $pinterest ) : ?>
					<div>
						<a
								itemprop="sameAs"
								href="<?php echo esc_url( $pinterest ); ?>"
								onclick="gtag('event', 'pj_click', {'event_category': 'Social Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
						>
							<?php echo file_get_contents( PJ_PLUGIN_DIR . '/assets/images/Pinterest.svg' ); ?>
							<span class="pj-screen-reader-text"><?php esc_html_e( 'Pinterest' ); ?></span>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( $twitter ) : ?>
					<div>
						<a
								itemprop="sameAs"
								href="<?php echo esc_url( $twitter ); ?>"
								onclick="gtag('event', 'pj_click', {'event_category': 'Social Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
						>
							<?php echo file_get_contents( PJ_PLUGIN_DIR . '/assets/images/Twitter.svg' ); ?>
							<span class="pj-screen-reader-text"><?php esc_html_e( 'Twitter' ); ?></span>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( $youtube ) : ?>
					<div>
						<a
								itemprop="sameAs"
								href="<?php echo esc_url( $youtube ); ?>"
								onclick="gtag('event', 'pj_click', {'event_category': 'Social Link', 'event_label': this.text.replaceAll('\t', '').replaceAll('\n', ''), 'value': this.getAttribute('href')});"
						>
							<?php echo file_get_contents( PJ_PLUGIN_DIR . '/assets/images/Youtube.svg' ); ?>
							<span class="pj-screen-reader-text"><?php esc_html_e( 'YouTube' ); ?></span>
						</a>
					</div>
				<?php endif; ?>

			</div>
		</div>

	</div>

</div>
