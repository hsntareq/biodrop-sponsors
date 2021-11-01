<?php

namespace Sponsor\Admin;

use Sponsor\Traits\Form_Error;

/**
 * SponsorForm
 */
class SponsorForm {

	use Form_Error;

	public $errors            = array();
	public $options_within    = array();
	public $options_result    = array();
	public $protocol_options  = array();
	public $options_recovered = array();

	public function __construct() {
		// if(get_request('entry-status'))
		$this->options_within    = array(
			'1_hour'                    => '1 hour',
			'2_hours'                   => '2 hours',
			'4_hours'                   => '4 hours',
			'6_hours'                   => '6 hours',
			'8_hours'                   => '8 hours',
			'12_hours'                  => '12 hours',
			'16_hours'                  => '16 hours',
			'24_hours'                  => '24 hours',
			'36_hours'                  => '36 hours',
			'2_hours_and_prior_2_days'  => '2 hours and prior 2 days',
			'4_hours_and_prior_2_days'  => '4 hours and prior 2 days',
			'12_hours_and_prior_2_days' => '12 hours and prior 2 days',
			'2_hours_and_prior_3_days'  => '2 hours and prior 3 days',
			'4_hours_and_prior_3_days'  => '4 hours and prior 3 days',
			'12_hours_and_prior_3_days' => '12 hours and prior 3 days',
			'2_hours_and_prior_5_days'  => '2 hours and prior 5 days',
			'4_hours_and_prior_5_days'  => '4 hours and prior 5 days',
			'12_hours_and_prior_5_days' => '12 hours and prior 5 days',
		);
		$this->options_result    = array(
			'1_hour'   => '1 hour',
			'2_hours'  => '2 hours',
			'4_hours'  => '4 hours',
			'6_hours'  => '6 hours',
			'12_hours' => '12 hours',
			'18_hours' => '18 hours',
			'24_hours' => '24 hours',
			'36_hours' => '36 hours',
			'48_hours' => '48 hours',
			'72_hours' => '72 hours',
			'1_week'   => '1 week',
			'2_weeks'  => '2 weeks',
			'1_month'  => '1 month',
		);
		$this->options_recovered = array(
			'within_0_10_months'  => 'within 0 – 10 months',
			'within_11_14_months' => 'within 11 – 14 months',
		);

		add_action( 'admin_init', array( $this, 'add_capability' ) );
		// add_action( 'admin_init', array( $this, 'sponsor_user_settings' ) );
		add_action( 'wp_ajax_save_protocol', array( $this, 'save_protocol' ) );
		add_action( 'wp_ajax_update_protocol', array( $this, 'update_protocol' ) );
		add_action( 'wp_ajax_delete_protocol', array( $this, 'delete_protocol' ) );
		add_action( 'wp_ajax_get_protocol_by_id', array( $this, 'get_protocol_by_id' ) );
		add_action( 'wp_ajax_get_selected_protocol', array( $this, 'get_selected_protocol' ) );
		add_action( 'wp_ajax_get_protocol_by_name', array( $this, 'get_protocol_by_name' ) );

	}

