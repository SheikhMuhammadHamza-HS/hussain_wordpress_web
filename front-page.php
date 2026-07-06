<?php
/**
 * Front page template.
 *
 * @package Usmani
 */

get_header();
?>

<main class="page-fade-in">
	<?php
	get_template_part( 'template-parts/section', 'hero' );
	get_template_part( 'template-parts/section', 'about-preview' );
	get_template_part( 'template-parts/section', 'services' );
	get_template_part( 'template-parts/section', 'features' );
	get_template_part( 'template-parts/section', 'team' );
	get_template_part( 'template-parts/section', 'training' );
	get_template_part( 'template-parts/section', 'testimonials' );
	?>
</main>

<?php
get_footer();
