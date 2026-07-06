<?php
/**
 * Team section.
 *
 * @package Usmani
 *
 * @var array $args Template args.
 */

$desc_key = isset( $args['desc_key'] ) ? $args['desc_key'] : 'team_desc';
$team     = ufc_rows( 'team', ufc_defaults( 'team' ) );
$delays   = array( 'reveal-delay-1', 'reveal-delay-2', 'reveal-delay-3' );
?>
<section class="team-section section-padding"<?php echo ! empty( $args['bg_gray'] ) ? ' style="background:var(--gray-50)"' : ''; ?>>
	<div class="container">
		<div class="text-center mb-5 reveal">
			<div class="section-label"><?php ufc_the_field( 'team_label', ufc_defaults( 'team_label' ) ); ?></div>
			<h2 class="section-title"><?php ufc_the_field( 'team_title', ufc_defaults( 'team_title' ) ); ?></h2>
			<div class="gold-line"></div>
			<p class="section-desc mt-4"><?php echo esc_html( ufc_field( $desc_key, ufc_defaults( $desc_key ) ) ); ?></p>
		</div>
		<div class="row g-4 justify-content-center">
			<?php foreach ( $team as $i => $member ) : ?>
				<div class="col-md-6 col-lg-4 reveal <?php echo esc_attr( $delays[ $i % 3 ] ); ?>">
					<div class="team-card">
						<div class="team-card-img">
							<img src="<?php echo esc_url( ufc_resolve_image( $member['image'] ?? '' ) ); ?>" alt="<?php echo esc_attr( $member['name'] ?? '' ); ?>">
						</div>
						<div class="team-card-body">
							<h4><?php echo esc_html( $member['name'] ?? '' ); ?></h4>
							<span><?php echo esc_html( $member['role'] ?? '' ); ?></span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
