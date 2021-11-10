<?php

function current_username() {
	global $current_user;
	return $current_user->display_name;
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

if ( ! function_exists( 'pr' ) ) {
	function pr( $var ) {
		$template = PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg' ? '<pre class="pr">%s</pre>' : "\n%s\n\n";
		printf( $template, trim( print_r( $var, true ) ) );
		return $var;
	}
}


if ( ! function_exists( 'vr' ) ) {
	function vr( $var ) {
		$template = PHP_SAPI !== 'cli' && PHP_SAPI !== 'phpdbg' ? '<pre class="pr">%s</pre>' : "\n%s\n\n";
		printf( $template, trim( var_dump( $var, true ) ) );
		return $var;
	}
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

function sp_header() {
	require sponsor()->path . 'templates/header-custom.php';
}
function sp_footer() {
	require sponsor()->path . 'templates/footer-custom.php';
}
