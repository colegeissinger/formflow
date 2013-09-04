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
		 * Allow us to set the demo settings and forms. This will also enable debugging for the form outputs
		 * @var boolean
		 */
		private $form_debug = false;


		/**
		 * Default Settings when no settings exist
		 * @var associate multidimensional array
		 */
		private $demo_settings = array(
			'title' => 'Form Title',
			'description' => 'This is my form description, if I want one...',
			'label_left' => false,
			'desc_placement'  => 'after-title',
			'args' => array(
				'class' => 'form-class',
				'id' => ''
			),
		);


		/**
		 * Default Form when no fields exist
		 * @var associate multidimensional array
		 */
		private $demo_form = array(
			array(
				'id'   	   => 1,
				'type' 	   => 'text',
				'required' => true,
				'args' 	   => array(
					'w_id'  	  => 'form-title',
					'w_class' 	  => 'form-title-class, hotdogs',
					'id'		  => 'text-field',
					'class'		  => 'text-input',
					'label' 	  => 'Text Field',
					'placeholder' => 'TEXT sdagusdhgsuh',
					'name'	  	  => 'first-text',
					'description' => 'asfddsf',
					'maxlength'   => 50,
				),
			),
			array(
				'id'   	   => 2,					// integer. The ID associated to this input field.
				'type' 	   => 'text',				// string.  options - text, textarea, dropdown, multiselect, number, checkbox, radio, image, file, date, phone, hidden, html, section, page-break
				'required' => true,					// boolean. Enables a field to be required for input.
				'args' 	   => array(				// array.	Arguments to pass for customizing the field.
					'w_id'  	  => 'form-title',  // string.  The ID to apply to the wrapper element of the input field.
					'w_class' 	  => 'form-class',  // string.  The class to apply to the wrapper element of the input field.
					'id'		  => 'text-field',  // string.  The ID to apply to the input field itself.
					'class'		  => 'text-input',  // string.  The class to apply to the input field itself.
					'label' 	  => 'Text Field',  // string.  The label to add to the front-end of the form.
					'placeholder' => 'placeholder', // string.  The default value. If added to text field, this is added into the placeholder attribute.
					'name'	  	  => 'text[]',		// string.  The name field. If not set, the label is used instead. To create an array use []
					'description' => '',			// string.  The description of the field. Normally useful for explaining the field for users on the front-end.
					'maxlength'   => 50,		    // integer. Enables max-length functionality.
				),
				'conditional' => array(	  // array.  Allows us to set conditional show/hiding of input fields based on certain conditions.
					'action'  => 'show',  // string. The action to take such as displaying or hiding an input field. opts - show, hide
					'logic'   => 'all',   // string. The logic we are looking for conditions to be met. opts - all, any
					'rules'   => array(   // array.  The actual rules we are looking for. Set multiple rules in separate arrays.
						array(
							'form_id'  => 1,      // integer. The ID of the form that we will conditionally check for.
							'operator' => 'is',   // string.  The detailed logic we are searching for. opts is, is not, greater than, less than, contains, starts with, ends with
							'value'    => 'taco', // string.  Match a value to make statement true. Use * to symbolize 'any thing'.
						),
					),
				),
			),
			array(
				'id'   	   => 3,
				'type' 	   => 'textarea',
				'required' => false,
				'args' 	   => array(
					'w_id'  	  => 'form-title',
					'w_class' 	  => 'form-title-class',
					'id'		  => 'text-field',
					'class'		  => 'text-input',
					'label' 	  => 'TEXTAREA',
					'placeholder' => 'textarea placeholder',
					'name'	  	  => 'first-text',
					'description' => 'My awesome textarea yo.',
					'maxlength'   => 250,
					'cols'		  => 30, // integer.  Set a column width if needed.
					'rows'		  => 10, // integer.  Set a row width if needed.
				),
			),
			array(
				'id'   	   => 4,
				'type' 	   => 'dropdown',
				'required' => false,
				'args' 	   => array(
					'w_id'  	  => 'form-title',
					'w_class' 	  => 'form-title-class',
					'id'		  => 'text-field',
					'class'		  => 'text-input',
					'label' 	  => 'DROPDOWN',
					'name'	  	  => 'first-text',
					'description' => 'dropdown',
					'options'	  => array(	// Sets up our select drop down. Set each option field with $value => $label
						'value1' => 'Value 1',
						'value2' => 'Value 2',
						'value3' => 'Value 3',
						'value4' => 'Value 4',
						'value5' => 'Value 5',
					),
				),
			),
			array(
				'id'   	   => 5,
				'type' 	   => 'multiselect',
				'required' => false,
				'args' 	   => array(
					'w_id'  	  => 'form-title',
					'w_class' 	  => 'form-title-class',
					'id'		  => 'text-field',
					'class'		  => 'text-input',
					'label' 	  => 'MULTISELECT',
					'name'	  	  => 'first-text',
					'description' => 'dropdown',
					'size'	  => 2, // New field, unique to Multiselect. This allows us to specify how many fields we want to show before the rest is shown with scrolling
					'options'	  => array(	// Sets up our select drop down. Set each option field with $value => $label
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
		private $plugin_version = '0.1';


		/**
		 * Custom Settings when no settings exist
		 * @var associate multidimensional array
		 */
		private $settings;


		/**
		 * Custom Form Fields
		 * @var associate multidimensional array
		 */
		private $form;


		/**
		 * Main loader.
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function __construct( $settings = array(), $form = array() ) {

			// Pass our custom settings or else get the default (only for development)
			$this->settings = ( empty( $settings ) && $this->form_debug ) ? $this->demo_settings : $settings;

			// Pass our custom Form or else get the default (only for development)
			$this->form     = ( empty( $form ) && $this->form_debug ) ? $this->demo_form : $form;
		}


		/**
		 * Whether the class has been given some form fields to process
		 * @return boolean
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function has_form_fields() {
			if ( empty( $this->form ) || is_null( $this->form ) ) {
				return false;
			} else {
				return true;
			}
		}


		/**
		 * Return an error message if nothing is passed
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function no_items() {
			echo '<h3>These are not the forms you are looking for...</h3>';
			echo '<p>Whooooops! Looks like there are no forms to process..</p>';
			echo '<p>Make sure you provide an array of form fields to output.</p>';
		}


		/**
		 * Processes all of our form fields
		 * @param  boolean
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function fields( $alignment_left = false ) {

			// Get the form data
			$fields = $this->form;
			$output = '';

			foreach ( $fields as $field ) {
				$args         = $field['args'];
				$conditionals = $field['conditional'];

				// Add our left class if the option is set
				if ( $alignment_left && ! empty( $args['w_class'] ) ) {
					$args['w_class']   .= ' left';
					$args['label_left'] = true;
				} elseif ( $alignment_left && empty( $args['w_class'] ) ) {
					$args['w_class']   .= 'left';
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

					// Add our description if left aligned form fields is NOT set.
					if ( isset( $args['description'] ) && ! empty( $args['description'] ) && ! $alignment_left )
						$output .= '<div class="ff_description">' . $args['description'] . '</div>';

					// Return the proper form field
					$output .= $this->get_field( $field['type'], $args );

					// If left aligned form fields are set, let's add the description below the form field
					if ( isset( $args['description'] ) && ! empty( $args['description'] ) && $alignment_left )
						$output .= '<div class="ff_description">' . $args['description'] . '</div>';

				// Close the field wrapper.
				$output .= '</li>';
			}

			return $output;

		}


		/**
		 * Check our conditionals and setup the right data attribute for use in JavaScript validation
		 * @param  string  $type  The type of input field we want to return
		 * @param  array   $args  An array of arguments to pass to the input field functions
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function check_conditionals( $conditionals ) {

			if ( isset( $conditionals ) && is_array( $conditiaonls ) ) {

			}

		}


		/**
		 * Return an error message if nothing is passed
		 * @param string  $type  The type of input field we want to return
		 * @param array   $args  An array of arguments to pass to the input field functions
		 * @return void
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_field( $type, $args ) {

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
		private function get_text_field( $args ) {

			if ( ! empty( $args ) ) {
				$output = '<input type="text"';

					// Set our name field, if one doesn't exist, use the label
					if ( isset( $args['name'] ) ) {
						$output .= ' name="' . esc_attr( $args['name'] ) . '"';
					} else {
						$output .= ' name="' . esc_attr( $args['label'] ) . '"';
					}

					// Check for an ID
					if ( isset( $args['id'] ) )
						$output .= ' id="' . esc_attr( $args['id'] ) . '"';

					// Check for a class
					if ( isset( $args['class'] ) )
						$output .= ' class="' . esc_attr( $args['class'] ) . '"';

					// Add our placeholder when a value is set
					if ( isset( $args['placeholder'] ) )
						$output .= ' placeholder="' . esc_attr( $args['placeholder'] ) . '"';

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
		private function get_textarea( $args ) {

			if ( ! empty( $args ) ) {
				$output = '<textarea';

					// Set our name field, if one doesn't exist, other wise use the label
					if ( isset( $args['name'] ) ) {
						$output .= ' name="' . esc_attr( $args['name'] ) . '"';
					} else {
						$output .= ' name="' . esc_attr( $args['label'] ) . '"';
					}

					// Check for an ID
					if ( isset( $args['id'] ) )
						$output .= ' id="' . esc_attr( $args['id'] ) . '"';

					// Check if a column size is set
					if ( isset( $args['cols'] ) )
						$output .= ' cols="' . esc_attr( $args['cols'] ) . '"';

					// Check if a row size is set
					if ( isset( $args['rows'] ) )
						$output .= ' rows="' . esc_attr( $args['rows'] ) . '"';

					// Add a placeholder if set
					if ( isset( $args['placeholder'] ) )
						$output .= ' placeholder="' . esc_attr( $args['placeholder'] ) . '"';

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
		private function get_dropdown( $args ) {

			if ( ! empty( $args ) ) {
				$output = '<select';

					// Set our name field
					if ( isset( $args['name'] ) ) {
						$output .= ' name="' . esc_attr( $args['name'] ) . '"';
					} else {
						$output .= ' name="' . esc_attr( $args['label'] ) . '"';
					}

					// Check if an ID is set
					if ( isset( $args['id'] ) )
						$output .= ' id="' . esc_attr( $args['id'] ) . '"';

					// Check if a class is set
					if ( isset( $args['class'] ) )
						$output .= ' class="' . esc_attr( $args['class'] ) . '"';

				$output .= '>';

					foreach ( $args['options'] as $value => $label ) {
						$output .= '<option value="' . esc_attr( $value ) . '">' . esc_html( $label ) . '</option>';
					}

				$output .= '</select>';

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
		private function get_multiselect( $args ) {

			if ( ! empty( $args ) ) {
				$output = '<select';

					// Set our name field
					if ( isset( $args['name'] ) ) {
						$output .= ' name="' . esc_attr( $args['name'] ) . '"';
					} else {
						$output .= ' name="' . urlencode( $args['label'] ) . '"';
					}

					// Check if an ID is set
					if ( isset( $args['id'] ) )
						$output .= ' id="' . esc_attr( $args['id'] ) . '"';

					// Check if a class is set
					if ( isset( $args['class'] ) )
						$output .= ' class="' . esc_attr( $args['class'] ) . '"';

				$output .= ' multiple size="' . absint( $args['size'] ) . '">';

					foreach ( $args['options'] as $value => $label ) {
						$output .= '<option value="' . esc_attr( $value ) . '">' . esc_html( $label ) . '</option>';
					}

				$output .= '</select>';

				return $output;
			}
		}


		/**
		 * Return an input field that only handles integers
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_number_field( $args ) {

		}


		/**
		 * Return a checkbox input field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_checkbox( $args ) {

		}


		/**
		 * Return a radio input field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_radio( $args ) {

		}


		/**
		 * Return a file upload field that only checks against image types
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_image_upload( $args ) {

		}


		/**
		 * Return a file upload field that only checks against file types
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_file_upload( $args ) {

		}


		/**
		 * Return a date picker field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_date_field( $args ) {

		}


		/**
		 * Return an input field that only handles integers
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_phone_field( $args ) {

		}


		/**
		 * Return a hidden input field
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_hidden_field( $args ) {

		}


		/**
		 * Return an HTML block
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_html_block( $args ) {

		}


		/**
		 * Return the section wrapper
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_section_wrapper( $args ) {

		}


		/**
		 * Return the page break
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function get_page_break( $args ) {

		}


		/**
		 * Calling this method will process all form inputs and pass them to the save method.
		 * @return string
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		private function process_form() {

		}


		/**
		 * The grand-daddy. This method will process all the data we have created and will output them into an actual working form.
		 * @return mixed
		 *
		 * @version 0.1
		 * @since   0.1
		 */
		public function display_form() { 

			// Get our custom form settings
			$settings = $this->settings;

			if ( $this->has_form_fields() ) : ?>
				<form action="<?php $this->process_form(); ?>" class="formflow-form">
					<fieldset>
						
						<?php if ( isset( $settings['title'] ) && ! empty( $settings['title'] ) ) : ?>
							<legend class="form-title"><?php echo $settings['title']; ?></legend>
						<?php endif; ?>

						<?php if ( isset( $settings['description'] ) && ! empty( $settings['description'] ) ) : ?>
							<p class="form-description"><?php echo $settings['description']; ?></p>
						<?php endif; ?>

						<ol>
							<?php echo $this->fields( $settings['label_left'] ); ?>
						</ol>
					</fieldset>
					<fieldset class="submit">
						<input type="submit" value="Submit" class="submit" />
					</fieldset>
				</form>
			<?php else : ?>
				<?php echo $this->no_items(); ?>
			<?php endif;
		}
	}