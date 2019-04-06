<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_LightboxVideo' );
	}
);

class Plate_LightboxVideo extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'Plate_LightboxVideo', // Base ID
			esc_html__( 'Video Lightbox', 'plate' ), // Name
			array(
				'classname'                   => 'widget--fullscreen-title widget--title-widget widget--is-fullscreen widget--is-table', // Classes
				'description'                 => esc_html__( 'Displays a clickable lightbox video area. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'url'   => '',
			'image' => '',
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables
		$url   = $instance['url'];
		$image = $instance['image'];

		// Before
		echo balanceTags( $before_widget );

			echo "<div class=\"widget-inner parallax-window\" data-parallax=\"scroll\" data-image-src=\"{$image}\">";

			echo '<div class="widget-content">';

		if ( $url ) {
			echo '<a href="' . esc_url( $url ) . '" class="lightbox-link lightbox-play" data-lity><div class="radar-animation"></div></a>';
		}

			echo '</div>';

		echo '</div>';

		// After
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['url']   = stripslashes( $new_instance['url'] );
		$instance['image'] = strip_tags( $new_instance['image'] );

		return $instance;
	}

	// Display widget
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'Video Share Link:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" value="<?php echo esc_attr( $instance['url'] ); ?>" />
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
