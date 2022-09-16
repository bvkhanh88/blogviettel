<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ReduxFramework_label_value' ) ) {
    class ReduxFramework_label_value {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since ReduxFramework 1.0.0
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;

	        $defaults = array(
		        'label' => '',
		        'text'   => '',
	        );

	        $this->value = wp_parse_args( $this->value, $defaults );

	        // In case user passes no default values.
	        if ( isset( $this->field['default'] ) ) {
		        $this->field['default'] = wp_parse_args( $this->field['default'], $defaults );
	        } else {
		        $this->field['default'] = $defaults;
	        }
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since ReduxFramework 1.0.0
         */
        function render() {
			?>
	        <div class="label-value-wrapper">
		        <div class="label-value-inner">
			        <label for="<?php echo esc_attr($this->field['name'] . $this->field['name_suffix'] . '-label'); ?>"><?php esc_html_e('Label','kbw'); ?></label>
			        <input type="text" id="<?php echo esc_attr($this->field['name'] . $this->field['name_suffix'] . '-label'); ?>" name="<?php echo esc_attr($this->field['name'] . $this->field['name_suffix'] . '[label]'); ?>" value="<?php echo esc_attr($this->value['label']); ?>"/>
		        </div>
		        <div class="label-value-inner">
			        <label for="<?php echo esc_attr($this->field['name'] . $this->field['name_suffix'] . '-value'); ?>"><?php esc_html_e('Text','kbw'); ?></label>
			        <input type="text" id="<?php echo esc_attr($this->field['name'] . $this->field['name_suffix'] . '-value'); ?>" name="<?php echo esc_attr($this->field['name'] . $this->field['name_suffix'] . '[value]'); ?>" value="<?php echo esc_attr($this->value['value']); ?>"/>
		        </div>
	        </div>
			<?php
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since ReduxFramework 3.0.0
         */
        function enqueue() {
	        wp_enqueue_style(
		        'redux-label-value-css',
		        ReduxFramework::$_url . 'inc/fields/label_value/field_label_value.css',
		        array(),
		        time(),
		        'all'
	        );
        }
    }
}