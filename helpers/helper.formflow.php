<?php
	
	
	/**
	 * Allows us to pass our settings array to the class
	 * @param  array  $settings The array that defines our settings
	 * @return array|boolean
	 */
	function cg_formflow_set_form_settings( $settings = array() ) {
		if ( empty( $settings ) ) {
			return false;
		} else {
			return $settings;
		}
	}


	/**
	 * Allows us to pass our form array to the class
	 * @param  array  $form The array that defines our form
	 * @return array|boolean
	 */
	function cg_formflow_set_form_fields( $form = array() ) {
		if ( empty( $form ) ) {
			return false;
		} else {
			return $form;
		}
	}


	/**
	 * Display our form
	 * @return void
	 */
	function cg_formflow_display_form() {
		global $cg_formflow;

		$cg_formflow->display_form();
	}