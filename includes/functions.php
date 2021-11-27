<?php
require __DIR__ . '/libs.php';
require ABSPATH . 'wp-load.php';
add_action( 'wp_ajax_save_protocol', 'save_protocol' );
add_action( 'wp_ajax_update_protocol', 'update_protocol' );
add_action( 'wp_ajax_delete_protocol', 'delete_protocol' );
add_action( 'wp_ajax_add_credit_card_action', 'add_credit_card_action' );
add_action( 'wp_ajax_edit_credit_card_action', 'edit_credit_card_action' );
add_action( 'wp_ajax_load_user_cards', 'load_user_cards' );
add_action( 'wp_ajax_delete_user_cards', 'delete_user_cards' );
add_action( 'wp_ajax_edit_user_cards', 'edit_user_cards' );

add_filter( 'wp_title', 'biodrop_page_title', 10000, 2 );
add_action( 'init', 'sponsor_admin_access', 100 );
add_filter( 'status_header', 'bs_status_header_function', 10, 2 );
// add_action( 'admin_init', 'sponsor_no_admin_access', 100 );


function sponsor_no_admin_access() {
	$redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/bs-admin' );
	global $current_user;
	if ( in_array( 'sponsor', $current_user->roles ) ) {
		exit( wp_redirect( $redirect ) );
	}
}


// add_filter( 'template_include', 'sponsors_admin_page_template', 1000, 1 );
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



function bs_status_header_function( $status_header, $header ) {
	return (int) $header == 404 ? status_header( 202 ) : $status_header;
}


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

function edit_user_cards() {
	global $wpdb;
	global $current_user;
					   // WPDB class object
	$table       = $wpdb->prefix . 'bs_sponsor_cards';
	$prepare_sql = $wpdb->prepare( "SELECT * FROM {$table} WHERE `id`=%d ORDER BY id DESC", $_POST['cc_id'] );
	$results     = $wpdb->get_results( $prepare_sql, OBJECT );
	$card_data   = isset( $results ) && ! empty( $results ) ? $results : array();
	// return $card_data;
	wp_send_json_success( $card_data );
}


function delete_user_cards() {
	global $wpdb;
	global $current_user;                        // WPDB class object
	$table = $wpdb->prefix . 'bs_sponsor_cards';
	$wpdb->delete(
		$table,      // table name with dynamic prefix
		array( 'id' => $_POST['cc_id'] ),                       // which id need to delete
		array( '%d' ),                             // make sure the id format
	);

	$prepare_sql = $wpdb->prepare( "SELECT * FROM {$table} WHERE `sponsor_id`= %d ORDER BY id DESC", $current_user->ID );
	$results     = $wpdb->get_results( $prepare_sql, OBJECT );
	$card_data   = isset( $results ) && ! empty( $results ) ? $results : array();
	// return $card_data;
	wp_send_json_success( $card_data );
}



function load_user_cards() {
	global $wpdb;
	global $current_user;

	$table       = $wpdb->prefix . 'bs_sponsor_cards';
	$prepare_sql = $wpdb->prepare( "SELECT * FROM {$table} WHERE `sponsor_id`= %d ORDER BY id DESC", $current_user->ID );
	$results     = $wpdb->get_results( $prepare_sql, OBJECT );
	$card_data   = isset( $results ) && ! empty( $results ) ? $results : array();
	// return $card_data;
	wp_send_json_success( $card_data );
}

function get_credit_cards( $user_id ) {
	global $wpdb;
	$table       = $wpdb->prefix . 'bs_sponsor_cards';
	$prepare_sql = $wpdb->prepare( "SELECT * FROM {$table} WHERE `sponsor_id`= %d ORDER BY id DESC", $user_id );
	$results     = $wpdb->get_results( $prepare_sql, OBJECT );
	return isset( $results ) && ! empty( $results ) ? $results : array();
}

