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

		$charset_collate = $wpdb->get_charset_collate();

		$sponsors_table = "CREATE TABLE `{$wpdb->prefix}bs_sponsors` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`name` varchar(100) NOT NULL DEFAULT '',
			`address1` text,
			`address2` text,
			`city` varchar(50) DEFAULT NULL,
			`state` varchar(10) DEFAULT NULL,
			`zip` int DEFAULT NULL,
			`email` text NOT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		$sponsors_cards = "CREATE TABLE `{$wpdb->prefix}bs_sponsor_cards` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`name` varchar(100) NOT NULL DEFAULT '',
			`sponsor_id` int NOT NULL,
			`card_number` int DEFAULT NULL,
			`card_expiration_month` int DEFAULT NULL,
			`card_expiration_year` int DEFAULT NULL,
			`card_code` int DEFAULT NULL,
			`created_at` datetime NOT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		$protocols_table = "CREATE TABLE `{$wpdb->prefix}bs_protocols` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`sponsor_id` int NOT NULL,
			`title` varchar(100) NOT NULL DEFAULT '',
			`created_at` datetime NOT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		$tasks = "CREATE TABLE `{$wpdb->prefix}bs_tasks` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`task_code` text NOT NULL,
			`protocol_id` int NOT NULL,
			`created_at` datetime NOT NULL,
			`expiration_time_for_determination` datetime DEFAULT NULL,
			`expiration_time_for_pass` datetime DEFAULT NULL,
			`pass_determination_required` tinyint(1) DEFAULT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		$user_protocols = "CREATE TABLE `{$wpdb->prefix}bs_user_protocols` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`user_id` int NOT NULL,
			`protocol_id` int NOT NULL,
			`user_firstname` varchar(100) DEFAULT NULL,
			`user_lastname` varchar(100) DEFAULT NULL,
			`user_email` text NOT NULL,
			`created_at` datetime NOT NULL,
			PRIMARY KEY (`id`)
			)  $charset_collate";

		$status_log = "CREATE TABLE `{$wpdb->prefix}bs_status_log` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`user_id` int NOT NULL,
			`protocol_id` int NOT NULL,
			`task_code` text NOT NULL,
			`task_required` tinyint(1) NOT NULL,
			`status` tinyint(1) NOT NULL,
			`expiration_time` datetime DEFAULT NULL,
			`last_activity` datetime DEFAULT NULL,
			`created_at` datetime NOT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		if ( ! function_exists( 'dbdelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}
		dbDelta( $sponsors_table );
		dbDelta( $sponsors_cards );
		dbDelta( $protocols_table );
		dbDelta( $tasks );
		dbDelta( $user_protocols );
		dbDelta( $status_log );
	}
}
