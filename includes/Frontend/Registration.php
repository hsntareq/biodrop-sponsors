<?php
namespace Sponsor\Frontend;

/**
 * Class Shortcode
 */
class Registration {

	/**
	 * Function __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_shortcode( 'page_template', array( $this, 'sponsor_registration_template' ) );
	}


	/**
	 * Function render_shortcode
	 *
	 * @param  var $attr
	 * @param  var $content
	 * @return string
	 */
	public function sponsor_registration_template( $page_template ) {
		if ( is_page( 'sponsor-registration' ) ) {
			$page_template = dirname( __FILE__ ) . '/templates/sponsor-registration-template.php';
		}
		return $page_template;
	}


}
