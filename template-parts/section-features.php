<?php
/**
 * Features grid section.
 *
 * @package Usmani
 *
 * @var array $args Template args.
 */

$show_desc = isset( $args['show_desc'] ) ? (bool) $args['show_desc'] : true;
$features  = ufc_rows( 'features', ufc_defaults( 'features' ) );
$delays    = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3', 'reveal-delay-4' );
?>
<section class="features-section section-padding">
	<div class="container">
		<div class="text-center mb-5 reveal">
			<div class="section-label"><?php ufc_the_field( 'features_label', ufc_defaults( 'features_label' ) ); ?></div>
			<h2 class="section-title"><?php ufc_the_field( 'features_title', ufc_defaults( 'features_title' ) ); ?></h2>
			<div class="gold-line"></div>
			<?php if ( $show_desc ) : ?>
				<p class="section-desc mt-4"><?php ufc_the_field( 'features_desc', ufc_defaults( 'features_desc' ) ); ?></p>
			<?php endif; ?>
		</div>
		<div class="row g-4">
			<?php foreach ( $features as $i => $feature ) : ?>
				<div class="col-md-6 col-lg-3 reveal <?php echo esc_attr( $delays[ $i % 4 ] ); ?>">
					<div class="feature-card">
						<img src="<?php echo esc_url( ufc_resolve_image( $feature['icon'] ?? '' ) ); ?>" alt="">
						<h4><?php echo esc_html( $feature['title'] ?? '' ); ?></h4>
						<p><?php echo esc_html( $feature['text'] ?? '' ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
