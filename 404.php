<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */

get_header(); ?>

<div id="content" class="site-content">

	<div id="primary" class="content-area">

		<main id="main" class="site-main" style="<?php echo esc_html( plate_background_image() ); ?>">

			<div class="error-404--wrap">

				<div class="error-404--inner">

					<section class="error-404 not-found">

						<header class="page-header">
							<?php plate_footer_logo(); ?>
							<p><?php esc_html_e( 'Sorry, this page does not exist', 'plate' ); ?></p>
						</header><!-- .page-header -->

						<div class="page-content">
							<?php
							printf(
								'<p><a href="%1$s">%2$s</a></p>',
								esc_url( home_url( '/' ) ),
								esc_html__( 'Go back to home', 'plate' )
							);
							?>
						 </div><!-- .page-content -->

					 </section><!-- .error-404 -->

				</div><!-- .error-404- -inner -->

			</div><!-- .error-404- -wrap -->

		</main><!-- .site-main -->

		</div><!-- .content-area -->

</div><!-- #content -->

<?php
get_footer();
