<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function plate_customizer_css() {

	// Colors.
	$theme_accent_color                  = get_theme_mod( 'theme_accent_color', '#50B29E' );
	$plate_background_color              = get_theme_mod( 'plate_background_color', '#ffffff' );
	$plate_content_header_color          = get_theme_mod( 'plate_content_header_color', '#24252f' );
	$plate_content_text_color            = get_theme_mod( 'plate_content_text_color', '#6D6D73' );
	$plate_headers_color                 = get_theme_mod( 'plate_headers_color', '#24252f' );
	$plate_nav_a_color                   = get_theme_mod( 'plate_nav_a_color', '#26262F' );
	$plate_nav_background_color          = get_theme_mod( 'plate_nav_background_color', '#ffffff' );
	$plate_nav_fixed_a_color             = get_theme_mod( 'plate_nav_fixed_a_color', '#26262F' );
	$plate_nav_fixed_background_color    = get_theme_mod( 'plate_nav_fixed_background_color', '#ffffff' );
	$plate_footer_background             = get_theme_mod( 'plate_footer_background', '#24252f' );
	$plate_footer_color                  = get_theme_mod( 'plate_footer_color', '#6D6D73' );
	$plate_footer_title_color            = get_theme_mod( 'plate_footer_title_color', '#ffffff' );
	$plate_footer_widget_color           = get_theme_mod( 'plate_footer_widget_color', '#6D6D73' );
	$plate_footer_link_color             = get_theme_mod( 'plate_footer_link_color', '#6D6D73' );
	$plate_footer_link_hover_color       = get_theme_mod( 'plate_footer_link_hover_color', '#ffffff' );
	$plate_hero_background_color_default = get_theme_mod( 'plate_hero_background_color_default', '#24252f' );
	$plate_hero_header_color             = get_theme_mod( 'plate_hero_header_color', '#ffffff' );
	$plate_address_circle_background     = get_theme_mod( 'plate_address_circle_background', '#24252f' );
	$plate_contact_btn_background        = get_theme_mod( 'plate_contact_btn_background', '#24252f' );
	$plate_address_circle_color          = get_theme_mod( 'plate_address_circle_color', '#ffffff' );
	$plate_announcement_bar_color        = get_theme_mod( 'plate_announcement_bar_color', '#24252f' );
	$plate_announcement_bar_text_color   = get_theme_mod( 'plate_announcement_bar_text_color', '#ffffff' );
	$plate_404_background_color          = get_theme_mod( 'plate_404_background_color', '#24252f' );

	$site_logo_width = get_theme_mod( 'custom_logo_max_width', '250' );

	// Convert main text hex color to rgba.
	$theme_accent_color_rgb           = plate_hex2rgb( $theme_accent_color );
	$rgb_address_circle_rgb           = plate_hex2rgb( $plate_address_circle_background );
	$plate_contact_btn_background_rgb = plate_hex2rgb( $plate_contact_btn_background );
	$plate_announcement_bar_color_rgb = plate_hex2rgb( $plate_announcement_bar_color );

	// If we get this far, we have a custom color scheme.
	$rgb_address_circle               = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.8)', $rgb_address_circle_rgb );
	$rgb_10_opacity                   = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.075)', $theme_accent_color_rgb );
	$rgb_100_opacity                  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 1)', $theme_accent_color_rgb );
	$rgb_85_opacity                   = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.85)', $theme_accent_color_rgb );
	$rgb_announcement_bar_color       = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.85)', $plate_announcement_bar_color_rgb );
	$plate_contact_btn_background_rgb = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.85)', $plate_contact_btn_background_rgb );

	$css =
	'
	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_width ) . 'px;
	}

	body.error404 .site-main:after {
		background-color:' . $plate_404_background_color . ';
	}

	body .announcement-bar {
		background-color:' . $plate_announcement_bar_color . ';
		background-color:' . $rgb_announcement_bar_color . ';
		color:' . $plate_announcement_bar_text_color . ';
	}

	body .announcement-bar a:hover,
	body .announcement-bar a:focus {
		color:' . $plate_announcement_bar_text_color . ';
	}

	body .content-area,
	body .content-block,
	body .widget-content,
	body .footer-fullwidth-widgets {
		background-color:' . $plate_background_color . ';
		color:' . $plate_content_text_color . ';
	}

	body .content-area strong,
	body blockquote cite, body blockquote small {
		 color:' . $plate_content_text_color . ';
	}


	body .split-screen__item.split-image:before {
		border-top-color:' . $plate_background_color . ';
	}

	body h1, body h2, body h3, body h4, body h5, body h6 {
		color:' . $plate_headers_color . ';
	}

	body .site-content .widget h1,
	body .site-content .widget h2,
	body .site-content .widget h3,
	body .site-content .widget h4,
	body .site-content .widget h5,
	body .site-content .widget h6,
	body .site-content .wprm_category_title:after,
	body .site-content .wprm_category_title:before,
	body .site-content .widget-area .widget-title,
	body .site-content .widget .wprm_shortcode.wprm_single_menu_item .title {
		color:' . $plate_content_header_color . ';
	}

	body .bp-name,
	body .bp-phone:before,
	body .bp-contact:before,
	body .bp-booking:before,
	body .bp-directions:before,
	body div.bp-address,
	body .bp-opening-hours-brief:before,
	body .bp-opening-hours .bp-title:before,
	body .content-bottom-widgets .widget-title {
		color:' . $plate_footer_title_color . ';
	}

	body .site-footer {
		background-color:' . $plate_footer_background . ';
	}

	body .social-navigation a:hover svg {
		fill:' . $plate_footer_background . ';
	}

	body .footer-navigation a,
	body .site-footer a:hover {
		color:' . $plate_footer_color . ';
	}

	body .site-footer .widget,
	body .site-footer .widget p,
	body .site-footer .widget ul,
	body .site-footer .widget li {
		color:' . $plate_footer_widget_color . ';
	}

	body .site-footer .widget a {
		color:' . $plate_footer_link_color . ';
	}

	body .site-footer .widget a:hover {
		color:' . $plate_footer_link_hover_color . ';
	}

	body .social-navigation svg {
		fill:' . $plate_footer_color . ';
	}

	body .social-navigation a:before,
	body .footer-navigation a:after {
		background-color:' . $plate_footer_color . ';
	}

	body button,
	body .button,
	body article .button a,
	body button[disabled]:hover,
	body button[disabled]:focus,
	body input[type="button"],
	body body.wp-autoresize .button a,
	body input[type="button"][disabled]:hover,
	body input[type="button"][disabled]:focus,
	body input[type="reset"],
	body input[type="reset"][disabled]:hover,
	body input[type="reset"][disabled]:focus,
	body input[type="submit"],
	body input[type="submit"][disabled]:hover,
	body input[type="submit"][disabled]:focus,
	body.woocommerce #page #respond input#submit.alt,
	body.woocommerce #page a.button.alt,
	body.woocommerce #page button.button.alt,
	body.woocommerce #page input.button.alt {
		background-color:' . $theme_accent_color . ';
		border-color:' . $theme_accent_color . ';
	}

	body .button:hover,
	body .button:focus,
	body button:hover,
	body button:focus,
	body article .button a:hover,
	body article .button a:focus,
	body input[type="button"]:hover,
	body input[type="button"]:focus,
	body input[type="reset"]:hover,
	body input[type="reset"]:focus,
	body input[type="submit"]:hover,
	body input[type="submit"]:focus,
	body.wp-autoresize .button a:hover,
	body.woocommerce #page #respond input#submit.alt:hover,
	body.woocommerce #page a.button.alt:hover,
	body.woocommerce #page button.button.alt:hover,
	body.woocommerce #page input.button.alt:hover {
		background-color: ' . $rgb_85_opacity . ';
	}

	body .main-navigation a,
	body .main-navigation a:hover {
		color:' . $plate_nav_a_color . ';
	}

	body .main-navigation a:after {
		background-color:' . $plate_nav_a_color . ';
	}

	body .main-navigation a:after {
		background-color:' . $plate_nav_a_color . ';
	}

	@media only screen and (min-width: 730px) {
		body .main-navigation.js--fixed ul, .main-navigation.js--opacity ul {
			background-color:' . $plate_nav_fixed_background_color . ';
		}

		body .main-navigation.js--fixed a, body .main-navigation.js--fixed a:hover {
			color:' . $plate_nav_fixed_a_color . ';
		}

		body .main-navigation.js--fixed a:after,
		body .main-navigation.js--opacity a:after {
			background-color:' . $plate_nav_fixed_a_color . ';
		}
	}

	@media only screen and (max-width: 768px) {
		body .main-navigation {
			background-color:' . $plate_background_color . ';
		}
	}

	body .site-hero--image,
	body .site-hero--background-color {
		background-color:' . $plate_hero_background_color_default . ';
	}

	body .hero-content-area .entry-header h1,
	body .hero-content-area .entry-header h2,
	body .hero-content-area .entry-header h3 {
		color:' . $plate_hero_header_color . ';
	}

	body .address-circle {
		background-color:' . $rgb_address_circle . ';
	}

	body .address-circle span {
		color:' . $plate_address_circle_color . ';
	}

	body #contact-form .button {
		background-color:' . $plate_contact_btn_background . ';
		border-color:' . $plate_contact_btn_background . ';
	}

	body #contact-form .button:hover {
		background: ' . $plate_contact_btn_background_rgb . ';
	}

	.woocommerce ul.products li.product span.onsale {
		background-color:' . $theme_accent_color . ';
	}

	a:hover,
	a:focus,
	.site-header a:hover,
	a:active,
	.footer-text a:hover,
	.entry-meta a:hover,
	body.woocommerce div.product p.price,
	body.woocommerce div.product span.price,
	.entry-content blockquote p { color:' . $theme_accent_color . '; }

	.entry-content blockquote { border-color:' . $theme_accent_color . '; }

	body .open-table-widget .datepicker-content .selected, body .open-table-widget .datepicker-content .selected:hover {
		color:' . $theme_accent_color . '!important;
	}
	';

	wp_add_inline_style( 'plate-style', wp_strip_all_tags( $css ) );

}
add_action( 'wp_enqueue_scripts', 'plate_customizer_css' );
