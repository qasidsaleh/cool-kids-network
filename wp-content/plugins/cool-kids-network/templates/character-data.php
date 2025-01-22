<?php
global $wp_roles;
if (is_user_logged_in() & !current_user_can('administrator')) {
    $user_id = get_current_user_id();
    $user_info = get_userdata($user_id);
    //Get User Role
    $user_roles = $user_info->roles;
    $role_names = array_map(function ($role_key) use ($wp_roles) {
        return $wp_roles->roles[$role_key]['name'];
    }, $user_roles);

    echo '<h2>User Data</h2>';
    echo '<div class="user-data">';
    echo '<p><strong>First Name: </strong>' . get_user_meta($user_id, 'first_name', true) . '</p>';
    echo '<p><strong>Last Name: </strong>' . get_user_meta($user_id, 'last_name', true) . '</p>';
    echo '<p><strong>Country: </strong>' . get_user_meta($user_id, 'country', true) . '</p>';
    echo '<p><strong>Email Address: </strong>' . $user_info->user_email . '</p>';
    echo '<p><strong>Role: </strong>' . implode(', ', $role_names) . '</p>'; 
    echo '</div>';

} else {
    echo '<p>Please log in to view your character data.</p>';
}
?>
