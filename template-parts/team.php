<?php
/**
 * The template for displaying team posts.
 *
 * @package     Plate
 * @link        https://themebeans.com/themes/plate
 */
?>

<div id="primary" class="content-area clearfix">
	<main id="main" class="site-main">
		<section class="hfeed content-wrap clearfix">

			<div class="masonry-feed">

				<?php
				// PULL PAGINATION FROM READING SETTINGS
				$paged = 1;
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				}
				if ( get_query_var( 'page' ) ) {
					$paged = get_query_var( 'page' );
				}

				if ( is_tax() ) {

					global $query_string;
					query_posts( "{$query_string}&posts_per_page=-1" );

					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/team-loop' );

					endwhile;
endif;
					wp_reset_postdata();

				} else {

					$args = array(
						'post_type'      => 'team',
						'order'          => 'ASC',
						'orderby'        => 'menu_order',
						'paged'          => $paged,
						'posts_per_page' => '-1',
					);

					$wp_query = new WP_Query( $args );

					if ( $wp_query->have_posts() ) :
						while ( $wp_query->have_posts() ) :
							$wp_query->the_post();

							get_template_part( 'template-parts/team-loop' );

					endwhile;
endif;
					wp_reset_postdata();

				} //END else is_tax()
				?>

			</div><!-- END .masonry-feed -->

			<div id="page_nav">
				<?php next_posts_link(); ?>
			</div>

		</section>
	</main><!-- .site-main -->
</div><!-- .content-area -->
