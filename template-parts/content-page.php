<?php
/**
 * The template part for displaying single posts
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

$layout = get_post_meta( $post->ID, '_plate_page_layout', true ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-wrap single-wrap clearfix' ); ?>>

	<div class="entry-content <?php echo esc_html( $layout ); ?>">
		<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'plate' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'plate' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<?php
	if ( $layout == 'page_layout_2' ) :
		get_sidebar( 'page' );
	endif;
	?>

</article><!-- #post-## -->
