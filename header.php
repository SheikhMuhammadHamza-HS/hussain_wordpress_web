<?php
/**
 * Theme header.
 *
 * @package Usmani
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="https://usmanisfinancialconsultancy.com/fav.jpg">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="preloader" id="preloader">
	<div style="text-align:center">
		<div class="preloader-spinner"></div>
		<div class="preloader-text">Usmani's</div>
	</div>
</div>

<div class="cursor-glow" id="cursorGlow"></div>

<nav class="main-navbar navbar navbar-expand-lg" id="mainNavbar">
	<div class="container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand p-0 d-flex align-items-center">
			<img src="<?php echo esc_url( ufc_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'usmani' ); ?>">
			<span class="fa fa-bars"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav ms-auto py-0">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'items_wrap'     => '%3$s',
							'fallback_cb'    => false,
							'walker'         => new UFC_Nav_Walker(),
						)
					);
				} else {
					ufc_fallback_nav();
				}
				?>
				<div class="nav-item" id="lang-selector">
					<a id="lang-toggle" href="#" class="nav-link d-inline-flex align-items-center">
						<span>EN</span>
						<i class="fas fa-caret-down ms-2"></i>
					</a>
					<ul id="lang-menu">
						<li><a class="fw-bold" href="https://usmanisfinancialconsultancy.com/lang/en">EN</a></li>
						<li><a href="https://usmanisfinancialconsultancy.com/lang/ru">RU</a></li>
						<li><a href="https://usmanisfinancialconsultancy.com/lang/fr">FR</a></li>
						<li><a href="https://usmanisfinancialconsultancy.com/lang/uz">UZ</a></li>
						<li><a href="https://usmanisfinancialconsultancy.com/lang/ur">UR</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>
