<?php
/**
 * Plugin Name: Cool Kids Network
 * Description: A proof-of-concept WordPress plugin for the Cool Kids Network.
 * Version: 1.0.0
 * Author: Qasid Saleh
 */

// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CKN_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CKN_PLUGIN_URL', plugin_dir_url(__FILE__));