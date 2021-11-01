<?php

namespace Sponsor;

use Sponsor\Admin\SponsorForm;

class Installer {

	public function run() {
		$this->add_version();
		$this->create_tables();
		$this->add_roles();
	}

	public function add_roles() {
		add_role(
			'sponsor',
			'Sponsor',
			array(
				'read'           => true,
				'delete_posts'   => false,
				'manage_options' => true,
				'manage_sponsor' => true,
			),
		);
	}
	public function add_version() {
		$installed = get_option( 'sp_installed' );
		if ( ! $installed ) {
			update_option( 'sp_installed', time() );
		}
		update_option( 'sp_version', SPONSOR_VERSION );
	}

	public function create_tables() {
		global $wpdb;

		$charset_collate   = $wpdb->get_charset_collate();
		$schema            = "CREATE TABLE `wp_sp_protocol` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
			`user_id` bigint NOT NULL,
			`DoNotReportData` int DEFAULT NULL,
			`mrna_first_injection` int DEFAULT NULL,
			`mrna_second_injection` int DEFAULT NULL,
			`mrna_twentyone_days_since_second_injection` int DEFAULT NULL,
			`mrna_three_months_since_second_injection` int DEFAULT NULL,
			`mrna_five_months_since_second_injection` int DEFAULT NULL,
			`mrna_eight_months_since_second_injection` int DEFAULT NULL,
			`single_dose_injection` int DEFAULT NULL,
			`single_dose_twentyone_days_since_injection` int DEFAULT NULL,
			`single_dose_three_months_since_injection` int DEFAULT NULL,
			`single_dose_five_months_since_injection` int DEFAULT NULL,
			`single_dose_eight_months_since_injection` int DEFAULT NULL,
			`booster_injection` int DEFAULT NULL,
			`booster_twentyone_days_since_injection` int DEFAULT NULL,
			`booster_three_months_since_injection` int DEFAULT NULL,
			`booster_five_months_since_injection` int DEFAULT NULL,
			`booster_eight_months_since_injection` int DEFAULT NULL,
			`recovery_negative_test_after_positive_test` int DEFAULT NULL,
			`recovery_six_months_after_negative_test` int DEFAULT NULL,
			`recovery_ten_months_after_negative_test` int DEFAULT NULL,
			`recovery_fourteen_months_since_negative_test` int DEFAULT NULL,
			`recovery_eighteen_months_since_negative_test` int DEFAULT NULL,
			`Age60Rate` int DEFAULT NULL,
			`Age80Rate` int DEFAULT NULL,
			`HighImmunityVoiceWithinHours` int DEFAULT NULL,
			`HighImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`HighImmunitySmellWithinHours` int DEFAULT NULL,
			`HighImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`HighImmunitySymptomsWithinHours` int DEFAULT NULL,
			`HighImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunityVoiceWithinHours` int DEFAULT NULL,
			`ModerateImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunitySmellWithinHours` int DEFAULT NULL,
			`ModerateImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunitySymptomsWithinHours` int DEFAULT NULL,
			`ModerateImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`LowImmunityVoiceWithinHours` int DEFAULT NULL,
			`LowImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`LowImmunitySmellWithinHours` int DEFAULT NULL,
			`LowImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`LowImmunitySymptomsWithinHours` int DEFAULT NULL,
			`LowImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`pcr_voice_test_within_hour` int DEFAULT NULL,
			`PRCTestVoiceConsecutiveDays` int DEFAULT NULL,
			`pcr_smell_test_within_hour` int DEFAULT NULL,
			`PCRTestSmellConsecutiveDays` int DEFAULT NULL,
			`PCRTestSymptomsWithinHours` int DEFAULT NULL,
			`PCRTestSymptomsConsecutiveDays` int DEFAULT NULL,
			`antigen_voice_test_within_hour` int DEFAULT NULL,
			`AntigenTestVoiceConsecutiveDays` int DEFAULT NULL,
			`antigen_smell_test_within_hour` int DEFAULT NULL,
			`AntigenTestSmellConsecutiveDays` int DEFAULT NULL,
			`AntigenTestSymptomsWithinHours` int DEFAULT NULL,
			`AntigenTestSymptomsConsecutiveDays` int DEFAULT NULL,
			`home_rapid_voice_test_within_hour` int DEFAULT NULL,
			`RapidHomeTestVoiceConsecutiveDays` int DEFAULT NULL,
			`home_rapid_smell_test_within_hour` int DEFAULT NULL,
			`RapidHomeTestSmellConsecutiveDays` int DEFAULT NULL,
			`RapidHomeTestSymptomsWithinHours` int DEFAULT NULL,
			`RapidHomeTestSymptomsConsecutiveDays` int DEFAULT NULL,
			`created_at` datetime DEFAULT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;";
		  $schema_protocol = "CREATE TABLE `{$wpdb->prefix}sp_protocol` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
			`user_id` bigint NOT NULL,
			`DoNotReportData` int DEFAULT NULL,
			`mrna_first_injection` int DEFAULT NULL,
			`mrna_second_injection` int DEFAULT NULL,
			`mrna_twentyone_days_since_second_injection` int DEFAULT NULL,
			`mrna_three_months_since_second_injection` int DEFAULT NULL,
			`mrna_five_months_since_second_injection` int DEFAULT NULL,
			`mrna_eight_months_since_second_injection` int DEFAULT NULL,
			`single_dose_injection` int DEFAULT NULL,
			`single_dose_twentyone_days_since_injection` int DEFAULT NULL,
			`single_dose_three_months_since_injection` int DEFAULT NULL,
			`single_dose_five_months_since_injection` int DEFAULT NULL,
			`single_dose_eight_months_since_injection` int DEFAULT NULL,
			`booster_injection` int DEFAULT NULL,
			`booster_twentyone_days_since_injection` int DEFAULT NULL,
			`booster_three_months_since_injection` int DEFAULT NULL,
			`booster_five_months_since_injection` int DEFAULT NULL,
			`booster_eight_months_since_injection` int DEFAULT NULL,
			`recovery_negative_test_after_positive_test` int DEFAULT NULL,
			`recovery_six_months_after_negative_test` int DEFAULT NULL,
			`recovery_ten_months_after_negative_test` int DEFAULT NULL,
			`recovery_fourteen_months_since_negative_test` int DEFAULT NULL,
			`recovery_eighteen_months_since_negative_test` int DEFAULT NULL,
			`Age60Rate` int DEFAULT NULL,
			`Age80Rate` int DEFAULT NULL,
			`HighImmunityVoiceWithinHours` int DEFAULT NULL,
			`HighImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`HighImmunitySmellWithinHours` int DEFAULT NULL,
			`HighImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`HighImmunitySymptomsWithinHours` int DEFAULT NULL,
			`HighImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunityVoiceWithinHours` int DEFAULT NULL,
			`ModerateImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunitySmellWithinHours` int DEFAULT NULL,
			`ModerateImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunitySymptomsWithinHours` int DEFAULT NULL,
			`ModerateImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`LowImmunityVoiceWithinHours` int DEFAULT NULL,
			`LowImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`LowImmunitySmellWithinHours` int DEFAULT NULL,
			`LowImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`LowImmunitySymptomsWithinHours` int DEFAULT NULL,
			`LowImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`pcr_voice_test_within_hour` int DEFAULT NULL,
			`PRCTestVoiceConsecutiveDays` int DEFAULT NULL,
			`pcr_smell_test_within_hour` int DEFAULT NULL,
			`PCRTestSmellConsecutiveDays` int DEFAULT NULL,
			`PCRTestSymptomsWithinHours` int DEFAULT NULL,
			`PCRTestSymptomsConsecutiveDays` int DEFAULT NULL,
			`antigen_voice_test_within_hour` int DEFAULT NULL,
			`AntigenTestVoiceConsecutiveDays` int DEFAULT NULL,
			`antigen_smell_test_within_hour` int DEFAULT NULL,
			`AntigenTestSmellConsecutiveDays` int DEFAULT NULL,
			`AntigenTestSymptomsWithinHours` int DEFAULT NULL,
			`AntigenTestSymptomsConsecutiveDays` int DEFAULT NULL,
			`home_rapid_voice_test_within_hour` int DEFAULT NULL,
			`RapidHomeTestVoiceConsecutiveDays` int DEFAULT NULL,
			`home_rapid_smell_test_within_hour` int DEFAULT NULL,
			`RapidHomeTestSmellConsecutiveDays` int DEFAULT NULL,
			`RapidHomeTestSymptomsWithinHours` int DEFAULT NULL,
			`RapidHomeTestSymptomsConsecutiveDays` int DEFAULT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		$schema_sponsors = "CREATE TABLE `{$wpdb->prefix}sp_sponsors` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`username` varchar(100) DEFAULT NULL,
			`protocol_id` bigint NOT NULL,
			`sponsor_id` bigint NOT NULL,
			`email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
			`current_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
			`last_activity` varchar(100) NOT NULL DEFAULT '',
			`created_at` datetime DEFAULT NULL,
			PRIMARY KEY (`id`)
			) $charset_collate";

		$schema_protocol_status = "CREATE TABLE `{$wpdb->prefix}sp_protocol_status` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`protocol_id` int NOT NULL,
			`data_status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
			`created_at` datetime NOT NULL,
			`created_by` int NOT NULL,
			PRIMARY KEY (`id`)
		  )  $charset_collate";

		  $schema_status = "CREATE TABLE `{$wpdb->prefix}sp_status` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`username` varchar(100) DEFAULT NULL,
			`protocol_id` bigint NOT NULL,
			`sponsor_id` bigint NOT NULL,
			`email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
			`current_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
			`last_activity` varchar(100) NOT NULL DEFAULT '',
			`created_at` datetime DEFAULT NULL,
			PRIMARY KEY (`id`)
			) $charset_collate";

		if ( ! function_exists( 'dbdelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}
		dbDelta( $schema_protocol );
		dbDelta( $schema_protocol_status );
		dbDelta( $schema_sponsors );
		dbDelta( $schema_status );
	}
}
