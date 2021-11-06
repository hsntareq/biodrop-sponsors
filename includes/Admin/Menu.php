<?php

namespace Sponsor\Admin;

/**
 * Menu
 */
class Menu {

	public $protocol;
	/**
	 * Function __construct
	 *
	 * @return void
	 */
	public function __construct( $protocol ) {
		$this->protocol = $protocol;
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_head', array( $this, 'my_custom_public_page' ) );
	}

	function my_custom_public_page() {
		if ( isset( $_GET['room_type'] ) ) {
			  $dir = plugin_dir_path( __FILE__ );
			  die( 'hi' );
			include $dir . 'custom_page.php';

		}
	}

	/**
	 * Function admin_menu
	 *
	 * @return void
	 */
	public function admin_menu() {
		$parent_slug = 'sponsor';
		$capability  = 'manage_options';
		$callable    = 'plugin_main_page';
		add_menu_page( __( 'Sponsor Portal', 'sponsor' ), __( 'Sponsor Portal', 'sponsor' ), $capability, $parent_slug, array( $this->protocol, $callable ), 'dashicons-art', 2 );
		add_submenu_page( $parent_slug, __( 'Sponsor Portal', 'sponsor' ), __( 'Sponsor Portal', 'sponsor' ), $capability, $parent_slug, array( $this->protocol, $callable ) );
		add_submenu_page( $parent_slug, __( 'Settings', 'sponsor' ), __( 'Settings', 'sponsor' ), 'administrator', 'biodrop-settings', array( $this, 'settings_page' ) );
		if ( current_user_can( 'sponsor' ) ) {

			// remove_menu_page( 'profile.php' );
			remove_menu_page( 'edit.php' );
			remove_menu_page( 'upload.php' );
			remove_menu_page( 'edit.php?post_type=page' );
			remove_menu_page( 'edit-comments.php' );
			remove_menu_page( 'themes.php' );
			remove_menu_page( 'plugins.php' );
			// remove_menu_page( 'users.php' );
			remove_menu_page( 'tools.php' );
			remove_menu_page( 'options-general.php' );

		}

		add_options_page(
			__( 'Page Title', 'textdomain' ),
			__( 'Circle Tree Login', 'textdomain' ),
			'manage_options',
			'sponsors',
			array(
				$this,
				'settings_page_role',
			)
		);
	}

	public function settings_page_role() {
		echo __( 'This is the page content', 'textdomain' );
	}



	/**
	 * Function plugin_page
	 *
	 * @return void
	 */
	public function settings_page() {
		$main_nav = new Settings();
		$main_nav->menu_page();
	}

	/**
	 * Function plugin_page
	 *
	 * @return void
	 */
	public function plugin_subpage() {
		echo 'Base sub Plugin';
	}
}
