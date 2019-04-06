<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */


/**
 * Check to see if a featured image is uploaded.
 * There's no point showing a project link, if there's no image.
 */
if ( has_post_thumbnail() ) :

	$id       = get_post_thumbnail_id();
	$src_feat = wp_get_attachment_image_src( $id, 'plate_port-grid' );
	$src      = wp_get_attachment_image_src( $id, 'plate_port-full' );
	?>

	<figure class="project post" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
		<?php echo '<a href="' . $src[0] . '" class="lightbox-link" itemprop="contentUrl" data-size="' . $src[1] . 'x' . $src[2] . '">'; ?>
			<?php echo '<img src="' . $src_feat[0] . '"/>'; ?>
		</a>
	</figure>

<?php
endif;
