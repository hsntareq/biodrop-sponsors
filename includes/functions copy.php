<?php

add_action( 'admin_init', 'sponsor_no_admin_access', 100 );
function sponsor_no_admin_access() {
	$redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/bs-admin' );
	global $current_user;
	if ( in_array( 'sponsor', $current_user->roles ) ) {
		exit( wp_redirect( $redirect ) );
	}
}



add_action( 'init', 'sponsor_admin_access', 100 );
function sponsor_admin_access() {
	global $current_user;
	if ( in_array( 'sponsor', $current_user->roles ) ) {
		add_filter( 'show_admin_bar', '__return_false' );
	}
}


function current_username() {
	global $current_user;
	return $current_user->display_name;
}

add_filter( 'template_include', 'sponsors_admin_page_template', 1000, 1 );
function sponsors_admin_page_template( $template ) {
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

function sp_header() {
	require sponsor()->path . 'includes/header-custom.php';
}
function sp_footer() {
	require sponsor()->path . 'includes/footer-custom.php';
}

function sp_po_insert_protocol( $args = array() ) {
	global $wpdb;

	if ( empty( $args['name'] ) ) {
		return new \WP_Error( 'no-name', __( 'You must provide a name', 'sponsor-portal' ) );
	}

	$defaults = array(
		'name'       => '',
		'address'    => '',
		'phone'      => '',
		'created_by' => get_current_user_id(),
		'created_at' => current_time( 'mysql' ),
	);
	$data     = wp_parse_args( $args, $defaults );
	$format   = array( '%s', '%s', '%s', '%d', '%s' );

	if ( isset( $data['id'] ) ) {
		$id      = $data['id'];
		$updated = $wpdb->update(
			"{$wpdb->prefix}sponsor_protocol",
			$data,
			array( 'id' => $id ),
			$format,
			array( '%d' )
		);
		return $updated;
	} else {
		$inserted = $wpdb->insert(
			"{$wpdb->prefix}sponsor_protocol",
			$data,
			$format
		);

		if ( ! $inserted ) {
			return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'sponsor-portal' ) );
		}
	}

	return $wpdb->insert_id;
}


function sp_po_get_protocols( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'number'  => 20,
		'offset'  => 0,
		'orderby' => 'id',
		'order'   => 'ASC',
	);

	$args = wp_parse_args( $args, $defaults );

	$items = $wpdb->get_results(
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sponsor_protocol ORDER BY {$args['orderby']} {$args['order']} LIMIT %d, %d", $args['offset'], $args['number'] )
	);

	return $items;
}

function sp_po_protocol_count() {
	global $wpdb;
	return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}sponsor_protocol" );
}

function sp_po_get_protocol( $id ) {
	global $wpdb;
	return $wpdb->get_row(
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}sponsor_protocol WHERE id = %d", $id )
	);
}

function sp_po_delete_protocol( $id ) {
	global $wpdb;
	return $wpdb->delete( $wpdb->prefix . 'sponsor_protocol', array( 'id' => $id ), array( '%d' ) );
}

function get_request( $key ) {
	return isset( $_REQUEST[ $key ] ) ? $_REQUEST[ $key ] : false;
}
function get_result( $key ) {
	return isset( $key ) ? $key : null;
}
function get_server( $key ) {
	return isset( $_SERVER[ $key ] ) ? $_SERVER[ $key ] : false;
}
function get_sp_admin_url( $nav_slug ) {
	return add_query_arg(
		array(
			'page' => 'sponsor',
			'nav'  => $nav_slug,
		),
		admin_url( 'admin.php' )
	);
}
function get_nav_url( $nav_slug ) {
	return add_query_arg(
		array(
			'page' => $nav_slug,
		),
		site_url( 'bs-admin' )
	);
}

function get_active( $key ) {
	return $key === get_request( 'page' ) ? ' active' : null;
}
if ( ! function_exists( 'get_current_url' ) ) {

	function get_current_url(): string {
		return admin_url( sprintf( basename( $_SERVER['REQUEST_URI'] ) ) );
	}
}


if ( ! function_exists( 'pr' ) ) {
	/**
	 * Function to print_r
	 *
	 * @param  array $var .
	 * @return array
	 */
	function pr( $var ) {
		$template = PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg' ? '<pre class="pr">%s</pre>' : "\n%s\n\n";
		printf( $template, trim( print_r( $var, true ) ) );

		return $var;
	}
}


if ( ! function_exists( 'vr' ) ) {
	/**
	 * Function to var_dump
	 *
	 * @param  array $var .
	 * @return array
	 */
	function vr( $var ) {
		$template = PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg' ? '<pre class="pr">%s</pre>' : "\n%s\n\n";
		printf( $template, trim( var_dump( $var, true ) ) );

		return $var;
	}
}


add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 );
function remove_default_stylesheet() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'twenty-twenty-one-style' );
	wp_dequeue_style( 'twenty-twenty-one-print-style' );
	// wp_dequeue_script( 'sponsor-theme-admin' );
	// wp_deregister_style( 'original-register-stylesheet-handle' );
}


// add_action( 'init', 'custom_login' );
function custom_login() {
	global $pagenow;
	if ( 'wp-login.php' == $pagenow ) {
		wp_redirect( site_url( 'bs-login' ) );
	}
	if ( 'wp-login.php' == $pagenow ) {
		// wp_redirect( site_url( 'bs-login' ) );
	}
}

// require '../../../wp-load.php';

add_action( 'wp_ajax_save_protocol', 'save_protocol' );
function save_protocol() {
	global $wpdb;
	return $wpdb->get_row(
		$wpdb->prepare( "SELECT * FROM {$wpdb->prefix}bs_sponsors" )
	);

	$tablename = $wpdb->prefix . 'bs_sponsors';
	$results   = $wpdb->get_results( "SELECT * FROM $tablename" );
	// current_time( 'mysql', 1 )
	$data_array['title']      = $_POST['protocol_name'];
	$data_array['sponsor_id'] = get_current_user_id();
	$data_array['created_at'] = current_time( 'mysql', 1 );

	$protocol_id   = $wpdb->insert( $tablename, $data_array );
	$query         = "SELECT * FROM $tablename";
	$query_results = $wpdb->get_results( $query );
	wp_send_json_success( $results );

	/*
	 die;
	$query         = "SELECT * FROM $tablename WHERE 'name'= `{$data_array['name']}`";
	$query_results = $wpdb->get_results( $query );
	if ( count( $query_results ) !== 0 ) {
		wp_send_json_error( 'Error' );
	} else {
		$insert = $wpdb->insert( $tablename, $data_array );
		wp_send_json_success( $wpdb->insert_id );

	} */
}
