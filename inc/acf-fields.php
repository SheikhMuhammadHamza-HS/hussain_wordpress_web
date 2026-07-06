<?php
/**
 * Register ACF field groups programmatically (when ACF is active).
 *
 * @package Usmani
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register local ACF field groups on init.
 */
function ufc_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// ---- Theme Options (footer, social, global contact) ----
	acf_add_local_field_group(
		array(
			'key'    => 'group_ufc_options',
			'title'  => __( 'Theme Options', 'usmani' ),
			'fields' => array(
				array(
					'key'   => 'field_ufc_footer_about',
					'label' => __( 'Footer About Text', 'usmani' ),
					'name'  => 'footer_about',
					'type'  => 'textarea',
				),
				array(
					'key'           => 'field_ufc_footer_logo',
					'label'         => __( 'Footer Logo', 'usmani' ),
					'name'          => 'footer_logo',
					'type'          => 'image',
					'return_format' => 'array',
				),
				array(
					'key'   => 'field_ufc_copyright',
					'label' => __( 'Copyright Text', 'usmani' ),
					'name'  => 'copyright',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_ufc_social_facebook',
					'label' => __( 'Facebook URL', 'usmani' ),
					'name'  => 'social_facebook',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_ufc_social_twitter',
					'label' => __( 'Twitter URL', 'usmani' ),
					'name'  => 'social_twitter',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_ufc_social_instagram',
					'label' => __( 'Instagram URL', 'usmani' ),
					'name'  => 'social_instagram',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_ufc_social_linkedin',
					'label' => __( 'LinkedIn URL', 'usmani' ),
					'name'  => 'social_linkedin',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_ufc_contact_address',
					'label' => __( 'Contact Address', 'usmani' ),
					'name'  => 'contact_address',
					'type'  => 'textarea',
				),
				array(
					'key'   => 'field_ufc_contact_email',
					'label' => __( 'Contact Email', 'usmani' ),
					'name'  => 'contact_email',
					'type'  => 'email',
				),
				array(
					'key'   => 'field_ufc_contact_phone',
					'label' => __( 'Contact Phone', 'usmani' ),
					'name'  => 'contact_phone',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_ufc_contact_hours',
					'label' => __( 'Working Hours', 'usmani' ),
					'name'  => 'contact_hours',
					'type'  => 'textarea',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'ufc-theme-options',
					),
				),
			),
		)
	);

	// ---- Home Page ----
	acf_add_local_field_group(
		array(
			'key'    => 'group_ufc_home',
			'title'  => __( 'Home Page Sections', 'usmani' ),
			'fields' => ufc_acf_home_fields(),
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
		)
	);

	// ---- About Page ----
	acf_add_local_field_group(
		array(
			'key'    => 'group_ufc_about',
			'title'  => __( 'About Page Content', 'usmani' ),
			'fields' => ufc_acf_about_fields(),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-about.php',
					),
				),
			),
		)
	);

	// ---- Services Page ----
	acf_add_local_field_group(
		array(
			'key'    => 'group_ufc_services_page',
			'title'  => __( 'Services Page Content', 'usmani' ),
			'fields' => ufc_acf_services_page_fields(),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-services.php',
					),
				),
			),
		)
	);

	// ---- Contact Page ----
	acf_add_local_field_group(
		array(
			'key'    => 'group_ufc_contact_page',
			'title'  => __( 'Contact Page Content', 'usmani' ),
			'fields' => ufc_acf_contact_page_fields(),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-contact.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'ufc_register_acf_fields' );

/**
 * Register ACF options page.
 */
function ufc_acf_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}
	acf_add_options_page(
		array(
			'page_title' => __( 'Theme Options', 'usmani' ),
			'menu_title' => __( 'Theme Options', 'usmani' ),
			'menu_slug'  => 'ufc-theme-options',
			'capability' => 'edit_theme_options',
			'redirect'   => false,
		)
	);
}
add_action( 'acf/init', 'ufc_acf_options_page' );

/**
 * Shared repeater sub-fields.
 *
 * @return array
 */
