<?php

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();


$_SESSION['logged_in'] = "NO";
$_SESSION['fname'] = null;
$_SESSION['lname'] = null;
ini_set('session.gc_max_lifetime', 0);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);



header("location: login.php");

?>