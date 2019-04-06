<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Page' );
	}
);

class Plate_Page extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'plate_page', // Base ID
			esc_html__( 'Page Content', 'plate' ), // Name
			array(
				'classname'                   => 'widget--page', // Classes
				'description'                 => esc_html__( 'Displays page content, selectable via a dropdown element. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'title'        => '',
			'image'        => '',
			'page_content' => '',
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables
		$title        = apply_filters( 'widget_title', $instance['title'] );
		$page_content = $instance['page_content'];
		$image        = ( true == $instance['image'] ) ? 'style="background-image: url(' . $instance['image'] . ');"' : '';

		// Before
		echo balanceTags( $before_widget );

		// Get the page content's ID
		$id   = array( $page_content );
		$args = array(
			'post_type'      => 'page',
			'post__in'       => $id,
			'posts_per_page' => 1,
		);

		query_posts( $args );

		if ( have_posts() ) :

			// Start the loop.
			while ( have_posts() ) :
				the_post();

				echo '<div class="widget-inner widget--has-background" ' . $image . '>';

					echo '<div class="widget-content">';

				if ( $title ) {
					echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
				}

						the_content();

					echo '</div>';

				echo '</div>';

				// End of the loop.
			endwhile;

		endif;

		// After
		echo balanceTags( $after_widget );

	}

	// Update widget
	function update( $new_instance, $old_instance ) {

		$new_instance['title']        = strip_tags( $new_instance['title'] );
		$new_instance['image']        = strip_tags( $new_instance['image'] );
		$new_instance['page_content'] = strip_tags( $new_instance['page_content'] );

		return $new_instance;
	}

	// Display form
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'plate' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<style>.widget-content select { margin-top: 2px; width: 100%;}</style>
			<label for="<?php echo esc_attr( $this->get_field_id( 'page_content' ) ); ?>"><?php esc_html_e( 'Page Content:', 'plate' ); ?></label>
			<?php
			wp_dropdown_pages(
				array(
					'id'       => $this->get_field_id( 'page_content' ),
					'name'     => $this->get_field_name( 'page_content' ),
					'selected' => $instance['page_content'],
				)
			);
			?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Background Image', 'plate' ); ?>:</label>
			<div class="widget-media-container">
				<div class="widget-media-inner">

					<?php $img_style    = ( $instance['image'] != '' ) ? '' : 'style=display:none;'; ?>
					<?php $no_img_style = ( $instance['image'] != '' ) ? 'style=display:none;' : ''; ?>

					<img id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-preview" src="<?php echo esc_attr( $instance['image'] ); ?>" <?php echo esc_attr( $img_style ); ?> />
					<span class="widget-no-image" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-noimg" <?php echo esc_attr( $no_img_style ); ?>><?php esc_html_e( 'No image selected', 'plate' ); ?></span>
				</div>

				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" class="widget-media-url" />
				<input type="button" value="<?php echo esc_html( 'Remove', 'plate' ); ?>" class="button widget-media-remove" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-remove" <?php echo esc_attr( $img_style ); ?> />
				<?php $button_text = ( $instance['image'] != '' ) ? esc_html__( 'Change Image', 'plate' ) : esc_html__( 'Select Image', 'plate' ); ?>
				<input type="button" value="<?php echo esc_html( $button_text ); ?>" class="button widget-media-upload" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>-button" />
				<br class="clear">
			</div>
		</p>
	<?php
	} //END form
} //END class
