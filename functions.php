<?php
/**
 * Usmani's Financial Consultancy theme functions.
 *
 * @package Usmani
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'UFC_THEME_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function ufc_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'usmani' ),
			'footer'  => __( 'Footer Quick Links', 'usmani' ),
		)
	);
}
add_action( 'after_setup_theme', 'ufc_theme_setup' );

/**
 * Enqueue styles and scripts.
 */
function ufc_enqueue_assets() {
	// Google Fonts.
	wp_enqueue_style(
		'ufc-google-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap',
		array(),
		null
	);

	// Icon libraries.
	wp_enqueue_style( 'ufc-fontawesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', array(), '5.7.2' );
	wp_enqueue_style( 'ufc-material-icons', 'https://fonts.googleapis.com/css2?family=Material+Icons', array(), null );
	wp_enqueue_style( 'ufc-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css', array(), '1.4.1' );

	// Bootstrap CSS + JS bundle.
	wp_enqueue_style( 'ufc-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0' );
	wp_enqueue_script( 'ufc-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true );

	// Theme stylesheet (contains the WordPress theme header + all site CSS).
	wp_enqueue_style( 'ufc-style', get_stylesheet_uri(), array( 'ufc-bootstrap' ), UFC_THEME_VERSION );

	// Theme JavaScript.
	wp_enqueue_script( 'ufc-main', get_theme_file_uri( 'assets/js/main.js' ), array( 'ufc-bootstrap' ), UFC_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'ufc_enqueue_assets' );

/**
 * Includes: ACF field registration and one-time page/menu provisioning.
 */
require get_theme_file_path( 'inc/acf-fields.php' );
require get_theme_file_path( 'inc/template-helpers.php' );
require get_theme_file_path( 'inc/nav-fallback.php' );
require get_theme_file_path( 'inc/theme-activation.php' );

/**
 * Admin notice prompting the site owner to install ACF so all sections
 * become editable from the dashboard.
 */
function ufc_acf_admin_notice() {
	if ( function_exists( 'get_field' ) ) {
		return;
	}
	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}
	$install_url = wp_nonce_url(
		self_admin_url( 'update.php?action=install-plugin&plugin=advanced-custom-fields' ),
		'install-plugin_advanced-custom-fields'
	);
	echo '<div class="notice notice-warning"><p><strong>' . esc_html__( "Usmani's theme:", 'usmani' ) . '</strong> ';
	echo esc_html__( 'Install the free "Advanced Custom Fields" plugin to edit all website sections (hero, services, team, testimonials, contact) from the admin. The site works with default content until then.', 'usmani' );
	echo ' <a href="' . esc_url( $install_url ) . '">' . esc_html__( 'Install ACF now', 'usmani' ) . '</a></p></div>';
}
add_action( 'admin_notices', 'ufc_acf_admin_notice' );

/**
 * Add a body class so page-specific styling has a hook if needed.
 */
function ufc_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'ufc-home';
	}
	return $classes;
}
add_filter( 'body_class', 'ufc_body_classes' );

/**
 * Handle contact form submission via admin-post.php.
 */
function ufc_handle_contact_form() {
	if ( ! isset( $_POST['ufc_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ufc_contact_nonce'] ) ), 'ufc_contact' ) ) {
		wp_safe_redirect( wp_get_referer() ? wp_get_referer() : home_url( '/contact/' ) );
		exit;
	}

	$name    = isset( $_POST['ufc_name'] ) ? sanitize_text_field( wp_unslash( $_POST['ufc_name'] ) ) : '';
	$email   = isset( $_POST['ufc_email'] ) ? sanitize_email( wp_unslash( $_POST['ufc_email'] ) ) : '';
	$phone   = isset( $_POST['ufc_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['ufc_phone'] ) ) : '';
	$subject = isset( $_POST['ufc_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['ufc_subject'] ) ) : '';
	$message = isset( $_POST['ufc_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ufc_message'] ) ) : '';

	$to      = ufc_field( 'contact_email', ufc_defaults( 'contact_email' ), 'option' );
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	if ( is_email( $email ) ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}

	$body  = '<p><strong>' . esc_html__( 'Name', 'usmani' ) . ':</strong> ' . esc_html( $name ) . '</p>';
	$body .= '<p><strong>' . esc_html__( 'Email', 'usmani' ) . ':</strong> ' . esc_html( $email ) . '</p>';
	$body .= '<p><strong>' . esc_html__( 'Phone', 'usmani' ) . ':</strong> ' . esc_html( $phone ) . '</p>';
	$body .= '<p><strong>' . esc_html__( 'Subject', 'usmani' ) . ':</strong> ' . esc_html( $subject ) . '</p>';
	$body .= '<p><strong>' . esc_html__( 'Message', 'usmani' ) . ':</strong><br>' . nl2br( esc_html( $message ) ) . '</p>';

	wp_mail( $to, '[UFC Contact] ' . $subject, $body, $headers );

	$redirect = add_query_arg( 'contact', 'sent', wp_get_referer() ? wp_get_referer() : home_url( '/contact/' ) );
	wp_safe_redirect( $redirect );
	exit;
}
add_action( 'admin_post_nopriv_ufc_contact', 'ufc_handle_contact_form' );
add_action( 'admin_post_ufc_contact', 'ufc_handle_contact_form' );
