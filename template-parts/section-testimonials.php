<?php
/**
 * Testimonials section.
 *
 * @package Usmani
 */

$testimonials = ufc_rows( 'testimonials', ufc_defaults( 'testimonials' ) );
$delays       = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3' );
?>
<section class="testimonial-section section-padding">
	<div class="container">
		<div class="text-center mb-5 reveal">
			<div class="section-label"><?php ufc_the_field( 'testimonials_label', ufc_defaults( 'testimonials_label' ) ); ?></div>
			<h2 class="section-title"><?php ufc_the_field( 'testimonials_title', ufc_defaults( 'testimonials_title' ) ); ?></h2>
			<div class="gold-line"></div>
		</div>
		<div class="testimonial-grid">
			<?php foreach ( $testimonials as $i => $item ) : ?>
				<div class="testimonial-card reveal <?php echo esc_attr( $delays[ $i % 3 ] ); ?>">
					<div class="quote-icon"><i class="fas fa-quote-left"></i></div>
					<div class="stars">
						<?php for ( $s = 0; $s < 5; $s++ ) : ?>
							<i class="fas fa-star"></i>
						<?php endfor; ?>
					</div>
					<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
					<h6><?php echo esc_html( $item['name'] ?? '' ); ?></h6>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
