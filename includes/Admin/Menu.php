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
