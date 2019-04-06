<?php
// Register widget.
add_action(
	'widgets_init', function() {
		return register_widget( 'Plate_Content_Block' );
	}
);

class Plate_Content_Block extends WP_Widget {

	protected $defaults;

	// Constructor
	function __construct() {
		parent::__construct(
			'plate_content_block', // Base ID
			esc_html__( 'Content Block', 'plate' ), // Name
			array(
				'classname'                   => 'widget--content-block widget--is-fullscreen', // Classes
				'description'                 => esc_html__( 'Displays a right, left or centered content block. For use in the "Home" widget area.', 'plate' ),
				'customize_selective_refresh' => true,
			) // Args
		);

		$this->defaults = array(
			'title'            => '',
			'image'            => '',
			'desc'             => '',
			'position'         => '',
			'btn_text'         => '',
			'btn_url'          => '',
			'background_color' => '',
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
		$position = $instance['position'];
		$btn      = $instance['btn_text'];
		$url      = $instance['btn_url'];
		$image    = ( true == $instance['image'] ) ? 'style="background-image: url(' . $instance['image'] . ');"' : '';

		// Before
		echo balanceTags( $before_widget );

		// Content
		if ( $image ) {
			echo '<div class="widget--has-background" ' . $image . '></div>';
		}

		echo '<div class="content-block ' . esc_html( $position ) . ' parallax--item">';

		if ( $title ) {
			echo balanceTags( $before_title ) . esc_html( $title ) . balanceTags( $after_title );
		}

		if ( $desc ) {
			echo '<p>' . balanceTags( $desc ) . '</p>';
		}

		if ( $btn ) {
			echo '<a href="' . esc_url( $url ) . '" class="button button--small">' . esc_html( $btn ) . '</a>';
		}

		echo '</div>';

		echo '<div class="image-overlay" style="background:' . $instance['background_color'] . '"></div>';

		// After
		echo balanceTags( $after_widget );

	}

	// Update widget
	function update( $new_instance, $old_instance ) {

		$new_instance['title']        = strip_tags( $new_instance['title'] );
		$new_instance['image']        = strip_tags( $new_instance['image'] );
		$new_instance['desc']         = stripslashes( $new_instance['desc'] );
		$new_instance['btn_text']     = stripslashes( $new_instance['btn_text'] );
		$new_instance['btn_url']      = stripslashes( $new_instance['btn_url'] );
		$new_instance['position']     = strip_tags( $new_instance['position'] );
		$instance['background_color'] = strip_tags( $new_instance['background_color'] );

		return $new_instance;
	}

	// Display form
	function form( $instance ) {

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$position = esc_attr( $instance['position'] ); ?>


		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'plate' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p style="margin-top: -8px;">
			<textarea class="widefat" rows="10" cols="15" id="<?php echo esc_html( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo balanceTags( $instance['desc'] ); ?></textarea>
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>"><?php esc_html_e( 'Block Position:', 'plate' ); ?></label><br>
			<label for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>" style="margin-right: 5px;">
				<?php esc_html_e( 'Left', 'plate' ); ?>
				<input class="" id="<?php echo esc_attr( $this->get_field_id( 'block--left' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'position' ) ); ?>" type="radio" value="block--left"
												<?php
												if ( $position === 'block--left' ) {
													echo 'checked="checked"'; }
?>
 />
			</label>
			<label for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>" style="margin-right: 5px;">
				<?php esc_html_e( 'Right', 'plate' ); ?>
				<input class="" id="<?php echo esc_attr( $this->get_field_id( 'block--right' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'position' ) ); ?>" type="radio" value="block--right"
												<?php
												if ( $position === 'block--right' ) {
													echo 'checked="checked"'; }
?>
 />
			</label>
			<label for="<?php echo esc_attr( $this->get_field_id( 'position' ) ); ?>">
				<?php esc_html_e( 'Centered', 'plate' ); ?>
				<input class="" id="<?php echo esc_attr( $this->get_field_id( 'block--center' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'position' ) ); ?>" type="radio" value="block--center"
												<?php
												if ( $position === 'block--center' ) {
													echo 'checked="checked"'; }
?>
 />
			</label>
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

		<p>
			<div class="widget-color-container">
				<label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_html_e( 'Overlay Color:', 'plate' ); ?></label>
				<script type='text/javascript'>
					jQuery(document).ready(function($) {
						$('.widget-color-picker').wpColorPicker();
					});
				</script>
				<input class="widget-color-picker" type="text" id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
			</div>
		</p>
	<?php
	} //END form
} //END class
