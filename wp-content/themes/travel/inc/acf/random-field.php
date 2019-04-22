<?php

if( ! class_exists('acf_field_random') ) :

    class acf_field_random extends acf_field {


        /*
        *  initialize
        *
        *  This function will setup the field type data
        *
        *  @type	function
        *  @date	5/03/2014
        *  @since	5.0.0
        *
        *  @param	n/a
        *  @return	n/a
        */

        function initialize() {

            // vars
            $this->name = 'random';
            $this->label = __("Random",'acf');
            $this->defaults = array(
                'default_value'	=> '',
                'maxlength'		=> '',
                'placeholder'	=> '',
                'prepend'		=> '',
                'append'		=> ''
            );

        }


        /*
        *  render_field()
        *
        *  Create the HTML interface for your field
        *
        *  @param	$field - an array holding all the field's data
        *
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        */

        function render_field( $field ) {

            // vars
            $atts = array();
            $keys = array( 'type', 'id', 'class', 'name', 'value', 'placeholder', 'maxlength', 'pattern' );
            $keys2 = array( 'readonly', 'disabled', 'required' );


            // prepend
            if( $field['prepend'] !== '' ) {

                $field['class'] .= ' acf-is-prepended';
                $html .= '<div class="acf-input-prepend">' . acf_esc_html($field['prepend']) . '</div>';

            }


            // append
            if( $field['append'] !== '' ) {

                $field['class'] .= ' acf-is-appended';
                $html .= '<div class="acf-input-append">' . acf_esc_html($field['append']) . '</div>';

            }


            // atts (value="123")
            foreach( $keys as $k ) {
                if( isset($field[ $k ]) ) $atts[ $k ] = $field[ $k ];
            }


            // atts2 (disabled="disabled")
            foreach( $keys2 as $k ) {
                if( !empty($field[ $k ]) ) $atts[ $k ] = $k;
            }


            // remove empty atts
            $atts = acf_clean_atts( $atts );


            // render
            $html .= '<div class="acf-input-wrap">' . acf_get_text_input( $atts ) . '</div>';


            // return
            echo $html;

        }


        /*
        *  render_field_settings()
        *
        *  Create extra options for your field. This is rendered when editing a field.
        *  The value of $field['name'] can be used (like bellow) to save extra data to the $field
        *
        *  @param	$field	- an array holding all the field's data
        *
        *  @type	action
        *  @since	3.6
        *  @date	23/01/13
        */

        function render_field_settings( $field ) {

            // default_value
            acf_render_field_setting( $field, array(
                'label'			=> __('Default Value','acf'),
                'instructions'	=> __('Appears when creating a new post','acf'),
                'type'			=> 'text',
                'name'			=> 'default_value',
            ));


            // placeholder
            acf_render_field_setting( $field, array(
                'label'			=> __('Placeholder Text','acf'),
                'instructions'	=> __('Appears within the input','acf'),
                'type'			=> 'text',
                'name'			=> 'placeholder',
            ));


            // prepend
            acf_render_field_setting( $field, array(
                'label'			=> __('Prepend','acf'),
                'instructions'	=> __('Appears before the input','acf'),
                'type'			=> 'text',
                'name'			=> 'prepend',
            ));


            // append
            acf_render_field_setting( $field, array(
                'label'			=> __('Append','acf'),
                'instructions'	=> __('Appears after the input','acf'),
                'type'			=> 'text',
                'name'			=> 'append',
            ));


            // maxlength
            acf_render_field_setting( $field, array(
                'label'			=> __('Character Limit','acf'),
                'instructions'	=> __('Leave blank for no limit','acf'),
                'type'			=> 'number',
                'name'			=> 'maxlength',
            ));

        }

        /**
         * validate_value
         *
         * Validates a field's value.
         *
         * @date	29/1/19
         * @since	5.7.11
         *
         * @param	(bool|string) Whether the value is vaid or not.
         * @param	mixed $value The field value.
         * @param	array $field The field array.
         * @param	string $input The HTML input name.
         * @return	(bool|string)
         */
        function validate_value( $valid, $value, $field, $input ){

            // Check maxlength
            if( $field['maxlength'] && mb_strlen(wp_unslash($value)) > $field['maxlength'] ) {
                return sprintf( __('Value must not exceed %d characters', 'acf'), $field['maxlength'] );
            }

            // Return.
            return $valid;
        }
    }


// initialize
    acf_register_field_type( 'acf_field_random' );

endif; // class_exists check

?>