<?php

namespace Sponsor\Frontend;

class Protocols {

	public function __construction() {
		add_action( 'wp_ajax_save_protocol', array( $this, 'save_protocol' ) );

	}

	public function save_protocol() {
		pr( $_REQUEST );
	}
}
