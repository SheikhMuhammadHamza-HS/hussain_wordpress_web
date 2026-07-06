<?php
/**
 * Fallback primary navigation when no menu is assigned.
 *
 * @package Usmani
 */
function ufc_fallback_nav() {
	$links = array(
		'home'     => array( 'label' => __( 'Home', 'usmani' ), 'url' => home_url( '/' ) ),
		'about'    => array( 'label' => __( 'About', 'usmani' ), 'url' => home_url( '/about/' ) ),
		'services' => array( 'label' => __( 'Services', 'usmani' ), 'url' => home_url( '/services/' ) ),
		'contact'  => array( 'label' => __( 'Contact Us', 'usmani' ), 'url' => home_url( '/contact/' ) ),
	);

	foreach ( $links as $slug => $link ) {
		$active = ( is_front_page() && 'home' === $slug )
			|| ( is_page( $slug ) );
		$class  = 'nav-item nav-link' . ( $active ? ' active' : '' );
		printf(
			'<a class="%1$s" href="%2$s">%3$s</a>',
			esc_attr( $class ),
			esc_url( $link['url'] ),
			esc_html( $link['label'] )
		);
	}
}

/**
 * Fallback footer links when no menu is assigned.
 *
 * @package Usmani
 */
function ufc_fallback_footer_links() {
	$links = array(
		array( 'label' => __( 'Home', 'usmani' ), 'url' => home_url( '/' ) ),
		array( 'label' => __( 'About', 'usmani' ), 'url' => home_url( '/about/' ) ),
		array( 'label' => __( 'Services', 'usmani' ), 'url' => home_url( '/services/' ) ),
		array( 'label' => __( 'Contact Us', 'usmani' ), 'url' => home_url( '/contact/' ) ),
	);

	foreach ( $links as $link ) {
		printf(
			'<a href="%1$s">%2$s</a>',
			esc_url( $link['url'] ),
			esc_html( $link['label'] )
		);
	}
}
