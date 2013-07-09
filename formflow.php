<?php

	/*
	Plugin Name: FormFlow
	Plugin URI: http://formflow.colegissinger.com/
	Description: A comprehensive form builder for WordPress developers
	Version: 0.1
	Author: Cole Geissinger
	Author URI: http://www.colegeissinger.com
	Text Domain: geissinger-formflow
	*/

	/**
	 * Copyright (c) "2013" Cole Geiissinger. All rights reserved.
	 *
	 * Released under the GPL license
	 * http://www.opensource.org/licenses/gpl-license.php
	 *
	 * This is an add-on for WordPress
	 * http://wordpress.org/
	 *
	 * **********************************************************************
	 * This program is free software; you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation; either version 2 of the License, or
	 * (at your option) any later version.
	 *
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	 * GNU General Public License for more details.
	 * **********************************************************************
	 */


	// Load our primary class
	if ( ! class_exists( 'CG_FormFlow' ) )
		require_once( 'classes/class.formflow.php' );

	// Instantiate our class and assign it a variable to use in our helper functions
	$cg_formflow = new CG_FormFlow;

	// Load our helper functions if everything is setup.
	if ( isset( $cg_formflow ) )
		require_once( 'helpers/helper.formflow.php' );


	/**
	 * Load some styles outside of the class. This is to be completly separate to allow devs to add their own styles
	 * @return void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	function cg_formflow_resources() {
		wp_enqueue_style( 'cg-formflow-default', plugins_url( 'assets/css/default.css', __FILE__ ) );
	}
	add_action( 'wp_head', 'cg_formflow_resources' );

