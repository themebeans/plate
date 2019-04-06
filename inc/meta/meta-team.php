<?php
/**
 * The file is for creating the team post type meta.
 * Meta output is defined on the page editor.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

function plate_metabox_team() {

	$prefix = '_plate_';

	$meta_box = array(
		'id'       => 'plate_team-meta',
		'title'    => esc_html__( 'Team Member Settings', 'plate' ),
		'page'     => 'team',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(

			array(
				'name' => esc_html__( 'Role:', 'plate' ),
				'desc' => esc_html__( 'Display this team member&#39;s position.', 'plate' ),
				'id'   => $prefix . 'team_role',
				'type' => 'text',
				'std'  => '',
			),

			array(
				'name' => esc_html__( 'Quote:', 'plate' ),
				'desc' => esc_html__( 'Display a small quote on image hover.', 'plate' ),
				'id'   => $prefix . 'team_quote',
				'type' => 'text',
				'std'  => '',
			),

			array(
				'name' => esc_html__( 'External URL:', 'plate' ),
				'desc' => esc_html__( 'Insert a URL to link this team member to.', 'plate' ),
				'id'   => $prefix . 'team_url',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	plate_add_meta_box( $meta_box );
}

add_action( 'add_meta_boxes', 'plate_metabox_team' );
