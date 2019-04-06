<?php
/**
 * The template for displaying the team loop.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

// Post Meta.
$role  = get_post_meta( $post->ID, '_plate_team_role', true );
$quote = get_post_meta( $post->ID, '_plate_team_quote', true );
$url   = get_post_meta( $post->ID, '_plate_team_url', true );


/**90*4
 * Check to see if a featured image is uploaded.
 * There's no point showing a team member, if there's no image.
 */
if ( has_post_thumbnail() ) :

	$id       = get_post_thumbnail_id();
	$src_feat = wp_get_attachment_image_src( $id, 'plate_port-grid' );
	$src      = wp_get_attachment_image_src( $id, 'plate_port-full' );
	?>

	<div id="post-<?php the_ID(); ?>" class="post team--member
									<?php
									if ( $quote ) {
										echo 'team--quoted'; }
?>
">

		<div class="team--image">

			<?php the_post_thumbnail( 'port-feat' ); ?>

			<?php if ( $quote ) { ?>
				<div class="overlay">
					<h4 class="entry-title"><?php echo esc_html( $quote ); ?></h4>
				</div>
			<?php } ?>

		</div>

		<div class="team--content">

			<?php if ( $url ) { ?>
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" target="_blank">', esc_url( $url ) ), '</a></h2>' ); ?>
			<?php } else { ?>
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			<?php } ?>

			<?php if ( $role ) { ?>
				<span class="entry-role">
					<?php echo esc_html( $role ); ?>
				</span>
			<?php
}

			the_content();

			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'plate' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>

		</div><!-- END .team--content -->

	</div><!-- END .team--member -->

<?php
endif;
