<?php
/**
 * Home page hero slider.
 *
 * @package Usmani
 */

$slides        = ufc_rows( 'hero_slides', ufc_defaults( 'hero_slides' ) );
$contact_url   = get_permalink( get_page_by_path( 'contact' ) ) ?: home_url( '/contact/' );
$research_url  = ufc_field( 'hero_research_url', 'https://usmanisfinancialconsultancy.com' );
?>
<section class="hero-section">
	<?php foreach ( $slides as $i => $slide ) : ?>
		<div class="hero-slide<?php echo 0 === $i ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $i ); ?>">
			<img src="<?php echo esc_url( ufc_resolve_image( $slide['image'] ?? '' ) ); ?>" alt="">
		</div>
	<?php endforeach; ?>
	<div class="hero-overlay"></div>
	<div class="container">
		<div class="hero-content">
			<div class="hero-badge">
				<i class="fas fa-star"></i>
				<span><?php ufc_the_field( 'hero_badge', ufc_defaults( 'hero_badge' ) ); ?></span>
				<i class="fas fa-star"></i>
			</div>
			<h1 class="hero-title"><?php echo wp_kses_post( ufc_field( 'hero_title', ufc_defaults( 'hero_title' ) ) ); ?></h1>
			<p class="hero-desc"><?php ufc_the_field( 'hero_desc', ufc_defaults( 'hero_desc' ) ); ?></p>
			<div class="hero-buttons">
				<a class="btn-gold" href="<?php echo esc_url( $contact_url ); ?>">
					<?php esc_html_e( 'Book A Free Consultation', 'usmani' ); ?> <i class="fas fa-arrow-right"></i>
				</a>
				<a class="btn-outline-gold" href="<?php echo esc_url( $research_url ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Research and Publication', 'usmani' ); ?> <i class="fas fa-arrow-right"></i>
				</a>
			</div>
		</div>
	</div>
	<?php if ( count( $slides ) > 1 ) : ?>
		<div class="hero-slide-indicators">
			<?php foreach ( $slides as $i => $slide ) : ?>
				<div class="slide-indicator<?php echo 0 === $i ? ' active' : ''; ?>" data-slide="<?php echo esc_attr( $i ); ?>"></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<a href="#homeAboutSection" class="hero-scroll-down"><span><?php esc_html_e( 'Scroll', 'usmani' ); ?></span><i class="fas fa-chevron-down"></i></a>
</section>
