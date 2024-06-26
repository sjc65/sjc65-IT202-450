<?php
require_once(__DIR__ . "/../lib/functions.php");
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = false; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "$BASE_PATH",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();


?>
<!-- include css and js files -->
<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<script src="<?php echo get_url('helpers.js'); ?>"></script>
<nav>
    <ul>
        <?php if (is_logged_in()) : ?>
            <li><a href="<?php echo get_url('home.php'); ?>">Home</a></li>
            <li><a href="<?php echo get_url('profile.php'); ?>">Profile</a></li>
            <li><a href="<?php echo get_url('favorites.php'); ?>">Favorites</a></li>
            <li><a href="<?php echo get_url('data_list.php'); ?>">Quotes</a></li>
            <li><a href="<?php echo get_url('api_gen.php'); ?>">Quote Gen.</a></li>
        <?php endif; ?>
        <?php if (!is_logged_in()) : ?>
            <li><a href="<?php echo get_url('login.php'); ?>">Login</a></li>
            <li><a href="<?php echo get_url('register.php'); ?>">Register</a></li>
        <?php endif; ?>
        <?php if (has_role("Admin")) : ?>
            <li><a href="<?php echo get_url('admin/create_role.php'); ?>">CreateRole</a></li>
            <li><a href="<?php echo get_url('admin/list_roles.php'); ?>">ListRoles</a></li>
            <li><a href="<?php echo get_url('admin/assign_roles.php'); ?>">AssignRoles</a></li>
            <li><a href="<?php echo get_url('admin/entity_association.php'); ?>">Entity Assoc.</a></li>
            <li><a href="<?php echo get_url('admin/user_association.php'); ?>">User Assoc.</a></li>
            <li><a href="<?php echo get_url('admin/api_data_list.php'); ?>">Non-User Assoc.</a></li>
        <?php endif; ?>
        <?php if (is_logged_in()) : ?>
            <li><a href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- Add the URLs you want to show in the nav bar for login, logout, or admin pages. -->