function ufc_acf_service_repeater() {
	return array(
		'key'        => 'field_ufc_services',
		'label'      => __( 'Services', 'usmani' ),
		'name'       => 'services',
		'type'       => 'repeater',
		'layout'     => 'block',
		'sub_fields' => array(
			array(
				'key'           => 'field_ufc_service_image',
				'label'         => __( 'Image', 'usmani' ),
				'name'          => 'image',
				'type'          => 'image',
				'return_format' => 'array',
			),
			array(
				'key'   => 'field_ufc_service_title',
				'label' => __( 'Title', 'usmani' ),
				'name'  => 'title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_ufc_service_text',
				'label' => __( 'Description', 'usmani' ),
				'name'  => 'text',
				'type'  => 'textarea',
			),
		),
	);
}

/**
 * @return array
 */
function ufc_acf_feature_repeater() {
	return array(
		'key'        => 'field_ufc_features',
		'label'      => __( 'Features', 'usmani' ),
		'name'       => 'features',
		'type'       => 'repeater',
		'layout'     => 'block',
		'sub_fields' => array(
			array(
				'key'           => 'field_ufc_feature_icon',
				'label'         => __( 'Icon', 'usmani' ),
				'name'          => 'icon',
				'type'          => 'image',
				'return_format' => 'array',
			),
			array(
				'key'   => 'field_ufc_feature_title',
				'label' => __( 'Title', 'usmani' ),
				'name'  => 'title',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_ufc_feature_text',
				'label' => __( 'Description', 'usmani' ),
				'name'  => 'text',
				'type'  => 'textarea',
			),
		),
	);
}

/**
 * @return array
 */
function ufc_acf_team_repeater() {
	return array(
		'key'        => 'field_ufc_team',
		'label'      => __( 'Team Members', 'usmani' ),
		'name'       => 'team',
		'type'       => 'repeater',
		'layout'     => 'block',
		'sub_fields' => array(
			array(
				'key'           => 'field_ufc_team_image',
				'label'         => __( 'Photo', 'usmani' ),
				'name'          => 'image',
				'type'          => 'image',
				'return_format' => 'array',
			),
			array(
				'key'   => 'field_ufc_team_name',
				'label' => __( 'Name', 'usmani' ),
				'name'  => 'name',
				'type'  => 'text',
			),
			array(
				'key'   => 'field_ufc_team_role',
				'label' => __( 'Role', 'usmani' ),
				'name'  => 'role',
				'type'  => 'text',
			),
		),
	);
}

/**
 * @return array
 */
