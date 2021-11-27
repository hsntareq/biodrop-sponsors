<?php

namespace Sponsor\Frontend;

class Protocols {

	public function __construct() {
		// add_action( 'wp_ajax_save_protocol', array( $this, 'save_protocol' ) );
		add_filter( 'template_include', array( $this, 'sponsors_admin_page_template' ) );
		// add_action( 'admin_post_save_protocol', array( $this, 'save_protocol' ) );
	}

	public function save_protocol() {

		pr( $_REQUEST );
		die( 'wrong' );

	}

	function sponsors_admin_page_template( $template ) {
		/*
		 pr( $wp );
		if ( is_user_logged_in() ) {
			$admin_template = plugin_dir_path( __FILE__ ) . 'templates/page-admin.php';
		} else {
			$admin_template = plugin_dir_path( __FILE__ ) . 'templates/page-login.php';
		} */
		global $wp;
		if ( is_user_logged_in() ) {
			$admin_template = sponsor()->path . 'templates/page-admin.php';
		} elseif ( $wp->request == 'bs-register' ) {
				$admin_template = sponsor()->path . 'templates/page-register.php';
		} elseif ( $wp->request == 'bs-login' ) {
			$admin_template = sponsor()->path . 'templates/page-login.php';
		}

		if ( file_exists( $admin_template ) ) {
			$template = $admin_template;
		}

		return $template;
	}


}
