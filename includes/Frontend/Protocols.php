<?php

namespace Sponsor\Frontend;

class Protocols {

	public function __construct() {
		// add_action( 'wp_ajax_save_protocol', array( $this, 'save_protocol' ) );
		// die( 'fixed' );
	}

	public function save_protocol() {
		pr( $_REQUEST );
	}



}