function ufc_acf_home_fields() {
	return array(
		array(
			'key'   => 'field_ufc_hero_tab',
			'label' => __( 'Hero', 'usmani' ),
			'type'  => 'tab',
		),
		array(
			'key'   => 'field_ufc_hero_badge',
			'label' => __( 'Hero Badge', 'usmani' ),
			'name'  => 'hero_badge',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_hero_title',
			'label' => __( 'Hero Title (HTML allowed for gold span)', 'usmani' ),
			'name'  => 'hero_title',
			'type'  => 'textarea',
		),
		array(
			'key'   => 'field_ufc_hero_desc',
			'label' => __( 'Hero Description', 'usmani' ),
			'name'  => 'hero_desc',
			'type'  => 'textarea',
		),
		array(
			'key'   => 'field_ufc_hero_research_url',
			'label' => __( 'Research Button URL', 'usmani' ),
			'name'  => 'hero_research_url',
			'type'  => 'url',
		),
		array(
			'key'        => 'field_ufc_hero_slides',
			'label'      => __( 'Hero Slides', 'usmani' ),
			'name'       => 'hero_slides',
			'type'       => 'repeater',
			'layout'     => 'table',
			'sub_fields' => array(
				array(
					'key'           => 'field_ufc_hero_slide_image',
					'label'         => __( 'Image', 'usmani' ),
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
				),
			),
		),
		array(
			'key'   => 'field_ufc_about_tab',
			'label' => __( 'About Preview', 'usmani' ),
			'type'  => 'tab',
		),
		array(
			'key'   => 'field_ufc_about_label',
			'label' => __( 'Section Label', 'usmani' ),
			'name'  => 'about_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_about_title',
			'label' => __( 'Section Title', 'usmani' ),
			'name'  => 'about_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_about_text',
			'label' => __( 'About Text', 'usmani' ),
			'name'  => 'about_text',
			'type'  => 'textarea',
		),
		array(
			'key'           => 'field_ufc_about_image',
			'label'         => __( 'About Image', 'usmani' ),
			'name'          => 'about_image',
			'type'          => 'image',
			'return_format' => 'array',
		),
		array(
			'key'   => 'field_ufc_about_years',
			'label' => __( 'Years Badge Number', 'usmani' ),
			'name'  => 'about_years',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_about_years_label',
			'label' => __( 'Years Badge Label', 'usmani' ),
			'name'  => 'about_years_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_about_mission',
			'label' => __( 'Mission', 'usmani' ),
			'name'  => 'about_mission',
			'type'  => 'textarea',
		),
		array(
			'key'   => 'field_ufc_about_vision',
			'label' => __( 'Vision', 'usmani' ),
			'name'  => 'about_vision',
			'type'  => 'textarea',
		),
		array(
			'key'   => 'field_ufc_services_tab',
			'label' => __( 'Services', 'usmani' ),
			'type'  => 'tab',
		),
		array(
			'key'   => 'field_ufc_services_label',
			'label' => __( 'Section Label', 'usmani' ),
			'name'  => 'services_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_services_title',
			'label' => __( 'Section Title', 'usmani' ),
			'name'  => 'services_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_services_desc',
			'label' => __( 'Section Description', 'usmani' ),
			'name'  => 'services_desc',
			'type'  => 'textarea',
		),
		ufc_acf_service_repeater(),
		array(
			'key'   => 'field_ufc_features_tab',
			'label' => __( 'Features', 'usmani' ),
			'type'  => 'tab',
		),
		array(
			'key'   => 'field_ufc_features_label',
			'label' => __( 'Section Label', 'usmani' ),
			'name'  => 'features_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_features_title',
			'label' => __( 'Section Title', 'usmani' ),
			'name'  => 'features_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_features_desc',
			'label' => __( 'Section Description', 'usmani' ),
			'name'  => 'features_desc',
			'type'  => 'textarea',
		),
		ufc_acf_feature_repeater(),
		array(
			'key'   => 'field_ufc_team_tab',
			'label' => __( 'Team', 'usmani' ),
			'type'  => 'tab',
		),
		array(
			'key'   => 'field_ufc_team_label',
			'label' => __( 'Section Label', 'usmani' ),
			'name'  => 'team_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_team_title',
			'label' => __( 'Section Title', 'usmani' ),
			'name'  => 'team_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_team_desc',
			'label' => __( 'Section Description', 'usmani' ),
			'name'  => 'team_desc',
			'type'  => 'textarea',
		),
		ufc_acf_team_repeater(),
		array(
			'key'   => 'field_ufc_training_tab',
			'label' => __( 'Training', 'usmani' ),
			'type'  => 'tab',
		),
		array(
			'key'   => 'field_ufc_training_label',
			'label' => __( 'Section Label', 'usmani' ),
			'name'  => 'training_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_training_title',
			'label' => __( 'Section Title', 'usmani' ),
			'name'  => 'training_title',
			'type'  => 'text',
		),
		array(
			'key'        => 'field_ufc_training',
			'label'      => __( 'Training Items', 'usmani' ),
			'name'       => 'training',
			'type'       => 'repeater',
			'layout'     => 'block',
			'sub_fields' => array(
				array(
					'key'   => 'field_ufc_training_icon',
					'label' => __( 'Icon Class (Font Awesome)', 'usmani' ),
					'name'  => 'icon',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_ufc_training_item_title',
					'label' => __( 'Title', 'usmani' ),
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_ufc_training_image',
					'label'         => __( 'Image', 'usmani' ),
					'name'          => 'image',
					'type'          => 'image',
					'return_format' => 'array',
				),
				array(
					'key'   => 'field_ufc_training_text',
					'label' => __( 'Description', 'usmani' ),
					'name'  => 'text',
					'type'  => 'textarea',
				),
			),
		),
		array(
			'key'   => 'field_ufc_testimonials_tab',
			'label' => __( 'Testimonials', 'usmani' ),
			'type'  => 'tab',
		),
		array(
			'key'   => 'field_ufc_testimonials_label',
			'label' => __( 'Section Label', 'usmani' ),
			'name'  => 'testimonials_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_testimonials_title',
			'label' => __( 'Section Title', 'usmani' ),
			'name'  => 'testimonials_title',
			'type'  => 'text',
		),
		array(
			'key'        => 'field_ufc_testimonials',
			'label'      => __( 'Testimonials', 'usmani' ),
			'name'       => 'testimonials',
			'type'       => 'repeater',
			'layout'     => 'block',
			'sub_fields' => array(
				array(
					'key'   => 'field_ufc_testimonial_text',
					'label' => __( 'Quote', 'usmani' ),
					'name'  => 'text',
					'type'  => 'textarea',
				),
				array(
					'key'   => 'field_ufc_testimonial_name',
					'label' => __( 'Author', 'usmani' ),
					'name'  => 'name',
					'type'  => 'text',
				),
			),
		),
	);
}

