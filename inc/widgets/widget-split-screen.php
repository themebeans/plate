<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Split_Screen' );
	}
);

class Plate_Split_Screen extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'Plate_Split_Screen', // Base ID
			esc_html__( 'Split Screen', 'plate' ), // Name
			array(
				'classname'                   => 'widget--split-screen', // Classes
				'description'                 => esc_html__( 'Displays a split content area, with an image on one side and text on the other. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'title'    => '',
			'desc'     => '',
			'btn_text' => '',
			'btn_url'  => '',
			'image'    => '',
			'position' => '',
		);

	}

	// Display widget
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// Variables
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$desc     = $instance['desc'];
		$btn      = $instance['btn_text'];
		$url      = $instance['btn_url'];
		$position = $instance['position'];
		$image    = ( true == $instance['image'] ) ? '<img src="' . $instance['image'] . '">' : '';

		// Before
		echo balanceTags( $before_widget );

		echo '<div class="split-screen__item ' . esc_html( $position ) . ' ">';?>

			<div class="center-vertical">
				<div class="center-vertical--inner">
						<?php
						if ( $title ) {
							echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
						}

						if ( $desc ) {
							echo '<p>' . balanceTags( $desc ) . '</p>';
						}

						if ( $btn ) {
							echo '<a href="' . esc_url( $url ) . '" class="button button--small">' . esc_html( $btn ) . '</a>';
						}
						?>
					</div>
				</div>
			</div>

			 <div class="split-screen__item split-image">
				<?php echo balanceTags( $image ); ?>
			</div>

		<?php

		// After
		echo balanceTags( $after_widget );
	}

	// Update widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['desc']     = stripslashes( $new_instance['desc'] );
		$instance['btn_text'] = stripslashes( $new_instance['btn_text'] );
		$instance['btn_url']  = stripslashes( $new_instance['btn_url'] );
		$instance['image']    = strip_tags( $new_instance['image'] );
		$instance['position'] = strip_tags( $new_instance['position'] );

		return $instance;
	}

	// Display widget
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$position = esc_attr( $instance['position'] );
		?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p style="margin-top: -8px;">
		<textarea class="widefat" rows="5" cols="15" id="<?php echo esc_html( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo balanceTags( $instance['desc'] ); ?></textarea>
		</p>

		<p style="margin-top: -12px;">
			<label for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>" style="margin-right: 5px;">
				<?php esc_html_e( 'Left', 'plate' ); ?>
				<input id="<?php echo esc_attr( $this->get_field_id( 'float--left' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'position' ) ); ?>" type="radio" value="float--left"
										<?php
										if ( $position === 'float--left' ) {
											echo esc_attr( 'checked="checked"' ); }
?>
 />
			</label>
			<label for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>">
				<?php esc_html_e( 'Right', 'plate' ); ?>
				<input id="<?php echo esc_attr( $this->get_field_id( 'float--right' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'position' ) ); ?>" type="radio" value="float--right"
										<?php
										if ( $position === 'float--right' ) {
											echo esc_attr( 'checked="checked"' ); }
?>
 />
			</label>
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'btn_text' ) ); ?>"><?php esc_html_e( 'Button Text:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'btn_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_text' ) ); ?>" value="<?php echo esc_attr( $instance['btn_text'] ); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'plate' ); ?></label>
		<input type="text" class="widefat" id="<?php echo esc_html( $this->get_field_id( 'btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" value="<?php echo esc_attr( $instance['btn_url'] ); ?>" />
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
