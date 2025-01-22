<?php

namespace CKN;

use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;

class APIEndpoint extends WP_REST_Controller {

    /**
     * Register the custom REST API endpoints.
     */
    public static function register_endpoints() {
        add_action('rest_api_init', function () {
            // Test endpoint
            // register_rest_route('ckn/v1', '/test', [
            //     'methods'  => 'GET',
            //     'callback' => [__CLASS__, 'test_endpoint'],
            // ]);

            // Change role endpoint
            register_rest_route('ckn/v1', '/change-role', [
                'methods'             => 'POST',
                'callback'            => [__CLASS__, 'change_user_role'],
                'permission_callback' => '__return_true', // Ensure proper permission checks
            ]);
        });
    }

    /**
     * Test endpoint callback to ensure the API is working.
     */
    public static function test_endpoint() {
        return new WP_REST_Response(['message' => 'Test endpoint works!'], 200);
    }

    /**
     * Change user role endpoint callback.
     *
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public static function change_user_role(WP_REST_Request $request) {
        $email      = sanitize_email($request->get_param('email'));
        $new_role   = sanitize_text_field($request->get_param('role'));

        // Validate role
        $valid_roles = ['cool_kid', 'cooler_kid', 'coolest_kid'];
        if (!in_array($new_role, $valid_roles)) {
            return new WP_REST_Response(['error' => 'Invalid role specified.'], 400);
        }

        // Find user by email
        $user = get_user_by('email', $email);
        if (!$user) {
            return new WP_REST_Response(['error' => 'User not found by email.'], 404);
        }

        // Update the user's role
        $user->set_role($new_role);

        return new WP_REST_Response(['message' => 'User role updated successfully.'], 200);
    }
}