	public function get_protocols() {
		global $wpdb;
		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}sp_protocol" );
		return $results;
	}

	public function get_edit_protocol( $id ) {
		$current_user = wp_get_current_user();
		$protocols    = $this->get_protocols();
		foreach ( $protocols as $key => $protocol ) {
			if ( $protocol->id == $id && $protocol->user_id == $current_user->ID && $protocol->type !== 'preset' ) {
				return $protocol;
			}
		}
	}

	/**
	 * Function to get_protocol_by_id
	 *
	 * @param  mixed $id .
	 * @return array
	 */
	public function get_selected_protocol() {
		global $wpdb;
		$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `{$wpdb->prefix}sp_protocol` WHERE `id` = %d", get_request( 'protocol_id' ) ) );
		wp_send_json_success( $result );
	}
	/**
	 * Function to get_protocol_by_id
	 *
	 * @param  mixed $id .
	 * @return array
	 */
	public function get_protocol_by_name() {

		global $wpdb;
		$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `{$wpdb->prefix}sp_protocol` WHERE `name` = %s", get_request( 'protocol_name' ) ) );
		wp_send_json_success( $result );
	}

	/**
	 * Function to get_protocol_by_id
	 *
	 * @param  mixed $id .
	 * @return array
	 */
	public function get_protocol_by_id( $id ) {
		global $wpdb;
		$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `{$wpdb->prefix}sp_protocol` WHERE `id` = %d", $id ) );
		return $result;
	}

	/**
	 * Function to save_protocol
	 *
	 * @return array
	 */
	public function save_protocol() {

		global $wpdb;
		$tablename = $wpdb->prefix . 'sp_protocol';
		$fields    = array( 'type', 'name', 'mrna_first_injection', 'mrna_second_injection', 'mrna_twentyone_days_since_second_injection', 'mrna_three_months_since_second_injection', 'mrna_five_months_since_second_injection', 'mrna_eight_months_since_second_injection', 'single_dose_injection', 'single_dose_twentyone_days_since_injection', 'single_dose_three_months_since_injection', 'single_dose_five_months_since_injection', 'single_dose_eight_months_since_injection', 'booster_injection', 'booster_twentyone_days_since_injection', 'booster_three_months_since_injection', 'booster_five_months_since_injection', 'booster_eight_months_since_injection', 'recovery_negative_test_after_positive_test', 'recovery_six_months_after_negative_test', 'recovery_ten_months_after_negative_test', 'recovery_fourteen_months_since_negative_test', 'recovery_eighteen_months_since_negative_test', 'pcr_voice_test_within_hour', 'pcr_smell_test_within_hour', 'antigen_voice_test_within_hour', 'antigen_smell_test_within_hour', 'home_rapid_voice_test_within_hour', 'home_rapid_smell_test_within_hour' );

		$data_array = array();
		foreach ( $fields as $field ) {
			$data_array[ $field ] = $_POST[ $field ];
		}

		$data_array['user_id'] = get_current_user_id();

		$query         = "SELECT * FROM $tablename WHERE 'name'= `{$data_array['name']}`";
		$query_results = $wpdb->get_results( $query );
		if ( count( $query_results ) !== 0 ) {
			wp_send_json_error( 'Error' );
		} else {
			$insert = $wpdb->insert( $tablename, $data_array );
			wp_send_json_success( $wpdb->insert_id );
		}

	}


	/**
	 * Function delete_protocol
	 *
	 * @return success
	 */
	public function delete_protocol() {
		/*
		if ( ! wp_verify_nonce( $_REQUEST['_sponsor_nonce'], 'delete_protocol' ) ) {
			wp_die( 'Are you cheating2?' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating1?' );
		} */

		 global $wpdb;
		 $tablename = $wpdb->prefix . 'sp_protocol';
		$delete_id  = $wpdb->delete(
			$tablename,
			array( 'id' => $_POST['protocol_id'] ),
			array( '%d' ),
		);
		if ( $delete_id ) {
			wp_send_json_success( $delete_id );
		}
	}
	/**
	 * Function to save_protocol
	 *
	 * @return array
	 */
	public function update_protocol() {

		global $wpdb;
		$tablename = $wpdb->prefix . 'sp_protocol';
		$fields    = array( 'type', 'name', 'mrna_first_injection', 'mrna_second_injection', 'mrna_twentyone_days_since_second_injection', 'mrna_three_months_since_second_injection', 'mrna_five_months_since_second_injection', 'mrna_eight_months_since_second_injection', 'single_dose_injection', 'single_dose_twentyone_days_since_injection', 'single_dose_three_months_since_injection', 'single_dose_five_months_since_injection', 'single_dose_eight_months_since_injection', 'booster_injection', 'booster_twentyone_days_since_injection', 'booster_three_months_since_injection', 'booster_five_months_since_injection', 'booster_eight_months_since_injection', 'recovery_negative_test_after_positive_test', 'recovery_six_months_after_negative_test', 'recovery_ten_months_after_negative_test', 'recovery_fourteen_months_since_negative_test', 'recovery_eighteen_months_since_negative_test', 'pcr_voice_test_within_hour', 'pcr_smell_test_within_hour', 'antigen_voice_test_within_hour', 'antigen_smell_test_within_hour', 'home_rapid_voice_test_within_hour', 'home_rapid_smell_test_within_hour' );

		$data_array = array();
		foreach ( $fields as  $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				$data_array[ $field ] = $_POST[ $field ];
			}
		}
		$data_array['user_id'] = get_current_user_id();
		$where                 = array(
			'id'      => $_POST['protocol_id'],
			'user_id' => $data_array['user_id'],
		);

		 $wpdb->update( $tablename, $data_array, $where );

		wp_send_json_success( $wpdb );
	}

	/*
	 public function update_protocols( $id ) {

		global $wpdb;
		$tablename = $wpdb->prefix . 'sp_protocol';
		$fields    = array( 'mrna_first_injection', 'mrna_second_injection', 'mrna_twentyone_days_since_second_injection', 'mrna_three_months_since_second_injection', 'mrna_five_months_since_second_injection', 'mrna_eight_months_since_second_injection', 'single_dose_injection', 'single_dose_twentyone_days_since_injection', 'single_dose_three_months_since_injection', 'single_dose_five_months_since_injection', 'single_dose_eight_months_since_injection', 'booster_injection', 'booster_twentyone_days_since_injection', 'booster_three_months_since_injection', 'booster_five_months_since_injection', 'booster_eight_months_since_injection', 'recovery_negative_test_after_positive_test', 'recovery_six_months_after_negative_test', 'recovery_ten_months_after_negative_test', 'recovery_fourteen_months_since_negative_test', 'recovery_eighteen_months_since_negative_test', 'pcr_voice_test_within_hour', 'pcr_smell_test_within_hour', 'antigen_voice_test_within_hour', 'antigen_smell_test_within_hour', 'home_rapid_voice_test_within_hour', 'home_rapid_smell_test_within_hour' );

		$data_array = array();
		foreach ( $fields as $field ) {
			$data_array[ $field ] = $_POST[ $field ];
		}

		$data_array['user_id'] = get_current_user_id();

		$where = array( 'id' => $id );

		$wpdb->update( $tablename, $data_array, $where );

		wp_send_json_success( $_REQUEST );
	} */

	/**
	 * Add_capability
	 *
	 * @return void
	 */
	public function add_capability() {
		remove_role( 'sponsor_role' );

		$role = get_role( 'sponsor' );
		$role->add_cap( 'manage_sponsor' );

		$role2 = get_role( 'administrator' );
		$role2->add_cap( 'manage_sponsor' );
	}


	public function array_block( $label, $switch, $option ) {
		return array(
			'label'  => $label,
			'switch' => $switch,
			'value'  => array(
				'type'    => 'switch',
				'options' => $option,
			),
		);
	}

	public function protocol_fields() {
		$fields = array();
		foreach ( $this->protocol_options() as $sec_key => $blocks ) {
			foreach ( $blocks['blocks'] as $block_key => $blocks ) {
				foreach ( $blocks['fields'] as $field_key => $field ) {
					$fields[ $block_key . '_' . $field_key ] = $field;
				}
			}
		}
		return $fields;
	}
	/**
	 * Function protocol_options
	 *
	 * @return array
	 */
	public function protocol_options() {
		$options_within    = $this->options_within;
		$options_result    = $this->options_result;
		$options_recovered = $this->options_recovered;
		$attr              = array(
			'immunity_scale'  => array(
				'label'  => 'Immunity Scale',
				'desc'   => 'Immunity Scale description',
				'blocks' => array(
					'mrna'        => array(
						'slug'        => 'mrna',
						'heading'     => 'mRNA Vaccinated',
						'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
						'fields'      => array(
							'first_injection'  => array(
								'label'   => 'First injection',
								'type'    => 'number',
								'switch'  => 'on',
								'default' => 0,
								'remark'  => 1,
							),
							'second_injection' => array(
								'label'   => 'Second injection',
								'type'    => 'number',
								'switch'  => 'on',
								'default' => 0,
								'remark'  => 2,
							),
							'twentyone_days_since_second_injection' => array(
								'label'   => 'Twentyone days since second injection',
								'type'    => 'number',
								'switch'  => 'on',
								'default' => 0,
								'remark'  => 6,
							),
							'three_months_since_second_injection' => array(
								'label'   => 'Three months since second injection',
								'type'    => 'number',
								'switch'  => 'on',
								'default' => 0,
								'remark'  => 5,
							),
							'five_months_since_second_injection' => array(
								'label'   => 'Five months since second injection',
								'type'    => 'number',
								'switch'  => 'on',
								'default' => 0,
								'remark'  => 4,
							),
							'eight_months_since_second_injection' => array(
								'label'   => 'Eight months since second injection',
								'type'    => 'number',
								'switch'  => 'on',
								'default' => 0,
								'remark'  => 3,
							),

						),
					),
					'single_dose' => array(
						'slug'        => 'single_dose',
						'heading'     => 'Single Dose Vaccinated',
						'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
						'fields'      => array(
							'injection'                    => array(
								'label'   => 'Injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 1,
							),
							'twentyone_days_since_injection' => array(
								'label'   => 'Twentyone days since injection',
								'type'    => 'number',
								'switch'  => 'on',
								'default' => 0,
								'remark'  => 6,
							),
							'three_months_since_injection' => array(
								'label'   => 'Three months since injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 5,
							),
							'five_months_since_injection'  => array(
								'label'   => 'Five months since injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 4,
							),
							'eight_months_since_injection' => array(
								'label'   => 'Eight months since injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 3,
							),

						),
					),
					'booster'     => array(
						'slug'        => 'booster',
						'heading'     => 'Booster Vaccinated',
						'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
						'fields'      => array(
							'injection'                    => array(
								'label'   => 'Injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 1,
							),
							'twentyone_days_since_injection' => array(
								'label'   => 'Twentyone days since injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 6,
							),
							'three_months_since_injection' => array(
								'label'   => 'Three months since injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 5,
							),
							'five_months_since_injection'  => array(
								'label'   => 'Five months since injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 4,
							),
							'eight_months_since_injection' => array(
								'label'   => 'Eight months since injection',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 3,
							),

						),
					),
					'recovery'    => array(
						'slug'        => 'recovery',
						'heading'     => 'Recovery from COVID-19 positive test',
						'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
						'fields'      => array(
							'negative_test_after_positive_test' => array(
								'label'   => 'Negative test after positive test',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 7,
							),
							'six_months_after_negative_test' => array(
								'label'   => 'Six months after negative test',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 6,
							),
							'ten_months_after_negative_test' => array(
								'label'   => 'Ten months after negative test',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 5,
							),
							'fourteen_months_since_negative_test' => array(
								'label'   => 'Fourteen months since negative test',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 4,
							),
							'eighteen_months_since_negative_test' => array(
								'label'   => 'Eighteen months since negative test',
								'switch'  => 'on',
								'type'    => 'number',
								'default' => 0,
								'remark'  => 3,
							),

						),
					),
				),
			),
			'immunity_result' => array(
				'label'  => 'Immunity Result',
				'desc'   => 'Immunity Result description',
				'blocks' => array(
					'pcr'        => array(
						'slug'        => 'pcr',
						'heading'     => 'Negative PCR Test',
						'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
						'fields'      => array(
							'voice_test_within_hour' => array(
								'label'   => 'Voice Test',
								'type'    => 'group',
								'switch'  => 'on',
								'default' => 0,
							),
							'smell_test_within_hour' => array(
								'label'   => 'Smell Test',
								'type'    => 'group',
								'switch'  => 'on',
								'default' => 0,
							),

						),
					),
					'antigen'    => array(
						'slug'        => 'antigen',
						'heading'     => 'Negative Antigen Test',
						'sub_heading' => __( 'Negative Antigen test result after positive PCR test result', 'sponsor' ),
						'fields'      => array(
							'voice_test_within_hour' => array(
								'label'   => 'Voice Test',
								'type'    => 'group',
								'switch'  => 'on',
								'default' => 0,
							),
							'smell_test_within_hour' => array(
								'label'   => 'Smell Test',
								'type'    => 'group',
								'switch'  => 'on',
								'default' => 0,
							),

						),
					),
					'home_rapid' => array(
						'slug'        => 'home_rapid',
						'heading'     => 'Negative Home Rapid Test',
						'sub_heading' => __( 'Negative Home Rapid test result after positive PCR test result', 'sponsor' ),
						'fields'      => array(
							'voice_test_within_hour' => array(
								'label'   => 'Voice Test',
								'type'    => 'group',
								'switch'  => 'on',
								'default' => 0,
							),
							'smell_test_within_hour' => array(
								'label'   => 'Smell Test',
								'type'    => 'group',
								'switch'  => 'on',
								'default' => 0,
							),

						),
					),
				),
			),
		);
		return $attr;
	}





	/**
	 * Function select_options_by_key
	 *
	 * @param  array  $options .
	 * @param  string $field .
	 * @return html
	 */
	public function get_protocol_by_current_user() {
		$current_user  = get_current_user_id();
		$all_protocols = $this->get_protocols();
		if ( $all_protocols ) {
			foreach ( $all_protocols as $key => $option ) {
				if ( ! empty( $option->name ) && ( $option->user_id == $current_user ) && 'user' == $option->type ) {
					$protocols[] = $option;
				} else {
					$protocols = array();
				}
			}
			return $protocols;
		}
		return array();
	}
	/**
	 * Function select_options
	 *
	 * @param  mixed $options .
	 * @return string
	 */
	public function select_options( $options = array() ) {
		$output = '';
		if ( $options ) {
			foreach ( $options as $key => $option ) {
				$output .= "<option value='{$key}'>{$option}</option>";
			}
		}
		return $output;
	}
	/**
	 * Function menu_function
	 *
	 * @return void
	 */
	public function protocol_formmmmmm() {

		switch ( get_request( 'nav' ) ) {
			case 'entry-status':
				$template = __DIR__ . '/views/entry-status.php';
				break;
			case 'protocols':
				$template = __DIR__ . '/views/protocols.php';
				break;

			default:
				$template = __DIR__ . '/views/entry-status.php';
				break;
		}

		if ( file_exists( $template ) ) {
			ob_start();
			include $template;
			return ob_get_clean();
		}
	}

	public function generate() {

	}

	public function plugin_main_page() {
		include __DIR__ . '/views/protocol-main.php';
	}

	/**
	 * Function for form_handler
	 *
	 * @return void
	 */
	public function form_handler() {
		if ( ! isset( $_POST['submit_protocol'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( get_request( '_wpnonce' ), 'new-protocol' ) ) {
			wp_die( 'Are you cheating?' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating?' );
		}

		$id      = isset( $_POST['id'] ) ? intval( get_request( 'id' ) ) : 0;
		$name    = isset( $_POST['name'] ) ? sanitize_text_field( get_request( 'name' ) ) : '';
		$address = isset( $_POST['address'] ) ? sanitize_textarea_field( get_request( 'address' ) ) : '';
		$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( get_request( 'phone' ) ) : '';

		if ( empty( $name ) ) {
			$this->errors['name'] = __( 'Please provide a name', 'sponsor-portal' );
		}
		if ( empty( $phone ) ) {
			$this->errors['phone'] = __( 'Please provide a phone', 'sponsor-portal' );
		}
		if ( ! empty( $this->errors ) ) {
			return;
		}

		$args = array(
			'name'    => $name,
			'address' => $address,
			'phone'   => $phone,
		);

		if ( $id ) {
			$args['id']  = $id;
			$redirect_to = add_query_arg(
				array(
					'page'    => 'biodrop-portal',
					'action'  => 'edit',
					'updated' => 'true',
					'id'      => $id,
				),
				admin_url( 'admin.php' )
			);
		} else {
			$redirect_to = add_query_arg(
				array(
					'page'     => 'biodrop-portal',
					'inserted' => 'true',
				),
				admin_url( 'admin.php' )
			);
		}

		$insert_id = sp_po_insert_protocol( $args );

		if ( is_wp_error( $insert_id ) ) {
			wp_die( $insert_id->get_error_messages() );
		}

		wp_redirect( $redirect_to );

		exit;
	}

	public function delete_protocolS() {
		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'sp-po-delete-action' ) ) {
			wp_die( 'Are you cheating2?' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating1?' );
		}
		$id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

		if ( sp_po_delete_protocol( $id ) ) {
			$redirect_to = add_query_arg(
				array(
					'page'    => 'biodrop-portal',
					'deleted' => 'true',
				),
				admin_url( 'admin.php' )
			);
		} else {
			$redirect_to = add_query_arg(
				array(
					'page'    => 'biodrop-portal',
					'deleted' => 'true',
				),
				admin_url( 'admin.php' )
			);
		}
		wp_redirect( $redirect_to );
		exit;
	}
}
