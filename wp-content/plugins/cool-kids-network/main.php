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

// Include core classes
require_once CKN_PLUGIN_DIR . 'includes/class-role-handler.php';
require_once CKN_PLUGIN_DIR . 'includes/class-character-data.php';
require_once CKN_PLUGIN_DIR . 'includes/class-shortcodes.php';
require_once CKN_PLUGIN_DIR . 'includes/class-user-access.php';

// Plugin activation
register_activation_hook(__FILE__, function () {
    \CKN\RoleHandler::add_roles();
    flush_rewrite_rules();
});

// Plugin deactivation
register_deactivation_hook(__FILE__, function () {
    \CKN\RoleHandler::remove_roles();
});

// Initialize plugin
add_action('plugins_loaded', function () {
    new \CKN\CharacterData();
    new \CKN\Shortcodes();
    new \CKN\UserAccess();
});

// Include Stylesheet
function ckn_enqueue_styles() {
    // Enqueue the custom stylesheet for the plugin
    wp_enqueue_style('ckn-plugin-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'ckn_enqueue_styles');