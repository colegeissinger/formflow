<?php



	/**
	 * Display our form
	 * @return void
	 */
	function cg_formflow_display_form( $settings = array(), $form = array() ) {

		$cg_formflow = new CG_FormFlow( $settings, $form );

		$cg_formflow->display_form();
	}