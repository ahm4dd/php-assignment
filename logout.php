<?php
session_start();

$_SESSION = [];


/*
    session_destroy() does not unset the session cookie, so we need to do it manually.
    We check if we are using cookies for sessions, and if so, we clear the cookie for the client.
*/
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params(); // Get the current cookie parameters to ensure we delete the correct cookie
    setcookie(
        session_name(), // Get the name of the current session cookie
        '',
        time() - 42000, // Set the expiration time to a past time to delete the cookie
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

session_destroy();

header('Location: login.php');
exit;
