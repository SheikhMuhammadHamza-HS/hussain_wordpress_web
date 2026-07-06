<?php
/**
 * Template Name: Contact Page
 * Template for the Contact page.
 *
 * @package Usmani
 */

get_header();

$hero_image = ufc_image_url( 'contact_hero_image', ufc_defaults( 'contact_hero_image' ) );
?>

<main class="page-fade-in">
	<?php
	get_template_part(
		'template-parts/page',
		'hero',
		array(
			'label' => __( 'Contact Us', 'usmani' ),
			'title' => ufc_field( 'contact_hero_title', ufc_defaults( 'contact_hero_title' ) ),
			'desc'  => ufc_field( 'contact_hero_desc', ufc_defaults( 'contact_hero_desc' ) ),
			'image' => $hero_image,
		)
	);

	get_template_part( 'template-parts/section', 'contact' );
	?>
</main>

<?php
get_footer();
