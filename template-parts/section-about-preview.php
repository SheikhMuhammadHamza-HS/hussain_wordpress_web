<?php
/**
 * About preview section (home page).
 *
 * @package Usmani
 */

$about_image = ufc_image_url( 'about_image', ufc_defaults( 'about_image' ) );
?>
<section class="about-section section-padding" id="homeAboutSection">
	<div class="container">
		<div class="row g-5 align-items-center">
			<div class="col-xl-7 reveal reveal-delay-2">
				<div class="about-text">
					<div class="section-label"><?php ufc_the_field( 'about_label', ufc_defaults( 'about_label' ) ); ?></div>
					<h2 class="section-title"><?php ufc_the_field( 'about_title', ufc_defaults( 'about_title' ) ); ?></h2>
					<div class="gold-line" style="margin:16px 0 24px"></div>
					<p><?php ufc_the_field( 'about_text', ufc_defaults( 'about_text' ) ); ?></p>
					<div class="row g-3">
						<div class="col-md-6">
							<div class="about-card">
								<div class="about-card-icon"><i class="fas fa-lightbulb"></i></div>
								<div>
									<h5><?php esc_html_e( 'OUR MISSION', 'usmani' ); ?></h5>
									<p><?php ufc_the_field( 'about_mission', ufc_defaults( 'about_mission' ) ); ?></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="about-card">
								<div class="about-card-icon"><i class="bi bi-bookmark-heart-fill"></i></div>
								<div>
									<h5><?php esc_html_e( 'OUR VISION', 'usmani' ); ?></h5>
									<p><?php ufc_the_field( 'about_vision', ufc_defaults( 'about_vision' ) ); ?></p>
								</div>
							</div>
						</div>
					</div>
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