function edit_credit_card_action() {
	if ( isset( $_REQUEST['card_nonce'] ) && wp_verify_nonce( $_REQUEST['card_nonce'], '_credit_card' ) ) {
		global $wpdb;
		global $current_user;
		$required_fields = array( 'card_number', 'expiration_date', 'card_cvv', 'name_on_card' );

		$data['card_id']         = isset( $_POST['card_id'] ) ? sanitize_text_field( wp_unslash( $_POST['card_id'] ) ) : '';
		$data['payment_type']    = isset( $_POST['payment_type'] ) ? sanitize_text_field( wp_unslash( $_POST['payment_type'] ) ) : '';
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

		$expire   = str_split( $data_processed['expiration_date'], 2 );
		$response = array();
		if ( empty( $missing_fields ) ) {

			$table = $wpdb->prefix . 'bs_sponsor_cards';
			$data  = array(
				'card_id'               => $data_processed['card_id'],
				'name'                  => $data_processed['payment_type'],
				'name_on_card'          => $data_processed['name_on_card'],
				'sponsor_id'            => $current_user->ID,
				'card_number'           => $data_processed['card_number'],
				'card_expiration_month' => $expire[0],
				'card_expiration_year'  => $expire[1],
				'card_code'             => $data_processed['card_cvv'],
				'created_at'            => current_time( 'mysql' ),
			);

			$format   = array( '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%s' );
			$rowcount = $wpdb->get_var( "SELECT  COUNT(*) FROM {$table}  WHERE card_id = {$data['card_id']} " );

			if ( $rowcount < 1 ) {
				$where = array( 'id' => $data['card_id'] );
				$wpdb->update( $table, $data, $where );

				// $results  = $wpdb->get_results( $prepare_sql, OBJECT );
				$response = array(
					'data'    => get_credit_cards( $current_user->ID ),
					'status'  => 'success',
					'message' => 'Card updated successfully.',
				);
			} else {
				$response = array(
					'data'    => get_credit_cards( $current_user->ID ),
					'status'  => 'exist',
					'message' => 'This Card already exists',
				);
				wp_send_json_success( $response );
			}
		} else {
			$response = array(
				'data'    => $missing_fields,
				'status'  => 'missing',
				'message' => 'Highlighted fields cannot be left empty',
			);
		}

		wp_send_json_success( $response );
	}
}

function add_credit_card_action() {
	if ( isset( $_REQUEST['card_nonce'] ) && wp_verify_nonce( $_REQUEST['card_nonce'], '_credit_card' ) ) {
		global $wpdb;
		global $current_user;
		$required_fields = array( 'card_number', 'expiration_date', 'card_cvv', 'name_on_card' );

		$data['payment_type']    = isset( $_POST['payment_type'] ) ? sanitize_text_field( wp_unslash( $_POST['payment_type'] ) ) : '';
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

		$expire   = str_split( $data_processed['expiration_date'], 2 );
		$response = array();
		if ( empty( $missing_fields ) ) {

			$table = $wpdb->prefix . 'bs_sponsor_cards';
			$data  = array(
				'name'                  => $data_processed['payment_type'],
				'name_on_card'          => $data_processed['name_on_card'],
				'sponsor_id'            => $current_user->ID,
				'card_number'           => $data_processed['card_number'],
				'card_expiration_month' => $expire[0],
				'card_expiration_year'  => $expire[1],
				'card_code'             => $data_processed['card_cvv'],
				'created_at'            => current_time( 'mysql' ),
			);

			$format   = array( '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%s' );
			$rowcount = $wpdb->get_var( "SELECT  COUNT(*) FROM {$table}  WHERE card_number = {$data['card_number']} " );

			if ( $rowcount < 1 ) {
				$wpdb->insert( $table, $data, $format );
				$prepare_sql = $wpdb->prepare( "SELECT * FROM {$table}" );
				$results     = $wpdb->get_results( $prepare_sql, OBJECT );
				$response    = array(
					'data'    => get_credit_cards( $current_user->ID ),
					'status'  => 'success',
					'message' => 'Card added successfully.',
				);
			} else {
				$response = array(
					'data'    => get_credit_cards( $current_user->ID ),
					'status'  => 'exist',
					'message' => 'This Card already exists',
				);
				wp_send_json_success( $response );
			}
		} else {
			$response = array(
				'data'    => $missing_fields,
				'status'  => 'missing',
				'message' => 'Highlighted fields cannot be left empty',
			);
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

	$entry = $wpdb->get_results( "SELECT * FROM {$table_protocols} WHERE `title` LIKE '{$protocol_array['title']}'" );

	if ( empty( $entry ) ) {

		$protocol_id = insert_form_data( $table_protocols, $protocol_array );

		$task_array['task_code']   = json_encode( get_request( 'task_name' ) );
		$task_array['protocol_id'] = $protocol_id;
		$task_array['created_at']  = current_time( 'mysql', 1 );
		$task_id                   = insert_form_data( $table_tasks, $task_array );
		$response                  = array(
			'success' => true,
			'task_id' => $task_id,
			'message' => 'Successfully saved!',
		);
	} else {
		$response = array(
			'success' => false,
			'message' => 'Protocol already exists!',
		);
	}

	wp_send_json_success( $response );
}

function get_edit_data( $key ) {
	return isset( $_GET[ $key ] ) ? esc_attr( $_GET[ $key ] ) : false;
}

function get_fields( $table ) {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$table}" );
}

function get_fields_by_user( $table, $user_id ) {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$table} WHERE `sponsor_id` = {$user_id}" );
}

function get_field_by_id( $id, $table ) {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$table} WHERE 'id'= {$id}" );
}

function get_data_by_field( $value, $field, $table ) {
	global $wpdb;
	return $wpdb->get_results( "SELECT * FROM {$table} WHERE `{$field}`= {$value}" );
}
