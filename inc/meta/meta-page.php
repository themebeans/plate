<?php
/**
 * The file is for creating the page post type meta.
 * Meta output is defined on the page editor.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

function plate_metabox_page() {

	$prefix = '_plate_';

	$meta_box = array(
		'id'       => 'plate_page-meta',
		'title'    => esc_html__( 'Page Options', 'plate' ),
		'page'     => 'page',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(

			array(
				'name' => esc_html__( 'Display Page Header', 'plate' ),
				'desc' => esc_html__( '', 'plate' ),
				'id'   => $prefix . 'page_header',
				'type' => 'checkbox',
				'std'  => true,
			),

			array(
				'name'    => esc_html__( 'Layout', 'plate' ),
				'desc'    => esc_html__( 'Select the layout for this page.', 'plate' ),
				'id'      => $prefix . 'page_layout',
				'type'    => 'select',
				'std'     => 'content-std',
				'options' => array(
					'page_layout_1' => esc_html__( 'Default', 'plate' ),
					'page_layout_2' => esc_html__( '50/50 Sidebar Area', 'plate' ),
				),
			),

			array(
				'name' => esc_html__( 'Hero Background Color', 'plate' ),
				'desc' => esc_html__( 'Modify the background color of hero area on this page.', 'plate' ),
				'id'   => $prefix . 'hero_background_color',
				'type' => 'color',
				'val'  => '',
				'std'  => '',
			),
		),
	);
	plate_add_meta_box( $meta_box );
}

add_action( 'add_meta_boxes', 'plate_metabox_page' );
