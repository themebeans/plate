<?php
/**
 * The file is for creating the blog post type meta.
 * Meta output is defined on the page editor.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

function plate_metabox_post() {

	$prefix = '_plate_';

	$meta_box = array(
		'id'       => 'plate_post-meta',
		'title'    => esc_html__( 'Post Settings', 'plate' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(

			array(
				'name' => esc_html__( 'Grid Image', 'plate' ),
				'desc' => esc_html__( 'Insert a image to use on the blogroll grid.', 'plate' ),
				'id'   => $prefix . 'grid_image',
				'type' => 'file',
				'std'  => '',
			),
		),
	);
	plate_add_meta_box( $meta_box );

	$meta_box = array(
		'id'       => 'plate_post-meta-video',
		'title'    => esc_html__( 'Video Settings', 'plate' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(

			array(
				'name' => esc_html__( 'Lightbox Embed:', 'plate' ),
				'desc' => esc_html__( 'Insert a embeded URL for a video lightbox.', 'plate' ),
				'id'   => $prefix . 'post_embed_url',
				'type' => 'text',
				'std'  => '',
			),

			array(
				'name' => esc_html__( 'Embed:', 'plate' ),
				'desc' => esc_html__( 'Alternatively, insert an embed code.', 'plate' ),
				'id'   => $prefix . 'post_embed',
				'type' => 'textarea',
				'std'  => '',
			),
		),
	);
	plate_add_meta_box( $meta_box );
}

add_action( 'add_meta_boxes', 'plate_metabox_post' );
