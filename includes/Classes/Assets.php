<?php

namespace Sponsor\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Assets
 */
class Assets {

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'admin_init', array( $this, 'admin_bootstrap_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_meta_data' ) );

	}


	public function load_meta_data() {
		// Localize scripts
		$localize_data = apply_filters( 'sponsor_localize_data', $this->get_default_localized_data() );
		wp_localize_script( 'sponsor-admin', '_appObject', $localize_data );
		wp_localize_script( 'sponsor-builder', '_appObject', $localize_data );

		// Inline styles
		// wp_add_inline_style( 'sponsor-frontend', $this->load_color_palette() );
		// wp_add_inline_style( 'sponsor-admin', $this->load_color_palette() );
	}


	/**
	 * Function get_default_localized_data
	 *
	 * @return array
	 */
	private function get_default_localized_data() {
		return array(
			'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
			'home_url'         => get_home_url(),
			'base_path'        => sponsor()->basepath,
			'sponsor_url'      => sponsor()->url,
			'nonce_key'        => sponsor()->nonce,
			sponsor()->nonce   => wp_create_nonce( sponsor()->nonce_action ),
			'loading_icon_url' => get_admin_url() . 'images/wpspin_light.gif',
		);
	}

	/**
	 * Function to enqueue admin_scripts
	 *
	 * @return void
	 */
	public function admin_bootstrap_init() {

		if ( in_array( get_request( 'page' ), sponsor()->alowed_bootstrap_pages ) ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_bootstrap_style' ) );
		}
	}

	public function admin_bootstrap_style() {
		wp_enqueue_style( 'sponsor-bootstrap', sponsor()->url . 'assets/css/bootstrap.min.css', array(), sponsor()->version );
	}

	public function admin_scripts() {
		wp_enqueue_style( 'sponsor-fontawesome', sponsor()->url . 'assets/css/fontawesome/all.css', array(), sponsor()->version );
		// wp_enqueue_style( 'sponsor-select2', sponsor()->url . 'assets/css/select2.min.css', array(), sponsor()->version );
		wp_enqueue_style( 'sponsor-admin', sponsor()->url . 'assets/css/sponsor.css', array(), sponsor()->version );

		wp_enqueue_script( 'sponsor-bootstrap', sponsor()->url . 'assets/js/bootstrap.bundle.min.js', array(), sponsor()->version, true );

		// wp_enqueue_script( 'sponsor-select2', sponsor()->url . 'assets/js/select2.min.js', array( 'jquery' ), sponsor()->version, true );
		wp_enqueue_script( 'sponsor-lib', sponsor()->url . 'assets/js/lib.js', array(), sponsor()->version, true );
		wp_enqueue_script( 'sponsor-admin', sponsor()->url . 'assets/js/sponsor.js', array(), sponsor()->version, true );

		// wp_enqueue_media();

		/*
		 wp_enqueue_script( 'sponsor-admin', sponsor()->url . 'assets/js/sponsor-admin.js', array(), sponsor()->version, true );

		$sponsor_localize_data = $this->get_default_localized_data();

		$sponsor_localize_data = apply_filters( 'sponsor_localize_data', $sponsor_localize_data );
		wp_localize_script( 'sponsor-admin', '_sponsorobject', $sponsor_localize_data ); */

	}


}
