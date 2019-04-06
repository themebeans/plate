<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Ad' );
	}
);

class Plate_Ad extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'plate_ad', // Base ID
			esc_html__( 'Sidebar Ad', 'plate' ), // Name
			array(
				'classname'                   => 'widget--ad', // Classes
				'description'                 => esc_html__( 'Displays a linkable image advertisement.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'ad_url' => '',
			'image'  => '',
		);
	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables
		$url   = $instance['ad_url'];
		$image = $instance['image'];

		// Before
		echo balanceTags( $before_widget );

		if ( $image && $url ) {
			echo '<a target="blank" href="' . esc_url( $url ) . '"><img src="' . esc_html( $image ) . '"></a>';
		}

		// After
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['ad_url'] = stripslashes( $new_instance['ad_url'] );
		$instance['image']  = strip_tags( $new_instance['image'] );

		return $instance;
	}

	// Display widget
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ad_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'ad_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ad_url' ) ); ?>" value="<?php echo esc_attr( $instance['ad_url'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e( 'Image', 'plate' ); ?>:</label>
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
