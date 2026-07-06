<?php
/**
 * One-time theme activation: create pages, menus, and reading settings.
 *
 * @package Usmani
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Run provisioning on theme switch (once).
 */
function ufc_theme_activation() {
	if ( get_option( 'ufc_theme_provisioned' ) ) {
		return;
	}

	$home_id = ufc_get_or_create_page(
		'home',
		__( 'Home', 'usmani' ),
		''
	);

	ufc_get_or_create_page(
		'about',
		__( 'About', 'usmani' ),
		'',
		'page-about.php'
	);

	ufc_get_or_create_page(
		'services',
		__( 'Services', 'usmani' ),
		'',
		'page-services.php'
	);

	ufc_get_or_create_page(
		'contact',
		__( 'Contact Us', 'usmani' ),
		'',
		'page-contact.php'
	);

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $home_id );
	update_option( 'page_for_posts', 0 );

	ufc_create_menus();

	update_option( 'ufc_theme_provisioned', 1 );
}
add_action( 'after_switch_theme', 'ufc_theme_activation' );

/**
 * Create a page if it does not exist.
 *
 * @param string $slug     Page slug.
 * @param string $title    Page title.
 * @param string $content  Page content.
 * @param string $template Optional page template filename.
 * @return int Page ID.
 */
function ufc_get_or_create_page( $slug, $title, $content = '', $template = '' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		if ( $template ) {
			update_post_meta( $existing->ID, '_wp_page_template', $template );
		}
		return (int) $existing->ID;
	}

	$page_id = wp_insert_post(
		array(
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_content' => $content,
			'post_status'  => 'publish',
			'post_type'    => 'page',
		)
	);

	if ( $template && ! is_wp_error( $page_id ) ) {
		update_post_meta( $page_id, '_wp_page_template', $template );
	}

	return is_wp_error( $page_id ) ? 0 : (int) $page_id;
}

/**
 * Create primary and footer navigation menus.
 */
function ufc_create_menus() {
	$pages = array(
		'home'     => get_page_by_path( 'home' ),
		'about'    => get_page_by_path( 'about' ),
		'services' => get_page_by_path( 'services' ),
		'contact'  => get_page_by_path( 'contact' ),
	);

	$primary_id = wp_create_nav_menu( __( 'Primary Menu', 'usmani' ) );
	if ( ! is_wp_error( $primary_id ) ) {
		$order = 1;
		foreach ( $pages as $page ) {
			if ( $page ) {
				wp_update_nav_menu_item(
					$primary_id,
					0,
					array(
						'menu-item-title'     => $page->post_title,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $page->ID,
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => $order++,
					)
				);
			}
		}
		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary']   = (int) $primary_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	$footer_id = wp_create_nav_menu( __( 'Footer Quick Links', 'usmani' ) );
	if ( ! is_wp_error( $footer_id ) ) {
		$order = 1;
		foreach ( $pages as $page ) {
			if ( $page ) {
				wp_update_nav_menu_item(
					$footer_id,
					0,
					array(
						'menu-item-title'     => $page->post_title,
						'menu-item-object'    => 'page',
						'menu-item-object-id' => $page->ID,
						'menu-item-type'      => 'post_type',
						'menu-item-status'    => 'publish',
						'menu-item-position'  => $order++,
					)
				);
			}
		}
		$locations           = get_theme_mod( 'nav_menu_locations', array() );
		$locations['footer'] = (int) $footer_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}
