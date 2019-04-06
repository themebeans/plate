/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).html( newval );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( newval ) {
			$( 'body .custom-logo-link img.custom-logo' ).css( 'width', newval );
		} );
	} );

	wp.customize( 'plate_footer_background', function( value ) {
		value.bind( function( to ) {
			$( 'body .site-footer, body .content-bottom-widgets .widget--grid-gallery' ).css( 'background-color', to );
		} );
	});

	wp.customize( 'plate_footer_background', function( value ) {
		value.bind( function( to ) {
			$( 'body .social-navigation a:hover svg' ).css( 'fill', to );
		} );
	});

	wp.customize( 'plate_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .content-area, body .content-block,body .widget-content, body .footer-fullwidth-widgets, body .main-navigation' ).css( 'background', to );
		} );
	});

	wp.customize( 'plate_content_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .content-area, body blockquote cite, body blockquote small, body .content-area strong, body .content-block,body .widget-content, body .footer-fullwidth-widgets' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_headers_color', function( value ) {
		value.bind( function( to ) {
			$( 'body h1, body h2, body h3, body h4, body h5, body h6' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_content_header_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .site-content .widget h1,body .site-content .widget h2,body .site-content .widget h3, body .site-content .widget h4, body .site-content .widget h5, body .site-content .widget h6, body .site-content .wprm_category_title:after, body .site-content .wprm_category_title:before,body .site-content .widget-area .widget-title,body .site-content .widget .wprm_shortcode.wprm_single_menu_item .title' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_footer_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .footer-navigation a' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_footer_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .social-navigation a:before, body .footer-navigation a:after' ).css( 'background-color', to );
		} );
	});

	wp.customize( 'plate_footer_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .social-navigation svg' ).css( 'fill', to );
		} );
	});

	wp.customize( 'plate_footer_title_color', function( value ) {
		value.bind( function( to ) {
			$( 'body body div.bp-address, body .content-bottom-widgets .widget-title, body .bp-name, body .bp-phone:before, body .bp-contact:before, body .bp-booking:before, body .bp-directions:before, body .bp-opening-hours-brief:before, body .bp-opening-hours .bp-title:before ' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_footer_widget_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .site-footer .widget, body .site-footer .widget p, body .site-footer .widget ul, body .site-footer .widget li' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_footer_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .site-footer .widget a' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_footer_link_hover_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .site-footer .widget a:hover' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_nav_a_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .main-navigation a, body .main-navigation a:hover' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_nav_a_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .main-navigation a:after' ).css( 'background-color', to );
		} );
	});

	wp.customize( 'plate_nav_fixed_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .main-navigation.js--fixed ul li, .main-navigation.js--opacity ul li' ).css( 'background-color', to );
		} );
	});

	wp.customize( 'plate_nav_fixed_a_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .main-navigation.js--fixed a, body .main-navigation.js--fixed a:hover' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_hero_header_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .hero-content-area .entry-header h1, body .hero-content-area .entry-header h2, body .hero-content-area .entry-header h3' ).css( 'color', to );
		} );
	});

	wp.customize( 'plate_hero_background_color_default', function( value ) {
		value.bind( function( to ) {
			$( 'body .site-hero--background-color' ).css( 'background-color', to );
		} );
	});

	wp.customize( 'footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .footer-text' ).html( to );
		} );
	} );

	wp.customize( 'post_categories', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-meta .cat-links' ).removeClass( 'hidden' );
			} else {
				$( '.entry-meta .cat-links' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'announcement_bar', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.announcement-bar' ).removeClass( 'hidden' );
			} else {
				$( '.announcement-bar' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'announcement_bar_text', function( value ) {
		value.bind( function( to ) {
			$( '.announcement-bar p' ).html( to );
		} );
	} );

	wp.customize( 'plate_announcement_bar_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .announcement-bar, body .announcement-bar a:hover, body .announcement-bar a:focus' ).css( 'background-color', to );
		} );
	});

	wp.customize( 'plate_announcement_bar_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body .announcement-bar, body .announcement-bar a:hover, body .announcement-bar a:focus' ).css( 'color', to );
		} );
	});

	wp.customize( 'post_tags', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-meta .tags-links' ).removeClass( 'hidden' );
			} else {
				$( '.entry-meta .tags-links' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'footer_copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .copyright .footer-text' ).html( to );
		} );
	} );

	wp.customize( 'powered_by_plate', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-plate' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-plate' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'powered_by_wordpress', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.powered-by-wordpress' ).removeClass( 'hidden' );
			} else {
				$( '.powered-by-wordpress' ).addClass( 'hidden' );
			}
		} );
	} );

} )( jQuery );
