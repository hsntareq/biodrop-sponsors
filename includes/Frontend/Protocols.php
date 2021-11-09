<?php

namespace Sponsor\Frontend;

class Protocols {

	public function __construct() {
		// add_filter( 'template_include', array( $this, 'sponsors_admin_page_template' ) );
		add_action( 'wp_ajax_save_protocol', array( $this, 'save_protocol' ) );
		// add_action( 'wp_ajax_nopriv_save_protocol', array( $this, 'save_protocol' ) );
	}

	public function save_protocol() {
		pr( $_REQUEST );
	}


	public function sponsors_admin_page_template( $template ) {
		global $wp;
		if ( is_user_logged_in() ) {
			$admin_template = plugin_dir_path( __FILE__ ) . 'templates/page-admin.php';
		} else {
			$allowed_urls = array( 'bs-login', 'bs-register' );
			if ( ! in_array( $wp->request, $allowed_urls ) ) {
				wp_redirect( site_url( 'bs-login' ) );
			}
			if ( $wp->request == 'bs-register' ) {
				$admin_template = plugin_dir_path( __FILE__ ) . 'templates/page-register.php';
			} elseif ( $wp->request == 'bs-login' ) {
				$admin_template = plugin_dir_path( __FILE__ ) . 'templates/page-login.php';
			}
		}

		if ( file_exists( $admin_template ) ) {
			$template = $admin_template;
		}

		return $template;
	}

}
