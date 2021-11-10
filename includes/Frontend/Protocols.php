<?php

namespace Sponsor\Frontend;

class Protocols {

	public function __construct() {
		add_action( 'wp_ajax_save_protocol', array( $this, 'save_protocol' ) );
		add_action( 'wp_ajax_nopriv_save_protocol', array( $this, 'save_protocol' ) );
		add_filter( 'template_include', array( $this, 'sponsors_admin_page_template' ), 1000, 1 );
	}

	public function save_protocol() {

		pr( $_REQUEST );
	}

	function sponsors_admin_page_template( $template ) {
		/*
		 pr( $wp );
		if ( is_user_logged_in() ) {
			$admin_template = plugin_dir_path( __FILE__ ) . 'templates/page-admin.php';
		} else {
			$admin_template = plugin_dir_path( __FILE__ ) . 'templates/page-login.php';
		} */
		if ( is_user_logged_in() ) {
			$admin_template = sponsor()->path . 'templates/page-admin.php';
		} else {
			$admin_template = sponsor()->path . 'templates/page-login.php';
		}

		if ( file_exists( $admin_template ) ) {
			$template = $admin_template;
		}

		return $template;
	}


}
