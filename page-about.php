<?php
/**
 * About page template (slug: about).
 * Template Name: About Page
 *
 * @package Usmani
 */

get_header();

$about_image = ufc_image_url( 'about_image', ufc_defaults( 'about_image' ) );
$values      = ufc_rows( 'values', ufc_defaults( 'values' ) );
$delays      = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3', 'reveal-delay-4' );
?>

<main class="page-fade-in">
	<?php
	get_template_part(
		'template-parts/page',
		'hero',
		array(
			'label' => ufc_field( 'about_label', ufc_defaults( 'about_label' ) ),
			'title' => ufc_field( 'about_title', ufc_defaults( 'about_title' ) ),
			'image' => $about_image,
		)
	);
	?>

	<section class="about-section section-padding">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-xl-7 reveal reveal-delay-2">
					<div class="about-text">
						<div class="section-label"><?php ufc_the_field( 'about_page_label', ufc_defaults( 'about_page_label' ) ); ?></div>
						<h2 class="section-title"><?php ufc_the_field( 'about_page_title', ufc_defaults( 'about_page_title' ) ); ?></h2>
						<div class="gold-line" style="margin:16px 0 24px"></div>
						<?php echo wp_kses_post( ufc_field( 'about_page_body', ufc_defaults( 'about_page_body' ) ) ); ?>
					</div>
				</div>
				<div class="col-xl-5 reveal">
					<div class="about-image-wrapper">
						<img src="<?php echo esc_url( $about_image ); ?>" alt="<?php esc_attr_e( 'About Us', 'usmani' ); ?>">
						<div class="about-experience-badge">
							<div class="number"><?php ufc_the_field( 'about_years', ufc_defaults( 'about_years' ) ); ?></div>
							<div class="label"><?php ufc_the_field( 'about_years_label', ufc_defaults( 'about_years_label' ) ); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-padding" style="background:var(--gray-50)">
		<div class="container">
			<div class="row g-4">
				<div class="col-md-6 reveal reveal-delay-1">
					<div class="about-card" style="padding:36px">
						<div class="about-card-icon" style="width:64px;height:64px;font-size:1.4rem"><i class="fas fa-lightbulb"></i></div>
						<div>
							<h5 style="font-size:1.1rem;margin-bottom:12px"><?php esc_html_e( 'OUR MISSION', 'usmani' ); ?></h5>
							<p style="font-size:.95rem;line-height:1.8"><?php ufc_the_field( 'about_mission_full', ufc_defaults( 'about_mission_full' ) ); ?></p>
						</div>
					</div>
				</div>
				<div class="col-md-6 reveal reveal-delay-2">
					<div class="about-card" style="padding:36px">
						<div class="about-card-icon" style="width:64px;height:64px;font-size:1.4rem"><i class="bi bi-bookmark-heart-fill"></i></div>
						<div>
							<h5 style="font-size:1.1rem;margin-bottom:12px"><?php esc_html_e( 'OUR VISION', 'usmani' ); ?></h5>
							<p style="font-size:.95rem;line-height:1.8"><?php ufc_the_field( 'about_vision_full', ufc_defaults( 'about_vision_full' ) ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-padding">
		<div class="container">
			<div class="text-center mb-5 reveal">
				<div class="section-label"><?php esc_html_e( 'Our Values', 'usmani' ); ?></div>
				<h2 class="section-title"><?php esc_html_e( 'What We Stand For', 'usmani' ); ?></h2>
				<div class="gold-line"></div>
			</div>
			<div class="row g-4">
				<?php foreach ( $values as $i => $value ) : ?>
					<div class="col-md-6 col-lg-3 reveal <?php echo esc_attr( $delays[ $i % 4 ] ); ?>">
						<div class="about-values-card">
							<div class="val-icon"><i class="<?php echo esc_attr( $value['icon'] ?? 'fas fa-star' ); ?>"></i></div>
							<h5><?php echo esc_html( $value['title'] ?? '' ); ?></h5>
							<p><?php echo esc_html( $value['text'] ?? '' ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php
	get_template_part(
		'template-parts/section',
		'team',
		array(
			'desc_key' => 'team_desc_full',
			'bg_gray'  => true,
		)
	);
	?>
</main>

<?php
get_footer();
