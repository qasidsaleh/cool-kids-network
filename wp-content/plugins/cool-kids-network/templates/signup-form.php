<form method="POST" action="">
    <input type="email" name="email" placeholder="Email Address" required />
    <button type="submit">Confirm</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = sanitize_email($_POST['email']);
    if (!email_exists($email)) {
        wp_create_user($email, wp_generate_password(), $email);
        echo '<p>Account created successfully!</p>';
    } else {
        echo '<p>Email already exists!</p>';
    }
}
?>
