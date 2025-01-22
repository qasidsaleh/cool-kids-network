<?php
namespace CKN;

class Shortcodes {
    public function __construct() {
        add_shortcode('ckn_signup_form', [$this, 'signup_form']);
    }

    public function signup_form() {
        ob_start();
        include CKN_PLUGIN_DIR . 'templates/signup-form.php';
        return ob_get_clean();
    }
    
}
