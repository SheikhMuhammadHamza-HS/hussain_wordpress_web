<?php
/**
 * Training tabs section.
 *
 * @package Usmani
 */

$training = ufc_rows( 'training', ufc_defaults( 'training' ) );
$tab_ids  = array( 'tabWorkshop', 'tabConsultation', 'tabLearning' );
?>
<section class="training-section section-padding">
	<div class="container">
		<div class="text-center mb-5 reveal">
			<div class="section-label"><?php ufc_the_field( 'training_label', ufc_defaults( 'training_label' ) ); ?></div>
			<h2 class="section-title"><?php ufc_the_field( 'training_title', ufc_defaults( 'training_title' ) ); ?></h2>
			<div class="gold-line"></div>
		</div>
		<div class="row g-4 align-items-stretch">
			<div class="col-xl-5 reveal">
				<div class="training-pills">
					<?php foreach ( $training as $i => $item ) : ?>
						<?php
						$tab_id = isset( $tab_ids[ $i ] ) ? $tab_ids[ $i ] : 'tabTraining' . $i;
						$icon   = $item['icon'] ?? 'fas fa-circle';
						?>
						<a class="training-pill<?php echo 0 === $i ? ' active' : ''; ?>" href="#" onclick="switchTrainingTab(this,'<?php echo esc_js( $tab_id ); ?>');return false;">
							<h5><i class="<?php echo esc_attr( $icon ); ?> me-2" style="color:var(--gold-500)"></i><?php echo esc_html( $item['title'] ?? '' ); ?></h5>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-xl-7 reveal reveal-delay-2">
				<div class="training-content-area">
					<?php foreach ( $training as $i => $item ) : ?>
						<?php $tab_id = isset( $tab_ids[ $i ] ) ? $tab_ids[ $i ] : 'tabTraining' . $i; ?>
						<div id="<?php echo esc_attr( $tab_id ); ?>" class="tab-pane<?php echo 0 === $i ? ' active' : ''; ?>">
							<div class="training-content-inner">
								<img src="<?php echo esc_url( ufc_resolve_image( $item['image'] ?? '' ) ); ?>" alt="">
								<div class="training-text-area">
									<h3><?php echo esc_html( $item['title'] ?? '' ); ?></h3>
									<p><?php echo esc_html( $item['text'] ?? '' ); ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
