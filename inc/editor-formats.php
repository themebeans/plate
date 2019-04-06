<?php
/**
 * Custom TinyMCE editor formats for this theme.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */


/**
 * TinyMCE callback function to insert 'styleselect' into the $buttons array
 */
function plate_mce_formats_button( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'plate_mce_formats_button' );



/**
 * TinyMCE Callback function to filter the MCE settings
 */
function plate_mce_before_init_insert_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title'   => 'Highlight',
			'inline'  => 'span',
			'classes' => 'markup--highlight',
			'wrapper' => false,
		),
		array(
			'title'   => 'Button',
			'inline'  => 'span',
			'classes' => 'button',
			'wrapper' => false,
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;
}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'plate_mce_before_init_insert_formats' );
