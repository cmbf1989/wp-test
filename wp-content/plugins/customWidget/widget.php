<?php
/*
Plugin Name: Custom Widget Fun Fact
Plugin URI:
Description: This plugin adds a custom widget.
Version: 1.0
Author: Cesar Ferreira
Author URI: http://github.com/cmbf1989/
License: GPL2
*/

class FunFactWidget extends WP_Widget {

    const TITLE = "FUN FACT";
    public function __construct() {
        parent::__construct(
            'FunFactWidget',
            __( 'Fun Fact', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
        )
    );
    }

    /**
    * Author:         Cesar Ferreira
    * Description:    Create widget default form to input data.
    * Arguments:      $instance - $instance holding array of data
    */
    public function form($instance) {

        // Set widget defaults
        $defaults = array(
            'textarea' => 'This is a test where the widget gets created with default text',
        );
        // Parse current settings with defaults
        
        ?>
        <div class="widget-fun-fact">
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'textarea')); ?>"><?php _e( 'Textarea:', 'text_domain'); ?></label>
                <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'textarea')); ?>" name="<?php echo esc_attr($this->get_field_name( 'textarea')); ?>"><?php echo wp_kses_post($defaults['textarea']); ?></textarea>
            </p>        
        </div>
        <?php 
        
    }

	/**
    * Author:         Cesar Ferreira
    * Description:    Widget on update, "merge" new data to instance array.
    * Arguments:      $new_instance - Holds new data to be saved
    *                 $old_instance - Holds old data already in the $instance
    */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['textarea'] = !empty($new_instance['textarea']) ? wp_kses_post($new_instance['textarea']) : '';
        return $instance;
    }

	/**
     *  
    * Author:         Cesar Ferreira
    * Description:    Widget function to present data after data is saved.
    * Arguments:      $args - Extra arguments passed in previous methods.
    *                 $instance - Holds information about saved data.
    */
    public function widget($args, $instance) {

         // Check the widget options 
        $textarea = !empty($instance['textarea']) ? $instance['textarea'] : '';
        if (is_category('News')) {

            echo $args['before_widget'];
        
            // Display the widget
            echo '<div class="widget-text wp_widget_plugin_box">';

                // Display widget default title 
                echo $args['before_title'].self::TITLE.$args['after_title'];
                
                // Display textarea field
                if ($textarea) {
                    echo '<p>' . $textarea . '</p>';
                }
        
            echo '</div>';
            echo $args['after_widget'];
        }
    }

}

/**
* Author:         Cesar Ferreira
* Description:    Registers widget to be set as a valid widget to activate.
* Arguments:      
*/
function registerFunFactWidget() {
    register_widget( 'FunFactWidget');
}


add_action( 'widgets_init', 'registerFunFactWidget');