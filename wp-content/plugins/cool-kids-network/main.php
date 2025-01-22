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

// Plugin activation
register_activation_hook(__FILE__, function () {

});

// Plugin deactivation
register_deactivation_hook(__FILE__, function () {
    
});

// Include Stylesheet
function ckn_enqueue_styles() {
    // Enqueue the custom stylesheet for the plugin
    wp_enqueue_style('ckn-plugin-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'ckn_enqueue_styles');