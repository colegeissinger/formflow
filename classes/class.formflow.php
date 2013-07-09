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
				'required' => true,
				'args' 	  => array(
					'w_id'  	 	  => 'form-title',
					'w_class' 	  => 'form-title-class, hotdogs',
					'id'			  => 'text-field',
					'class'		  => 'text-input',
					'label' 	  	  => 'Text Field',
					'placeholder' => 'TEXT',
					'name'	  	  => 'first-text',
					'description' => 'asfddsf',
					'maxlength'   => 50,
				),
			),
			array(
				'id'   	  => 2,					// integer. The ID associated to this input field.
				'type' 	  => 'text',			// string.  options - text, textarea, dropdown, multiselect, number, checkbox, radio, image, file, date, phone, hidden, html, section, page-break
				'required' => true,				// boolean. Enables a field to be required for input.
				'args' 	  => array(				// array.	Arguments to pass for customizing the field.
					'w_id'  	 	  => 'form-title',  // string.  The ID to apply to the wrapper element of the input field.
					'w_class' 	  => 'form-class',  // string.  The class to apply to the wrapper element of the input field.
					'id'			  => 'text-field',  // string.  The ID to apply to the input field itself.
					'class'		  => 'text-input',  // string.  The class to apply to the input field itself.
					'label' 	  	  => 'Text Field',  // string.  The label to add to the front-end of the form.
					'placeholder' => 'placeholder', // string.  The default value. If added to text field, this is added into the placeholder attribute.
					'name'	  	  => 'text[]',		  // string.  The name field. If not set, the label is used instead. To create an array use []
					'description' => '',				  // string.  The description of the field. Normally useful for explaining the field for users on the front-end.
					'maxlength'   => 50,				  // integer. Enables max-length functionality.
				),
				'conditional' => array(	// array.  Allows us to set conditional show/hiding of input fields based on certain conditions.
					'action' => 'show',  // string. The action to take such as displaying or hiding an input field. opts - show, hide
					'logic'  => 'all',   // string. The logic we are looking for conditions to be met. opts - all, any
					'rules'  => array(   // array.  The actual rules we are looking for. Set multiple rules in separate arrays.
						array(
							'form_id'  => 1,      // integer. The ID of the form that we will conditionally check for.
							'operator' => 'is',   // string.  The detailed logic we are searching for. opts is, is not, greater than, less than, contains, starts with, ends with
							'value'    => 'taco', // string.  Match a value to make statement true. Use * to symbolize 'any thing'.
						),
					),
				),
			),
			array(
				'id'   	  => 3,
				'type' 	  => 'textarea',
				'required' => false,
				'args' 	  => array(
					'w_id'  	 	  => 'form-title',
					'w_class' 	  => 'form-title-class',
					'id'			  => 'text-field',
					'class'		  => 'text-input',
					'label' 	  	  => 'TEXTAREA',
					'placeholder' => 'textarea placeholder',
					'name'	  	  => 'first-text',
					'description' => 'My awesome textarea yo.',
					'maxlength'   => 250,
					'cols'		  => 30,					// integer.  Set a column width if needed.
					'rows'		  => 10,					// integer.  Set a row width if needed.
				),
			),
			array(
				'id'   	  => 3,
				'type' 	  => 'dropdown',
				'required' => false,
				'args' 	  => array(
					'w_id'  	 	  => 'form-title',
					'w_class' 	  => 'form-title-class',
					'id'			  => 'text-field',
					'class'		  => 'text-input',
					'label' 	  	  => 'DROPDOWN',
					'name'	  	  => 'first-text',
					'description' => 'dropdown',
					'options'	  => array(			// Sets up our select drop down. Set each option field with $value => $label
						'value1' => 'Value 1',
						'value2' => 'Value 2',
						'value3' => 'Value 3',
						'value4' => 'Value 4',
						'value5' => 'Value 5',
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


		/**
		 * Return an error message if nothing is passed
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function __construct( $args = array() ) {
			$args = wp_parse_args( $args, array(
				'plural'   => '',
				'singular' => '',
			) );

			$args['plural'] = sanitize_key( $args['plural'] );
			$args['singular'] = sanitize_key( $args['singular'] );

		}


		/**
		 * Return an error message if nothing is passed
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function form_settings() {
			$settings = $this->settings;
		}


		/**
		 * Return an error message if nothing is passed
		 * @param  boolean
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function fields( $left = false ) {

			// Get the form data
			$fields = $this->data;
			$output = '';

			foreach ( $fields as $field ) {
				$args   		  = $field['args'];
				$conditionals = $field['conditional'];

				// Add our left class if the option is set
				if ( $left && ! empty( $args['w_class'] ) ) {
					$args['w_class'] .= ' left';
					$args['label_left'] = true;
				} elseif ( $left && empty( $args['w_class'] ) ) {
					$args['w_class'] .= 'left';
					$args['label_left'] = true;
				}

				// Start our field wrapper, which is an LI.
				$output .= '<li';

					// Set a wrapper ID if present.
					if ( isset( $args['w_id'] ) && ! empty( $args['w_id'] ) )
						$output .= ' id="' . esc_attr( $args['conditional']['id'] ) . '"';

					// Set a wrapper class if present.
					if ( isset( $args['w_class'] )  && ! empty( $args['w_class'] ) )
						$output .= ' class="' . $args['w_class'] . '"';

					// Check if the field is required
					if ( $field['required'] )
						$output .= ' data-formflow-required="true"';

					// Check if a conditional is set
					if ( isset( $conditionals ) && is_array( $conditionals ) )
						$this->check_conditionals( $conditionals );

				// Close the opening li tag.
				$output .= '>';

					// Create the opening label.
					$output .= '<label';

						// Set our for value if a form id.
						if ( isset( $args['id'] ) && ! empty( $args['id'] ) )
							$output .= ' for="' . $args['id'] . '"';

					// Close the opening label tag.
					$output .= '>';

						// Check that a label exists...
						if ( isset( $args['label'] ) && ! empty( $args['label'] ) )
							$output .= $args['label'];

					// Close the label tag
					$output .= '</label>';

					if ( isset( $args['description'] ) && ! empty( $args['description'] ) && ! $left )
						$output .= '<div class="description">' . $args['description'] . '</div>';

					// Return the proper form field
					$output .= $this->get_field( $field['type'], $args );

				// Close the field wrapper.
				$output .= '</li>';
			}

			return $output;

		}


		/**
		 * Check our conditionals and setup the right data attribute for use in JavaScript validation
		 * @param string $type The type of input field we want to return
		 * @param array  $args An array of arguments to pass to the input field functions
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function check_conditionals( $conditionals ) {

			if ( isset( $conditionals ) && is_array( $conditiaonls ) ) {

			}
		}


		/**
		 * Return an error message if nothing is passed
		 * @param string $type The type of input field we want to return
		 * @param array  $args An array of arguments to pass to the input field functions
		 * @return void
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_field( $type, $args ) {

			switch ( $type ) {
				case 'text':
					return $this->get_text_field( $args );
					break;
				case 'textarea':
					return $this->get_textarea( $args );
					break;
				case 'dropdown':
					return $this->get_dropdown( $args );
					break;
				case 'multiselect':
					return $this->get_multiselect( $args );
					break;
				case 'number':
					return $this->get_number_field( $args );
					break;
				case 'checkbox':
					return $this->get_checkbox( $args );
					break;
				case 'radio':
					return $this->get_radio( $args );
					break;
				case 'image':
					return $this->get_image_upload( $args );
					break;
				case 'file':
					return $this->get_file_upload( $args );
					break;
				case 'date':
					return $this->get_date_field( $args );
					break;
				case 'phone':
					return $this->get_phone_field( $args );
					break;
				case 'hidden':
					return $this->get_hidden_field( $args );
					break;
				case 'html':
					return $this->get_html_block( $args );
					break;
				case 'section':
					return $this->get_section_wrapper( $args );
					break;
				case 'page-break':
					return $this->get_page_break( $args );
					break;
			}
		}


		/**
		 * Return the text input field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_text_field( $args ) {

			if ( ! empty( $args ) ) {
				$output = '<input type="text"';

					// Set our name field, if one doesn't exist, use the label
					if ( isset( $args['name'] ) ) {
						$output .= ' name="' . $args['name'] . '"';
					} else {
						$output .= ' name="' . urlencode( $args['label'] ) . '"';
					}

					// Check for an ID
					if ( isset( $args['id'] ) )
						$output .= ' id="' . $args['id'] . '"';

					// Check for a class
					if ( isset( $args['class'] ) )
						$output .= ' class="' . $args['class'] . '"';

					// Add our placeholder when a value is set
					if ( isset( $args['placeholder'] ) )
						$output .= ' placeholder="' . $args['placeholder'] . '"';

				$output .= ' />';

				return $output;
			}
		}


		/**
		 * Return the textarea field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_textarea( $args ) {

			if ( ! empty( $args ) ) {
				$output = '<textarea';

					// Set our name field, if one doesn't exist, other wise use the label
					if ( isset( $args['name'] ) ) {
						$output .= ' name="' . $args['name'] . '"';
					} else {
						$output .= ' name="' . urlencode( $args['label'] ) . '"';
					}

					// Check for an ID
					if ( isset( $args['id'] ) )
						$output .= ' id="' . $args['id'] . '"';

					// Check if a column size is set
					if ( isset( $args['cols'] ) )
						$output .= ' cols="' . $args['cols'] . '"';

					// Check if a row size is set
					if ( isset( $args['rows'] ) )
						$output .= ' rows="' . $args['rows'] . '"';

					// Add a placeholder if set
					if ( isset( $args['placeholder'] ) )
						$output .= ' placeholder="' . $args['placeholder'] . '"';

				$output .= '></textarea>';

				return $output;
			}
		}


		/**
		 * Return the dropdown field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_dropdown( $args ) {

			if ( ! empty( $args ) ) {
				$output = '<select';

					// Set our name field
					if ( isset( $args['name'] ) ) {
						$output .= ' name="' . $args['name'] . '"';
					} else {
						$output .= ' name="' . urlencode( $args['label'] ) . '"';
					}

					// Check if an ID is set
					if ( isset( $args['id'] ) )
						$output .= ' id="' . $args['id'] . '"';

					// Check if a class is set
					if ( isset( $args['class'] ) )
						$output .= ' class="' . $args['class'] . '"';

				$output .= '>';

					foreach ( $args['options'] as $value => $label ) {
						$output .= '<option value="' . $value . '">' . $label . '</option>';
					}

				$output .= '</select>';

				if ( isset( $args['label_left'] ) && $args['label_left'] )
					$output .= '<div class="description">' . $args['description'] . '</div>';

				return $output;
			}
		}


		/**
		 * Return the multiselect field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_multiselect( $args ) {

		}


		/**
		 * Return an input field that only handles integers
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_number_field( $args ) {

		}


		/**
		 * Return a checkbox input field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_checkbox( $args ) {

		}


		/**
		 * Return a radio input field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_radio( $args ) {

		}


		/**
		 * Return a file upload field that only checks against image types
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_image_upload( $args ) {

		}


		/**
		 * Return a file upload field that only checks against file types
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_file_upload( $args ) {

		}


		/**
		 * Return a date picker field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_date_field( $args ) {

		}


		/**
		 * Return an input field that only handles integers
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_phone_field( $args ) {

		}


		/**
		 * Return a hidden input field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_hidden_field( $args ) {

		}


		/**
		 * Return an HTML block
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_html_block( $args ) {

		}


		/**
		 * Return the section wrapper
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_section_wrapper( $args ) {

		}


		/**
		 * Return the page break
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function get_page_break( $args ) {

		}


		/**
		 * Calling this method will process all form inputs and pass them to the save method.
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function process_form() {

		}


		/**
		 * The grand-daddy. This method will process all the data we have created and will output them into an actual working form.
		 * @return mixed
		 */
		public function display_form() { ?>
			<form action="<?php $this->process_form(); ?>" class="formflow-form">
				<fieldset>
					<legend>Form Sign-up Thing</legend>
					<ol>
						<?php echo $this->fields( true ); ?>
					</ol>
				</fieldset>
				<fieldset class="submit">
					<input type="submit" value="Submit" class="submit" />
				</fieldset>
			</form>
		<?php }
	}