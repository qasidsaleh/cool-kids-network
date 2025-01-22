<?php
namespace CKN;

class CharacterData {
    public function __construct() {
        // Generate random character data, including country, when a user registers
        add_action('user_register', [$this, 'generate_character_data']);

        // Add the country field to the user profile and edit screens
        add_action('show_user_profile', [$this, 'add_country_field_to_profile']);
        add_action('edit_user_profile', [$this, 'add_country_field_to_profile']);

        // Save the country field when updating the user profile
        add_action('personal_options_update', [$this, 'save_country_field']);
        add_action('edit_user_profile_update', [$this, 'save_country_field']);
    }

    /**
     * Generate random character data (including country) for a new user.
     *
     * @param int $user_id User ID.
     */
    public function generate_character_data($user_id) {
        $response = wp_remote_get('https://randomuser.me/api/');
        if (is_wp_error($response)) {
            error_log('Failed to fetch random user data.');
            return;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);
        if (!isset($data['results'][0])) {
            error_log('Invalid API response format.');
            return;
        }

        $user_data = $data['results'][0];

        // Update user meta with random data
        update_user_meta($user_id, 'first_name', $user_data['name']['first']);
        update_user_meta($user_id, 'last_name', $user_data['name']['last']);
        update_user_meta($user_id, 'country', $user_data['location']['country']);

        // Set default role to "Cool Kid" for the user
        $user = new \WP_User($user_id);
        if ($user) {
            $user->set_role('cool_kid'); // Ensure 'cool_kid' role is assigned
            error_log('Assigned role: ' . implode(', ', $user->roles)); // Debugging role assignment
        }
    }

    /**
     * Add the country field to user profile/edit screen.
     *
     * @param WP_User $user User object.
     */
    public function add_country_field_to_profile($user) {
        $country = get_user_meta($user->ID, 'country', true);
        ?>
        <h3>Additional User Data</h3>
        <table class="form-table">
            <tr>
                <th><label for="country">Country</label></th>
                <td>
                    <input type="text" name="country" id="country" value="<?php echo esc_attr($country); ?>" class="regular-text" />
                    <p class="description">User's country of residence.</p>
                </td>
            </tr>
        </table>
        <?php
    }

    /**
     * Save the country field when the user profile is updated.
     *
     * @param int $user_id User ID.
     */
    public function save_country_field($user_id) {
        // Check if the current user can edit the user profile
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        // Sanitize and update the 'country' field
        if (isset($_POST['country'])) {
            update_user_meta($user_id, 'country', sanitize_text_field($_POST['country']));
        }
    }
}
