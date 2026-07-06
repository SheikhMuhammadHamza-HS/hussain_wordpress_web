<?php
/**
 * Contact page content.
 *
 * @package Usmani
 */

$form_sent = isset( $_GET['contact'] ) && 'sent' === $_GET['contact']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
?>
<section class="section-padding">
	<div class="container">
		<div class="row g-4 mb-5">
			<div class="col-md-6 col-lg-3 reveal reveal-delay-1">
				<div class="contact-info-card">
					<div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
					<h5><?php esc_html_e( 'Our Office', 'usmani' ); ?></h5>
					<p><?php ufc_the_field( 'contact_address', ufc_defaults( 'contact_address' ), 'option' ); ?></p>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 reveal reveal-delay-2">
				<div class="contact-info-card">
					<div class="icon-circle"><i class="fas fa-envelope"></i></div>
					<h5><?php esc_html_e( 'Email Us', 'usmani' ); ?></h5>
					<p><?php ufc_the_field( 'contact_email', ufc_defaults( 'contact_email' ), 'option' ); ?></p>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 reveal reveal-delay-3">
				<div class="contact-info-card">
					<div class="icon-circle"><i class="fa fa-phone-alt"></i></div>
					<h5><?php esc_html_e( 'Call Us', 'usmani' ); ?></h5>
					<p><?php ufc_the_field( 'contact_phone', ufc_defaults( 'contact_phone' ), 'option' ); ?></p>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 reveal reveal-delay-4">
				<div class="contact-info-card">
					<div class="icon-circle"><i class="fas fa-clock"></i></div>
					<h5><?php esc_html_e( 'Working Hours', 'usmani' ); ?></h5>
					<p><?php echo wp_kses_post( ufc_field( 'contact_hours', ufc_defaults( 'contact_hours' ), 'option' ) ); ?></p>
				</div>
			</div>
		</div>

		<div class="row g-5">
			<div class="col-lg-7 reveal">
				<div class="contact-form-wrap">
					<?php if ( $form_sent ) : ?>
						<div id="contactSuccess" style="text-align:center;padding:40px">
							<div style="width:70px;height:70px;background:linear-gradient(135deg,var(--gold-500),var(--gold-300));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:1.8rem;color:var(--navy-900)"><i class="fas fa-check"></i></div>
							<h3 style="color:var(--navy-800);margin-bottom:10px"><?php esc_html_e( 'Message Sent!', 'usmani' ); ?></h3>
							<p style="color:var(--text-muted)"><?php esc_html_e( 'Thank you for reaching out. Our team will get back to you within 24 hours.', 'usmani' ); ?></p>
						</div>
					<?php else : ?>
						<div class="section-label"><?php esc_html_e( 'Send a Message', 'usmani' ); ?></div>
						<h3 class="section-title" style="font-size:1.6rem;margin-bottom:8px"><?php esc_html_e( "We'd Love to Hear From You", 'usmani' ); ?></h3>
						<div class="gold-line" style="margin:0 0 30px"></div>
						<form id="contactForm" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
							<input type="hidden" name="action" value="ufc_contact">
							<?php wp_nonce_field( 'ufc_contact', 'ufc_contact_nonce' ); ?>
							<div class="row g-3">
								<div class="col-md-6">
									<label class="form-label"><?php esc_html_e( 'Full Name *', 'usmani' ); ?></label>
									<input type="text" name="ufc_name" class="form-control" placeholder="<?php esc_attr_e( 'Your name', 'usmani' ); ?>" required>
								</div>
								<div class="col-md-6">
									<label class="form-label"><?php esc_html_e( 'Email Address *', 'usmani' ); ?></label>
									<input type="email" name="ufc_email" class="form-control" placeholder="your@email.com" required>
								</div>
								<div class="col-md-6">
									<label class="form-label"><?php esc_html_e( 'Phone Number', 'usmani' ); ?></label>
									<input type="tel" name="ufc_phone" class="form-control" placeholder="+44 xxx xxx xxxx">
								</div>
								<div class="col-md-6">
									<label class="form-label"><?php esc_html_e( 'Subject *', 'usmani' ); ?></label>
									<select name="ufc_subject" class="form-select" required>
										<option value=""><?php esc_html_e( 'Select a topic', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Product Development', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Islamic Finance Consultancy', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Sharia Review & Audit', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Corporate Restructuring', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Corporate Governance', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Sukuk Structuring', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Training & Development', 'usmani' ); ?></option>
										<option><?php esc_html_e( 'Other', 'usmani' ); ?></option>
									</select>
								</div>
								<div class="col-12">
									<label class="form-label"><?php esc_html_e( 'Your Message *', 'usmani' ); ?></label>
									<textarea name="ufc_message" class="form-control" placeholder="<?php esc_attr_e( 'Tell us about your requirements...', 'usmani' ); ?>" required></textarea>
								</div>
								<div class="col-12">
									<button type="submit" class="btn-gold" style="border:none">
										<?php esc_html_e( 'Send Message', 'usmani' ); ?> <i class="fas fa-paper-plane ms-2"></i>
									</button>
								</div>
							</div>
						</form>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-5 reveal reveal-delay-2">
				<div style="background:var(--navy-800);border-radius:var(--radius-lg);padding:40px;height:100%;display:flex;flex-direction:column;justify-content:center">
					<div class="section-label" style="justify-content:center"><?php esc_html_e( 'Why Contact Us', 'usmani' ); ?></div>
					<h3 style="color:var(--white);font-size:1.5rem;text-align:center;margin-bottom:24px"><?php esc_html_e( 'Your Islamic Finance Journey Starts Here', 'usmani' ); ?></h3>
					<div style="display:flex;flex-direction:column;gap:20px">
						<?php
						$reasons = array(
							array(
								'title' => __( 'Free Initial Consultation', 'usmani' ),
								'text'  => __( 'Get expert advice at no cost to understand your Shariah-compliant options.', 'usmani' ),
							),
							array(
								'title' => __( 'Tailored Solutions', 'usmani' ),
								'text'  => __( 'Every solution is customized to your unique financial needs and goals.', 'usmani' ),
							),
							array(
								'title' => __( 'Global Expertise', 'usmani' ),
								'text'  => __( 'Benefit from our worldwide network of Islamic finance professionals.', 'usmani' ),
							),
							array(
								'title' => __( 'Quick Response', 'usmani' ),
								'text'  => __( 'Our team responds within 24 hours to all inquiries.', 'usmani' ),
							),
						);
						foreach ( $reasons as $reason ) :
							?>
							<div style="display:flex;gap:16px;align-items:flex-start">
								<div style="width:40px;height:40px;background:rgba(201,168,76,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--gold-400)"><i class="fas fa-check"></i></div>
								<div>
									<h5 style="font-family:'Inter';font-size:.9rem;color:var(--white);margin-bottom:4px"><?php echo esc_html( $reason['title'] ); ?></h5>
									<p style="font-size:.85rem;color:rgba(255,255,255,0.55);margin:0"><?php echo esc_html( $reason['text'] ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div style="margin-top:30px;text-align:center">
						<div class="footer-social" style="justify-content:center">
							<a href="<?php echo esc_url( ufc_field( 'social_facebook', ufc_defaults( 'social_facebook' ), 'option' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
							<a href="<?php echo esc_url( ufc_field( 'social_twitter', ufc_defaults( 'social_twitter' ), 'option' ) ); ?>"><i class="fab fa-twitter"></i></a>
							<a href="<?php echo esc_url( ufc_field( 'social_instagram', ufc_defaults( 'social_instagram' ), 'option' ) ); ?>"><i class="fab fa-instagram"></i></a>
							<a href="<?php echo esc_url( ufc_field( 'social_linkedin', ufc_defaults( 'social_linkedin' ), 'option' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
