<?php
/**
 * Template helpers: ACF-safe field access, defaults, and the nav walker.
 *
 * @package Usmani
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return an ACF field value, falling back to a default when ACF is not
 * installed or the field is empty. This lets the theme render the full
 * original content out of the box while remaining fully editable in wp-admin.
 *
 * @param string   $selector Field name.
 * @param mixed    $default  Default value when empty/unavailable.
 * @param int|null $post_id  Optional post/option id ('option' for options page).
 * @return mixed
 */
function ufc_field( $selector, $default = '', $post_id = null ) {
	if ( function_exists( 'get_field' ) ) {
		$value = ( null === $post_id ) ? get_field( $selector ) : get_field( $selector, $post_id );
		if ( null !== $value && '' !== $value && array() !== $value ) {
			return $value;
		}
	}
	return $default;
}

/**
 * Echo an ACF field value with a default, escaped for HTML output.
 *
 * @param string $selector Field name.
 * @param mixed  $default  Default value.
 * @param int|null $post_id Optional post/option id.
 */
function ufc_the_field( $selector, $default = '', $post_id = null ) {
	echo esc_html( ufc_field( $selector, $default, $post_id ) );
}

/**
 * Resolve an image value (ACF array, attachment ID, or URL string).
 *
 * @param mixed  $value   Image field value.
 * @param string $default Fallback URL.
 * @param string $size    Image size.
 * @return string
 */
function ufc_resolve_image( $value, $default = '', $size = 'large' ) {
	if ( is_array( $value ) ) {
		if ( isset( $value['sizes'][ $size ] ) ) {
			return $value['sizes'][ $size ];
		}
		if ( isset( $value['url'] ) ) {
			return $value['url'];
		}
	}
	if ( is_numeric( $value ) ) {
		$src = wp_get_attachment_image_url( (int) $value, $size );
		if ( $src ) {
			return $src;
		}
	}
	if ( is_string( $value ) && '' !== $value ) {
		return $value;
	}
	return $default;
}

/**
 * Return an image URL from an ACF image field (array/id/url) or a default URL.
 *
 * @param string $selector Field name.
 * @param string $default  Default image URL.
 * @param string $size     Image size.
 * @param int|null $post_id Optional post/option id.
 * @return string
 */
function ufc_image_url( $selector, $default = '', $size = 'large', $post_id = null ) {
	$value = ufc_field( $selector, null, $post_id );
	if ( is_array( $value ) ) {
		if ( isset( $value['sizes'][ $size ] ) ) {
			return $value['sizes'][ $size ];
		}
		if ( isset( $value['url'] ) ) {
			return $value['url'];
		}
	}
	if ( is_numeric( $value ) ) {
		$src = wp_get_attachment_image_url( (int) $value, $size );
		if ( $src ) {
			return $src;
		}
	}
	if ( is_string( $value ) && '' !== $value ) {
		return $value;
	}
	return $default;
}

/**
 * Get a repeater/rows value with a default array of rows. Each default row is an
 * associative array keyed by sub-field name.
 *
 * @param string $selector Repeater field name.
 * @param array  $default  Default rows.
 * @param int|null $post_id Optional post/option id.
 * @return array
 */
function ufc_rows( $selector, $default = array(), $post_id = null ) {
	$value = ufc_field( $selector, null, $post_id );
	if ( is_array( $value ) && ! empty( $value ) ) {
		return $value;
	}
	return $default;
}

/**
 * Site logo URL (custom logo if set, else the hosted brand logo).
 *
 * @return string
 */
function ufc_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$src = wp_get_attachment_image_url( $custom_logo_id, 'full' );
		if ( $src ) {
			return $src;
		}
	}
	return 'https://usmanisfinancialconsultancy.com/logo.jpeg';
}

/**
 * Default content used when ACF is not installed / fields are empty.
 * Mirrors the original static site so the theme looks complete on activation.
 *
 * @param string $key Section key.
 * @return mixed
 */
