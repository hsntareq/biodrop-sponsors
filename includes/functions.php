<?php
require __DIR__ . '/libs.php';
// require ABSPATH . 'wp-load.php';
add_action( 'wp_ajax_save_protocol', 'save_protocol' );
add_action( 'wp_ajax_update_protocol', 'update_protocol' );
add_action( 'wp_ajax_delete_protocol', 'delete_protocol' );
add_action( 'wp_ajax_add_credit_card', 'add_credit_card' );

add_filter( 'wp_title', 'biodrop_page_title', 10000, 2 );
add_action( 'init', 'sponsor_admin_access', 100 );

function user_data_action() {
	pr( $_REQUEST );
}
function sanitize_array( $array = array() ) {
	$data = array();
	foreach ( $array as $key => $value ) {
		$data_value   = str_replace( array( '_', '-', '/' ), '', $value );
		$data[ $key ] = sanitize_textarea_field( $data_value );
	}
	return $data;
}

function get_credit_cards( $user_id ) {
	global $wpdb;
	$table       = $wpdb->prefix . 'bs_sponsor_cards';
	$prepare_sql = $wpdb->prepare( "SELECT * FROM {$table} WHERE `sponsor_id`=" . $user_id );
	$results     = $wpdb->get_results( $prepare_sql, OBJECT );
	return $results ;
}

function add_credit_card() {
	if ( isset( $_REQUEST['card_nonce'] ) && wp_verify_nonce( $_REQUEST['card_nonce'], 'add_credit_card' ) ) {
		global $wpdb;
		global $current_user;
		$required_fields = array( 'card_number', 'expiration_date', 'card_cvv', 'name_on_card' );

		$data['card_number']     = isset( $_POST['card_number'] ) ? sanitize_text_field( wp_unslash( $_POST['card_number'] ) ) : '';
		$data['expiration_date'] = isset( $_POST['expiration_date'] ) ? sanitize_text_field( wp_unslash( $_POST['expiration_date'] ) ) : '';
		$data['card_cvv']        = isset( $_POST['card_cvv'] ) ? sanitize_text_field( wp_unslash( $_POST['card_cvv'] ) ) : '';
		$data['name_on_card']    = isset( $_POST['name_on_card'] ) ? sanitize_text_field( wp_unslash( $_POST['name_on_card'] ) ) : '';

		$missing_fields = array();
		$data_processed = sanitize_array( $data );
		foreach ( $required_fields as $key => $field ) {
			if ( empty( $data_processed[ $field ] ) ) {
				$missing_fields[] = $field;
			}
		}

		$expire = str_split( $data_processed['expiration_date'], 2 );

		if ( empty( $missing_fields ) ) {

			$table = $wpdb->prefix . 'bs_sponsor_cards';
			$data  = array(
				'name'                  => $data_processed['name_on_card'],
				'sponsor_id'            => $current_user->ID,
				'card_number'           => $data_processed['card_number'],
				'card_expiration_month' => $expire[0],
				'card_expiration_year'  => $expire[1],
				'card_code'             => $data_processed['card_cvv'],
				'created_at'            => current_time( 'mysql' ),
			);

			$format   = array( '%s', '%d', '%d', '%d', '%d', '%d', '%s' );
			$rowcount = $wpdb->get_var( "SELECT  COUNT(*) FROM {$table}  WHERE card_number = {$data['card_number']} " );

			if ( $rowcount < 1 ) {
				$wpdb->insert( $table, $data, $format );
				$prepare_sql = $wpdb->prepare( "SELECT * FROM {$table}" );
				$results     = $wpdb->get_results( $prepare_sql, OBJECT );
			} else {
				$results = 'Already exists';
			}
			$response = $results;
		} else {
			$response = $missing_fields;
		}
		wp_send_json_success( $response );

	} else {

		die( __( 'Security check', 'sponsor' ) );

	}
}

function sponsor_admin_access() {
	global $current_user;
	if ( in_array( 'sponsor', $current_user->roles ) ) {
		add_filter( 'show_admin_bar', '__return_false' );
	}
}

function biodrop_page_title() {

	if ( isset( $_GET['page'] ) && isset( $_GET['edit'] ) ) {
		$title = ucwords( $_GET['page'] ) . ' Edit | ' . get_bloginfo( 'name' );
	} elseif ( isset( $_GET['page'] ) ) {
		$title = ucwords( $_GET['page'] ) . ' | ' . get_bloginfo( 'name' );
	} else {
		$title = 'Welcome | ' . get_bloginfo( 'name' );
	}

	return $title;
}



function delete_protocol() {
	global $wpdb;
	$tablename = $wpdb->prefix . 'bs_protocols';
	$delete_id = $wpdb->delete(
		$tablename,
		array( 'id' => $_POST['protocol_id'] ),
		array( '%d' ),
	);
	if ( $delete_id ) {
		wp_send_json_success( $delete_id );
	}

	wp_send_json_success( $task_id );
}
function update_protocol() {
	global $wpdb;

	$table_protocols = $wpdb->prefix . 'bs_protocols';
	$table_tasks     = $wpdb->prefix . 'bs_tasks';
	$protocol_id     = get_request( 'select_protocol' ) ? sanitize_text_field( get_request( 'select_protocol' ) ) : 0;

	$protocol_array['title']      = get_request( 'protocol_name' ) ? sanitize_text_field( get_request( 'protocol_name' ) ) : null;
	$protocol_array['sponsor_id'] = get_current_user_id();
	$protocol_array['created_at'] = current_time( 'mysql', 1 );
	$protocol_id                  = update_form_data( $table_protocols, $protocol_array, array( 'id' => $protocol_id ) );

	$task_array['task_code']   = json_encode( get_request( 'task_name' ) );
	$task_array['protocol_id'] = $protocol_id;
	$task_array['created_at']  = current_time( 'mysql', 1 );
	$task_id                   = update_form_data( $table_tasks, $task_array, array( 'protocol_id' => $protocol_id ) );

	wp_send_json_success( $task_id );
}
function save_protocol() {
	global $wpdb;
	$table_protocols              = $wpdb->prefix . 'bs_protocols';
	$table_tasks                  = $wpdb->prefix . 'bs_tasks';
	$protocol_array['title']      = get_request( 'protocol_name' ) ? sanitize_text_field( get_request( 'protocol_name' ) ) : null;
	$protocol_array['sponsor_id'] = get_current_user_id();
	$protocol_array['created_at'] = current_time( 'mysql', 1 );
	$protocol_id                  = insert_form_data( $table_protocols, $protocol_array );

	$task_array['task_code']   = json_encode( get_request( 'task_name' ) );
	$task_array['protocol_id'] = $protocol_id;
	$task_array['created_at']  = current_time( 'mysql', 1 );
	$task_id                   = insert_form_data( $table_tasks, $task_array );

	wp_send_json_success( $task_id );
}

function get_edit_data( $key ) {
	return isset( $_GET[ $key ] ) ? esc_attr( $_GET[ $key ] ) : false;
}

function get_fields( $table ) {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$table}" );
}

function get_field_by_id( $id, $table ) {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$table} WHERE 'id'= {$id}" );
}

function get_data_by_field( $value, $field, $table ) {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$table} WHERE `{$field}`= {$value}" );
}
