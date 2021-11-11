<?php
require __DIR__ . '/libs.php';
// require ABSPATH . 'wp-load.php';
add_action( 'wp_ajax_save_protocol', 'save_protocol' );
add_action( 'wp_ajax_update_protocol', 'update_protocol' );
add_action( 'wp_ajax_delete_protocol', 'delete_protocol' );

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
