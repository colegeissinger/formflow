<?php

	/**
	 * Our core class.
	 *
	 * This contains all the cool jazz that makes this plugin work.
	 *
	 * @author  Cole Geissinger <cole@colegeissinger.com>
	 * @version 0.1
	 * @since   0.1
	 */
	class CG_FormFlow {

		/**
		 * Example settings
		 * @var associate multidimensional array Contains all the data allowed to be passed to the form_settings() method.
		 */
		var $settings = array(
			array(
				'title' => 'Form Title',
				'description' => 'This is my form description, if I want one...',
				'label_placement' => 'left',
				'desc_placement'  => 'after-title',
				'args' => array(
					'class' => 'form-class',
					'id' => ''
				),
			),
		);


		/**
		 * Example data.
		 * @var associate multidimensional array
		 */
		var $data = array(
			array(
				'id'   	  => 1,
				'type' 	  => 'text',
				'label' 	  => 'Text Field',
				'value' 	  => 'TEXT',
				'required' => true,
				'args' 	  => array(
					'w_id'  	 	  => 'form-title',
					'w_class' 	  => 'form-title-class, hotdogs',
					'id'			  => 'text-field',
					'class'		  => 'text-input',
					'maxlength'   => 50,
					'description' => '',
				),
			),
			array(
				'id'   	  => 2,					// integer. The ID associated to this input field.
				'type' 	  => 'text',			// string.  options - text, textarea, dropdown, multiselect, number, checkbox, radio, image, file, date, phone, hidden, html, section, page-break
				'label' 	  => 'Text Field',	// string.  The label to add to the front-end of the form.
				'value' 	  => 'TEXT',			// string.  The default value. If added to text field, this is added into the placeholder attribute.
				'required' => true,				// boolean. Enables a field to be required for input.
				'args' 	  => array(				// array.	Arguments to pass for customizing the field.
					'w_id'  	 	  => 'form-title', // string.  The ID to apply to the wrapper element of the input field.
					'w_class' 	  => 'form-class', // string.  The class to apply to the wrapper element of the input field.
					'id'			  => 'text-field', // string.  The ID to apply to the input field itself.
					'class'		  => 'text-input', // string.  The class to apply to the input field itself.
					'maxlength'   => 50,				 // integer. Enables max-length functionality.
					'description' => '',				 // string.  The description of the field. Normally useful for explaining the field for users on the front-end.
					'conditional' => array(			 // array.   Allows us to set conditional show/hiding of input fields based on certain conditions.
						'action' => 'show', // string. The action to take such as displaying or hiding an input field. opts - show, hide 
						'logic'  => 'all',  // string. The logic we are looking for conditions to be met. opts - all, any
						'rules'  => array(  // array.  The actual rules we are looking for. Set multiple rules in separate arrays.
							array(
								'form_id'  => 1,      // integer. The ID of the form that we will conditionally check for.
								'operator' => 'is',   // string.  The detailed logic we are searching for. opts is, is not, greater than, less than, contains, starts with, ends with
								'value'    => 'taco', // string.  Match a value to make statement true. Use * to symbolize 'any thing'.
							),
						),
					),
				),
			),
		);

		/**
		 * The current version of this plugin
		 * @var string
		 */
		protected $plugin_version = '0.1';


		/**
		 * The current list of items.
		 *
		 * REQUIRED
		 * @var array
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		protected $items;


		/**
		 * Whether the class has been given some elements to process
		 * @return boolean
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function has_items() {
			return ! empty( $this->items );
		}

		/**
		 * Return an error message if nothing is passed
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function no_items() {
			_e( 'No form items set', 'geissinger-formflow');
		}


		public function __construct( $args = array() ) {
			$args = wp_parse_args( $args, array(
				'plural'   => '',
				'singular' => '',
			) );

			$args['plural'] = sanitize_key( $args['plural'] );
			$args['singular'] = sanitize_key( $args['singular'] );

		}


		public function form_settings() {
			$settings = $this->settings;
		}


		public function text_field( $args ) {

		}


		public function fields() {

			$data = $this->data;



		}


		public function process_form() {



		}


		public function display_form() {



		}
	}