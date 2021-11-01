<?php

namespace Sponsor\Admin;

/**
 * Settings
 */
class Settings {
	public function __construct() {
	}

	public function menu_page() {
		include __DIR__ . '/views/settings/main.php';

	}
}
