<?php
/**
 * Services grid section.
 *
 * @package Usmani
 *
 * @var array $args Template args.
 */

$show_header = isset( $args['show_header'] ) ? (bool) $args['show_header'] : true;
$services    = ufc_rows( 'services', ufc_defaults( 'services' ) );
$services_url = get_permalink( get_page_by_path( 'services' ) ) ?: home_url( '/services/' );
$delays      = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3' );
?>
<section class="services-section section-padding">
	<div class="container">
		<?php if ( $show_header ) : ?>
			<div class="text-center mb-5 reveal">
				<div class="section-label"><?php ufc_the_field( 'services_label', ufc_defaults( 'services_label' ) ); ?></div>
				<h2 class="section-title"><?php ufc_the_field( 'services_title', ufc_defaults( 'services_title' ) ); ?></h2>
				<div class="gold-line"></div>
				<p class="section-desc mt-4"><?php ufc_the_field( 'services_desc', ufc_defaults( 'services_desc' ) ); ?></p>
			</div>
		<?php endif; ?>
		<div class="row g-4">
			<?php foreach ( $services as $i => $service ) : ?>
				<div class="col-md-6 col-lg-4 reveal <?php echo esc_attr( $delays[ $i % 3 ] ); ?>">
					<div class="service-card">
						<div class="service-card-img">
							<img src="<?php echo esc_url( ufc_resolve_image( $service['image'] ?? '' ) ); ?>" alt="<?php echo esc_attr( $service['title'] ?? '' ); ?>">
						</div>
						<div class="service-card-body">
							<span class="service_title"><?php echo esc_html( $service['title'] ?? '' ); ?></span>
							<p><?php echo esc_html( $service['text'] ?? '' ); ?></p>
							<?php if ( $show_header ) : ?>
								<a class="btn-service" href="<?php echo esc_url( $services_url ); ?>">
									<?php esc_html_e( 'Learn More', 'usmani' ); ?> <i class="fas fa-arrow-right"></i>
								</a>
							<?php else : ?>
								<span class="btn-service"><?php esc_html_e( 'Learn More', 'usmani' ); ?> <i class="fas fa-arrow-right"></i></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
