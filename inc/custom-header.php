<?php
/**
 * Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 */



/**
 * Set up the WordPress core custom header feature.
 */
function plate_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'plate_custom_header_args', array(
        'width'                  => 9999,
        'height'                 => 9999,
        'flex-height'            => true,
    ) ) );
}
add_action( 'after_setup_theme', 'plate_custom_header_setup' );