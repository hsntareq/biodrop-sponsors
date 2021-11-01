<?php

/**
 * Function sp_po_insert_protocol
 *
 * @param  mixed $args
 * @return int|WP_Error
 */
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
function get_url( $nav_slug ) {
	return add_query_arg(
		array(
			'page' => 'sponsor',
			'nav'  => $nav_slug,
		),
		admin_url( 'admin.php' )
	);
}

function get_active( $key ) {
	return $key === get_request( 'nav' ) ? ' active' : null;
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


