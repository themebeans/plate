<?php
/**
 * The sidebar containing the main sidebar on index and posts pages.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */
?>

<?php if ( is_active_sidebar( 'sidebar-7' ) ) : ?>
	<div class="page-sidebar sidebar">
		<?php dynamic_sidebar( 'sidebar-7' ); ?>
	</div><!-- .sidebar .page-sidebar -->
<?php endif; ?>
