<?php
/**
 * Theme footer.
 *
 * @package Usmani
 */

$footer_logo = ufc_image_url( 'footer_logo', ufc_defaults( 'footer_logo' ), 'medium', 'option' );
?>
<footer class="main-footer section-padding">
	<div class="container">
		<div class="row g-5">
			<div class="col-md-12 col-xl-4">
				<div class="footer-logo">
					<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<p><?php ufc_the_field( 'footer_about', ufc_defaults( 'footer_about' ), 'option' ); ?></p>
					<div class="footer-social">
						<a href="<?php echo esc_url( ufc_field( 'social_facebook', ufc_defaults( 'social_facebook' ), 'option' ) ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
						<a href="<?php echo esc_url( ufc_field( 'social_twitter', ufc_defaults( 'social_twitter' ), 'option' ) ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
						<a href="<?php echo esc_url( ufc_field( 'social_instagram', ufc_defaults( 'social_instagram' ), 'option' ) ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
						<a href="<?php echo esc_url( ufc_field( 'social_linkedin', ufc_defaults( 'social_linkedin' ), 'option' ) ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-xl-4">
				<div>
					<h4 class="footer-heading"><?php esc_html_e( 'Quick Links', 'usmani' ); ?></h4>
					<div class="footer-links">
						<?php
						if ( has_nav_menu( 'footer' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'container'      => false,
									'items_wrap'     => '%3$s',
									'fallback_cb'    => false,
									'walker'         => new UFC_Footer_Walker(),
								)
							);
						} else {
							ufc_fallback_footer_links();
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-xl-4">
				<div>
					<h4 class="footer-heading"><?php esc_html_e( 'Contact Info', 'usmani' ); ?></h4>
					<div class="footer-contact-item">
						<i class="fas fa-map-marker-alt"></i>
						<p><?php ufc_the_field( 'contact_address', ufc_defaults( 'contact_address' ), 'option' ); ?></p>
					</div>
					<div class="footer-contact-item">
						<i class="fas fa-envelope"></i>
						<p><?php ufc_the_field( 'contact_email', ufc_defaults( 'contact_email' ), 'option' ); ?></p>
					</div>
					<div class="footer-contact-item">
						<i class="fa fa-phone-alt"></i>
						<p><?php ufc_the_field( 'contact_phone', ufc_defaults( 'contact_phone' ), 'option' ); ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom text-center">
			<p><?php echo esc_html( ufc_field( 'copyright', ufc_defaults( 'copyright' ), 'option' ) ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