/**
 * @return array
 */
function ufc_acf_about_fields() {
	return array(
		array(
			'key'   => 'field_ufc_about_page_label',
			'label' => __( 'Hero Label', 'usmani' ),
			'name'  => 'about_page_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_about_page_title',
			'label' => __( 'Hero Title', 'usmani' ),
			'name'  => 'about_page_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_about_page_body',
			'label' => __( 'About Body (HTML allowed)', 'usmani' ),
			'name'  => 'about_page_body',
			'type'  => 'wysiwyg',
		),
		array(
			'key'   => 'field_ufc_about_mission_full',
			'label' => __( 'Mission (full)', 'usmani' ),
			'name'  => 'about_mission_full',
			'type'  => 'textarea',
		),
		array(
			'key'   => 'field_ufc_about_vision_full',
			'label' => __( 'Vision (full)', 'usmani' ),
			'name'  => 'about_vision_full',
			'type'  => 'textarea',
		),
		array(
			'key'        => 'field_ufc_values',
			'label'      => __( 'Core Values', 'usmani' ),
			'name'       => 'values',
			'type'       => 'repeater',
			'layout'     => 'block',
			'sub_fields' => array(
				array(
					'key'   => 'field_ufc_value_icon',
					'label' => __( 'Icon Class', 'usmani' ),
					'name'  => 'icon',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_ufc_value_title',
					'label' => __( 'Title', 'usmani' ),
					'name'  => 'title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_ufc_value_text',
					'label' => __( 'Description', 'usmani' ),
					'name'  => 'text',
					'type'  => 'textarea',
				),
			),
		),
		array(
			'key'   => 'field_ufc_team_desc_full',
			'label' => __( 'Team Section Description', 'usmani' ),
			'name'  => 'team_desc_full',
			'type'  => 'textarea',
		),
		ufc_acf_team_repeater(),
	);
}

/**
 * @return array
 */
function ufc_acf_services_page_fields() {
	return array(
		array(
			'key'   => 'field_ufc_services_hero_title',
			'label' => __( 'Hero Title', 'usmani' ),
			'name'  => 'services_hero_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_services_hero_desc',
			'label' => __( 'Hero Description', 'usmani' ),
			'name'  => 'services_hero_desc',
			'type'  => 'textarea',
		),
		array(
			'key'           => 'field_ufc_services_hero_image',
			'label'         => __( 'Hero Background', 'usmani' ),
			'name'          => 'services_hero_image',
			'type'          => 'image',
			'return_format' => 'array',
		),
		ufc_acf_service_repeater(),
		array(
			'key'   => 'field_ufc_services_features_label',
			'label' => __( 'Features Label', 'usmani' ),
			'name'  => 'features_label',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_services_features_title',
			'label' => __( 'Features Title', 'usmani' ),
			'name'  => 'features_title',
			'type'  => 'text',
		),
		ufc_acf_feature_repeater(),
	);
}

/**
 * @return array
 */
function ufc_acf_contact_page_fields() {
	return array(
		array(
			'key'   => 'field_ufc_contact_hero_title',
			'label' => __( 'Hero Title', 'usmani' ),
			'name'  => 'contact_hero_title',
			'type'  => 'text',
		),
		array(
			'key'   => 'field_ufc_contact_hero_desc',
			'label' => __( 'Hero Description', 'usmani' ),
			'name'  => 'contact_hero_desc',
			'type'  => 'textarea',
		),
		array(
			'key'           => 'field_ufc_contact_hero_image',
			'label'         => __( 'Hero Background', 'usmani' ),
			'name'          => 'contact_hero_image',
			'type'          => 'image',
			'return_format' => 'array',
		),
	);
}
