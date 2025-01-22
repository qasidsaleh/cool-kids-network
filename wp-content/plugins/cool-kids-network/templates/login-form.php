<form method="POST" action="">
    <input type="email" name="email" placeholder="Enter your email" required />
    <button type="submit">Log In</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = sanitize_email($_POST['email']);
    $user = get_user_by('email', $email);

    if ($user) {
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        echo '<p>Login successful!</p>';
    } else {
        echo '<p>User not found!</p>';
    }
}
?>
