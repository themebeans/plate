<?php
/**
 * The sidebar containing the main sidebar on index and posts pages.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */
?>

<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
	<div id="secondary" class="sidebar">
		<?php dynamic_sidebar( 'sidebar-6' ); ?>
	</div><!-- .sidebar -->
<?php endif; ?>
