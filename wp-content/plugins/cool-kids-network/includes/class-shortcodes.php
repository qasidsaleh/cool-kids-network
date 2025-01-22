<?php
namespace CKN;

class Shortcodes {
    public function __construct() {
        add_shortcode('ckn_signup_form', [$this, 'signup_form']);
        add_shortcode('ckn_login_form', [$this, 'login_form']);
        add_shortcode('ckn_character_data', [$this, 'character_data']);
    }

    public function signup_form() {
        ob_start();
        include CKN_PLUGIN_DIR . 'templates/signup-form.php';
        return ob_get_clean();
    }

    public function login_form() {
        ob_start();
        include CKN_PLUGIN_DIR . 'templates/login-form.php';
        return ob_get_clean();
    }

    public function character_data() {
        ob_start();
        include CKN_PLUGIN_DIR . 'templates/character-data.php';
        return ob_get_clean();
    }

}
