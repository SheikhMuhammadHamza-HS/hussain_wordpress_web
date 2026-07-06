<?php
/**
 * Template Name: Services Page
 * Template for the Services page.
 *
 * @package Usmani
 */

get_header();

$hero_image = ufc_image_url( 'services_hero_image', ufc_defaults( 'services_hero_image' ) );
?>

<main class="page-fade-in">
	<?php
	get_template_part(
		'template-parts/page',
		'hero',
		array(
			'label' => ufc_field( 'services_label', ufc_defaults( 'services_label' ) ),
			'title' => ufc_field( 'services_hero_title', ufc_defaults( 'services_hero_title' ) ),
			'desc'  => ufc_field( 'services_hero_desc', ufc_defaults( 'services_hero_desc' ) ),
			'image' => $hero_image,
		)
	);

	get_template_part(
		'template-parts/section',
		'services',
		array( 'show_header' => false )
	);

	get_template_part(
		'template-parts/section',
		'features',
		array( 'show_desc' => false )
	);
	?>
</main>

<?php
get_footer();
