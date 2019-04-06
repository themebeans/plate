<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

if ( ! function_exists( 'plate_jetpack_setup' ) ) :
	function plate_jetpack_setup() {

		/*
		 * Let JetPack manage the site logo.
		 * By adding theme support, we declare that this theme does use the default
		 * JetPack Site Logo functionality, if the module is activated.
		 *
		 * See: http://jetpack.me/support/site-logo/
		 */
		add_image_size( 'plate-logo', 9999, 9999 );

		add_theme_support( 'site-logo', array( 'size' => 'plate-logo' ) );

	}
endif;
add_action( 'after_setup_theme', 'plate_jetpack_setup' );
