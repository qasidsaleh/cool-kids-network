<?php
namespace CKN;

class UserAccess {
    public function __construct() {
        // Register shortcode to display the user list
        add_shortcode('user_list', [$this, 'display_user_list_based_on_role']);
    }

    /**
     * Display a list of all users (names and countries) based on the current user's role.
     *
     * @return string HTML content for the user list or a message.
     */
    public function display_user_list_based_on_role() {
        // Get the current user's roles
        $current_user = wp_get_current_user();
        $roles = $current_user->roles;

        // Check if the user has the "Cooler Kid" or "Coolest Kid" role
        if (in_array('cooler_kid', $roles)) {
            $users = get_users(); // Get all registered users

            ob_start(); // Start output buffering
            echo '<h2>List of Registered Users:</h2>';
            echo '<table style="width:100%; border-collapse:collapse;">';
            echo '<tr><th>Name</th><th>Country</th></tr>';

            foreach ($users as $user) {
                $first_name = get_user_meta($user->ID, 'first_name', true);
                $last_name = get_user_meta($user->ID, 'last_name', true);
                $country = get_user_meta($user->ID, 'country', true);

                echo '<tr>';
                echo '<td>' . esc_html($first_name . ' ' . $last_name) . '</td>';
                echo '<td>' . esc_html($country) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
            return ob_get_clean(); // Return the output buffer content
        } else if ( in_array('coolest_kid', $roles)) {
            $users = get_users(); // Get all registered users

            ob_start(); // Start output buffering
            echo '<h2>List of Registered Users</h2>';
            echo '<table style="width:100%; border-collapse:collapse;">';
            echo '<tr><th>Name</th><th>Country</th><th>Email</th><th>Role</th></tr>';

            foreach ($users as $user) {
                $first_name = get_user_meta($user->ID, 'first_name', true);
                $last_name = get_user_meta($user->ID, 'last_name', true);
                $country = get_user_meta($user->ID, 'country', true);
                $email = $user->user_email; // Get the email directly from the user object

                // Get user role(s)
                $roles = $user->roles;
                $role_name = !empty($roles) ? ucfirst($roles[0]) : '';

                echo '<tr>';
                echo '<td>' . esc_html($first_name . ' ' . $last_name) . '</td>';
                echo '<td>' . esc_html($country) . '</td>';
                echo '<td>' . esc_html($email) . '</td>';
                echo '<td>' . esc_html($role_name) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
            return ob_get_clean(); // Return the output buffer content
        }

        // If the user has the "Cool Kid" role, deny access
        if (in_array('cool_kid', $roles)) {
            return '';
        }

        // For any other roles
        return '';
    }
}
