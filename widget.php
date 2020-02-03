<?php

class Testi_Widget extends WP_Widget{
    /**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'testi_widget',
			'description' => 'Testi widget',
		);
		parent::__construct( 'testi_widget', 'Testi Widget', $widget_ops );
    }
    
    /**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance) {
        
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : "Testimoni";

        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        if ( $title ) {

            echo "<h3 style='text-align: center;'>".$args['before_title'] . $title . $args['after_title'] ."</h3>";
        }

        global $wpdb;
        $data = $wpdb->get_results("SELECT * FROM testimonial ORDER BY RAND() LIMIT 1");
        echo '<p>'.$data[0]->name.'</p><br><p>'.$data[0]->testimonial.'</p>';
    }
    
    public function form( $instance ) {
        // outputs the options form on admin
        $title = isset( $instance["title"] ) ? esc_attr( $instance["title"] ) : "";

        ?>

        <p><label>Title:</label>

        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( "title" ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
    }

    
}

function testi_widget()
{
    register_widget("Testi_Widget");
}

add_action('widgets_init', 'Testi_Widget');

?>