function ufc_defaults( $key ) {
	$d = array(
		'hero_badge'   => 'Shariah-Compliant Finance',
		'hero_title'   => 'Empowering Islamic Finance, <span class="gold-text">Globally</span>',
		'hero_desc'    => "Usmani's Financial Consultancy specializes in Shariah-compliant finance, eliminating Riba and non-Islamic agreements.",
		'hero_slides'  => array(
			array( 'image' => 'https://arabiconline.eu/wp-content/uploads/2023/08/sur_mosque.jpg' ),
			array( 'image' => 'https://usmanisfinancialconsultancy.com/storage/heroes/MIULoil3jTHfHQHgxEKPeYtDGM5yXZvtVjLHQInR.jpg' ),
		),

		'about_label'  => 'About Us',
		'about_title'  => 'Leading the Way in Islamic Finance',
		'about_text'   => 'ٱلْحَمْدُ لِلَّٰهِ, Usmani\'s Financial Consultancy (UFC) is a premier Shariah compliance firm dedicated to transforming the financial landscape by eliminating interest (Riba) and non-Islamic agreements. With extensive expertise and strategic global partnerships, we provide cutting-edge financial solutions that align with Islamic principles.',
		'about_image'  => 'https://usmanisfinancialconsultancy.com/storage/abouts/f4KKg1kmuCenHeWMlGNElUElSR1KP9mp3IZzhtO6.jpg',
		'about_years'  => '10+',
		'about_years_label' => 'Years of Excellence',
		'about_mission' => 'Empower individuals and businesses to navigate finance with integrity and adherence to Islamic principles.',
		'about_vision'  => 'Be a leading force in promoting Islamic financial practices globally for ethical prosperity.',

		'services_label' => 'Our Services',
		'services_title' => 'We Provide Best Offer For The Services',
		'services_desc'  => 'We offer expert Shariah-compliant financial solutions, helping you make ethical, interest-free decisions aligned with Islamic principles.',
		'services'       => array(
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/storage/services/hjIKOdgeyj0rRvSRA8OVAM4gacE845ZIcyfNKbc7.jpg',
				'title' => 'PRODUCT DEVELOPMENT',
				'text'  => 'We specialize in crafting solutions that align with Shariah principles, offering you peace of mind in your financial endeavors.',
			),
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/storage/services/1h2HSaS6LzIyyMNRFc2YDY9BFKtRYx918CuhuIgr.jpg',
				'title' => "ISLAMIC FINANCE PRODUCT'S CONSULTANCY",
				'text'  => 'Expert guidance on Islamic financial products tailored to meet the specific needs and objectives of clients, ensuring compliance with Shariah principles.',
			),
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/storage/services/IXir6FZoIscQGZhPvXjYuwZSi5c6Issi831IPNMb.jpg',
				'title' => 'SHARIA REVIEW AND AUDIT',
				'text'  => 'Through examination and assessment of financial practices, products, and transactions to ensure compliance with Islamic law and principles.',
			),
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/storage/services/Wc2h1T8wq1HSzGBJuhvqXkdBBW7N8iOJm4WcxytL.jpg',
				'title' => 'ADVISORY AND CORPORATE RESTRUCTURING',
				'text'  => 'Strategic guidance and support for organizations seeking to optimize their operations, improve efficiency, and align with Shariah-compliant practices through restructuring initiatives.',
			),
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/storage/services/wkaT4p18cNXyVOOakIoePBl8IH5dlXlEXoF4YTZf.jpg',
				'title' => 'CORPORATE GOVERNANCE',
				'text'  => 'Uphold the highest standards of ethical business practices through our corporate governance services. We guide your organization to operate transparently and responsibly, fostering trust and long-term success.',
			),
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/storage/services/ij6Vov59G31zjrEOeeI6PMzXh7U05bXBFE1fDqwr.jpg',
				'title' => 'Sukuk Structuring',
				'text'  => 'Unlock new avenues for capital with our Sukuk structuring expertise. Tailored to your needs, these Islamic financial instruments facilitate capital market investments while upholding ethical standards.',
			),
		),

		'features_label' => 'Our Features',
		'features_title' => 'Ethical Financial Solutions, Guided by Shariah Principles',
		'features_desc'  => "Usmani's offers expert Shariah-compliant financial solutions, backed by global partnerships, guiding you towards ethical financial success.",
		'features'       => array(
			array(
				'icon'  => 'https://usmanisfinancialconsultancy.com/icons/icon1.png',
				'title' => 'Expert Shariah-Compliant Solutions',
				'text'  => 'Specialized services adhering strictly to Shariah law, providing ethical, interest-free financial solutions.',
			),
			array(
				'icon'  => 'https://usmanisfinancialconsultancy.com/icons/icon2.png',
				'title' => 'Global Partnerships & Expertise',
				'text'  => 'Broad network of global partners offering world-class financial insights for clients worldwide.',
			),
			array(
				'icon'  => 'https://usmanisfinancialconsultancy.com/icons/icon3.png',
				'title' => 'Interest-Free (Riba-Free) Finance',
				'text'  => 'Commitment to liberating finance from interest, upholding Islamic values with sustainable alternatives.',
			),
			array(
				'icon'  => 'https://usmanisfinancialconsultancy.com/icons/icon4.png',
				'title' => 'In-Depth Knowledge & Consultation',
				'text'  => 'Extensive expertise in Islamic finance with personalized guidance for complex financial decisions.',
			),
		),

		'team_label' => 'Our Team',
		'team_title' => 'Meet Our Expert Team Members',
		'team_desc'  => 'UFC is led by President Dr. Mufti Hassan Usmani, son of Mufti Taqi Usmani. Co-founded by Mr. Shahzad Ahmed, dedicated to ethical, interest-free financial solutions.',
		'team'       => array(
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/assets/images/mufti-sahab.jpeg',
				'name'  => 'Dr Mufti Hassan Usmani',
				'role'  => 'President',
			),
			array(
				'image' => 'https://usmanisfinancialconsultancy.com/assets/images/shezad-ahmad.jpeg',
				'name'  => 'Shahzad Ahmad',
				'role'  => 'Co-Founder',
			),
		),

		'training_label' => 'Training & Development',
		'training_title' => 'Empowering Clients with Knowledge',
		'training'       => array(
			array(
				'icon'  => 'fas fa-chalkboard-teacher',
				'title' => 'Interactive Workshops and Webinars',
				'image' => 'https://usmanisfinancialconsultancy.com/assets/training/workshop-1.jpg',
				'text'  => 'Engage with our expert team through hands-on workshops and live webinars designed to provide in-depth knowledge of Islamic finance principles.',
			),
			array(
				'icon'  => 'fas fa-user-tie',
				'title' => 'One-on-One Consultations',
				'image' => 'https://usmanisfinancialconsultancy.com/assets/training/consultation-1.jpg',
				'text'  => 'Receive personalized guidance tailored to your specific financial needs. Our consultants work closely with you for thorough understanding.',
			),
			array(
				'icon'  => 'fas fa-graduation-cap',
				'title' => 'Continuous Learning Opportunities',
				'image' => 'https://usmanisfinancialconsultancy.com/assets/training/consultation_2.png',
				'text'  => 'Stay updated with ongoing learning resources including seminars, articles, and resources in Islamic finance.',
			),
		),

		'testimonials_label' => 'Testimonial',
		'testimonials_title' => 'Our Clients Reviews',
		'testimonials'       => array(
			array(
				'text' => "Usmani's helped us implement an interest-free strategy that aligns with our business goals and Islamic values. Their expertise has been invaluable.",
				'name' => 'Ahmed M., CEO, Ethical Investment Group',
			),
			array(
				'text' => 'They guided me in creating a Shariah-compliant investment plan that delivers profitable returns. Their professionalism made it seamless.',
				'name' => 'Sara K., Independent Investor',
			),
			array(
				'text' => 'Exceptional service in eliminating Riba from our finances, opening new growth opportunities while staying true to Islamic principles.',
				'name' => 'Imran S., CFO, Global Trading Corporation',
			),
		),

		// About page long-form.
		'about_page_label' => 'Who We Are',
		'about_page_title' => "About Usmani's Financial Consultancy",
		'about_page_body'  => "<p>ٱلْحَمْدُ لِلَّٰهِ, Usmani's Financial Consultancy (UFC) is a premier Shariah compliance firm dedicated to transforming the financial landscape by eliminating interest (Riba) and non-Islamic agreements. With extensive expertise and strategic global partnerships, we provide cutting-edge financial solutions that align with Islamic principles.</p>\n<p>Our firm is led by President Dr. Mufti Hassan Usmani, the son of Mufti Taqi Usmani, a globally renowned Islamic scholar and authority in Islamic finance. Under the mentorship of Mufti Taqi Usmani DB, UsFC upholds the highest standards of Shariah compliance, ensuring that our clients benefit from ethical, interest-free financial structures.</p>\n<p>Our mission is to empower individuals, businesses, and financial institutions worldwide with Shariah-compliant solutions that promote economic justice and prosperity. Let us help you navigate the world of Islamic finance with confidence.</p>",
		'about_mission_full' => 'Our Mission is to empower individuals and businesses to navigate the complex world of finance and business with integrity and adherence to Islamic principles. We strive to make Shariah-compliant finance accessible, practical, and beneficial for all.',
		'about_vision_full'  => 'Our vision is to be a leading force in promoting Islamic financial practices globally. We envision a world where businesses flourish, individuals prosper, and communities thrive through ethical financial practices rooted in Shariah principles.',
		'values'             => array(
			array( 'icon' => 'fas fa-balance-scale', 'title' => 'Justice & Fairness', 'text' => 'Every financial solution we design is rooted in the principles of equity and justice as prescribed by Islamic law.' ),
			array( 'icon' => 'fas fa-handshake', 'title' => 'Integrity & Trust', 'text' => 'We maintain the highest standards of honesty and transparency in all our dealings and client relationships.' ),
			array( 'icon' => 'fas fa-globe-americas', 'title' => 'Global Excellence', 'text' => 'Through strategic partnerships worldwide, we deliver world-class Islamic finance solutions to clients globally.' ),
			array( 'icon' => 'fas fa-book-quran', 'title' => 'Shariah Compliance', 'text' => 'Unwavering commitment to ensuring every product and service meets the highest standards of Islamic jurisprudence.' ),
		),
		'team_desc_full'     => 'UFC, led by President Dr. Mufti Hassan Usmani, son of renowned Islamic scholar Mufti Taqi Usmani, upholds the highest standards of Shariah compliance. Co-founded by Islamic finance expert Mr. Shahzad Ahmed. We have members from Turkey, Uzbekistan, Tunisia, Pakistan and we seek their efforts and knowledge time to time.',

		// Services page hero.
		'services_hero_title' => 'Shariah-Compliant Financial Solutions',
		'services_hero_desc'  => 'We offer expert Shariah-compliant financial solutions, helping you make ethical, interest-free decisions aligned with Islamic principles.',
		'services_hero_image' => 'https://usmanisfinancialconsultancy.com/storage/services/hjIKOdgeyj0rRvSRA8OVAM4gacE845ZIcyfNKbc7.jpg',

		// Contact page.
		'contact_hero_title' => 'Get In Touch',
		'contact_hero_desc'  => "Have questions about Shariah-compliant finance? We're here to help you navigate your financial journey.",
		'contact_hero_image' => 'https://usmanisfinancialconsultancy.com/storage/heroes/MIULoil3jTHfHQHgxEKPeYtDGM5yXZvtVjLHQInR.jpg',
		'contact_address'    => 'Unit F, Winston Business Park, Churchill Way 26434, Sheffield, United Kingdom, S35 2PS',
		'contact_email'      => 'info@usmanisfinancialconsultancy.com',
		'contact_phone'      => '+447478034875',
		'contact_hours'      => "Monday - Friday<br>9:00 AM - 6:00 PM",

		// Footer.
		'footer_about' => "Empowering Islamic Finance, globally, Usmani's Financial Consultancy specializes in Shariah-compliant finance, eliminating Riba and non-Islamic agreements.",
		'footer_logo'  => 'https://usmanisfinancialconsultancy.com/assets/images/general_images/logo.PNG',
		'social_facebook'  => '#',
		'social_twitter'   => '#',
		'social_instagram' => '#',
		'social_linkedin'  => '#',
		'copyright'    => '© ' . gmdate( 'Y' ) . " Usmani's Financial Consultancy. All Rights Reserved.",
	);

	return isset( $d[ $key ] ) ? $d[ $key ] : '';
}

/**
 * Navbar walker producing the original Bootstrap "nav-item nav-link" markup.
 */
class UFC_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Start element (single-level menu of anchors).
	 *
	 * @param string   $output Output.
	 * @param WP_Post  $item   Menu item.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 * @param int      $id     Id.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$active  = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );

		$class_str = 'nav-item nav-link';
		if ( $active ) {
			$class_str .= ' active';
		}

		$atts  = ' class="' . esc_attr( $class_str ) . '"';
		$atts .= ' href="' . esc_url( $item->url ) . '"';
		if ( ! empty( $item->target ) ) {
			$atts .= ' target="' . esc_attr( $item->target ) . '"';
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$output .= '<a' . $atts . '>' . esc_html( $title ) . '</a>';
	}

	/**
	 * No closing tag needed (anchors are self-contained above).
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}

/**
 * Footer links walker: plain anchors for the .footer-links container.
 */
class UFC_Footer_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$title   = apply_filters( 'the_title', $item->title, $item->ID );
		$output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $title ) . '</a>';
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}
