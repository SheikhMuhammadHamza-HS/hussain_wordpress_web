<?php
/**
 * Inner page hero banner.
 *
 * @package Usmani
 *
 * @var array $args Required: label, title. Optional: desc, image.
 */

$label = $args['label'] ?? '';
$title = $args['title'] ?? '';
$desc  = $args['desc'] ?? '';
$image = $args['image'] ?? '';
?>
<div class="page-hero">
	<div class="page-hero-bg" style="background-image:url('<?php echo esc_url( $image ); ?>')"></div>
	<div class="page-hero-overlay"></div>
	<div class="page-hero-content">
		<?php if ( $label ) : ?>
			<div class="section-label"><?php echo esc_html( $label ); ?></div>
		<?php endif; ?>
		<h1><?php echo esc_html( $title ); ?></h1>
		<div class="gold-line"></div>
		<?php if ( $desc ) : ?>
			<p><?php echo esc_html( $desc ); ?></p>
		<?php endif; ?>
	</div>
</div>
